<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/map', 'GoogleController@index');


    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'role:admin'], function () {

            Route::get('/home', 'HomeController@index');

            Route::group(['prefix' => 'role'], function () {
                Route::get('rol', 'RoleController@index');

                Route::get('get', 'RoleController@get');
                Route::get('show/{id_role}', 'RoleController@show');
                Route::post('new_role', 'RoleController@store');
                Route::post('update/{id}', 'RoleController@update');
                Route::delete('destroy/{id}', 'RoleController@destroy');

                Route::resource('getAll', 'PermissionController@getAll');
                Route::post('getAllRol/{id_role}', 'PermissionController@getAllRol');
            });

            Route::group(['prefix' => 'mette'], function () {
                Route::get('matte_index', 'MatteDesignController@mette_index');
                Route::get('editor_index', 'MatteDesignController@editor_index');
                Route::post('store', 'MatteDesignController@store');
            });

            Route::group(['prefix' => 'user'], function () {
                Route::get('user_index', 'UserController@user_index');
                Route::get('get', 'UserController@get');
                Route::delete('destroy/{id}', 'UserController@destroy');
                Route::post('getAllUser/{id_user}', 'RoleController@getAllUser');
                Route::resource('getAll', 'RoleController@getAll');
                Route::post('update/{id}', 'UserController@update');
                Route::post('new_user', 'UserController@store');
                Route::post('reset_passwd/{id}', 'UserController@reset_passwd');
            });


            Route::group(['prefix' => 'perm'], function () {
                Route::get('permission', 'PermissionController@index');
                Route::get('get', 'PermissionController@get');
                Route::post('show/{id}', 'PermissionController@show');
                Route::post('new_permission', 'PermissionController@store');
                Route::delete('destroy/{id}', 'PermissionController@destroy');
                Route::post('update/{id}', 'PermissionController@update');
            });

        });
    });


});


Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout');
    Route::get('/paymentDetails', 'PaymentController@index');
    Route::resource('user', 'UserController', ['only' => ['index', 'store', 'update', 'destroy']]);
    Route::resource('user.projects', 'ProjectController', ['only' => ['index', 'store', 'update', 'destroy', 'show', 'pullToRefresh']]);
    Route::get('/user/{user}/projects/{lp}/pulltorefresh', 'ProjectController@pulltorefresh')->name('api.user.projects.pulltorefresh');
    Route::get('/user/{user_id}/projects/{project_id}/togglefavorite', 'ProjectController@toggleFavorite')->name('api.user.projects.togglefavorite');
    Route::resource('size', 'SizeController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
    Route::get('/size/{ls}/pulltorefresh', 'SizeController@pulltorefresh')->name('api.size.pulltorefresh');
    Route::resource('mattetemplate', 'MatteTemplateController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);
    Route::get('/mattetemplate/{lmt}/pulltorefresh', 'MatteTemplateController@pulltorefresh')->name('api.mattetemplate.pulltorefresh');
    Route::get('/mattetemplate/{mattetemplate}/specifications', 'MatteTemplateController@specifications')->name('api.mattetemplate.specifications');
    Route::resource('user.order', 'OrderController', ['only' => ['index', 'store', 'update', 'destroy','show']]);

    /*Shopping Cart*/
    Route::get('/shoppingcart/user/{user}/products', 'ShoppingCartController@productList')->name('api.shoppingcart.productslist');
    Route::delete('/shoppingcart/user/{user}/emptycart', 'ShoppingCartController@emptyCart')->name('api.shoppingcart.emptycart');
    Route::post('/shoppingcart/addproduct', 'ShoppingCartController@addToCart')->name('api.shoppingcart.addtocart');
    Route::delete('/shoppingcart/user/{user}/remove/product/{line_id}', 'ShoppingCartController@removeProduct')->name('api.shoppingcart.removeproduct');

    /*Payments*/
    Route::post('/payment/user/{user_id}/creditcard', 'PaymentController@creditCardPayment')->name('api.payment.creditCardPayment');
    Route::post('/payment/user/{user_id}/creditcard/{card_id}/', 'PaymentController@storedCreditCardPayment')->name('api.payment.storedCreditCardPayment');


    /*Vault and Local functions*/
    Route::post('/vault/user/{user_id}/create/card', 'PaymentController@createCard')->name('api.vault.createCard');
    Route::get('/vault/user/{user_id}/card/{card_id}/details', 'PaymentController@getCardDetailsFromPaypal')->name('api.vault.getCardDetailsFromPaypal');
    Route::get('/vault/local/user/{user_id}/card/{card_id}/details', 'PaymentController@getLocalCardDetails')->name('api.vault.getLocalCardDetails');
    Route::get('/vault/local/list/user/{user_id}/cards', 'PaymentController@getCardList')->name('api.vault.getCardList');
    Route::delete('/vault/user/{user_id}/card/{card_id}/delete', 'PaymentController@deleteCard')->name('api.vault.deleteCard');

    /*Sale*/
    Route::get('/sale/{transaction_id}/details', 'PaymentController@getSaleFromPaypal')->name('api.vault.getSaleFromPaypal');

    /*Filesystem operations*/
    Route::post('/filesystem/upload/image', 'FileSystemController@uploadProjectImage')->name('api.filesystem.uploadprojectimage');
});



Route::get('/home', 'HomeController@index');
Route::get('/checkoutSuccess', 'PaymentController@checkoutSuccess');
Route::get('/checkoutCancel', 'PaymentController@checkoutCancel');


