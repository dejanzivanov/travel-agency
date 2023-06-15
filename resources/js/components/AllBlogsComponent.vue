<script>

// window.editPost = function (id) {
    // console.log('Post ID:', id);
    // deleteTable();
    //clear whole table
    // $('#blog-table').DataTable().clear();
    // $.timer(5);

    // $('#blog-table').DataTable().clearRows();
    // $('#blog-table').DataTable().destroy();
// }

//
// window.deletePost = function (id) {
//     console.log('Overview', id);
//
//     const data = {'post_id': id};
//     axios.post('/blog-data-delete', data)
//         .then(response => {
//             var rowToDelete = $('#blog-table').DataTable().row(`#row-${id}`);
//             // rowToDelete.remove();
//             // $('#blog-table').DataTable().draw();
//             // this.blog
//             //ovde treba filter
//         })
//         .catch(error => {
//             console.log(error);
//         });
// }


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
            // console.log(data_id);
            let data = {'post_id': data_id};
            // console.log('Overview', data_id);
            axios.post('/blog-data-delete', data)
         .then(response => {
             // var rowToDelete = $('#blog-table').DataTable().row(`#row-${id}`);
             // rowToDelete.remove();
             // $('#blog-table').DataTable().draw();
             // this.blog
             //ovde treba filter
             self.deleteTable();
             self.initTable();
         })
         .catch(error => {
             console.log(error);
         });


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
                    { title: 'Created At', data: 'created_at' },
                    { title: 'Published At', data: 'published_at' },
                    { title: 'Archived At', data: 'archived_at' },
                    { title: 'Title', data: 'title' },
                    { title: 'Status', data: 'status' },
                    { title: 'Body Text', data: 'bodyText' },
                    {
                        title: 'Actions',
                        data: null,
                        render: function (data, type, row) {
                            return `  <div class="d-flex justify-content-around">
                                <button class="btn btn-sm btn-primary edit_post" data-id="${data.id}">Edit</button>
                                <button class="btn btn-sm btn-danger ml-3 pl-3 delete_post" data-id="${data.id}">Delete</button>
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
</style>
