<template>
    <div class="container">
        <h1 class="text-center text-white">Welcome to Insurance Purchasing</h1>
        <div class="row">
            <div class="col-md-4 pt-3 pb-3 m3-3">
                <div class="card h-100 mb-3 m-3 p-3">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" v-on:keydown="resetNameErrors" class="form-control" id="name" v-model="name">
                        <div v-for="error in nameErrors" :key="error"><span class="text-red">{{ error }}</span></div>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" v-on:keydown="resetLastNameErrors"  class="form-control" id="last-name" v-model="lastName">
                        <div v-for="error in lastNameErrors" :key="error"><span class="text-red">{{ error }}</span></div>
                    </div>
                    <div class="form-group">
                        <label for="holiday-date">Holiday Duration:</label>

                        <date-picker :disabled-date="disabledDate" class="form-control w-100"  @change="resetDateErrors" v-model="holidayDate" range format="DD.MM.YYYY." type="date" id="holiday-date"></date-picker>
                    </div>
                    <div class="form-group">
                        <label for="number-of-days">Number of Days:</label>
<!--                        <p>{{ holidayDate[1] }}  {{ holidayDate[0] }}</p>-->
                        <p style="min-height: 40px" name="number-of-days pt-2" class="form-control h-50 mb-0 pt-0 ">{{ numberOfDays }}</p>
                        <div v-for="error in dateErrors" :key="error"><span class="text-red pt-2 mt-2">{{ error }}</span></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone-number">Phone Number:</label>
                        <input type="text" class="form-control" v-on:keydown="resetPhoneNumberErrors" id="phone-number" v-model="phoneNumber">
                        <div v-for="error in phoneNumberErrors" :key="error"><span class="text-red">{{ error }}</span></div>
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
                <div :id="index" v-for="(member, index) in groupMembers" :key="index" class="col-md-4 pt-3 pb-3 m3-3">
                    <div class="card h-100 mb-3 m-3 p-3">
                        <h5>Group Member {{ index + 1 }}</h5>
                        <div class="form-group">
                            <label :for="'member-name-' + index">Name:</label>
                            <input type="text" class="form-control" v-on:keydown="resetDependentsNameErrors" :id="'member-name-' + index" v-model="member.name">
                            <div v-for="error in dependentNameErrors" :key="error"><span class="text-red">{{ error }}</span></div>
                        </div>
                        <div class="form-group pt-3">
                            <label :for="'member-last-name-' + index">Last Name:</label>
                            <input type="text" class="form-control" v-on:keydown="resetDependentsLastNameErrors" :id="'member-last-name-' + index" v-model="member.lastName">
                            <div v-for="error in dependentLastNameErrors" :key="error"><span class="text-red">{{ error }}</span></div>
                        </div>
                        <div class="form-group pt-3" :id="'dependent-birth-date-' + index">
                            <label :for="'member-date-birth-' + index">Date Of Birth :</label>
                                <date-picker  id="dependent-date-picker" class="form-control" v-model="member.dateOfBirth" type="date" format="DD.MM.YYYY."></date-picker>
                            <div v-for="error in dependentDateErrors" :key="error"><span class="text-red">{{ error }}</span></div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-3" @click="addMember" v-if="index === groupMembers.length - 1 && isLastMemberValid">Add Member</button>
                        <button type="button" class="btn btn-danger mt-3" @click="removeMember(index)" >Remove Member</button>

                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-5 pt-5">
            <div class="d-flex justify-content-center align-items-center">
