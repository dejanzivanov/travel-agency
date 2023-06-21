<template>
    <div>
        <div class="container shaking-effect">
            <div>
                <h1 class="text-center mt-3">Edit Page </h1>
            </div>
            <div class="mb-3">
                <label :for="title" class="form-label label-white text-white">Title</label>
                <input type="text" class="form-control" v-model="title" :id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label :for="description" class="form-label label-white">Description</label>
                <input type="text" class="form-control" v-model="description" :id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="bodyText" class="form-label label-white">Body Text</label>
                <vue-editor id="bodyText" @input="logContent" v-model="post.bodyText" :editorOptions="editorOptions"></vue-editor>
            </div>
            <div class="mb-3">
                <label :for="image" class="form-label label-white">Image</label>
                <div class="input-group">
<!--                    <input type="text" class="form-control" v-model="image" :id="image" name="image" required v-on:change="onChange">-->
<!--                    <button class="btn btn-outline-secondary" type="button" @click="selectImage()">Select Image</button>-->
                    <form @submit="formSubmit" enctype="multipart/form-data">
                        <input type="file" class="form-control" v-on:change="onChange">
                    </form>

                </div>
            </div>
            <div class="mb-3">
                <label class="form-label label-white">Type</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="news" value="news" v-model="type">
                    <label class="form-check-label label-white" for="news">
                        News
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" :id="post" value="post" v-model="type">
                    <label class="form-check-label label-white" :for="post">
                        Post
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group">
                    <label :for="status" class="label-white">Status:</label>
                    <select class="form-control" v-model="status" :id="status" required>
                        <option value="archived">Archived</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>



            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" v-on:click="updatePost(post.id)">Update</button>
            </div>
        </div>

        <!-- Validation Error Modal -->
        <div class="modal fade bg-dark needs-validation" id="validationModal" tabindex="-1"
             aria-labelledby="validationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-white-outline">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="validationModalLabel">Validation Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-bg-dark">
                        All fields are required.
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade bg-dark" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-white-outline">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-bg-dark">
                        Are you sure that you want to update this post?
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" @click="confirmUpdate()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {VueEditor} from "vue2-editor/dist/vue2-editor.core.js";

import $ from 'jquery';
window.jQuery = $;
window.$ = $;
export default {

    data() {
        return {
            content: this.post.bodyText,
            title: this.post.title,
            description: this.post.description,
            image: this.post.image,
            type: this.post.type,
            status: this.post.status,
            name: '',
            file: '',
            success: '',

            editorOptions: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{'header': 1}, {'header': 2}],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    [{'script': 'sub'}, {'script': 'super'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                    [{'direction': 'rtl'}],
                    [{'size': ['small', false, 'large', 'huge']}],
                    [{'header': [1, 2, 3, 4, 5, 6, false]}],
                    [{'color': []}, {'background': []}],
                    [{'font': []}],
                    [{'align': []}],
                    ['clean'],
                    ['link', 'image', 'video']
                ]
            },
        }
    },
    mounted()
    {

    },
    computed:
    {
        // content: function () {
        //     return this.post.bodyText;
        //
    },
    component:
    {
        VueEditor
    },

    props: {
        post: Object
    },
    methods: {
        formSubmit(e)
        {
            // e.preventDefault();
            let existingObj = this;
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('id', this.post.id);
            axios.post('/upload', data, config)
                .then(function (res) {
                    existingObj.success = res.data.success;
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
        },
        onChange(e)
        {
            this.file = e.target.files[0];
        },
        logContent() {
            console.log('Content is: ', this.post.bodyText)
        },
        updatePost(postId) {
            if (
                !this.title || this.title.trim() === '' ||
                !this.description || this.description.trim() === '' ||
                !this.post.bodyText || this.post.bodyText.trim() === '' ||
                !this.image || this.image.trim() === ''
            ) {
                $('#validationModal').modal('show');

            } else {
                $('#confirmationModal').modal('show');

            }
        },
        confirmUpdate() {
            console.log('Post updated!');
            this.formSubmit();
            this.updateBlogData();
            $('#confirmationModal').modal('hide');
        },
        updateBlogData()
        {
            //send axios request with all the data to the server

            axios.post('/update-blog', {
                id: this.post.id,
                title: this.title,
                description: this.description,
                bodyText: this.post.bodyText,
                image: this.file.name,
                type: this.type,
                status: this.status,
            })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>

<style scoped>
.modal-content {
    outline: 2px solid white;
    outline-offset: -2px;
}

.shaking-effect {
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

@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import '~quill/dist/quill.core.css';
@import '~quill/dist/quill.bubble.css';
@import '~quill/dist/quill.snow.css';

</style>

