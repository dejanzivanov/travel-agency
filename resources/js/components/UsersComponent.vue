

<template>
    <div class="container">
        <div class="row">
            <h1 class="text-center pt-4 text-white">Users</h1>
        </div>
        <div class="d-flex justify-content-end py-3">
            <button class="btn btn-dark my-auto create-new-user" :disabled="createNewUserButton" data-bs-toggle="modal" data-bs-target="#createUserModal">Create new user</button>
        </div>
        <div>
            <table id="users-table" class="display text-white">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Account Type</th>
                    <th>Phone Number</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title black-text" id="createUserModalLabel">Create New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createUserForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" v-on:keydown="resetCreateNameErrors" v-model="newUserName" class="form-control" id="name" name="name" required>
                                <div v-for="error in createNameErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" v-on:keydown="resetCreateLastNameErrors" v-model="newUserLastName" class="form-control form-control-dark" id="lastName" name="lastName" required>
                                <div v-for="error in createLastNameErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" v-on:keydown="resetCreateEmailErrors"  v-model="newUserEmail" class="form-control form-control-dark" id="email" name="email" required>
                                <div v-for="error in createEmailErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" v-on:keydown="resetCreatePasswordErrors" v-model="newUserPassword" class="form-control" id="password" name="password" required>
                                <div v-for="error in createPasswordErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="accountType" class="form-label">Account Type</label>
                                <select class="form-select form-control-dark" v-model="newUserAccountType" id="accountType" name="accountType" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <div v-for="error in createAccountTypeErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" v-on:keydown="resetCreatePhoneNumberErrors" v-model="newUserPhoneNumber" class="form-control" id="phoneNumber" name="phoneNumber" required>
                                <div v-for="error in createPhoneNumberErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-dark create-user2">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title black-text" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            <input type="hidden" id="editUserId" name="userId">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" v-on:keydown="resetUpdateName" v-model="updateUserName" class="form-control" id="editName" name="name" required>
                                <div v-for="error in updateNameErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text"  v-on:keydown="resetUpdateLastName" v-model="updateUserLastName" class="form-control form-control-dark" id="editLastName" name="lastName" required>
                                <div v-for="error in updateLastNameErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" v-on:keydown="resetUpdateEmail"  v-model="updateUserEmail" class="form-control form-control-dark" id="editEmail" name="email" required>


                                <div v-for="error in updateEmailErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editPassword" class="form-label">Password</label>
                                <input type="password"  v-on:keydown="resetUpdatePassword" v-model="updateUserPassword" class="form-control form-control-dark" id="editPassword" name="password" required>
                                <div v-for="error in updatePasswordErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editAccountType" class="form-label">Account Type</label>
                                <select class="form-select form-control-dark" v-model="updateUserAccountType" id="editAccountType" name="accountType" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <div v-for="error in updateAccountTypeErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="editPhoneNumber"  class="form-label">Phone Number</label>
                                <input type="text" v-on:keydown="resetUpdatePhoneNumber" v-model="updateUserPhoneNumber" class="form-control" id="editPhoneNumber" name="phoneNumber" required>
                                <div v-for="error in updatePhoneNumberErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-dark edit-user2">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import $ from 'jquery';
import datatable from 'datatables.net';
import Swal from 'sweetalert2';
import moment from "moment/moment";

