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
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name" v-model="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email" v-model="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter your password" v-model="password">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter your phone number" v-model="phone">
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
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            phone: '',
            token: ''
        };
    },
    methods:
    {
        register() {
            // Implement your registration logic here
            // You can access the entered name, email, password and phone using this.name, this.email, this.password and this.phone
            // console.log('Register clicked');
            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('phone', this.phone);

            axios.post('/register', formData)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log();
                });
        }
    },
    mounted()
    {
        this.token = document.head.querySelector('meta[name="csrf-token"]').content;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = this.token;
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
