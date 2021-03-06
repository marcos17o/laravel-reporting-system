<?php

use Illuminate\Support\Facades\Route;

use App\User;
use App\Permission\Models\Role;
use App\Permission\Models\Factura;
use App\Permission\Models\salario;

use App\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     $user = User::find(2);
//     // $user->roles()->sync([2]);
//     Gate::authorize('haveaccess', 'role.index');
//     return $user;

//     // return $user->havePermission('role.create');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/role', 'RoleController')->names('role');

Route::resource('/user', 'UserController',[
    'except' => ['create','store']
])->names('user');

Route::resource('/factura', 'FacturaController')->names('factura');

Route::get('/reports', 'ReportesController@index')->name('reports.index');

Route::post('/get_data_grafica', 'ReportesController@get_data_grafica')->name('reports.get_data_grafica');
Route::post('/get_data_grafica_torta', 'ReportesController@get_data_grafica_torta')->name('reports.get_data_torta');
Route::post('/get_data_relatorio', 'ReportesController@get_data_relatorio')->name('reports.get_data_relatorio');
