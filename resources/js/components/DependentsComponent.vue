<template>

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


</template>

<script>

import $ from 'jquery';
window.jQuery = $;
window.$ = $;
import datatable from 'datatables.net';

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
                    columns:[
                            {title: 'ID', data: 'id'},
                            {title: 'Name', data: 'name'},
                            {title: 'Last Name', data: 'last_name'},
                            {title: 'Date Of Birth', data: 'date_of_birth'},
                        ]
                });
            }
        },

}


</script>


<style scoped>

</style>
