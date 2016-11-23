/**
 * Created by lara on 7/23/16.
 */

$(function () {


    /*
     *Paint the data table roles
     * */
    var role_table = $('#role-table').DataTable({

        responsive: true,
        processing: true,
        serverSide: true,

        ajax: {
            'url': 'get',
            'type': 'GET'
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]

    });

    /*
     *Click and edit rol
     * */
    var pl = $('#edit_permission_rol').bootstrapDualListbox({
        showFilterInputs: true
    });
    $('#role-table').DataTable().on('click', '.btn_edit_rol[data-remote]', function (e) {
        e.preventDefault();
        if ($('#edit_permission_rol option').length != 0) {
            $("#edit_permission_rol option").remove();
        }

        var id = $(this).data('remote');

        var token = $('#token').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'getAllRol/' + id,
            success: function (data) {
                console.log(data);
                for (i = 1; i < data.length; i++) {
                    if (data[i]['intersect']) {
                        $('#edit_permission_rol').append('<option selected="selected" value="' + data[i]['data']['id'] + '">' + data[i]['data']['display_name'] + '</option>');
                    } else {
                        $('#edit_permission_rol').append('<option value="' + data[i]['data']['id'] + '">' + data[i]['data']['display_name'] + '</option>');
                    }

                }


                $('#er_name').val(data[0]['rol']['name']);
                $('#er_id').val(id);
                $('#er_display_name').val(data[0]['rol']['display_name']);
                $('#er_description').val(data[0]['rol']['description']);

                pl.bootstrapDualListbox('refresh', true);

            },
            error: function (req, status, err) {
                msg('error', 'error');

            }
        });
    });

    /*
     *Click submit rol
     */
    $('#submit_edit_rol').on('click', function (e) {

        e.preventDefault();

        var form = $("#frm_new_rol");
        var formData = {
            name: $('#er_name').val(),
            permission: $('#edit_permission_rol').val(),
            display_name: $('#er_display_name').val(),
            description: $('#er_description').val(),
        };
        var token = $('#token').val();
        var id = $('#er_id').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'update/' + id,
            data: formData,
            success: function (data) {


                if (data['status'] == 'failure' ) {
                    if (data['message']['name'] != undefined || data['message']['name'] != null) {
                        msg('error', data['message']['name'][0]);
                        $('#er_name').val('');
                        $('#er_name').focus();
                    }
                    if (data['message']['display_name'] != undefined || data['message']['display_name'] != null) {
                        msg('error', data['message']['display_name'][0]);
                        $('#er_display_name').val('');
                        $('#er_display_name').focus();
                    }
                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);
                        $('#role-table').dataTable()._fnAjaxUpdate();
                        $('#er_name').val('');
                        $('#er_display_name').val('');
                        $('#er_description').val('');

                        $('#modal_edit_rol').modal('hide');
                    }
                }


                console.log(data);

            },
            error: function (req, status, err) {
                console.log('something went wrong', status, err);
                msg('error', 'error');
            }

        });

    });


    /*
     *Click and delete rol
     * */
    $('#role-table').DataTable().on('click', '.btn_delete_rol[data-remote]', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        e.preventDefault();

        var id = $(this).data('remote');
        $.ajax({
            url: "destroy/" + id,
            type: 'DELETE',
            success: function (data) {

                if (data['status'] == "success") {
                    $('#role-table').dataTable()._fnAjaxUpdate();
                    msg('success', data['message']);
                }


                console.log(data);

            },
            error: function (req, status, err) {
                console.log('something went wrong', status, err);
                msg('error', 'error');
            }
        });

    });



    var pr = $('#nr_permission_rol').bootstrapDualListbox({
        showFilterInputs: true
    });


    /*
     *Get All Permissions
     * */
    $("#addrol").on('click', function (e) {
        e.preventDefault();
        if ($('#nr_permission_rol option').length != 0) {
            $("#nr_permission_rol option").remove();
        }
        ;

        var token = $('#token').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'getAll',
            success: function (data) {
                for (i = 0; i < data.length; i++) {
                    $('#nr_permission_rol').append('<option value="' + data[i]['id'] + '">' + data[i]['display_name'] + '</option>');
                }
                pr.bootstrapDualListbox('refresh', true);


            },
            error: function (req, status, err) {
                msg('error', 'error');

            }
        });
    });

    /*
     *Add new role
     * */
    $("#submit_new_rol").on('click', function (e) {
        e.preventDefault();

        // var form = $("#frm_new_rol");
        var formData = {
            name: $('#nr_name').val(),
            permission: $('#nr_permission_rol').val(),
            display_name: $('#nr_display_name').val(),
            description: $('#nr_description').val(),
        };
        var token = $('#token').val();

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'new_role',
            data: formData,
            success: function (data) {


                if (data['status'] == 'failure' ) {
                    if (data['message']['name'] != undefined || data['message']['name'] != null) {
                        msg('error', data['message']['name'][0]);
                        $('#nr_name').val('');
                        $('#nr_name').focus();
                    }
                    if (data['message']['display_name'] != undefined || data['message']['display_name'] != null) {
                        msg('error', data['message']['display_name'][0]);
                        $('#nr_display_name').val('');
                        $('#nr_display_name').focus();
                    }
                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);
                        $('#role-table').dataTable()._fnAjaxUpdate();
                        $('#nr_name').val('');
                        $('#nr_display_name').val('');
                        $('#nr_description').val('');

                        $('#modal_new_rol').modal('hide');
                    }
                }
                console.log(data);
            },
            error: function (req, status, err) {
                console.log('something went wrong', status, err);
                msg('error', 'error');
            }

        });

    });


});