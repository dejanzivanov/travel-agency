<!--<template>-->
<!--    <div>-->
<!--        <div class="container shaking-effect">-->
<!--            <div>-->
<!--                <h1 class="text-center mt-3">Edit Page</h1>-->
<!--            </div>-->


<!--            <div class="mb-3">-->
<!--                <label for="title-{{ this.post.id }}" class="form-label label-white text-white">Title</label>-->
<!--                <input type="text" class="form-control" id="title-{{ this.post.id }}" name="title"-->
<!--                       value="{{ this.post.title }}" required>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label for="description-{{ this.post.id }}" class="form-label label-white">Description</label>-->
<!--                <input type="text" class="form-control" id="description-{{ this.post.id }}" name="description"-->
<!--                       value="{{ this.post.description }}" required>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label for="bodyText-{{ this.post.id }}" class="form-label label-white">Body Text</label>-->
<!--                <textarea class="form-control" id="bodyText-{{ this.post.id }}" name="bodyText" required>{{ this.post.bodyText }}</textarea>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label for="image-{{ this.post.id }}" class="form-label label-white">Image</label>-->
<!--                <div class="input-group">-->
<!--                    <input type="text" class="form-control" id="image-{{ this.post.id }}" name="image"-->
<!--                           value="{{ this.post.image }}" required>-->
<!--                    <button class="btn btn-outline-secondary" type="button" onclick="selectImage()">Select Image-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="mb-3">-->
<!--                <label class="form-label label-white">Type</label>-->
<!--                <div class="form-check">-->
<!--                    <input class="form-check-input" type="radio" name="type" :id="'news-' + post.id" value="news" :checked="post.type === 'news'">-->
<!--                    <label class="form-check-label label-white" for="news-{{ this.post.id }}">-->
<!--                        News-->
<!--                    </label>-->
<!--                </div>-->
<!--                <div class="form-check">-->
<!--                    <input class="form-check-input" type="radio" name="type" :id="'post-' + post.id" value="post" :checked="post.type === 'post'">-->
<!--                    <label class="form-check-label label-white" for="post-{{ this.post.id }}">-->
<!--                        Post-->
<!--                    </label>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="mb-4">-->
<!--                <div class="form-group">-->
<!--                    <label for="status-{{ this.post.id }}" class="label-white">Status:</label>-->
<!--                    <select class="form-control" :id="'status-' + post.id" required>-->
<!--                        <option value="In preparation">In preparation</option>-->
<!--                        <option value="Archived">Archived</option>-->
<!--                        <option value="Published">Published</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="d-flex justify-content-center">-->
<!--                <button class="btn btn-primary" onclick="updatePost( this.post.id )">Update</button>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; Validation Error Modal &ndash;&gt;-->
<!--        <div class="modal fade bg-dark needs-validation" id="validationModal" tabindex="-1"-->
<!--             aria-labelledby="validationModalLabel" aria-hidden="true">-->
<!--            <div class="modal-dialog modal-white-outline">-->
<!--                <div class="modal-content bg-dark">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title" id="validationModalLabel">Validation Error</h5>-->
<!--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                    </div>-->
<!--                    <div class="modal-body text-bg-dark">-->
<!--                        All fields are required.-->
<!--                    </div>-->
<!--                    <div class="modal-footer bg-dark">-->
<!--                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--        &lt;!&ndash; Confirmation Modal &ndash;&gt;-->
<!--        <div class="modal fade bg-dark" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"-->
<!--             aria-hidden="true">-->
<!--            <div class="modal-dialog modal-white-outline">-->
<!--                <div class="modal-content bg-dark">-->
<!--                    <div class="modal-header">-->
<!--                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>-->
<!--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                    </div>-->
<!--                    <div class="modal-body text-bg-dark">-->
<!--                        Are you sure that you want to update this post?-->
<!--                    </div>-->
<!--                    <div class="modal-footer bg-dark">-->
<!--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>-->
<!--                        <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Yes</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--    </div>-->

<!--</template>-->

<!--<script>-->

