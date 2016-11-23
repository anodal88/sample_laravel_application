/**
 * Created by lara on 7/27/16.
 */

$(function () {

    // $("#nu_active").click(function () {
    //    ($('input:checkbox[name=colorfavorito]:checked').val();
    // });
    /*
     *Paint the data table users
     * */
    var user_table = $('#user-table').DataTable({

        responsive: true,
        processing: true,
        serverSide: true,

        ajax: {
            'url': 'get',
            'type': 'GET'
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]

    });


    /*
     *Add new user
     * */
    $("#submit_new_user").on('click', function (e) {
        e.preventDefault();


        // var form = $("#frm_new_rol");
        var formData = {
            name: $('#nu_name').val(),
            role: $('#new_user_rol').val(),
            username: $('#nu_username').val(),
            password: $('#nu_password').val(),
            password_confirmation: $('#nu_password_confirmation').val(),
            email: $('#nu_email').val(),
            active: $("#nu_active").prop('checked') ? 1 : 0
        };
        var token = $('#token').val();

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'new_user',
            data: formData,
            success: function (data) {


                if (data['status'] == 'failure') {
                    if (data['message']['name'] != undefined || data['message']['name'] != null) {
                        msg('error', data['message']['name'][0]);
                        $('#nu_name').val('');
                        $('#nu_name').focus();
                    }
                    if (data['message']['username'] != undefined || data['message']['username'] != null) {
                        msg('error', data['message']['username'][0]);
                        $('#nu_username').val('');
                        $('#nu_username').focus();
                    }

                    if (data['message']['password'] != undefined || data['message']['password'] != null) {
                        msg('error', data['message']['password'][0]);
                        $('#nu_password').val('');
                        $('#nu_password_confirmation').val('');
                        $('#nu_password').focus();

                    }
                    if (data['message']['email'] != undefined || data['message']['email'] != null) {
                        msg('error', data['message']['password'][0]);
                        $('#nu_email').val('');
                        $('#nu_email').focus();
                    }
                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);
                        $('#user-table').dataTable()._fnAjaxUpdate();
                        $('#nu_name').val('');
                        $('#nu_username').val('');
                        $('#nu_email').val('');

                        $('#modal_new_user').modal('hide');
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


    var pr = $('#new_user_rol').bootstrapDualListbox({
        showFilterInputs: true
    });

    /*
     *Get All Role
     * */
    $("#btn_new_user").on('click', function (e) {
        e.preventDefault();
        if ($('#new_user_rol option').length != 0) {
            $("#new_user_rol option").remove();
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
                    $('#new_user_rol').append('<option value="' + data[i]['id'] + '">' + data[i]['display_name'] + '</option>');
                }
                pr.bootstrapDualListbox('refresh', true);


            },
            error: function (req, status, err) {
                msg('error', 'error');

            }
        });
    });


    $('#user-table').DataTable().on('click', '#btn_user_reset_password[data-remote]', function (e) {
        $('#rp_id').val($(this).data('remote'));

    });


    /*
     *
     * Reset password
     *
     * */

    $('#submit_reset_password').on('click', function (e) {
        e.preventDefault();

        var formData = {
            password: $('#rp_password').val(),
            password_confirmation: $('#rp_password_confirmation').val()
        };
        var token = $('#token').val();
        var id = $('#rp_id').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'reset_passwd/' + id,
            data: formData,
            success: function (data) {


                if (data['status'] == 'failure') {
                    msg('error', data['message']['password'][0]);
                    $('#rp_password').val('');
                    $('#rp_password_confirmation').val('');
                    $('#rp_password').focus();

                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);
                        $('#rp_password').val('');
                        $('#rp_password_confirmation').val('');
                        $('#rp_id').val('');

                        $('#modal_reset_password').modal('hide');
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
     *Click submit edit user
     */
    $('#submit_edit_user').on('click', function (e) {

        e.preventDefault();

        var formData = {
            name: $('#eu_name').val(),
            rol: $('#edit_user_rol').val(),
            display_name: $('#eu_username').val(),
            active: $("#eu_active").prop('checked') ? 1 : 0
            // description: $('#eu_email').val(),
        };
        var token = $('#token').val();
        var id = $('#eu_id').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'update/' + id,
            data: formData,
            success: function (data) {


                if (data['status'] == 'failure') {
                    if (data['message']['name'] != undefined || data['message']['name'] != null) {
                        msg('error', data['message']['name'][0]);
                        $('#eu_name').val('');
                        $('#eu_name').focus();
                    }
                    if (data['message']['username'] != undefined || data['message']['username'] != null) {
                        msg('error', data['message']['username'][0]);
                        $('#eu_username').val('');
                        $('#eu_username').focus();
                    }
                } else {
                    if (data['status'] == "success") {
                        msg('success', data['message']);
                        $('#user-table').dataTable()._fnAjaxUpdate();
                        $('#eu_name').val('');
                        $('#eu_username').val('');
                        $('#eu_email').val('');
                        $("#nu_active").prop('checked', false);

                        $('#modal_edit_user').modal('hide');
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
     *Click and edit user
     * */
    var pl = $('#edit_user_rol').bootstrapDualListbox({
        showFilterInputs: true
    });
    $('#user-table').DataTable().on('click', '.btn_edit_user[data-remote]', function (e) {
        e.preventDefault();
        if ($('#edit_user_rol option').length != 0) {
            $("#edit_user_rol option").remove();
        }

        var id = $(this).data('remote');

        var token = $('#token').val();
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            cache: false,
            url: 'getAllUser/' + id,
            success: function (data) {
                console.log(data);
                for (i = 1; i < data.length; i++) {
                    if (data[i]['intersect']) {
                        $('#edit_user_rol').append('<option selected="selected" value="' + data[i]['data']['id'] + '">' + data[i]['data']['display_name'] + '</option>');
                    } else {
                        $('#edit_user_rol').append('<option value="' + data[i]['data']['id'] + '">' + data[i]['data']['display_name'] + '</option>');
                    }

                }


                $('#eu_name').val(data[0]['user']['name']);
                $("#eu_active").prop('checked', data[0]['user']['active']);
                $('#eu_id').val(id);
                $('#eu_username').val(data[0]['user']['username']);
                // $('#eu_email').val(data[0]['user']['email']);

                pl.bootstrapDualListbox('refresh', true);

            },
            error: function (req, status, err) {
                msg('error', 'error');

            }
        });
    });


    /*
     *Click and delete rol
     * */
    $('#user-table').DataTable().on('click', '.btn_delete_user[data-remote]', function (e) {
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
                    $('#user-table').dataTable()._fnAjaxUpdate();
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
});
