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
//HOME
Route::get('/', 'HomeController@index')->name('home');

//Carrinho
Route::get('/single/{slug}', 'HomeController@single')->name('single');
Route::get('/carrinho/', 'CarrinhoController@index')->name('carrinho.index');
Route::post('/carrinho/add', 'CarrinhoController@add')->name('carrinho.add');
Route::get('/carrinho/remover/{slug}', 'CarrinhoController@remover')->name('carrinho.remover');
Route::get('/carrinho/cancelar', 'CarrinhoController@cancelar')->name('carrinho.cancelar');

//Checkout
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout/proccess', 'CheckoutController@proccess')->name('checkout.proccess');
Route::get('/checkout/obrigado', 'CheckoutController@obrigado')->name('checkout.obrigado');

//Administrativo
Route::prefix('/admin')->middleware('auth')->namespace('Admin')->group(function (){

    Route::resource('lojas', 'LojaController');

    Route::resource('produto', 'ProdutoController');

    Route::resource('categorias', 'CategoriaController');

    Route::post('fotos/remover/', 'ProdutoFotoController@removerFoto')->name('removerFoto');
});

//Autenticação
Auth::routes();

