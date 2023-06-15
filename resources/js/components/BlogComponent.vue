<template>
    <div>
        <div class="d-flex flex-column align-items-center mt-3">
            <h1 class="text-center">Admin Blog Dashboard</h1>
            <div class="mt-3 d-flex justify-content-between w-50">
                <button class="btn btn-dark" @click="viewAllPosts">View All Posts</button>
                <button class="btn btn-dark" @click="createNewPost">Create New Post</button>
            </div>
            <div class="mt-3">
                <all-blogs-component v-if="showAllBlogs"></all-blogs-component>
                <create-post-component v-if="showCreatePost"></create-post-component>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    components: {
        AllBlogsComponent: () => import('./AllBlogsComponent.vue'),
        CreatePostComponent: () => import('./CreatePostComponent.vue'),
    },
    data() {
        return {
            showAllBlogs: false,
            showCreatePost: false,
        }
            },
    methods: {
        viewAllPosts() {
            this.showAllBlogs = true;
            this.showCreatePost = false;
        },
        createNewPost() {
            this.showAllBlogs = false;
            this.showCreatePost = true;
        },
    },
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
