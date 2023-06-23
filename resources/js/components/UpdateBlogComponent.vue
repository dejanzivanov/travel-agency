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
                <label :for="description" class="form-label label-white text-white">Description</label>
                <input type="text" class="form-control" v-model="description" :id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="bodyText" class="form-label label-white text-white">Body Text</label>
                <vue-editor id="bodyText" @input="logContent" v-model="post.bodyText" :editorOptions="editorOptions"></vue-editor>
            </div>
            <div class="mb-3">
                <label :for="image" class="form-label label-white text-white">Image</label>
                <div class="input-group">
<!--                    <input type="text" class="form-control" v-model="image" :id="image" name="image" required v-on:change="onChange">-->
<!--                    <button class="btn btn-outline-secondary" type="button" @click="selectImage()">Select Image</button>-->
                    <form @submit="formSubmit" enctype="multipart/form-data">
                        <input type="file" class="form-control" v-on:change="onChange">
                    </form>

                </div>
            </div>
            <div class="mb-3">
                <label class="form-label label-white text-white">Type</label>
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
                <button class="btn btn-primary" v-on:click="updatePost(post.id)" :disabled="this.updateDisabled">Update</button>
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
            created_at: this.post.created_at,
            updated_at: this.post.updated_at,
            published_at: this.post.published_at,
            updateDisabled: false,
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
        console.log(this.created_at);
        console.log(this.archived_at);
        console.log(this.published_at);

    },
    computed:
    {

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
            if(this.created_at != '' || this.created_at != null || this.created_at != undefined)
            {
               if (this.published_at == '' || this.published_at == null || this.published_at == undefined)
               {
                   if(this.status == 'archived')
                   {
                       this.showWarningToast('Publish First');
                       return;
                   }
               }
            }

            if(this.file === '' || this.file === null || this.file === undefined || this.file.name === 'undefined')
            {
                this.showWarningToast('Upload Image First');
                return;
            }

            // this.formSubmit();
            // this.updateBlogData();
            $('#confirmationModal').modal('hide');
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
            this.formSubmit();
            this.updateBlogData();
            $('#confirmationModal').modal('hide');
            this.showSuccessToast('Post Updated Successfully');
            this.updateDisabled = true
            setTimeout(() => {
                window.location.href = '/post/' + this.post.id;
            }, 1000);


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
        },
        showWarningToast(message)
        {
            this.$toast.warning(message, {
                transition: "Vue-Toastification__fade",
                position: "top-right",
                timeout: 2000,
                closeOnClick: true,
                pauseOnFocusLoss: false,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                hideProgressBar: false,
                closeButton: "button",
                newestOnTop: true,
                icon: true,
                rtl: false,
            });
        },

        showSuccessToast(message)
        {
            this.$toast.success(message, {
                transition: "Vue-Toastification__fade",
                position: "top-right",
                timeout: 2000,
                closeOnClick: true,
                pauseOnFocusLoss: false,
                pauseOnHover: true,
                draggable: true,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                hideProgressBar: false,
                closeButton: "button",
                newestOnTop: true,
                icon: true,
                rtl: false,
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

