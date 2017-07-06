<?php

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
	return view('adminlte::auth.login');
});


Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });
	Route::get('home', 'HomeController@index');
	Route::resource('convocatoria', 'ConvocatoriaController');
	// Route::get('get_convocatoria', 'ConvocatoriaController@dataTables');

	Route::get('get_convocatoria', array('as'=>'get_convocatoria', 'uses'=>'ConvocatoriaController@dataTables'));

    //for materias
    Route::resource('materias', 'MateriaController');
    Route::get('getMaterias',['as'=>'getMaterias','uses'=>'MateriaController@getMaterias']);
    Route::get('materias/deleteM/{id}',['as'=>'deleteM','uses'=>'MateriaController@deleteM']);

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
   
    //for users
    Route::resource('users','User\UserController');
    Route::get('getUsers','User\UserController@getUsers');

    //import
    
    Route::get('student/import','Student\StudentController@import');
    Route::resource('student','Student\StudentController');
    Route::post('importStudents','Student\StudentController@importStudents');
    Route::get('getStudents','Student\StudentController@getStudents');
});
