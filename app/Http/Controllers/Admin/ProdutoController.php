<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use App\Http\Requests\ProdutoRequest;
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
        $userLoja = auth()->user()->loja;
        $produtos = $userLoja->produtos()->paginate(8);

        //Mensagens de aviso personalizadas
        $mensagemVerde = $request->session()->get('mensagemVerde');
        $mensagemVermelha = $request->session()->get('mensagemVermelha');
        $mensagemAmarela = $request->session()->get('mensagemAmarela');

        return view('admin.produtos.index', compact('produtos', 'mensagemVerde', 'mensagemVermelha', 'mensagemAmarela'));
    }

    public function create()
    {
        $categorias = Categoria::all(['id', 'nome']);
        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(ProdutoRequest $request)
    {
        $loja = auth()->user()->loja;

        $produto = $loja->produtos()->create([
            'nome' => $request->nomeProduto,
            'descricao' => $request->body,
            'body' => $request->descricao,
            'preco'=> $request->preco,
            'slug' => $request->slug
        ]);

        $produto->categoria()->sync($request->categorias);

        $request->session()->flash('mensagemVerde', 'O produto foi cadastrado com sucesso');
        return redirect()->route('produto.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produto = $this->produto->findOrFail($id);
        $categorias = Categoria::all(['id', 'nome']);

        return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    public function update(ProdutoRequest $request, $id)
    {
        $produto = $this->produto->find($id);

        $produto->update([
            'nome' => $request->nomeProduto,
            'descricao' => $request->body,
            'body' => $request->descricao,
            'preco'=> $request->preco,
            'slug' => $request->slug
        ]);

        $produto->categoria()->sync($request->categorias);

        $request->session()->flash('mensagemAmarela', 'O produto foi atualizado com sucesso');
        return redirect()->route('produto.index');
    }

    public function destroy($id, Request $request)
    {
        $produto = $this->produto->find($id);

        $produto->delete();

        $request->session()->flash('mensagemVermelha', 'O produto foi removido com sucesso');
        return redirect()->route('produto.index');
    }
}
