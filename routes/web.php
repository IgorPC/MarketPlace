<?php

use App\Loja;
use App\User;
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

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('/admin')->middleware('auth')->namespace('Admin')->group(function (){

    Route::resource('lojas', 'LojaController');

    Route::resource('produto', 'ProdutoController');
});

Auth::routes();

