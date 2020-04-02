<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->loja = $loja;
    }

    public function index(Request $request)
    {
        $lojas = Loja::paginate(10);
        $mensagem = $request->session()->get('mensagem');

        return view('admin.lojas.index', compact('lojas', 'mensagem'));
    }

    public function create()
    {
        $users = User::all();

        return view('admin.lojas.create', compact('users'));
    }

    public function store(Request $request)
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

    public function update(Request $request, $id)
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
