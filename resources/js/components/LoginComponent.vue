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
                            @csrf
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
            token: ''
        };
    },
    methods: {
        login() {
            // Implement your login logic here
            // You can access the entered email and password using this.email and this.password
            // console.log('Login clicked');
            const formData = new FormData();
            formData.append('email', this.email);
            formData.append('password', this.password);

            axios.post('/login', formData)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log();
                });
        }
    },
    mounted() {
        this.token = document.head.querySelector('meta[name="csrf-token"]').content;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = this.token;
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
