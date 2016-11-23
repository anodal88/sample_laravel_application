/**
 * Created by lara on 10/26/16.
 */
$(function () {

    function hola() {
        alert(1);
    }

$('form#mette_send button[role="presentation"]').on('click', function (e) {
    e.preventDefault();
    console.log(this.text);
    alert(1);
});

});