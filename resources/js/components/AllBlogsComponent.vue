<script>

import $ from 'jquery';
import datatable from 'datatables.net';
import moment from "moment";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            blogs: [],
        }
    },

    mounted() {
        var self = this;

        $(document).on('click','.edit_post', function () {
            self.deleteTable();
            setTimeout(function() {
                self.initTable(); }, 3000);
        });

        $(document).on('click','.delete_post', function () {

            let data_id = $(this).data('id');
            let data = {'post_id': data_id};

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/blog-data-delete', data)
                        .then(response => {
                            self.deleteTable();
                            self.initTable();
                        })
                        .catch(error => {
                            console.log(error);
                        });
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })


        });


        this.initTable();
    },
    methods: {
        initTable() {
            const self = this;

            $('#blog-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: '/blog-data',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {},
                    dataSrc: function(response) {
                        self.blogs = response.data; // Update the component's data
                        return self.blogs;
                    },
                },
                responsive: true,
                autowidth: false,
                columns: [
                    { title: 'ID', data: 'id' },
                    { title: 'Author', data: 'author' },
                    { title: 'Image', data: 'image', "render": function (data, type, row, meta) {
                            return '<a href="storage/uploads/' + row.id + '/' + data + '"><img src="storage/uploads/' + row.id + '/' + data + '" class="img-thumbnail slika"></a>';
                        },
                    },
                    { title: 'Created At',
                        data: 'created_at',
                        render: function(data, type, row) {
                        if(data != null) {
                            return '<span class="created_at" title="' + data + '">' + moment(data).format('d.m.Y') + '</span>';
                        }
                        else
                            return data;
                        },
                    },
                    { title: 'Published At',
                        data: 'published_at',
                        render: function(data, type, row) {
                        if(data != null) {
                            return '<span class="published_at" title="' + data + '">' + moment(data).format('d.m.Y') + '</span>';
                        }
                        else
                            return data;
                        },
                    },
                    { title: 'Archived At',
                        data: 'archived_at',
                        render: function(data, type, row) {
                            if (data != null) {
                                return '<span class="archived_at" title="' + data + '">' + moment(data).format('d.m.Y') + '</span>';
                             }
                            else
                                return data;
                        },
                    },
                    { title: 'Title', data: 'title' },
                    { title: 'Status', data: 'status' },
                    { title: 'Type', data: 'type' },
                    // { title: 'Description', data: 'description' },
                    {
                        title: 'Actions',
                        data: null,
                        render: function (data, type, row) {
                            return `  <div class="d-flex justify-content-around">
                                <a href="/blog-data-update/${data.id}"class="btn btn-sm btn-primary edit_post" data-id="${data.id}">Edit</a>
                                <button class="btn btn-sm btn-danger ml-3 pl-3 delete_post " data-id="${data.id}">Delete</button>
                            </div>
                            `;
                        },
                    },

                ],
            });
        },
        deleteTable()
        {
            const dataTable = $('#blog-table').DataTable();
            dataTable.clear().destroy();

        }
    },
}
</script>

<template>
    <div>
        <table id="blog-table" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Image: </th>
                <th>Created At:</th>
                <th>Published At:</th>
                <th>Archived At:</th>
                <th>Title</th>
                <th>Body Text</th>
                <th>Status</th>
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

.slika
{
    height: 40px;
    width: 80px;
}
</style>
