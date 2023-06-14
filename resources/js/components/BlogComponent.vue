<template>
    <div>
        <div class="d-flex flex-column align-items-center mt-3">
            <h1 class="text-center">Admin Blog Dashboard</h1>
            <div class="mt-3 d-flex justify-content-between w-50">
                <button class="btn btn-dark" @click="viewAllPosts">View All Posts</button>
                <button class="btn btn-dark" @click="createNewPost">Create New Post</button>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    methods: {
        viewAllPosts() {
            console.log('view all posts');
        },
        createNewPost() {
            console.log('create new post');
        },
    },
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
