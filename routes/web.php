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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/model', function (){

    /*$user = User::create([
        'name' => "Igor Pereira Coutinho",
        'email' => "igor@pctv.com",
        'password' => bcrypt('igorigor')
    ]);
    $user = User::find(33);
    $user->update([
        'name' => "IGOR DOIDERA"
    ]);*/

    /*$user = User::find(1);
    $loja =$user->loja()->create([
        'nome' => 'WISDOM',
        'descricao' => 'Uma loja muito sabia',
        'telefone' => '77981370699',
        'celular' => '77981370699',
        'slug' => 'wisdom-uma-loja-sabia'
    ]);

    dd($loja);*/

    /*$loja = Loja::find(31);
    $produto = $loja->produtos()->create([
        'nome' => 'Sabedoria Liquida',
        'descricao'=> 'Um produto direto das FakeNews',
        'body' => 'adasdasdasdiohfaodhasidhadasdasdasdashjblasnkdnasdjbasfksadmãsdjlfnkasljfjsdsãndsdnahdçasndasdhasjd',
        'preco'=> '5.90',
        'slug' => 'sabedoria-liquida'
    ]);*/

    /*\App\Categoria::create([
        'nome' => 'Fakes',
        'descricao' => 'dadajkfadnjasdaudgasygdasdasidasdgasdasgashdbahdashdajh',
        'slug' => 'fakes'
    ]);

    App\Categoria::create([
        'nome' => 'Falsos',
        'descricao' => 'dadajkfadnjasdaudgasygdasdasidasdgasdasgashdbahdashdajh',
        'slug' => 'falsos'
    ]);

    $prod = \App\Produto::find(31);
    $produto = $prod->categoria()->sync([2]);
    dd($produto);
    */


});

Route::prefix('/admin')->namespace('Admin')->group(function (){
    Route::get('/lojas', 'LojaController@index')->name('admin.loja.index');
    Route::get('/criar-loja', 'LojaController@create')->name('admin.loja.create');
    Route::post('/criar-loja', 'LojaController@store')->name('admin.loja.store');
    Route::get('/{lojaID}/edit', 'LojaController@edit')->name('admin.loja.index');
    Route::post('/{lojaID}/edit', 'LojaController@update')->name('admin.loja.update');
    Route::get('/destroy/{lojaID}', 'LojaController@destroy')->name('admin.loja.destroy');

    Route::resource('produto', 'ProdutoController');
});