<!--                <button type="button" class="btn btn-success" @click="purchase" :disabled="isPurchaseDisabled">Purchase</button>-->
                <button type="button" class="btn btn-success" @click="purchase">Purchase</button>
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
            groupMembers: [{ name: '', lastName: '', dateOfBirth: '' }],
            nameErrors: [],
            lastNameErrors: [],
            dateErrors: [],
            phoneNumberErrors: [],
            dependentNameErrors: [],
            dependentLastNameErrors: [],
            dependentDateErrors: [],





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
                    this.numberOfDays === '' ||
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
            else if(index === 0 && this.groupMembers.length === 1)

            {   this.policyType = 'individual';
                this.groupMembers.splice(0, 1);
                this.handlePolicyTypeChange();
            }
            else if(index === 0 && this.groupMembers.length > 1)
            {
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
            if(this.name === '' || this.name === null || this.name === undefined)
            {
                if (!this.nameErrors.includes('Name is required')) {
                    this.nameErrors.push('Name is required');
                }
                return;
            }
            if(this.lastName === '' || this.lastName === null || this.lastName === undefined)
            {
                if (!this.lastNameErrors.includes('Last Name is required')) {
                    this.lastNameErrors.push('Last Name is required');
                }
                return;
            }
            if(this.holidayDate === '' || this.holidayDate === null || this.holidayDate === undefined)
            {
                if (!this.dateErrors.includes('Date is required')) {
                    this.dateErrors.push('Date is required');
                }
                return;
            }
            if(this.phoneNumber === '' || this.phoneNumber === null || this.phoneNumber === undefined)
            {
                if (!this.phoneNumberErrors.includes('Phone Number is required')) {
                    this.phoneNumberErrors.push('Phone Number is required');
                }
                return;
            }

            //ovde

            const self = this;

            for (let i = 0; i < this.groupMembers.length; i++) {
                if(this.groupMembers[i].name === '' || this.groupMembers[i].name === null || this.groupMembers[i].name === undefined)
                {
                    let box = document.getElementById("member-name-" + i);

                    if (!document.getElementById('error-message-name-' + i))
                    {
                        box.insertAdjacentHTML('afterend', '<div id="error-message-name-' + i + '"><span class="text-red" style="color: red">Name is required!</span></div>');
                    }

                    return;
                }
                if(this.groupMembers[i].lastName === '' || this.groupMembers[i].lastName === null || this.groupMembers[i].lastName === undefined)
                {
                    let box = document.getElementById("member-last-name-" + i);
                    if (!document.getElementById('error-message-last-name-' + i)) {
                        box.insertAdjacentHTML('afterend', '<div id="error-message-last-name-' + i + '"><span class="text-red" style="color: red">Last Name is required!</span></div>');
                    }
                         return;
                }
                if(this.groupMembers[i].dateOfBirth === '' || this.groupMembers[i].dateOfBirth === null || this.groupMembers[i].dateOfBirth === undefined)
                {
                    if (!document.getElementById('error-message-birth-date-' + i)) {
                        let box1 = document.getElementById("dependent-birth-date-" + i);
                        box1.insertAdjacentHTML('beforeend', '<div  id="error-message-birth-date-' + i + '"><span class="text-red" style="color: red">Date is required!</span></div>');
                    }
                    return;
                }
            }





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
                            this.showSuccessToast('Your Deki Scam Insurance Purchase was successfull!')
                            this.isPurchaseDisabled = true;
                            setTimeout(() => {
                                window.location.href = '/';
                            }, 1000);
                        }
                    })
                })
                .catch(error => {
                    console.log(error);
                });
        },
        showSuccessToast(message)
        {
            this.$toast.success(message, {
                transition: "Vue-Toastification__fade",
                position: "top-right",
                timeout: 2000,
                closeOnClick: true,
                pauseOnFocusLoss: false,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                hideProgressBar: false,
                closeButton: "button",
                newestOnTop: true,
                icon: true,
                rtl: false,
            });
        },
        disabledDate(date) {
            const currentDate = new Date(); // Get the current date and time
            return date.getTime() < currentDate.getTime(); // Disable dates before the current moment
        },
        resetNameErrors() {
            this.nameErrors = [];
        },
        resetLastNameErrors() {
            this.lastNameErrors = [];
        },
        resetPhoneNumberErrors() {
            this.phoneNumberErrors = [];
        },
        resetDateErrors() {
            this.dateErrors = [];
        },
        resetDependentsNameErrors() {
            this.dependentNameErrors = [];
        },
        resetDependentsLastNameErrors() {
            this.dependentLastNameErrors = [];
        },
    }
};
</script>


<style scoped>


.text-red {
    color: red!important;
}

.form-control {
    background-color: #222;
    border: none;
    color: #fff;
}

.form-control:focus {
    background-color: #333;
    color: #fff;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.form-label {
    color: #000;
}
</style>
