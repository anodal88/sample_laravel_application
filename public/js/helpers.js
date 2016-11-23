/**
 * Created by lara on 7/23/16.
 */

/*
* Type msg [success,error,warning,message]
* **/
function msg(type_msg,msg) {
    if (type_msg === 'success') {
        alertify.success(msg);
    } else if (type_msg === 'error') {
        alertify.error(msg);
    } else if (type_msg === 'warning') {
        alertify.warning(msg);
    } else if (type_msg === 'message') {
        alertify.message(msg);
    } else {
        alertify.message(msg);
    }
}


    function resetCaptcha(){
        var img = document.getElementById('img');
        img.src="/captcha/inverse?"+Math.random(8);
    }


// /*By Mohammad Khodabandeh        */
// function ajaxCall(url, params, timeOut, type, token,ajxSuccessFn, ajxFailFn) {
//
//     timeOut = timeOut === "" ||
//     timeOut === "undefined" ||
//     timeOut === null ? 6000 : timeOut;
//     type = type.toUpperCase() != "GET" &&
//     type.toUpperCase() != "POST" &&
//     type.toUpperCase() != "PUT" &&
//     type.toUpperCase() != "DELETE" ? "POST" : type;
//
//     $.ajax({
//         type: type.toUpperCase(),
//         cache: false,
//         url: url,
//         data: params,
//         headers: {'X-CSRF-TOKEN': token},
//         success: function(result) {
//             console.log("#.1 ------ start of ajax success -----");
//
//             if (arguments.length > 4) {
//                 var successFn = partial(ajxSuccessFn, result);
//                 successFn();
//             }
//
//             console.log("#.2 ------ end of ajax success -----");
//         },
//         error: function(xhr, ajaxOptions, thrownError) {
//
//             if (arguments.length > 5) {
//                 var errorFn = partial(ajxFailFn, xhr, thrownError);
//                 errorFn();
//             }
//
//             console.log("\n\t*** ajax call failure! : (readyState: " +
//                 xhr.readyState + " - status: " + xhr.status +" "+ xhr.statusText +
//                 ") Error Message: " + thrownError.message + " ***");
//         },
//         timeout: timeOut
//     }).complete(function(xhr, status) {
//         console.log("\n\t***  ajax call completed: (readyState: " +
//             xhr.readyState + " - status: " + xhr.status +" "+ xhr.statusText + ") Result: " + status + " ***");
//     });
// }
// //*************** Partial Definition ************/
// function partial(fn) {
//     var args = Array.prototype.slice.call(arguments);
//     args.shift();
//     return function() {
//         var new_args = Array.prototype.slice.call(arguments);
//         args = args.concat(new_args);
//         return fn.apply(window, args);
//     };
// }
// $p = partial;