export default
{
    mounted: function ()
    {
        const self = this;
        this.initTable();
        $(document).on('click', '.dugme', function ()
        {
            const id = $(this).data('id');
            console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    self.destroyUser(id);
                    self.destroyTable();
                    self.initTable();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });

        $(document).on('click', '.create-new-user', function() {
            console.log('create user');
            $('#createUserModal').modal('show'); // Show the modal
        });

        // Create user button click event
        $(document).on('click', '.create-user2', function() {

            self.createUser();
        });

        $('#createUserModal').on('hidden.bs.modal', function (e) {
            // Check if the modal being closed is the create user modal
            if (e.target.id === 'createUserModal') {
                // Remove the modal backdrop element
                $('.modal-backdrop').remove();

                // Reset the form
                $('#createUserForm')[0].reset();
            }
        });

        $(document).on('click', '.edit-dugme', function() {
            const userId = $(this).data('id');
            self.openEditUserModal(userId);
        });
        $(document).on('click', '.edit-user2', function () {

            self.saveChanges();
            // self.destroyTable();
            // self.initTable();
        });

        // $('#createUserModal').on('hidden.bs.modal', function (e) {
        //     // self.createNewUserButton = false;
        //
        // })
    },
    data()
    {
        return {
            users: [],
            createNewUserButton: false,
            newUserName: '',
            newUserLastName: '',
            newUserEmail: '',
            newUserPassword: '',
            newUserAccountType: '',
            newUserPhoneNumber: '',

            updateUserName: '',
            updateUserLastName: '',
            updateUserEmail: '',
            updateUserPassword: '',
            updateUserAccountType: '',
            updateUserPhoneNumber: '',

            updateEmailErrors: [],
            updateNameErrors: [],
            updateLastNameErrors: [],
            updatePasswordErrors: [],
            updateAccountTypeErrors: [],
            updatePhoneNumberErrors: [],

            createEmailErrors: [],
            createPasswordErrors: [],
            createLastNameErrors: [],
            createNameErrors: [],
            createAccountTypeErrors: [],
            createPhoneNumberErrors: [],
        };
    },
    methods:
    {
        resetUpdateEmail()
        {
            this.updateEmailErrors = [];
        },
        resetUpdateName()
        {
            this.updateNameErrors = [];
        },
        resetUpdateLastName()
        {
            this.updateLastNameErrors = [];
        },
        resetUpdatePassword()
        {
            this.updatePasswordErrors = [];
        },
        resetUpdatePhoneNumber()
        {
            this.updatePhoneNumberErrors = [];
        },
        resetCreateNameErrors()
        {
            this.createNameErrors = [];
        },
        resetCreateLastNameErrors()
        {
            this.createLastNameErrors = [];
        },
        resetCreateEmailErrors()
        {
            this.createEmailErrors = [];
        },
        resetCreatePasswordErrors()
        {
            this.createPasswordErrors = [];
        },
        resetCreatePhoneNumberErrors()
        {
            this.createPhoneNumberErrors = [];
        },

        initTable()
        {
            const self = this;
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: '/users-data',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {},
                },
                autoWidth: false,
                // responsive: true,
                columns: [
                    { title: 'ID', data: 'id'},
                    { title: 'Name', data: 'name'},
                    { title: 'Last Name', data: 'last_name'},
                    { title: 'Email', data: 'email'},
                    // { title: 'Password', data: 'password'},
                    {
                        title: 'Password',
                        data: 'password',
                        render: function(data, type, row) {
                            var truncatedPassword = data.length > 8 ? data.substr(0, 8) + '...' : data;
                            return '<span class="password" title="' + data + '">' + truncatedPassword + '</span>';
                        }
                    },
                    { title: 'Account Type', data: 'account_type'},
                    { title: 'Phone Number', data: 'phone_number'},
                    { title: 'Created At',
                        data: 'created_at', render: function(data, type, row) {
                            if(data != null) {
                                return '<span class="created_at" title="' + data + '">' + moment(data).format('DD.MM.YYYY') + '</span>';
                            }
                            else
                                return data;
                        },
                    },
                    { title: 'Actions', orderable: false, data: 'id', render: function (data, type, row)
                        {
                            return '<div class="d-flex justify-content-around"><button class="btn btn-danger dugme" data-id="' + data + '">Delete</button><button class="btn btn-dark edit-dugme" data-id="' + data + '">Edit</button></div>';
                        }
                    },

                ],
            });
        },
        destroyTable()
        {
            const dataTable = $('#users-table').DataTable();
            dataTable.destroy();
        },
        destroyUser(id)
        {
            axios.post('/user-delete', {id: id})
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createUser() {
            const form = document.getElementById('createUserForm');
            const formData = new FormData(form);
            if(this.newUserName === null || this.newUserName === '' || this.newUserName === undefined)
            {
                // this.showWarningToast('Name is required!');
                // return;
                if (!this.createNameErrors.includes('Name is required')) {
                    this.createNameErrors.push('Name is required');
                }
                return;
            }
            if(this.newUserLastName === null || this.newUserLastName === '' || this.newUserLastName === undefined)
            {
                // this.showWarningToast('Last Name is required');
                // return;
                if (!this.createLastNameErrors.includes('Last Name is required')) {
                    this.createLastNameErrors.push('Last Name is required');
                }
                return;
            }
            if(this.newUserEmail === null || this.newUserEmail === '' || this.newUserEmail === undefined)
            {
                // this.showWarningToast('Email is required');
                // return;
                if (!this.createEmailErrors.includes('Email is required')) {
                    this.createEmailErrors.push('Email is required');
                }
                return;
            }
            else
            {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(this.updateUserEmail)) {
                    // this.showWarningToast('Email is invalid');
                    // return;
                    if (!this.createEmailErrors.includes('Email is invalid')) {
                        this.createEmailErrors.push('Email is invalid');
                    }
                    return;
                }
            }
            if(this.newUserPassword)
            {
                // Password rules
                const passwordRules = [
                    // Rule 1: Minimum length of 8 characters
                    {
                        rule: this.newUserPassword.length >= 8,
                        message: 'Password should have a minimum length of 8 characters.',
                    },
                    // Rule 2: Contains at least one uppercase letter
                    {
                        rule: /[A-Z]/.test(this.newUserPassword),
                        message: 'Password should contain at least one uppercase letter.',
                    },
                    // Rule 3: Contains at least one lowercase letter
                    {
                        rule: /[a-z]/.test(this.newUserPassword),
                        message: 'Password should contain at least one lowercase letter.',
                    },
                    // Rule 4: Contains at least one digit
                    {
                        rule: /[0-9]/.test(this.newUserPassword),
                        message: 'Password should contain at least one digit.',
                    },
                    // Rule 5: Contains at least one special character
                    {
                        rule: /[!@#$%^&*]/.test(this.newUserPassword),
                        message: 'Password should contain at least one special character.',
                    },
                    // Rule 6: Does not contain spaces
                    {
                        rule: !/\s/.test(this.newUserPassword),
                        message: 'Password should not contain spaces.',
                    },
                    // Rule 7: Does not start or end with whitespace
                    {
                        rule: !/^\s|\s$/.test(this.newUserPassword),
                        message: 'Password should not start or end with whitespace.',
                    },
                    // Rule 8: Does not match the user's name or last name
                    {
                        rule:
                            this.newUserPassword.toLowerCase().indexOf(this.newUserName.toLowerCase()) === -1 &&
                            this.newUserPassword.toLowerCase().indexOf(this.newUserLastName.toLowerCase()) === -1,
                        message: 'Password should not match your name or last name.',
                    },
                    // Rule 9: Does not contain sequences of repeated characters (e.g., "aaa" or "111")
                    {
                        rule: !/(.)\1\1/.test(this.newUserPassword),
                        message: 'Password should not contain sequences of repeated characters.',
                    },
                    // Rule 10: Add your custom rule here
                    // Example: At least one special character from a specific set
                    {
                        rule: /[!@#$%^&*]/.test(this.newUserPassword),
                        message: 'Password should contain at least one special character from the set: !@#$%^&*',
                    },
                ];

                // Check each password rule and show toast for failed rules
                const failedRules = passwordRules.filter(rule => !rule.rule);
                if (failedRules.length > 0) {
                    failedRules.forEach(rule => {
                        // this.showWarningToast(rule.message);
                        if (!this.createPasswordErrors.includes(rule.message)) {
                            this.createPasswordErrors.push(rule.message);
                        }
                    });
                    return;
                }
            }
            if(this.newUserPassword === '' || this.newUserPassword === null || this.newUserPassword === undefined)
            {
                // this.showWarningToast('Password is required');
                // return;
                if (!this.createPasswordErrors.includes('Password is required')) {
                    this.createPasswordErrors.push('Password is required');
                }
                return;
            }
            if(this.newUserAccountType === '' || this.newUserAccountType === null || this.newUserAccountType === undefined)
            {
                // this.showWarningToast('Account Type is required');
                // return;
                if (!this.createAccountTypeErrors.includes('Account Type is required')) {
                    this.createAccountTypeErrors.push('Account Type is required');
                }
                return;
            }
            if(this.newUserPhoneNumber === '' || this.newUserPhoneNumber === null || this.newUserPhoneNumber === undefined)
            {
                // this.showWarningToast('Phone Number is required');
                // return;
                if (!this.createPhoneNumberErrors.includes('Phone Number is required')) {
                    this.createPhoneNumberErrors.push('Phone Number is required');
                }
                return;
            }


            // Check if any required fields are empty
            let hasEmptyFields = false;
            for (const value of formData.values()) {
                console.log(formData.get('name'));

                if (!value) {
                    hasEmptyFields = true;
                    // break;
                }
            }

            if (hasEmptyFields) {
                $('#createUserModal').addClass('shake'); // Add the shake class to the modal
                // this.showWarningToast('All fields are required!'); // Show a warning toast

                // Remove the shake class after the animation completes
                setTimeout(() => {
                    $('#createUserModal').removeClass('shake');
                }, 1000);
            } else {
                // All fields are filled, proceed with user creation logic

                // Prepare the data for submission
                const userData = {};
                for (const [key, value] of formData.entries()) {
                    userData[key] = value;
                }

                // Make the API call to create a new user
                axios.post('/create-user', userData)
                    .then(response => {
                        // User creation successful, show success message


                        // Close the modal and reset the form
                        if (response.data.error && response.data.error.startsWith('SQLSTATE[23000]')) {
                            this.showWarningToast('Duplicate email');
                            return;
                        }
                       else if(response.status == 500)
                        {
                            this.showWarningToast('There has been an error1');
                            return;
                        }
                        else if(response.status == 200)
                        {
                            this.showSuccessToast('User created successfully.2');
                            this.createNewUserButton = true;


                        }
                        else
                        {
                            this.showWarningToast('There has been an error3');
                            return;
                        }


                        Swal.fire({
                            title: 'Success',
                            text: 'User created successfully.',
                            icon: 'success',
                        });


                        form.reset();
                        $('#createUserModal').modal('hide');

                        // Refresh the table to display the updated user list
                        this.destroyTable();
                        this.initTable();
                        this.createNewUserButton = true;

                        setTimeout(() => {
                            this.createNewUserButton = false;

                        }, 5000);
                    })
            }
        },
        openEditUserModal(userId) {
            // Get the user data from the server based on the userId
            axios.post('/user/' + userId)
                .then(response => {
                    const userData = response.data;
                    console.log("mlem", userData);
                    console.log("mlem", userData[0].id);
                    const self = this;

                    $('#editUserModal').modal('show');

                    $('#editUserModal').on('shown.bs.modal', function () {

                        $('#editUserId').val(userData[0].id);
                        self.updateUserName = userData[0].name;
                        self.updateUserLastName = userData[0].last_name;
                        self.updateUserEmail = userData[0].email;
                        self.updateUserAccountType = userData[0].account_type;
                        self.updateUserPhoneNumber = userData[0].phone_number;




                        $('#editUserModal').off('shown.bs.modal');
                    });

                    // // Show the edit modal

                })
                .catch(error => {
                    console.error(error);
                });
        },
        saveChanges() {



            if (this.updateUserName === null || this.updateUserName === '' || this.updateUserName === undefined) {
                if (!this.updateNameErrors.includes('Name is required')) {
                    this.updateNameErrors.push('Name is required');
                }
                return;
            }

            if (this.updateUserLastName === null || this.updateUserLastName === '' || this.updateUserLastName === undefined) {
                // this.showWarningToast('Last Name is required');
                if (!this.updateLastNameErrors.includes('Last Name is required')) {
                    this.updateLastNameErrors.push('Last Name is required');
                }
                return;
            }

            if (this.updateUserEmail === null || this.updateUserEmail === '' || this.updateUserEmail === undefined) {
                // this.showWarningToast('Email is required');
                if (!this.updateEmailErrors.includes('Email is required')) {
                    this.updateEmailErrors.push('Email is required');
                }
                return;
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(this.updateUserEmail)) {
                    // this.showWarningToast('Email is invalid');
                    if (!this.updateEmailErrors.includes('Email is invalid')) {
                        this.updateEmailErrors.push('Email is invalid');
                    }
                    return;
                }
            }

            if (this.updateUserPassword) {
                const passwordRules = [
                    {
                        rule: this.updateUserPassword.length >= 8,
                        message: 'Password should have a minimum length of 8 characters.',
                    },
                    {
                        rule: /[A-Z]/.test(this.updateUserPassword),
                        message: 'Password should contain at least one uppercase letter.',
                    },
                    {
                        rule: /[a-z]/.test(this.updateUserPassword),
                        message: 'Password should contain at least one lowercase letter.',
                    },
                    {
                        rule: /[0-9]/.test(this.updateUserPassword),
                        message: 'Password should contain at least one digit.',
                    },
                    {
                        rule: /[!@#$%^&*]/.test(this.updateUserPassword),
                        message: 'Password should contain at least one special character.',
                    },
                    {
                        rule: !/\s/.test(this.updateUserPassword),
                        message: 'Password should not contain spaces.',
                    },
                    {
                        rule: !/^\s|\s$/.test(this.updateUserPassword),
                        message: 'Password should not start or end with whitespace.',
                    },
                    {
                        rule:
                            this.updateUserPassword.toLowerCase().indexOf(this.updateUserName.toLowerCase()) === -1 &&
                            this.updateUserPassword.toLowerCase().indexOf(this.updateUserLastName.toLowerCase()) === -1,
                        message: 'Password should not match your name or last name.',
                    },
                    {
                        rule: !/(.)\1\1/.test(this.updateUserPassword),
                        message: 'Password should not contain sequences of repeated characters.',
                    },
                    {
                        rule: /[!@#$%^&*]/.test(this.updateUserPassword),
                        message: 'Password should contain at least one special character from the set: !@#$%^&*',
                    },
                ];

                const failedPasswordRules = passwordRules.filter(rule => !rule.rule);
                if (failedPasswordRules.length > 0) {
                    failedPasswordRules.forEach(rule => {
                        // this.showWarningToast(rule.message);
                        if (!this.updatePasswordErrors.includes(rule.message)) {
                            this.updatePasswordErrors.push(rule.message);
                        }
                    });
                    return;
                }
            }

            // if (this.updateUserPassword === '' || this.updateUserPassword === null || this.updateUserPassword === undefined) {
            //     this.showWarningToast('Password is required');
            //     return;
            // }

            if (this.updateUserAccountType === '' || this.updateUserAccountType === null || this.updateUserAccountType === undefined) {
                // this.showWarningToast('Account Type is required');
                // return;
                if (!this.updateAccountTypeErrors.includes('Account Type is required')) {
                    this.updateAccountTypeErrors.push('Account Type is required');
                }
                return;
            }

            if (this.updateUserPhoneNumber === '' || this.updateUserPhoneNumber === null || this.updateUserPhoneNumber === undefined) {
                // this.showWarningToast('Phone Number is required');
                // return;
                if (!this.updatePhoneNumberErrors.includes('Phone Number is required')) {
                    this.updatePhoneNumberErrors.push('Phone Number is required');
                }
                return;
            }


            const form = document.getElementById('editUserForm');
            const formData = new FormData(form);

            // Check if any required fields are empty
            let hasEmptyFields = false;
            // for (const value of formData.values()) {
            //     if (!value) {
            //         hasEmptyFields = true;
            //         break;
            //     }
            // }

            if (hasEmptyFields) {
                $('#editUserModal').addClass('shake'); // Add the shake class to the modal

                // Remove the shake class after the animation completes
                setTimeout(() => {
                    $('#editUserModal').removeClass('shake');
                }, 1000);
            } else {
                // All fields are filled, proceed with user update logic

                // Prepare the data for submission
                const userData = {};
                for (const [key, value] of formData.entries()) {
                    userData[key] = value;
                }

                // Make the API call to update the user
                axios
                    .post('/update-user', userData)
                    .then(response => {
                        // User update successful, show success message
                        Swal.fire({
                            title: 'Success',
                            text: 'User updated successfully.',
                            icon: 'success',
                        });
                            this.updateEmailErrors = [];
                            this.updateNameErrors = [];
                            this.updateLastNameErrors = [];
                            this.updatePasswordErrors = [];
                           this.updateAccountTypeErrors = [];
                           this.updatePhoneNumberErrors = [];


                            // Close the modal
                        $('#editUserModal').modal('hide');

                        // Refresh the table to display the updated user list
                        this.destroyTable();
                        this.initTable();
                    })
                    .catch(error => {
                        // Error occurred during user update, show error message
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to update the user.',
                            icon: 'error',
                        });
                        console.error(error);
                    });
            }
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
        showWarningToast(message)
        {
            this.$toast.warning(message, {
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

    },
}

</script>

<style scoped>
.shake {
    animation: shake 0.5s;
}

@keyframes shake {
    0% {
        transform: translateX(0);
    }
    25% {
        transform: translateX(-5px);
    }
    50% {
        transform: translateX(5px);
    }
    75% {
        transform: translateX(-5px);
    }
    100% {
        transform: translateX(0);
    }
}

.text-red
{
    color: red!important;
}

.black-text
{
    color: black!important;
}
</style>
