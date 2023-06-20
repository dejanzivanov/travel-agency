<template>
    <div class="container">
        <h1 class="text-center">Welcome to Insurance Purchasing</h1>
        <div class="row">
            <div class="col-md-4 pt-3 pb-3 m3-3">
                <div class="card h-100 mb-3 m-3 p-3">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" class="form-control" id="last-name" v-model="lastName">
                    </div>
                    <div class="form-group">
                        <label for="holiday-date">Holiday Duration:</label>

                        <date-picker class="form-control w-100" v-model="holidayDate" range format="DD.MM.YYYY." type="date" id="holiday-date"></date-picker>
                    </div>
                    <div class="form-group">
                        <label for="number-of-days">Number of Days:</label>
<!--                        <p>{{ holidayDate[1] }}  {{ holidayDate[0] }}</p>-->
                        <p name="number-of-days" class="form-control h-50">{{ numberOfDays }}</p>
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Phone Number:</label>
                        <input type="text" class="form-control" id="phone-number" v-model="phoneNumber">
                    </div>
                    <div class="form-group">
                        <label for="policy-type">Policy Type:</label>
                        <select class="form-control" id="policy-type" v-model="policyType" @change="handlePolicyTypeChange">
                            <option value="individual">Individual</option>
                            <option value="group">Group</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" v-if="policyType === 'group'">
                <div v-for="(member, index) in groupMembers" :key="index" class="col-md-4 pt-3 pb-3 m3-3">
                    <div class="card h-100 mb-3 m-3 p-3">
                        <h5>Group Member {{ index + 1 }}</h5>
                        <div class="form-group">
                            <label :for="'member-name-' + index">Name:</label>
                            <input type="text" class="form-control" :id="'member-name-' + index" v-model="member.name">
                        </div>
                        <div class="form-group">
                            <label :for="'member-last-name-' + index">Last Name:</label>
                            <input type="text" class="form-control" :id="'member-last-name-' + index" v-model="member.lastName">
                        </div>
                        <div class="form-group pt-3">
                            <label :for="'member-date-birth-' + index">Date Of Birth :</label>
<!--                            <input type="text" class="form-control" :id="'member-phone-number-' + index" v-model="member.dateOfBirth">-->
                                <date-picker  class="form-control" v-model="member.dateOfBirth" type="date" format="DD.MM.YYYY."></date-picker>
                        </div>
                        <button type="button" class="btn btn-secondary" @click="addMember" v-if="index === groupMembers.length - 1 && isLastMemberValid">Add Member</button>
                        <button type="button" class="btn btn-danger" @click="removeMember(index)" v-if="index === groupMembers.length - 1 && groupMembers.length > 1">Remove Member</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-5">
            <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-success" @click="purchase" :disabled="isPurchaseDisabled">Purchase</button>
            </div>
        </div>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import Swal from 'sweetalert2';
