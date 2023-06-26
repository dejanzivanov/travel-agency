

<template>
    <div class="container">
        <div class="row">
            <h1 class="text-center pt-4 text-white">Users</h1>
        </div>
        <div class="d-flex justify-content-end py-3">
            <button class="btn btn-dark my-auto create-new-user" data-bs-toggle="modal" data-bs-target="#createUserModal">Create new user</button>
        </div>
        <div>
            <table id="users-table" class="display">
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
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control form-control-dark" id="lastName" name="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-dark" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="accountType" class="form-label">Account Type</label>
                                <select class="form-select form-control-dark" id="accountType" name="accountType" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
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
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control form-control-dark" id="editLastName" name="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control form-control-dark" id="editEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editAccountType" class="form-label">Account Type</label>
                                <select class="form-select form-control-dark" id="editAccountType" name="accountType" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editPhoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="editPhoneNumber" name="phoneNumber" required>
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
    },
    data()
    {
        return {
            users: [],
        };
    },
    methods:
    {
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
                                return '<span class="created_at" title="' + data + '">' + moment(data).format('d.m.Y') + '</span>';
                            }
                            else
                                return data;
                        },
                    },
                    { title: 'Actions', data: 'id', render: function (data, type, row)
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

            // Check if any required fields are empty
            let hasEmptyFields = false;
            for (const value of formData.values()) {
                if (!value) {
                    hasEmptyFields = true;
                    break;
                }
            }

            if (hasEmptyFields) {
                $('#createUserModal').addClass('shake'); // Add the shake class to the modal

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
                        Swal.fire({
                            title: 'Success',
                            text: 'User created successfully.',
                            icon: 'success',
                        });

                        // Close the modal and reset the form
                        $('#createUserModal').modal('hide');


                        form.reset();

                        // Refresh the table to display the updated user list
                        this.destroyTable();
                        this.initTable();
                    })
                    .catch(error => {
                        // Error occurred during user creation, show error message
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to create a new user.',
                            icon: 'error',
                        });
                        console.error(error);
                    });
            }
        },
        openEditUserModal(userId) {
            // Get the user data from the server based on the userId
            axios.post('/user/' + userId)
                .then(response => {
                    const userData = response.data;
                    console.log("mlem", userData);
                    console.log("mlem", userData[0].id);
                    // console.log(userDataid);

                    // Populate the form fields in the edit modal with the user data
                    // await new Promise(resolve => setTimeout(resolve, 500)); // Adjust the delay as needed
                    // setTimeout(() => {
                    $('#editUserModal').modal('show');

                    $('#editUserModal').on('shown.bs.modal', function () {
                        // setTimeout(function() {

                            $('#editUserId').val(userData[0].id);
                        $('#editName').val(userData[0].name);
                        $('#editLastName').val(userData[0].last_name);
                        $('#editEmail').val(userData[0].email);
                        $('#editAccountType').val(userData[0].account_type);
                        $('#editPhoneNumber').val(userData[0].phone_number);
                        // }, 500);
                        $('#editUserModal').off('shown.bs.modal');
                    });

                    // // Show the edit modal

                })
                .catch(error => {
                    console.error(error);
                });
        },
        saveChanges() {
            const form = document.getElementById('editUserForm');
            const formData = new FormData(form);

            // Check if any required fields are empty
            let hasEmptyFields = false;
            for (const value of formData.values()) {
                if (!value) {
                    hasEmptyFields = true;
                    break;
                }
            }

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

    },
}

</script>

<style>
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

.black-text
{
    color: black!important;
}
</style>