<!--import $ from 'jquery';-->
<!--export default {-->
<!--    mounted() {-->
<!--        console.log('post is: ', this.post);-->
<!--    },-->
<!--    props:-->
<!--        {-->
<!--            post: Object-->
<!--        },-->
<!--    methods: {-->
<!--        updatePost(postId)-->
<!--        {-->
<!--            var title = document.getElementById('title-' + postId).value;-->
<!--            var description = document.getElementById('description-' + postId).value;-->
<!--            var bodyText = document.getElementById('bodyText-' + postId).value;-->
<!--            var image = document.getElementById('image-' + postId).value;-->
<!--            var type = document.querySelector('input[name="type"]:checked').value;-->
<!--            var status = document.getElementById('status-' + postId).value;-->

<!--            if (title.trim() === '' || description.trim() === '' || bodyText.trim() === '' || image.trim() === '') {-->
<!--                $('#validationModal').modal('show');-->
<!--            } else {-->
<!--                $('#confirmationModal').modal('show');-->
<!--            }-->
<!--        },-->
<!--        confirmationUpdate()-->
<!--        {-->
<!--            console.log('Post updated!');-->
<!--            $('#confirmationModal').modal('hide');-->
<!--        },-->
<!--        selectImage()-->
<!--        {-->
<!--            console.log('Image selection dialog opened!');-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->
<!--.modal-content {-->
<!--    outline: 2px solid white;-->
<!--    outline-offset: -2px;-->
<!--}-->

<!--.shaking-effect {-->
<!--    animation: shake 0.5s;-->
<!--}-->

<!--@keyframes shake {-->
<!--    0% {-->
<!--        transform: translateX(0);-->
<!--    }-->
<!--    25% {-->
<!--        transform: translateX(-5px);-->
<!--    }-->
<!--    50% {-->
<!--        transform: translateX(5px);-->
<!--    }-->
<!--    75% {-->
<!--        transform: translateX(-5px);-->
<!--    }-->
<!--    100% {-->
<!--        transform: translateX(0);-->
<!--    }-->
<!--}-->
<!--</style>-->
<template>
    <div>
        <div class="container shaking-effect">
            <div>
                <h1 class="text-center mt-3">Edit Page </h1>
            </div>

            <div class="mb-3">
                <label :for="'title-' + post.id" class="form-label label-white text-white">Title</label>
                <input type="text" class="form-control" :id="'title-' + post.id" name="title"
                       :value="post.title" required>
            </div>
            <div class="mb-3">
                <label :for="'description-' + post.id" class="form-label label-white">Description</label>
                <input type="text" class="form-control" :id="'description-' + post.id" name="description"
                       :value="post.description" required>
            </div>
            <div class="mb-3">
                <label :for="'bodyText-' + post.id" class="form-label label-white">Body Text</label>
                <vue-editor id="'bodyText-' + post.id" @input="logContent" v-model="post.bodyText"
                            :editorOptions="editorOptions"></vue-editor>
            </div>
            <div class="mb-3">
                <label :for="'image-' + post.id" class="form-label label-white">Image</label>
                <div class="input-group">
                    <input type="text" class="form-control" :id="'image-' + post.id" name="image"
                           :value="post.image" required>
                    <button class="btn btn-outline-secondary" type="button" @click="selectImage()">Select Image
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label label-white">Type</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" :id="'news-' + post.id" value="news"
                           :checked="post.type === 'news'">
                    <label class="form-check-label label-white" :for="'news-' + post.id">
                        News
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" :id="'post-' + post.id" value="post"
                           :checked="post.type === 'post'">
                    <label class="form-check-label label-white" :for="'post-' + post.id">
                        Post
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group">
                    <label :for="'status-' + post.id" class="label-white">Status:</label>
                    <select class="form-control" :id="'status-' + post.id" required>
                        <option value="In preparation">In preparation</option>
                        <option value="Archived">Archived</option>
                        <option value="Published">Published</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" @click="updatePost(post.id)">Update</button>
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
        <!--        <vue-editor id="editor1" v-model="this.content" />-->
        <div>{{ this.content }}</div>

    </div>
</template>

<script>
import {VueEditor} from "vue2-editor/dist/vue2-editor.core.js";

import $ from 'jquery';

export default {

    data() {
        return {
            content: this.post.bodyText,
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
    mounted() {
        console.log('post is: ', this.post);
        // console.log('content is: ', this.content);

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
        logContent() {
            console.log('Content is: ', this.post.bodyText)
        },
        updatePost(postId) {
            var title = document.getElementById('title-' + postId).value;
            var description = document.getElementById('description-' + postId).value;
            var bodyText = document.getElementById('bodyText-' + postId).value;
            var image = document.getElementById('image-' + postId).value;
            var type = document.querySelector('input[name="type"]:checked').value;
            var status = document.getElementById('status-' + postId).value;

            if (title.trim() === '' || description.trim() === '' || bodyText.trim() === '' || image.trim() === '') {
                $('#validationModal').modal('show');
            } else {
                $('#confirmationModal').modal('show');
            }
        },
        confirmUpdate() {
            console.log('Post updated!');
            $('#confirmationModal').modal('hide');
        },
        selectImage() {
            console.log('Image selection dialog opened!');
        },

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

