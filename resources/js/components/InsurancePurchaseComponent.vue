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
                        <div class="form-group">
                            <label :for="'member-phone-number-' + index">Phone Number:</label>
                            <input type="text" class="form-control" :id="'member-phone-number-' + index" v-model="member.phoneNumber">
                        </div>
                        <button type="button" class="btn btn-secondary" @click="addMember" :disabled="!isLastMemberValid">Add Member</button>
                        <button type="button" class="btn btn-danger" @click="removeMember(index)">Remove Member</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            lastName: '',
            phoneNumber: '',
            policyType: 'individual',
            groupMembers: [{ name: '', lastName: '', phoneNumber: '' }]
        };
    },
    watch: {
        groupMembers: {
            handler() {
                this.checkLastMemberValidity();
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
                lastMember.phoneNumber.trim() !== ''
            );
        }
    },
    methods: {
        checkLastMemberValidity() {
            const lastMember = this.groupMembers[this.groupMembers.length - 1];
            return (
                lastMember.name.trim() !== '' &&
                lastMember.lastName.trim() !== '' &&
                lastMember.phoneNumber.trim() !== ''
            );
        },
        addMember() {
            if (this.isLastMemberValid) {
                this.groupMembers.push({ name: '', lastName: '', phoneNumber: '' });
            }
        },
        removeMember(index) {
            if (index > 0) {
                this.groupMembers.splice(index, 1);
            }
        },
        handlePolicyTypeChange() {
            if (this.policyType === 'individual') {
                this.groupMembers = [{ name: '', lastName: '', phoneNumber: '' }];
            }
        }
    }
};
</script>
