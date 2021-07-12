import helper from "../Core/Helper";

// Datatable Column Defs
let columnDefs = [
    { "targets": 0, "orderable": false},
    { "searchable": false, "targets": [0,2,3]}
];
// Datatable Columns
let columns = [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'role_permissions', name: 'role_permissions', orderable: false},
    {data: 'action', name: 'action',orderable: false},
];

/**
 * Class User
 */
class Role {
    constructor() {
        let dataTable = helper.ajaxDatatable("#index-dataTable", columnDefs, columns, []);
        helper.deleteRecord(dataTable);
    }
}
let role = new Role();
