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
//Asynchronus validation
//Route::get('/remote','RemoteController');
Route::post('/remote','RemoteController')->name('remote');

Route::get('/',function(){
	return redirect()->route('login');
});

Route::get('/login','User\LoginController@login')->name('login');
Route::post('/authentication','User\LoginController@authentication');
Route::get('/dashboard', 'User\LoginController@dashboard');

Route::get('/profile/{profile}', 'ProfileController@index')->name('profile.index');
Route::POST('/profile/view', 'ProfileController@view')->name('profile.view');
Route::get('/profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('/profile/{profile}', 'ProfileController@update')->name('profile.update');

Route::post('/course/view', 'CourseController@view')->name('course.view');
Route::post('/course/{course}', 'CourseController@update')->name('course.update');
Route::resource('/course', 'CourseController')->except(['create', 'show', 'update']);

Route::post('/section/view', 'SectionController@view')->name('section.view');
Route::post('/section/{section}', 'SectionController@update')->name('section.update');
Route::resource('/section', 'SectionController')->except(['create', 'show', 'update']);

Route::post('/semester/view', 'SemesterController@view')->name('semester.view');
Route::post('/semester/{semester}', 'SemesterController@update')->name('semester.update');
Route::resource('/semester', 'SemesterController')->except(['create', 'show', 'update']);

Route::post('/faculty/view', 'FacultyController@view')->name('faculty.view');
Route::post('/faculty/{faculty}', 'FacultyController@update')->name('faculty.update');
Route::resource('/faculty', 'FacultyController')->except(['create', 'show', 'update']);

Route::post('/department/view', 'DepartmentController@view')->name('department.view');
Route::post('/department/{department}', 'DepartmentController@update')->name('department.update');
Route::resource('/department', 'DepartmentController')->except(['create', 'show', 'update']);

Route::post('/deptcourse/dynamic', 'DepartmentalCourseController@dynamic')->name('deptcourse.dynamic');
Route::post('/deptcourse/view', 'DepartmentalCourseController@view')->name('deptcourse.view');
Route::post('/deptcourse/{deptcourse}', 'DepartmentalCourseController@update')->name('deptcourse.update');
Route::resource('/deptcourse', 'DepartmentalCourseController')->except(['create', 'show', 'update']);

Route::post('/userreg/dynamic', 'User\RegisterController@dynamic')->name('userreg.dynamic');
Route::post('/userreg/view', 'User\RegisterController@view')->name('userreg.view');
Route::post('/userreg/{userreg}', 'User\RegisterController@update')->name('userreg.update');
Route::resource('/userreg', 'User\RegisterController')->except(['create', 'show', 'update']);

Route::post('/coursereg/search', 'CourseRegController@search')->name('coursereg.search');
Route::post('/coursereg/dynamic', 'CourseRegController@dynamic')->name('coursereg.dynamic');
Route::post('/coursereg/view', 'CourseRegController@view')->name('coursereg.view');
Route::post('/coursereg/{coursereg}', 'CourseRegController@update')->name('coursereg.update');
Route::resource('/coursereg', 'CourseRegController')->except(['create', 'show', 'update']);

Route::get('/tutionfee', 'TutionFeeController@index')->name('tutionfee.index');
Route::post('/tutionfee/search', 'TutionFeeController@search')->name('tutionfee.search');
Route::post('/tutionfee/view', 'TutionFeeController@view')->name('tutionfee.view');
Route::get('/tutionfee/{tutionfee}/edit', 'TutionFeeController@edit')->name('tutionfee.edit');
Route::post('/tutionfee/{tutionfee}', 'TutionFeeController@update')->name('tutionfee.update');

Route::get('/studresult', 'StudResultController@index')->name('studresult.index');
Route::post('/studresult/dynamic', 'StudResultController@dynamic')->name('studresult.dynamic');
Route::post('/studresult/search', 'StudResultController@search')->name('studresult.search');
Route::post('/studresult/view', 'StudResultController@view')->name('studresult.view');
Route::get('/studresult/{studresult}/edit', 'StudResultController@edit')->name('studresult.edit');
Route::post('/studresult/{studresult}', 'StudResultController@update')->name('studresult.update');

Route::get('/fmregcourse', 'FMRegCourseController@index')->name('fmregcourse.index');
Route::post('/fmregcourse/dynamic', 'FMRegCourseController@dynamic')->name('fmregcourse.dynamic');

Route::get('/studregcourse', 'StudRegCourseController@index')->name('studregcourse.index');
Route::post('/studregcourse/dynamic', 'StudRegCourseController@dynamic')->name('studregcourse.dynamic');

Route::get('/paymentledger', 'PaymentLedgerController@index')->name('paymentledger');

Route::get('/liveresult', 'LiveResultController@index')->name('liveresult.index');
Route::post('/liveresult/dynamic', 'LiveResultController@dynamic')->name('liveresult.dynamic');
Route::post('/liveresult/result', 'LiveResultController@live_result')->name('liveresult.result');

Route::get('/result/result', 'ResultController@result');
Route::get('/result', 'ResultController@index')->name('result.index');
Route::post('/result/result', 'ResultController@result')->name('result.result');

Route::get('/settings/{settings}', 'SettingsController@view')->name('settings.view');
Route::get('/bal/{settings}', 'SettingsController@update');
Route::post('/settings/{settings}', 'SettingsController@update')->name('settings.update');

Route::get('/logout','User\LoginController@logout')->name('logout');


