

<template>
<div class="container">
    <div class="row">
        <h1 class="text-center">Insurance</h1>
    </div>
    <div>
        <table id="insurance-table" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Policy Type</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</template>

<script>

import $ from 'jquery';
import datatable from 'datatables.net';
export default
{
    mounted: function()
    {
        // console.log('Component mounted.')
        this.initTable();
        var self = this;

        $(document).on('click', '.policy_type', function()
        {
            // let data_id = $(this).data('id');
            // console.log(data_id);
            //     console.log(response.data);
            //     self.insurances = response.data;
            //     self.destroyTable();
            //     self.initTable();
            // })
            // .catch(error => {
            //     console.log(error);
            // });
        });
    },
    data(){
        return{
            insurances: [],
        };
    },
    methods:
    {
        initTable()
        {
            const self = this;
            $('#insurance-table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: '/insurance-data',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data: {},
                },
                responsive: true,
                columns:[
                    {title: 'ID', data: 'id'},
                    {title: 'Name', data: 'name'},
                    {title: 'Last Name', data: 'last_name'},
                    {title: 'Phone', data: 'phone_number'},
                    {title: 'Start Date', data: 'journey_start'},
                    {title: 'End Date', data: 'journey_end'},
                    {title: 'Policy Type', data: 'type', 'render': function (data, type, row)
                        {
                            if(data === 'group')
                                return '<a  href="/dependents/' + row.id +'" data-id="' + row.id + '" class="policy_type" >'+data.toString().charAt(0).toUpperCase() + data.slice(1) +'</a>';
                            else
                                return data.toString().charAt(0).toUpperCase() + data.slice(1);
                        }},
                ],

            });
        },
        destroyTable()
        {
            const dataTable = $('#insurance-table').DataTable();
            dataTable.clear().destroy();
        },

    },
}

</script>

<style>

.policy_type{
    color: #0000EE;
    cursor: pointer!important;
}

</style>
