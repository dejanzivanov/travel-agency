<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title text-center">Registration</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="register" method="POST">
                            <!--                            <input type="hidden" name="_token" :value="csrf">-->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                       v-model="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                       v-model="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password"
                                       placeholder="Enter your password" v-model="password">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter your phone number"
                                       v-model="phone">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            phone: '',

        };
    },
    methods:
        {
            register() {
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('password', this.password);
                formData.append('phone', this.phone);

                let data =
                    {
                        'name': this.name,
                        'email': this.email,
                        'password': this.password,
                        'phone': this.phone
                    }
                axios.post('/register', data)
                    .then(response => {
                        console.log("Login successful");
                        console.log(response.data);

                        Swal.fire({
                            title: 'Success!',
                            text: 'You have been successfully registered',
                            icon: 'success',
                            confirmButtonText: 'Proceed To Login',
                            allowOutsideClick: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.data['link']
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    });
            }
        },
    mounted() {
        // this.token = document.head.querySelector('meta[name="csrf-token"]').content;
        // axios.defaults.headers.common['X-CSRF-TOKEN'] = this.token;
    }
};
</script>

<style>
body {
    background-color: #343a40;
    color: #fff;
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
