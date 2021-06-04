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

Route::get('/', "IndexController@showHome")->name('homepage');

Route::get('/login', "LoginController@showLogin")->name('login_page')->middleware('guest');
Route::post('/logout', 'LoginController@logout')->name('logout');
Route::post('/submit_login', "LoginController@login")->name('submit_login');
Route::get('/dashboard', "DashboardController@showDashboard")->name('dashboard');

Route::get('/sekolah', "SekolahController@showSekolah")->name('sekolah');
Route::get('/sekolah-add', "SekolahController@showAddSekolah")->name('sekolah-add');
Route::post('/sekolah-store', "SekolahController@createSekolah")->name('sekolah-store');
Route::post('/sekolah-delete/{sekolah}', "SekolahController@deleteSekolah")->name('sekolah-delete');
Route::get('/sekolah-show-update/{sekolah}', "SekolahController@showEditSekolah")->name('sekolah-show-update');
Route::post('/sekolah-update/{sekolah}', "SekolahController@updateSekolah")->name('sekolah-update');

Route::get('/pasar', "PasarController@showPasar")->name('pasar');
Route::get('/pasar-add', "PasarController@showAddPasar")->name('pasar-add');
Route::post('/pasar-store', "PasarController@createPasar")->name('pasar-store');
Route::post('/pasar-delete/{pasar}', "PasarController@deletePasar")->name('pasar-delete');
Route::get('/pasar-show-update/{pasar}', "PasarController@showEditPasar")->name('pasar-show-update');
Route::post('/pasar-update/{pasar}', "PasarController@updatePasar")->name('pasar-update');

Route::get('/tempatibadah', "TempatIbadahController@showTempatIbadah")->name('tempatibadah');
Route::get('/tempatibadah-add', "TempatIbadahController@showAddTempatIbadah")->name('tempatibadah-add');
Route::post('/tempatibadah-store', "TempatIbadahController@createTempatIbadah")->name('tempatibadah-store');
Route::post('/tempatibadah-delete/{tempatibadah}', "TempatIbadahController@deleteTempatIbadah")->name('tempatibadah-delete');
Route::get('/tempatibadah-show-update/{tempatibadah}', "TempatIbadahController@showEditTempatIbadah")->name('tempatibadah-show-update');
Route::post('/tempatibadah-update/{tempatibadah}', "TempatIbadahController@updateTempatIbadah")->name('tempatibadah-update');

Route::get('/desa', "DesaController@showDesa")->name('desa');
Route::get('/desa-add', "DesaController@showAddDesa")->name('desa-add');
Route::post('/desa-store', "DesaController@createDesa")->name('desa-store');
Route::post('/desa-delete/{desa}', "DesaController@deleteDesa")->name('desa-delete');
Route::get('/desa-show-update/{desa}', "DesaController@showEditDesa")->name('desa-show-update');
Route::post('/desa-update/{desa}', "DesaController@updateDesa")->name('desa-update');
