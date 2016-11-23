/**
 * Created by lara on 7/27/16.
 */


$(function () {

    /*
     *Paint the data table permissions
     * */
    var permission_table = $('#permission-table').DataTable({

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
     *Click submit rol
     */


    $('#submit_edit_permission').on('click', function (e) {

        e.preventDefault();

        var formData = {
            name: $('#ep_name').val(),
            display_name: $('#ep_display_name').val(),
            description: $('#ep_description').val(),
        };
        var token = $('#token').val();
        var id = $('#ep_id').val();
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
                        $('#ep_name').val('');
                        $('#ep_name').focus();
                    }
                    if (data['message']['display_name'] != undefined || data['message']['display_name'] != null) {
                        msg('error', data['message']['display_name'][0]);
                        $('#ep_display_name').val('');
                        $('#ep_display_name').focus();
                    }
                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);
                        $('#permission-table').dataTable()._fnAjaxUpdate();
                        $('#ep_name').val('');
                        $('#ep_display_name').val('');
                        $('#ep_description').val('');

                        $('#modal_edit_permission').modal('hide');
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
     *Click and delete permission
     * */
    $('#permission-table').DataTable().on('click', '.btn_delete_permission[data-remote]', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var id = $(this).data('remote');
        $.ajax({
            url: "destroy/" + id,
            type: 'DELETE',
            success: function (data) {

                if (data['status'] == "success") {

                    msg('success', data['message']);
                    $('#permission-table').dataTable()._fnAjaxUpdate();
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
     *Click and edit permission
     * */

    $('#permission-table').DataTable().on('click', '.btn_edit_permission[data-remote]', function (e) {
        e.preventDefault();

        var id = $(this).data('remote');

        var token = $('#token').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'show/' + id,
            success: function (data) {
                console.log(data);
                $('#ep_name').val(data['name']);
                $('#ep_id').val(id);
                $('#ep_display_name').val(data['display_name']);
                $('#ep_description').val(data['description']);

                pl.bootstrapDualListbox('refresh', true);

            },
            error: function (req, status, err) {
                msg('error', 'error');

            }
        });
    });



    $("#submit_np").on('click', function (e) {
        e.preventDefault();

        // var form = $("#frm_new_permission");
        var formData = {
            name: $('#np_name').val(),
            display_name: $('#np_display_name').val(),
            description: $('#np_description').val(),
        };
        var token = $('#token').val();

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'new_permission',
            data: formData,
            success: function (data) {


                if (data['status'] == 'failure') {
                    if (data['message']['name'] != undefined  || data['message']['name'] != null) {
                        msg('error', data['message']['name'][0]);
                        $('#np_name').val('');
                        $('#np_name').focus();
                    }
                    if (data['message']['display_name'] != undefined || data['message']['display_name'] != null) {
                        msg('error', data['message']['display_name'][0]);
                        $('#np_display_name').val('');
                        $('#np_display_name').focus();
                    }
                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);

                        $('#np_name').val('');
                        $('#np_display_name').val('');
                        $('#np_description').val('');

                        $('#permission-table').dataTable()._fnAjaxUpdate();

                        $('#modal_new_permssion').modal('hide');
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