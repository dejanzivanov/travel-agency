<script setup>
import {onMounted} from 'vue';
import axios from 'axios';

window.editPost = function (id) {
    console.log('Post ID:', id);
}

window.deletePost = function (id) {
    console.log('Overview', id);

    const data = { 'post-id': id };
    axios.post('/delete-post', data)
        .then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.log(error);
        });
}

onMounted(() => {
    // Fetch data from the server
    axios.post('/blog-data')
        .then(response => {
            const blogs = response.data;
            initializeTable(blogs);
        })
        .catch(error => {
            console.error(error);
        });
});

function initializeTable(blogs) {
    // Initialize DataTables with the fetched data
    console.log(blogs);
    $(document).ready(function () {
        $('#blog-table').DataTable({
            buttons: ['copy', 'csv', 'excel'],
            data: blogs,
            pageLength: 2,
            columns: [
                {title: 'ID', data: 'id'},
                {title: 'Author', data: 'author'},
                {title: 'Created At', data: 'created_at'},
                {title: 'Published At', data: 'published_at'},
                {title: 'Archived At', data: 'archived_at'},
                {title: 'Title', data: 'title'},
                {title: 'Body Text', data: 'bodyText'},
                {
                    title: 'Actions',
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-sm btn-primary" onclick="editPost(${data.id})">Edit</button>
                                <button class="btn btn-sm btn-danger ml-3 pl-3" onclick="deletePost(${data.id})">Delete</button>
                            </div>
                        `;
                    },
                },
            ],
            responsive: true,
            autowidth: false,

        });
    });
}
</script>

<template>
    <div class="container">
        <h1 class="mb-4">We will show all posts here</h1>
        <table id="blog-table" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Created At:</th>
                <th>Published At:</th>
                <th>Archived At:</th>
                <th>Title</th>
                <th>Body Text</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
</template>

<style>

#blog-table > tbody > tr > td.sorting_1 {
    background-color: #999292 !important;
}

table.dataTable tbody tr {
    background-color: #999292 !important;
}

table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
    background-color: #999292 !important;
}
</style>
