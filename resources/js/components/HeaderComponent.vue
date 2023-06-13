<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Home</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/insurance-purchase">Purchase Insurance</a>
                    </li>
                    <li class="nav-item" v-if="!authenticated">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item" v-if="!authenticated">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item" v-if="is_admin">
                        <a class="nav-link" href="/admin-dashboard">Admin Dashboard</a>
                    </li>

                </ul>
            </div>
            <div class="ml-auto">
                <button class="btn btn-danger ml-5" @click="logout" v-if="authenticated">
                    Logout
                </button>
            </div>

        </div>
    </nav>
</template>

<script>
import Swal from "sweetalert2";

export default {
    name: 'Header',
    props: {
        authenticated: {
            type: Boolean,
            default: false,
        },
        is_admin: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        logout() {
            axios
                .post('/logout')
                .then((response) => {
                    console.log(response.data);
                    Swal.fire({
                        title: 'Success!',
                        text: 'You have been logged out successfully',
                        icon: 'success',
                        confirmButtonText: 'Proceed To Main Page',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '';
                        }
                    });
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'There has been problem with logging you out!',
                    })
                });
        },
    },
};
</script>


`
