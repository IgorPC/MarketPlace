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
        if(!auth()->user()->loja()->exists()){
            return redirect()->back();
        }

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
        $data = $request->all();

        $data['preco'] = formatarPrecoParaBanco($data['preco']);

        $produto = $loja->produtos()->create($data);

        $produto->categoria()->sync($request->categorias);

        if($request->hasFile('fotos')) {
            $imagens = $this->uploadImagem($request, 'imagem');
            $produto->fotos()->createMany($imagens);
        }

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
        $data = $request->all();

        $produto->update($data);

        $produto->categoria()->sync($request->categorias);

        if($request->hasFile('fotos')) {
            $imagens = $this->uploadImagem($request, 'imagem');
            $produto->fotos()->createMany($imagens);
        }

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

    public function uploadImagem(Request $request, $colunaImagem = null)
    {
        $imagens = $request->file('fotos');

        $uploadImagems = [];

        foreach ($imagens as $imagem) {
                $uploadImagems[] = [$colunaImagem => $imagem->store('produtos', 'public')];
        }

        return $uploadImagems;
    }
}
