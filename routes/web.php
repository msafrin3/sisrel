<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['logs']], function() {
    Route::get('/', 'HomeController@index');
    
    Auth::routes();
    
    Route::group(['middleware' => 'auth'], function() {
        Route::get('/home', 'HomeController@index')->name('home');
    
        // ADMIN
        
        Route::group(['middleware' => 'admin'], function() {
            Route::get('admin', 'AdminController@index');
            Route::get('admin/users', 'AdminController@users');
            Route::get('admin/users/add', 'AdminController@usersAdd');
            Route::post('admin/users/add', 'AdminController@usersStore');
            Route::get('admin/users/{user}', 'AdminController@usersEdit');
            Route::post('admin/users/{user}', 'AdminController@usersUpdate');
            Route::post('admin/users/{user}/delete', 'AdminController@usersDisable');
        
            Route::get('admin/roles', 'AdminController@roles');
            Route::get('admin/roles/add', 'AdminController@rolesAdd');
            Route::post('admin/roles/add', 'AdminController@rolesStore');
            Route::get('admin/roles/{role}', 'AdminController@rolesEdit');
            Route::post('admin/roles/{role}', 'AdminController@rolesUpdate');
            Route::post('admin/roles/{role}/delete', 'AdminController@rolesDelete');
            
            Route::get('admin/permissions', 'AdminController@permissions');
            Route::get('admin/permissions/add', 'AdminController@permissionsAdd');
            Route::post('admin/permissions/add', 'AdminController@permissionsStore');
            Route::get('admin/permissions/{permission}', 'AdminController@permissionsEdit');
            Route::post('admin/permissions/{permission}', 'AdminController@permissionsUpdate');
            Route::post('admin/permissions/{permission}/delete', 'AdminController@permissionsDelete');
        
            Route::get('admin/meta', 'AdminController@meta');
            Route::get('admin/meta/add', 'AdminController@metaAdd');
            Route::post('admin/meta/add', 'AdminController@metaStore');
            Route::get('admin/meta/{meta}', 'AdminController@metaEdit');
            Route::post('admin/meta/{meta}', 'AdminController@metaUpdate');
            Route::post('admin/meta/{meta}/delete', 'AdminController@metaDelete');
        
            Route::get('admin/metadata', 'AdminController@metaData');
            Route::get('admin/metadata/add', 'AdminController@metaDataAdd');
            Route::post('admin/metadata/add', 'AdminController@metaDataStore');
            Route::get('admin/metadata/{metadata}', 'AdminController@metaDataEdit');
            Route::post('admin/metadata/{metadata}', 'AdminController@metaDataUpdate');
            Route::post('admin/metadata/{metadata}/delete', 'AdminController@metaDataDelete');
        });

        // PELESEN
        Route::get('pelesen', 'PelesenController@index');
        Route::get('pelesen/add', 'PelesenController@create');
        Route::post('pelesen/add', 'PelesenController@store');
        Route::get('pelesen/show/{pelesen}', 'PelesenController@show');
        Route::get('pelesen/edit/{pelesen}', 'PelesenController@edit');
        Route::post('pelesen/edit/{pelesen}', 'PelesenController@update');
        Route::post('pelesen/delete/{pelesen}', 'PelesenController@destroy');

        Route::post('pelesen/delete/attachment/{attachment}', 'PelesenController@deleteAttachment');
        Route::get('pelesen/getReport', 'PelesenController@getReport');

        // LEVI
        Route::get('levi', 'LeviController@index');
        Route::get('levi/add', 'LeviController@create');
        Route::post('levi/add', 'LeviController@store');
        Route::get('levi/show/{levi}', 'LeviController@show');
        Route::get('levi/edit/{levi}', 'LeviController@edit');
        Route::post('levi/edit/{levi}', 'LeviController@update');
        Route::post('levi/delete/{levi}', 'LeviController@destroy');

        Route::get('levi/getLevi', 'LeviController@getLevi');
        Route::post('levi/updateConfirmation', 'LeviController@updateConfirmation');
        Route::post('levi/updatePayment', 'LeviController@updatePayment');

        Route::get('levi/getRunningNumber', 'LeviController@getRunningNumber');

        Route::get('testmail', function() {
            \Mail::to('safrin.carter94@gmail.com')->send(new \App\Mail\reminder());
        });

        Route::get('report', 'ReportController@index');
    });
});
