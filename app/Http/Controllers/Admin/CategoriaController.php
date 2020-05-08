<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    public function index(Request $request)
    {
        $loja = auth()->user()->loja()->get();
        if($loja->count() == 0){
            return redirect()->route('home');
        }

        $categorias = $this->categoria->paginate(8);

        //Mensagens de aviso personalizadas
        $mensagemVerde = $request->session()->get('mensagemVerde');
        $mensagemVermelha = $request->session()->get('mensagemVermelha');
        $mensagemAmarela = $request->session()->get('mensagemAmarela');

        return view('admin.categorias.index', compact('categorias', 'mensagemVerde', 'mensagemAmarela', 'mensagemVermelha'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(CategoriaRequest $request)
    {
        $data = $request->all();

        $this->categoria->create($data);

        $request->session()->flash('mensagemVerde', 'A categoria foi cadastrada com sucesso');
        return redirect()->route('categorias.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoria = $this->categoria->findOrFail($id);

        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(CategoriaRequest $request, $id)
    {
        $categoria = $this->categoria->findOrFail($id);
        $data = $request->all();

        $categoria->update($data);

        $request->session()->flash('mensagemAmarela', 'A categoria foi atualizada com sucesso');
        return redirect()->route('categorias.index');
    }

    public function destroy($id, Request $request)
    {
        $categoria = $this->categoria->findOrFail($id);

        $categoria->delete();

        $request->session()->flash('mensagemVermelha', 'A categoria foi removida com sucesso');
        return redirect()->route('categorias.index');
    }
}
