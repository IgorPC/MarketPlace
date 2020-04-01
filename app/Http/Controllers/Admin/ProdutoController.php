<?php

namespace App\Http\Controllers\Admin;

use App\Loja;
use App\Produto;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdutoController extends Controller
{

    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index(Request $request)
    {
        $produtos = $this->produto->paginate(8);
        $mensagem = $request->session()->get('mensagem');

        return view('admin.produtos.index', compact('produtos', 'mensagem'));
    }

    public function create()
    {
        $lojas = Loja::all(['id', 'nome']);
        $lojas = Loja::all();
        return view('admin.produtos.create', compact('lojas', 'lojas'));
    }

    public function store(Request $request)
    {
        $loja = Loja::find($request->loja);
        $produto = $loja->produtos()->create([
            'nome' => $request->nomeProduto,
            'descricao' => $request->body,
            'body' => $request->descricao,
            'preco'=> $request->preco,
            'slug' => $request->slug
        ]);

        $request->session()->flash('mensagem', 'O produto foi cadastrado com sucesso');
        return redirect()->route('produto.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produto = $this->produto->findOrFail($id);
        $lojas = Loja::all();

        return view('admin.produtos.edit', compact('produto', 'lojas'));
    }

    public function update(Request $request, $id)
    {
        $produto = $this->produto->find($id);

        $produto->update([
            'nome' => $request->nomeProduto,
            'descricao' => $request->body,
            'body' => $request->descricao,
            'preco'=> $request->preco,
            'slug' => $request->slug
        ]);

        $request->session()->flash('mensagem', 'O produto foi atualizado com sucesso');
        return redirect()->route('produto.index');
    }

    public function destroy($id, Request $request)
    {
        $produto = $this->produto->find($id);

        $produto->delete();

        $request->session()->flash('mensagem', 'O produto foi removido com sucesso');
        return redirect()->route('produto.index');
    }
}
