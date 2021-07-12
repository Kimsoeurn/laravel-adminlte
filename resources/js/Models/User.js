import helper from "../Core/Helper";

// Datatable Column Defs
let columnDefs = [
    { "targets": 0, "orderable": false},
    { "searchable": false, "targets": [0,4,5]}
];
// Datatable Columns
let columns = [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'email', name: 'email'},
    {data: 'role', name: 'role'},
    {data: 'last_login_time', name: 'last_login_time'},
    {data: 'action', name: 'action',orderable: false},
];

/**
 * Class User
 */
class User {
    constructor() {
        let dataTable = helper.ajaxDatatable("#index-dataTable", columnDefs, columns, []);
        helper.deleteRecord(dataTable);
    }
}
let user = new User();
