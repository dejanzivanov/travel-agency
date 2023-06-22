<template>
    <div>
        <div class="container shaking-effect">
            <div>
                <h1 class="text-center mt-3">Create New Post</h1>
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
                <label for="content" class="form-label label-white text-white">Body Text</label>
                <vue-editor id="content" v-model="content" :editorOptions="editorOptions"></vue-editor>
            </div>
            <div class="mb-3">
                <label :for="image" class="form-label label-white text-white">Image</label>
                <div class="input-group">
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
                    <input class="form-check-input" type="radio" name="type" id="post" value="post" v-model="type">
                    <label class="form-check-label label-white"  for="post">
                        Post
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-evenly">
                <button class="btn btn-primary pr-2" v-on:click="createPost()">Create Post</button>
                <a   class="btn btn-warning pl-2" v-on:click="submitPreview()">Preview Post</a>
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
            content: '',
            title: '',
            description: '',
            image: '',
            type: '',
            status: 'in_preparation',
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
    },
    component:
    {
        VueEditor
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
        },
        onChange(e)
        {
            this.file = e.target.files[0];
        },
        createPost() {
            if (
                !this.title || this.title.trim() === '' ||
                !this.description || this.description.trim() === '' ||
                !this.content || this.content.trim() === '' ||
                !this.file || this.file.name.trim() === ''
            ) {
                console.log('Validation Error')
                $('#validationModal').modal('show');

            } else {
                $('#confirmationModal').modal('show');

            }
        },
        confirmUpdate() {
            this.formSubmit();
            this.createNewPost();
            $('#confirmationModal').modal('hide');

            //settimer of 100 milisec

            this.showSuccessToast('Post Created Successfully');


            this.$emit('publish-post');

        },
        createNewPost()
        {
            //send axios request with all the data to the server

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file);
            data.append('title', this.title);
            data.append('description', this.description);
            data.append('bodyText', this.content);
            data.append('image_name', this.file.name);
            data.append('type', this.type);
            data.append('status', this.status);

            axios.post('/create-post', data, config)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
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
        submitPreview()
        {
            if (
                !this.title || this.title.trim() === '' ||
                !this.description || this.description.trim() === '' ||
                !this.content || this.content.trim() === '' ||
                !this.file || this.file.name.trim() === ''
            ) {
                this.showWarningToast('Please fill all the fields');

            } else {
                // $('#confirmationModal').modal('show');
                console.log('mlem', this.content)
                let data = {
                'title' : this.title,
                'description' : this.description,
                'bodyText' : this.content,
                'image_name' : this.file.name,
                'image_path' : URL.createObjectURL(this.file),
                'type' : this.type,
                'status' : this.status,
                'file' : this.file,
                };

                axios.post('/post-preview1', data)
                    .then(function (response) {
                        window.open("/post-preview", "_blank");
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }

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

