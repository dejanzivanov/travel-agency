<template>
    <div class="container">
        <div class="row">
            <div class="col-9 pt-5" >
                <table id="dependents-table" class="display">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



</template>

<script>

import $ from 'jquery';
window.jQuery = $;
window.$ = $;
import datatable from 'datatables.net';
import moment from "moment/moment";

export default {
    props:
        {
            data: [],
        },
    data() {
        return {
            val: {},
        }
    },
    mounted: function() {
        this.initTable();
    },

    methods:
        {
            initTable() {
                const self = this;

                $('#dependents-table').DataTable({
                    data: self.data,
                    responsive: true,
                    columns:[
                            {title: 'ID', data: 'id'},
                            {title: 'Name', data: 'name'},
                            {title: 'Last Name', data: 'last_name'},
                            {title: 'Date Of Birth', orderable: false, data: 'date_of_birth', render: function(data, type, row) {
                                    if(data != null) {
                                        return '<span class="start_date" title="' + data + '">' + moment(data).format('DD.MM.YYYY') + '</span>';
                                    }
                                    else
                                        return data;
                                },
                            },
                        ]
                });
            }
        },

}


</script>


<style>

#blog-table > tbody > tr > td.sorting_1 {
    background-color: #999292 !important;
}

#dependents-table.dataTable tbody tr {
    background-color: #999292 !important;
}

#dependents-table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.even {
    background-color: #999292 !important;
}
#dependents-table.dataTable.display tbody tr:hover>.sorting_1
{
    background-color: #999292 !important;
}
#dependents-table > tbody > tr:nth-child(1) > td.sorting_1
{
    background-color: #999292 !important;
}

#dependents-table > tbody > tr:nth-child(1)
{
    background-color: #999292 !important;
}

table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
    background-color: #999292 !important;
}


table.dataTable.display tbody tr.even>.sorting_1, table.dataTable.order-column.stripe tbody tr.even>.sorting_1 {
    background-color: #999292 !important;
}



</style>
