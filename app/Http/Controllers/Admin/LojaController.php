<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Loja;
use App\User;
use Illuminate\Http\Request;

class LojaController extends Controller
{
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
        $user = User::find($request->user);
        $loja = $user->loja()->create([
            'nome' => $request->nomeLoja,
            'descricao'=> $request->descricao,
            'telefone'=> $request->telefone,
            'celular'=> $request->celular,
            'slug' => $request->slug
        ]);
        return $loja;
    }

    public function edit($lojaID)
    {
        $loja = Loja::find($lojaID);

        return view('admin.lojas.edit', compact('loja'));
    }

    public function update(Request $request, $lojaID)
    {
        $loja = Loja::find($lojaID);
        $loja->update([
            'nome' => $request->nomeLoja,
            'descricao'=> $request->descricao,
            'telefone'=> $request->telefone,
            'celular'=> $request->celular,
            'slug' => $request->slug
        ]);

        $request->session()->flash('mensagem', 'Os dados da loja foram atualizados com sucesso');
        return redirect('/admin/lojas');
    }

    public function destroy($lojaID, Request $request)
    {
        $loja = Loja::find($lojaID);

        $loja->delete();

        $request->session()->flash('mensagem', 'A loja foi removida com sucesso');

        return redirect('/admin/lojas');
    }
}
