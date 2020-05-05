<?php

use App\Loja;
use App\User;
use Illuminate\Support\Facades\Route;

//HOME
Route::get('/', 'HomeController@index')->name('home');
Route::get('/categoria/{slug}', 'CategoriaController@index')->name('categoria.index');
Route::get('/loja/{slug}', 'LojaController@index')->name('loja.index');

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

//Ordens do Usuario
Route::get('/ordens/meus-pedidos', 'UsuarioController@index')->middleware('auth')->name('ordens.pedidos');

//Administrativo
Route::prefix('/admin')->middleware('auth')->namespace('Admin')->group(function (){

    Route::resource('lojas', 'LojaController');

    Route::resource('produto', 'ProdutoController');

    Route::resource('categorias', 'CategoriaController');

    Route::post('fotos/remover/', 'ProdutoFotoController@removerFoto')->name('removerFoto');

    Route::get('ordens/minhas-vendas', 'OrdemController@index')->name('ordens');

    //Notificações adminstrativas
    Route::get('notificacoes', 'NotificacaoController@notificacao')->name('admin.notificacao');
    Route::get('notificacoes/lerTodas', 'NotificacaoController@lerTodas')->name('admin.notificacao.lerTodas');
    Route::get('notificacoes/ler/{notificacao}', 'NotificacaoController@lerNotificacao')->name('admin.notificacao.lerNotificacao');
});

//Autenticação
Auth::routes();


