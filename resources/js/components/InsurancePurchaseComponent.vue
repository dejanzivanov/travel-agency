<!--<template>-->
<!--    <div class="bg-dark text-white p-3">-->
<!--        <h3>Insurance Purchase</h3>-->
<!--        <div class="form-group">-->
<!--            <label for="name">Name:</label>-->
<!--            <input type="text" class="form-control" id="name" v-model="name">-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="last-name">Last Name:</label>-->
<!--            <input type="text" class="form-control" id="last-name" v-model="lastName">-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="phone-number">Phone Number:</label>-->
<!--            <input type="text" class="form-control" id="phone-number" v-model="phoneNumber">-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="policy-type">Policy Type:</label>-->
<!--            <select class="form-control" id="policy-type" v-model="policyType" @change="handlePolicyTypeChange">-->
<!--                <option value="individual">Individual</option>-->
<!--                <option value="group">Group</option>-->
<!--            </select>-->
<!--        </div>-->
<!--        <div v-if="policyType === 'group'">-->
<!--            <div v-for="(member, index) in groupMembers" :key="index" class="mb-3">-->
<!--                <h5>Group Member {{ index + 1 }}</h5>-->
<!--                <div class="form-group">-->
<!--                    <label for="member-name">Name:</label>-->
<!--                    <input type="text" class="form-control" :id="'member-name-' + index" v-model="member.name">-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="member-last-name">Last Name:</label>-->
<!--                    <input type="text" class="form-control" :id="'member-last-name-' + index" v-model="member.lastName">-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="member-phone-number">Phone Number:</label>-->
<!--                    <input type="text" class="form-control" :id="'member-phone-number-' + index" v-model="member.phoneNumber">-->
<!--                </div>-->
<!--                <button type="button" class="btn btn-secondary" @click="addMember">Add Member</button>-->
<!--                <button type="button" class="btn btn-danger" @click="removeMember(index)" v-if="index > 0">Remove Member</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    data() {-->
<!--        return {-->
<!--            name: '',-->
<!--            lastName: '',-->
<!--            phoneNumber: '',-->
<!--            policyType: 'individual',-->
<!--            groupMembers: [{ name: '', lastName: '', phoneNumber: '' }]-->
<!--        };-->
<!--    },-->
<!--    methods: {-->
<!--        handlePolicyTypeChange() {-->
<!--            if (this.policyType === 'individual') {-->
<!--                this.groupMembers = [{ name: '', lastName: '', phoneNumber: '' }];-->
<!--            }-->
<!--        },-->
<!--        addMember() {-->
<!--            this.groupMembers.push({ name: '', lastName: '', phoneNumber: '' });-->
<!--        },-->
<!--        removeMember(index) {-->
<!--            this.groupMembers.splice(index, 1);-->
<!--        }-->
<!--    }-->
<!--};-->
<!--</script>-->

<!--<style scoped>-->
<!--.form-group {-->
<!--    margin-bottom: 15px;-->
<!--}-->
<!--</style>-->
<template>
    <div class="bg-dark text-white p-3 d-flex align-items-center justify-content-center vh-100">
        <div class="card">
            <h3>Insurance Purchase</h3>
            <div class="card">

            </div>

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
            <div v-if="policyType === 'group'">
                <div v-for="(member, index) in groupMembers" :key="index" class="mb-3">
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
                    <button type="button" class="btn btn-secondary" @click="addMember">Add Member</button>
                    <button type="button" class="btn btn-danger" @click="removeMember(index)" v-if="index > 0">Remove Member</button>
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
    methods: {
        handlePolicyTypeChange() {
            if (this.policyType === 'individual') {
                this.groupMembers = [{ name: '', lastName: '', phoneNumber: '' }];
            }
        },
        addMember() {
            this.groupMembers.push({ name: '', lastName: '', phoneNumber: '' });
        },
        removeMember(index) {
            if (this.groupMembers.length === 1) {
                // Clear the fields of the only member instead of removing it
                this.groupMembers[0] = { name: '', lastName: '', phoneNumber: '' };
            } else {
                this.groupMembers.splice(index, 1);
            }
        }
    }
};
</script>

<style scoped>
.form-group {
    margin-bottom: 15px;
}
</style>
