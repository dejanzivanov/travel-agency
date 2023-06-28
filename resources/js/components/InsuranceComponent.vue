

<template>
<div class="container">
    <div class="row">
        <h1 class="text-center text-white">Insurance</h1>
    </div>
    <div>
        <table id="insurance-table" class="display text-white">
            <thead>
            <tr>
                <th class="text-white">ID</th>
                <th class="text-white">Name</th>
                <th class="text-white">Last Name</th>
                <th class="text-white">Phone</th>
                <th class="text-white">Start Date</th>
                <th class="text-white">End Date</th>
                <th class="text-white">Policy Type</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</template>

<script>

import $ from 'jquery';
import datatable from 'datatables.net';
import moment from "moment";
export default
{
    mounted: function()
    {
        var self = this;

        // console.log('Component mounted.')
        this.initTable();

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
                    {title: 'Start Date', orderable: false, data: 'journey_start', render: function(data, type, row) {
                            if(data != null) {
                                return '<span class="start_date" title="' + data + '">' + moment(data).format('DD.MM.YYYY') + '</span>';
                            }
                            else
                                return data;
                        },
                    },
                    {title: 'End Date', orderable: false, data: 'journey_end', render: function(data, type, row) {
                            if(data != null) {
                                return '<span class="end_date" title="' + data + '">' + moment(data).format('DD.MM.YYYY') + '</span>';
                            }
                            else
                                return data;
                        },
                    },
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

<style scoped>

.policy_type{
    color: #0000EE;
    cursor: pointer!important;
}

</style>