export default {
    components: { DatePicker },
    data() {
        return {
            name: '',
            lastName: '',
            phoneNumber: '',
            policyType: 'individual',
            holidayDate: '',
            numberOfDays: '',
            groupMembers: [{ name: '', lastName: '', dateOfBirth: '' }]
        };
    },
    watch: {
        groupMembers: {
            handler() {
                this.checkLastMemberValidity();
            },
            deep: true
        },
        holidayDate: {
            handler() {
                this.numberOfDays = (this.holidayDate[1] - this.holidayDate[0]) / (1000 * 60 * 60 * 24);
            },
            deep: true
        }

    },
    computed: {
        isLastMemberValid() {
            const lastMember = this.groupMembers[this.groupMembers.length - 1];
            return (
                lastMember.name.trim() !== '' &&
                lastMember.lastName.trim() !== '' &&
                // lastMember.dateOfBirth !== ''
                (lastMember.dateOfBirth !== '' && lastMember.dateOfBirth !== null)

            );
        },
        isPurchaseDisabled() {
            if (this.policyType === 'individual') {
                return (
                    this.name.trim() === '' ||
                    this.lastName.trim() === '' ||
                    this.phoneNumber.trim() === '' ||
                    this.numberOfDays.trim() === '' ||
                    !this.holidayDate ||
                    this.holidayDate[0] === null ||
                    this.holidayDate[1] === null
                );
            } else if (this.policyType === 'group') {
                if (
                    this.name.trim() === '' ||
                    this.lastName.trim() === '' ||
                    this.phoneNumber.trim() === '' ||
                    this.numberOfDays === '' ||
                    !this.holidayDate ||
                    this.holidayDate[0] === null ||
                    this.holidayDate[1] === null
                ) {
                    return true;
                }
                return this.groupMembers.some(
                    member =>
                        member.name.trim() === '' ||
                        member.lastName.trim() === '' ||
                        !member.dateOfBirth
                );
            }
            return true;
            // if (this.policyType === 'individual') {
            //     return (
            //         // this.name.trim() === '' ||
            //         // this.lastName.trim() === '' ||
            //         // this.phoneNumber.trim() === '' ||
            //         // this.numberOfDays.trim() === '' ||
            //         //     this.holidayDate.trim() === '' ||
            //         // (this.holidayDate !== '' && this.holidayDate !== null)
            //         this.name.trim() === '' ||
            //         this.lastName.trim() === '' ||
            //         this.phoneNumber.trim() === '' ||
            //         this.numberOfDays.trim() === '' ||
            //         // (String(this.numberOfDays).trim() !== '' && this.numberOfDays !== null) ||
            //         this.holidayDate.trim() === '' ||
            //         (this.holidayDate[0] === '' || this.holidayDate[1] === '' || this.holidayDate === undefined || this.holidayDate === null)
            //     // );
            //
            //     );
            // // } else if (this.policyType === 'group') {
            // //     return (
            // //         this.groupMembers.every(member => member.name.trim() === '' && member.lastName.trim() === '' && (String(member.dateOfBirth).trim() !== '' && member.dateOfBirth !== null))
            // //     );
            // }
            // else if (this.policyType === 'group') {
            //     if(
            //     this.name.trim() === '' ||
            //     this.lastName.trim() === '' ||
            //     this.phoneNumber.trim() === '' ||
            //     this.numberOfDays === '' || this.numberOfDays === null || this.numberOfDays === undefined ||
            //     // (String(this.numberOfDays).trim() !== '' && this.numberOfDays !== null) ||
            //     this.holidayDate === '' ||
            //     (this.holidayDate[0] === '' || this.holidayDate[1] === '' || this.holidayDate === undefined || this.holidayDate === null))
            //     {
            //         return true;
            //
            //     }
            //     return this.groupMembers.every(member => (
            //         member.name.trim() === '' ||
            //         member.lastName.trim() === '' ||
            //         // member.dateOfBirth.trim() === '' ||
            //         // member.dateOfBirth === null
            //         member.dateOfBirth === '' ||
            //         member.dateOfBirth === null
            //     ))
            // }
            // console.log('123');
            // return true;
        }
    },
    methods: {
        checkLastMemberValidity() {
            const lastMember = this.groupMembers[this.groupMembers.length - 1];
            return (
                lastMember.name.trim() !== '' &&
                lastMember.lastName.trim() !== '' &&
                lastMember.dateOfBirth !== ''
            );
        },
        addMember() {
            if (this.isLastMemberValid) {
                this.groupMembers.push({ name: '', lastName: '', dateOfBirth: '' });
            }
        },
        removeMember(index) {
            if (index > 0) {
                this.groupMembers.splice(index, 1);
            }
        },
        handlePolicyTypeChange() {
            if (this.policyType === 'individual') {
                this.groupMembers = [{ name: '', lastName: '', dateOfBirth: '' }];
            }
        },
        createDataObject() {
            return {
                name: this.name,
                lastName: this.lastName,
                phoneNumber: this.phoneNumber,
                holidayDate: this.holidayDate,
                policyType: this.policyType,
                groupMembers: this.groupMembers,
            }
        },
        purchase()
        {
            const data = this.createDataObject();

            axios.post('/insurance-request', data)
                .then(response => {
                    console.log(response);
                    Swal.fire({
                        title: 'Your Deki Scam Insurance Purchase was successfull!',
                        allowOutsideClick: false,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect the user to the desired page
                            window.location.href = '/';
                        }
                    })
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
