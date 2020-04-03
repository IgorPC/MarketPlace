<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LojaRequest;
use App\Loja;
use App\Produto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{

    private $loja;

    public function __construct(Loja $loja)
    {
        $this->middleware('UsuarioTemLoja')->only(['create', 'store']);
        $this->loja = $loja;
    }

    public function index(Request $request)
    {
        $loja = auth()->user()->loja()->get();
        $numLoja = auth()->user()->loja()->count();
        $mensagem = $request->session()->get('mensagem');

        return view('admin.lojas.index', compact('loja', 'numLoja', 'mensagem'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.lojas.create', compact('users'));
    }

    public function store(LojaRequest $request)
    {
        $user = auth()->user();
        $user->loja()->create([
            'nome' => $request->nomeLoja,
            'descricao'=> $request->descricao,
            'telefone'=> $request->telefone,
            'celular'=> $request->celular,
            'slug' => $request->slug
        ]);

        $request->session()->flash('mensagem', 'A loja foi cadastrada com sucesso');
        return redirect()->route('lojas.index');
    }

    public function edit($lojaID)
    {
        $loja = Loja::find($lojaID);

        return view('admin.lojas.edit', compact('loja'));
    }

    public function update(LojaRequest $request, $id)
    {
        $loja = $this->loja->find($id);

        $loja->update([
            'nome' => $request->nomeLoja,
            'descricao'=> $request->descricao,
            'telefone'=> $request->telefone,
            'celular'=> $request->celular,
            'slug' => $request->slug
        ]);

        $request->session()->flash('mensagem', 'Os dados da loja foram atualizados com sucesso');
        return redirect()->route('lojas.index');
    }

    public function destroy($lojaID, Request $request)
    {
        $loja = Loja::find($lojaID);

        $produto = Produto::where('loja_id', $lojaID)->get();

        foreach ($produto as $prod){
            $prod->delete();
        }

        $loja->delete();

        $request->session()->flash('mensagem', 'A loja foi removida com sucesso');

        return redirect()->route('lojas.index');
    }
}
