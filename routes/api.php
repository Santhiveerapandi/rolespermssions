<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('data', 'RoleManager@data');
Route::post('register', 'RegisterController@register');
Route::post('login', 'RegisterController@login'); //student login
/* Route::post('register', 'Auth\LoginController@register')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login'); */

Route::group(['middleware' => ['role:super-admin']], function () {
    Route::get(
        '/admindemo',
        function () {
            return "Welcome to admin API";
        }
    );
});

Route::group(
    [
        'middleware'=> 'auth:api'
    ],
    function () {

        Route::get(
            '/hi',
            function () {
                return "Welcome to API";
            }
        );

        

        // Route::post('logout', 'AuthController@logout')->name('logout');

        Route::get('permissions', 'RoleManager@permissionsIndex')
        ->name('permissions.index')
        ->middleware('Permission:View All Permissions');

        Route::get('roles', 'RoleManager@rolesIndex')
        ->name('roles.index')
        ->middleware('Permission:View All Roles');

        Route::get('/roles/{role}/assign/{user}', 'RoleManager@rolesAddUser')
        ->name('roles.addUser')
        ->middleware('Permission:Assign Role');

        Route::get('/roles/{role}/unassign/{user}', 'RoleManager@rolesRemoveUser')
        ->name('roles.removeUser')
        ->middleware('Permission:Unassign Role');
    }
    /* I’m using the middleware to control who can permission:
    access those APIs. So only those with appropriate permissions
    will be able to invoke the API without getting a 405,
    Not Allowed HTTP response.
    */
);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
