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
    
	Route::get('home', 'HomeController@index');
	Route::resource('convocatoria', 'ConvocatoriaController');
	// Route::get('get_convocatoria', 'ConvocatoriaController@dataTables');

	Route::get('get_convocatoria', array('as'=>'get_convocatoria', 'uses'=>'ConvocatoriaController@dataTables'));

    //materias
    Route::resource('materias', 'Materia\MateriaController');
    Route::get('getMaterias',['as'=>'getMaterias','uses'=>'Materia\MateriaController@getMaterias']);
    Route::get('materias/deleteM/{id}',['as'=>'deleteM','uses'=>'Materia\MateriaController@deleteM']);
    Route::get('materiaPrerequisitos', ['as'=>'materiaPrerequisitos', 'uses'=>'Materia\MateriaController@materiaPrerequisitos']);
    Route::post('add_prerequisite_m', array('as'=>'add_prerequisite_m', 'uses'=> 'Materia\MateriaController@addPrerequisite'));
   
    //for users
    Route::resource('users','User\UserController');
    Route::get('getUsers','User\UserController@getUsers');

    //import
    Route::get('student/import','Student\StudentController@import');
    Route::resource('student','Student\StudentController');
    Route::post('importStudents','Student\StudentController@importStudents');
    Route::get('getStudents','Student\StudentController@getStudents');
    //convocatoria
    Route::get('print_announcement','ConvocatoriaController@print_announcement');
});
