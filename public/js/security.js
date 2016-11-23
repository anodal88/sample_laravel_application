/**
 * Created by lara on 7/23/16.
 */




/*
 *Paint the data table roles
 * */
$(function () {

    $('#role-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: 'get',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]

    });
});

$("#submit_new_rol").on('click', function (e) {
    e.preventDefault();

    var form = $("#frm_new_rol");
    var formData = {
        name: $('#name').val(),
        display_name: $('#display_name').val(),
        description: $('#description').val(),
    }
    var token=$('#token').val();

    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': token},
        cache: false,
        url: 'new_role',
        data: formData,
        success: function (data) {
            console.log(data);
            $('#new_rol').modal('hide');
            good();
        }

    });
    // ajaxCall('new_role',formData,null,'POST',token,good(),bad());

});

function good() {
    alertify.success('Success message');
}

function bad() {
    alertify.success('Success message');
}

//
// $(document).ready (function(){
//
//     $("#success-alert").hide();
//     $("#myWish").click(function showAlert() {
//         $("#success-alert").alert();
//         window.setTimeout(function () {
//             $("#success-alert").alert('close'); }, 2000);
//     });
// });
//
// $('#submit').on("click", function(){
//     $('#prueba').modal.show();
// });
// function PageInit() {
//     $dialog = $('<div id="prueba"></div>')
//         .dialog({
//             autoOpen: false,
//             title: 'Dialogo Básico',
//             modal: true
//         });
// }
