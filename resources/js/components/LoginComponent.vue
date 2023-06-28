

<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title text-center">Login</h3>
                    </div>
                    <div class="card-body">

                        <form @submit.prevent="login" method="POST">
<!--                            @csrf-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input v-on:keydown="resetEmailErrors" type="email" class="form-control" id="email" v-model="email" required>
                                <div v-for="error in this.emailErrors" :key="error">
                                    <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input v-on:keydown="resetPasswordErrors"  type="password" class="form-control" id="password" v-model="password" required>
                                <div v-for="error in this.paswordErrors" :key="error">
                                   <span class="text-red">{{ error }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";

export default {

    data() {
        return {
            email: '',
            password: '',
            token: '',
            emailErrors: [],
            paswordErrors: [],
        };
    },
    methods: {
        login() {
            // this.errors = [];
            if (this.email === '') {
                if (!this.emailErrors.includes('Email is required.'))
                        this.emailErrors.push('Email is required.');
            }
            if (this.password === '') {
                if (!this.paswordErrors.includes('Password is required.'))
                    this.paswordErrors.push('Password is required.');
            }
            if (!this.isValidEmail(this.email)) {
                if (!this.emailErrors.includes('Please enter a valid email address.'))
                    this.emailErrors.push('Please enter a valid email address.');
            }
            if (this.password.length < 8) {
                if (!this.paswordErrors.includes('Password should be at least 8 characters long.'))
                    this.paswordErrors.push('Password should be at least 8 characters long.');
            }
            if (this.password.toLowerCase() === 'password') {
                if (!this.paswordErrors.includes('Please choose a stronger password.'))
                    this.paswordErrors.push('Please choose a stronger password.');
            }
            if (!this.hasUppercase(this.password)) {
                if (!this.paswordErrors.includes('Password should contain at least one uppercase letter.'))
                    this.paswordErrors.push('Password should contain at least one uppercase letter.');
            }
            if (!this.hasLowercase(this.password)) {
                if (!this.paswordErrors.includes('Password should contain at least one lowercase letter.'))
                this.paswordErrors.push('Password should contain at least one lowercase letter.');
            }
            if (!this.hasNumber(this.password)) {
                if (!this.paswordErrors.includes('Password should contain at least one numeric digit.'))
                    this.paswordErrors.push('Password should contain at least one numeric digit.');
            }
            if (!this.hasSpecialChar(this.password)) {
                if (!this.paswordErrors.includes('Password should contain at least one special character.'))
                    this.paswordErrors.push('Password should contain at least one special character.');
            }
            if (this.password.includes(this.email)) {
                if (!this.paswordErrors.includes('Password should not contain the email address.'))
                    this.paswordErrors.push('Password should not contain the email address.');
            }
            if (!this.isStrongPassword(this.password)) {
                if (!this.paswordErrors.includes('Password is not strong enough.'))
                    this.paswordErrors.push('Password is not strong enough.');
            }
            if(this.paswordErrors.length > 0) {
                return;
            }

            if (this.paswordErrors.length === 0 || this.emailErrors.length === 0) {
                const formData = new FormData();
                formData.append('email', this.email);
                formData.append('password', this.password);


                axios.post('/login', formData)
                    .then(response => {
                        console.log("Login successful");
                        console.log(response);
                        // Access the response data
                        const responseData = response.data;
                        const message = responseData.message;
                        const link = responseData.link;
                        // Perform actions based on the response
                        if (message === 'Login successful') {
                            console.log("Redirecting to:", link);
                            // Redirect to the provided link
                            Swal.fire({
                                icon: 'success',
                                title: 'Good job!',
                                text: 'You are logged in now!',
                                confirmButtonText: 'Proceed to Admin Dashboard',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/';
                                }
                            })
                            ;
                            // window.location.href = link;
                        } else {
                            console.log("Error:", message);
                            // Handle error message
                        }
                    })
                    .catch(error => {
                        console.log("Login failed");
                        console.log(error.response.data.error);
                        if(error.response.data.error === 'Wrong credentials') {
                            this.paswordErrors.push('Invalid credentials.');
                        }
                    });
            }

        },
        isValidEmail(email) {
            // Basic email validation regex pattern
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        },
        hasUppercase(str) {
            return /[A-Z]/.test(str);
        },
        hasLowercase(str) {
            return /[a-z]/.test(str);
        },
        hasNumber(str) {
            return /\d/.test(str);
        },
        hasSpecialChar(str) {
            return /[!@#$%^&*(),.?":{}|<>]/.test(str);
        },
        isStrongPassword(str) {
            // Additional password strength validation rules
            const hasUppercase = /[A-Z]/.test(str);
            const hasLowercase = /[a-z]/.test(str);
            const hasNumber = /\d/.test(str);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(str);
            const isLongEnough = str.length >= 10;

            return hasUppercase && hasLowercase && hasNumber && hasSpecialChar && isLongEnough;
        },
        resetEmailErrors() {
            this.emailErrors = [];
        },
        resetPasswordErrors() {
            this.paswordErrors = [];
        }
    },
    mounted() {
        // this.token = document.head.querySelector('meta[name="csrf-token"]').content;
        // axios.defaults.headers.common['X-CSRF-TOKEN'] = this.token;
    }
};
</script>

<style>
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
