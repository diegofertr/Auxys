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
	Route::resource('convocatoria', 'Convocatoria\ConvocatoriaController');
	// Route::get('get_convocatoria', 'ConvocatoriaController@dataTables');

	Route::get('get_convocatoria', array('as'=>'get_convocatoria', 'uses'=>'Convocatoria\ConvocatoriaController@dataTables'));

    //materias
    Route::resource('materias', 'Materia\MateriaController');
    Route::get('getMaterias',['as'=>'getMaterias','uses'=>'Materia\MateriaController@getMaterias']);
    Route::get('materias/delete_materia/{id}',['as'=>'delete_materia','uses'=>'Materia\MateriaController@deleteMateria']);
    Route::post('edit_materia', array('as'=>'edit_materia', 'uses'=> 'Materia\MateriaController@editMateria'));
    Route::get('materiaPrerequisitos', ['as'=>'materiaPrerequisitos', 'uses'=>'Materia\MateriaController@materiaPrerequisitos']);
    Route::get('get_list_materias', array('as'=>'get_list_materias', 'uses'=> 'Materia\MateriaController@getListMaterias'));
    //for prerequisites
    Route::post('add_prerequisite_m', array('as'=>'add_prerequisite_m', 'uses'=> 'Materia\MateriaController@addPrerequisite'));
    Route::get('delete_prerequisite_m/{id}/{materia_id}', array('as'=>'delete_prerequisite_m', 'uses'=>'Materia\MateriaController@deletePrerequisite'));
    //for users
    Route::resource('users','User\UserController');
    Route::get('getUsers','User\UserController@getUsers');

    //student and import
    Route::get('student/import','Student\StudentController@import');
    Route::resource('student','Student\StudentController');
    Route::post('importStudents','Student\StudentController@importStudents');
    Route::get('getStudents','Student\StudentController@getStudents');
    Route::get('cumpleRequisitos','Student\StudentController@cumpleRequisitos');
    Route::get('materiaStudent', ['as'=>'materiaStudent', 'uses'=>'Student\StudentController@materiaStudent']);
    Route::post('cumple_requisito', array('as'=>'cumple_requisito', 'uses'=> 'Student\StudentController@cumpleRequisito'));
    Route::get('postulants', 'Student\StudentController@postulants');
    Route::get('check_student', ['as'=> 'check_student','uses'=>'Student\StudentController@check']);
    Route::get('get_student_info', ['as'=> 'get_student_info','uses'=>'Student\StudentController@getStudentInfo']);
    Route::post('postulate', ['as'=> 'postulate','uses'=>'Student\StudentController@postulate']);
    
    //Postulants
    Route::get('print_postulants/{materia_id}/', array('as'=>'print_postulants','uses' =>'Student\PostulantsController@printPostulants'));

    //convocatoria
    Route::get('print_announcement','Convocatoria\ConvocatoriaController@print_announcement');
    Route::resource('requisito_c', 'Convocatoria\RequisitosConvocatoriaController');
});
