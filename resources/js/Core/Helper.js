import Swal from 'sweetalert2';
/**
 * Class Helper
 */
class Helper {

    ajaxDatatable(el, columnDefs, columns, orderArr = [[2, 'asc']]) {
        let realUrl = $(el).data("url");
        return $(el).DataTable({
            "processing"  : true,
            "serverSide"  : true,
            'paging'      : true,
            "ordering"    : true,
            "ajax"        : realUrl,
            // "autoWidth": false,
            "columnDefs": columnDefs,
            "columns": columns,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "order": orderArr,
            initComplete: function () {
                this.api().columns([1,2]).every(function () {
                    let column = this;
                    let input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            let val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? val : '', true, false).draw();
                        });
                });
            }
        });
    }

    /**
     * Delete Recorde
     * @param  {[type]} dataTable [description]
     * @return {[type]}           [description]
     */
    deleteRecord(dataTable = "") {
        let s = this;
        $(document).on('click', ".btn-delete", function (e) {
            e.preventDefault();
            let me = $(this);
            let url = me.attr('href');
            Swal.fire({
                title: me.data('alert-title'),
                showCancelButton: true,
                confirmButtonText: me.data('confirm'),
                cancelButtonText: me.data('cancel'),
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.delete(url)
                        .then(function (response) {
                            let data = response.data;
                            console.log(data);
                            if (data.error) {
                                Swal.fire(data.message, '', 'warning');
                            } else {
                                if (dataTable != "") {
                                    Swal.fire(data.message, '', 'success');
                                    dataTable.ajax.reload();
                                } else {
                                    Swal.fire(data.message, '', 'success');
                                }
                            }
                        })
                        .catch(function (error) {
                            Swal.fire("Can't delete record", '', "warning");
                            console.log(error);
                        });

                }
            });
        });
    }

    showModal() {
        $(document).on('click', '.btn-show-modal', function (e) {
            e.preventDefault();
            let me = $(this);
            let url = me.attr('href');
            let size = me.data('size');
            let hideFooter = me.data('hide-footer');
            if (size !== undefined) {
                $('.modal-dialog').addClass(size);
            } else {
                $('.modal-dialog').removeClass('modal-lg')
            }
            if (hideFooter !== undefined) {
                $('.modal-footer').hide();
                $('.modal-body').addClass('p-0');
            } else {
                $('.modal-footer').show();
                $('.modal-body').removeClass('p-0');
            }
            $('#modal-default-title').html(me.data('title'));
            axios.get(url)
                .then(function (response) {
                    let modal = $('#modal-default-body');
                    modal.html(response.data);
                    $('#modal-default').modal({backdrop: 'static', keyboard: false}).show();
                    $('input[autofocus]').trigger('focus');
                    $('.select2').select2({
                        dropdownParent: $("#modal-default"),
                        theme: 'bootstrap4',
                    });
                    let inputDateTime = me.data('datetimepicker');
                    console.log(inputDateTime);
                    if (inputDateTime) {
                        let start = $(inputDateTime).data('val');
                        console.log(start);
                        $(inputDateTime).datetimepicker({
                            defaultDate: start,
                            icons: { time: "fa fa-clock"},
                            format: 'DD/MM/YYYY HH:mm'
                        });
                    }
                    modal.find('form').submit(function (e) {
                        e.preventDefault();
                        $('.btn-modal-default-save').trigger('click');
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    }

    displayErrors(errors) {
        if ($.isEmptyObject(errors) == false) {
            $.each(errors, function (key, val) {
                console.log(key);
                console.log(val);
                $("#" + key)
                    .addClass('is-invalid')
                    .closest('.form-group')
                    .append($('<div class="invalid-feedback d-block">' + val +'</div>').hide().fadeIn());
            });
            console.log('Error Form');
        }
        console.log('No Error');
    }

    displayInlineErrors(errors) {
        if ($.isEmptyObject(errors) == false) {
            $.each(errors, function (key, val) {
                console.log(key);
                console.log(val);
                $("#" + key)
                    .addClass('is-invalid')
                    .closest('.col-sm-10')
                    .append($('<span class="invalid-feedback" role="alert">' + val +'</span>').hide().fadeIn());
            });
            console.log('Error Form');
        }
        console.log('No Error');
    }


    /**
     * Remove Error Form message
     */
    removeFormError(form) {
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
    }

    /**
     * Add New Record
     */
    modalSave(dataTable = "") {
        let obj = this;
        $(document).on('click','.btn-modal-save', function (e) {
            let me = $(this);
            e.preventDefault();
            let form = $('#modal-form-body form');
            let url = form.attr('action');
            obj.removeFormError(form);
            let data =  new FormData(form[0]);
            // me.prop("disabled", true);
            let edit = me.data('edit') ? true : false;
            let axiosUrl = edit ? axios.put(url, data) : axios.post(url, data);
            axiosUrl.then(function (response) {
                let data = response.data;
                console.log(data);
                if (data.error) {
                    toastr.error(data.message);
                } else {
                    $("#modal-form").modal('hide');
                    toastr.success(data.message);
                    me.prop("disabled", false);
                    if (dataTable !== "") {
                        dataTable.ajax.reload();
                    }
                    if (data.reload) {
                        window.location.reload();
                    }

                    if (data.url) {
                        window.location.replace(data.url);
                    }
                }
            })
                .catch(function (xhr) {
                    let errors = xhr.response.data.errors;
                    console.log(xhr);
                    // me.prop("disabled", false);
                    obj.displayErrors(errors);
                });
        });
    }

    formSave(formEl, file = "") {
        let obj = this;
        $(document).on('click', '.btn-form-save', function (e) {
            e.preventDefault();
            let me = $(this);
            let form = $(formEl);
            let url = form.attr('action');
            let method = form.attr('method');
            let edit = me.data('edit') ? true : false;
            obj.removeFormError(form);
            let data = new FormData(form[0]);
            if (file != "") {
                data.append(file, document.getElementById(file).files[0]);
            }
            axios.post(url, data)
                .then(function (response) {
                    let data = response.data;
                    console.log(data);
                    if (data.error) {
                        console.log(data);
                        helper.toast(data.message, 'bg-danger');
                    } else {
                        if (!edit) {
                            form[0].reset();
                            $('input[autofocus]').trigger('focus');
                        }
                        if (data.reload) {
                            window.location.reload();
                        }
                        helper.toast(data.message)
                        if (data.url) {
                            window.location.replace(data.url);
                        }
                    }
                }).catch(function (xhr) {
                // console.log(xhr);
                let errors = xhr.response.data.errors;
                me.prop("disabled", false);
                obj.displayInlineErrors(errors);
            });
        })
    }
    toast(message, type = 'bg-success') {
        $(document).Toasts('create', {
            title: 'Alert Message',
            body: message,
            class: type,
            autohide: true,
            delay: 2000,
        });
    }

    findItem() {
        let form = $("#form-item-id");
        let thisMe = this;
        $(document).on("keyup", "#item_id", function () {
            let query = $(this).val();
            let url = form.data('url');
            let _token = $('input[name="_token"]').val();
            let data = {query: query, _token: _token};
            if (query != '') {
                axios.post(url, data)
                    .then(function (response) {
                        let data = response.data;
                        if (data.error) {
                        } else {
                            $('#item_list').slideDown();
                            $('#item_list').html(data);
                        }
                    })
                    .catch(function (xhr) {
                        let errors = xhr.response.data;
                        toastr.error("Somthing Wrong!");
                    });
            }
            if (query == "") {
                $('#item_list').slideUp();
            }
        });
    }

    showAjaxModal() {
        $(document).on('click', '.btn-show-modal', function (e) {
            e.preventDefault();
            let me = $(this);
            let url = me.attr('href');
            $('#modal-form-title').html(me.attr('title'));
            axios.get(url)
                .then(function (response) {
                    let modal = $('#modal-form-body');
                    modal.html(response.data);
                    $('#modal-form').modal({backdrop: 'static', keyboard: false}).show();
                    $('#modal-form').on('shown.bs.modal', function () {
                        $('#name').trigger('focus');
                        // $('input[autofocus]').trigger('focus');
                    })

                    modal.find('form').submit(function (e) {
                        e.preventDefault();
                        $('.btn-modal-save').trigger('click');
                    });
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    }
}
let helper = new Helper();
export default helper;
