

<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <div v-if="this.errors.length > 0" class="alert alert-danger">
                            <ul>
                                <li v-for="error in this.errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="login" method="POST">
<!--                            @csrf-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" v-model="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" v-model="password" required>
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
export default {
    data() {
        return {
            email: '',
            password: '',
            token: '',
            errors: [],
        };
    },
    methods: {
        login() {
            this.errors = [];
            if (this.email === '') {
                this.errors.push('Email is required.');
            }
            if (this.password === '') {
                this.errors.push('Password is required.');
            }
            if (!this.isValidEmail(this.email)) {
                this.errors.push('Please enter a valid email address.');
            }
            if (this.password.length < 8) {
                this.errors.push('Password should be at least 8 characters long.');
            }
            if (this.password.length > 20) {
                this.errors.push('Password should not exceed 20 characters.');
            }
            if (this.password.toLowerCase() === 'password') {
                this.errors.push('Please choose a stronger password.');
            }
            if (!this.hasUppercase(this.password)) {
                this.errors.push('Password should contain at least one uppercase letter.');
            }
            if (!this.hasLowercase(this.password)) {
                this.errors.push('Password should contain at least one lowercase letter.');
            }
            if (!this.hasNumber(this.password)) {
                this.errors.push('Password should contain at least one numeric digit.');
            }
            if (!this.hasSpecialChar(this.password)) {
                this.errors.push('Password should contain at least one special character.');
            }
            if (this.password.includes(this.email)) {
                this.errors.push('Password should not contain the email address.');
            }
            if (!this.isStrongPassword(this.password)) {
                this.errors.push('Password is not strong enough.');
            }
            if (this.errors.length === 0) {
                const formData = new FormData();
                formData.append('email', this.email);
                formData.append('password', this.password);

                axios.post('/login', formData)
                    .then(response => {
                        console.log("Login successful");
                        console.log(response.data);
                        window.location.href = response.data['link']

                    })
                    .catch(error => {
                        console.log("Login failed");
                        console.log(error.data);
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
