<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'WebsiteController@about');
Route::get('/careers', 'WebsiteController@careers');
Route::get('/careers/{id}','WebsiteController@job');
Route::post('/application','WebsiteController@application')->name('application');
Route::get('/projects','WebsiteController@project');
Route::get('/contacts','WebsiteController@contact');
Route::post('/contacts','WebsiteController@add_contact')->name('add_contact');






Route::prefix('admin')->group(function()
{
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/', 'AdminController@employees')->name('admin.dashboard');
Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::get('account','AdminController@account');
Route::put('account','AdminController@account_update')->name('update-admin');

Route::get('/employees','AdminController@employees');
Route::post('/employees','AdminController@add_employee')->name('add_employee');
Route::put('/employees/{id}','AdminController@edit_employee')->name('edit_employee');
Route::put('/employees/{id}/remove','AdminController@remove_employee')->name('remove_employee');
Route::get('/search/employees/','AdminController@search_employee')->name('search_employee');
Route::get('/employees/export/excel','AdminController@employee_excel')->name('employee.excel');

Route::get('/jobs','AdminController@job');
Route::post('/jobs','AdminController@add_job')->name('add_job');
Route::get('/search/jobs/','AdminController@search_job')->name('search_job');
Route::get('/jobs/export/excel','AdminController@job_excel')->name('job.excel');
Route::get('/jobs/applications/{id}','AdminController@application')->name('job.application');
Route::delete('/jobs/{id}','AdminController@destroy_job')->name('destroy_job');
Route::delete('/jobs/applications/{id}','AdminController@destroy_application')->name('destroy_application');

Route::get('/projects','AdminController@project');
Route::post('/projects','AdminController@add_project')->name('add_project');
Route::put('/projects/{id}','AdminController@edit_project')->name('edit_project');
Route::get('/search/projects/','AdminController@search_project')->name('search_project');
Route::get('/projects/export/excel','AdminController@project_excel')->name('project.excel');
Route::put('/projects/{id}/remove','AdminController@remove_project')->name('remove_project');

Route::get('/contacts','AdminController@contact');
Route::delete('/contacts/{id}','AdminController@destroy_contact')->name('destroy_contact');

Route::get('/archive/employees','AdminController@archive_employee');
Route::get('/archive/search/employees/','AdminController@search_archive_employee')->name('search_archive_employee');
Route::get('/archive/employees/export/excel','AdminController@archive_employee_excel')->name('archive_employee.excel');

Route::get('/archive/projects','AdminController@archive_project');
Route::get('/archive/search/projects/','AdminController@search_archive_project')->name('search_archive_project');
Route::get('/archive/projects/export/excel','AdminController@archive_project_excel')->name('archive_project.excel');
});