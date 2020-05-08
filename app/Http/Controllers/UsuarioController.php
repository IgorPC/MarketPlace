<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $ordens = auth()->user()->ordens()->paginate(10);

        return view('ordens-index', compact('ordens'));
    }

    public function editar(Request $request)
    {
        $mensagemVerde = $request->session()->get('mensagemVerde');
        return view('admin.editar-dados', compact('mensagemVerde'));
    }

    public function atualizar(UsuarioRequest $request, $id)
    {
        $user = $this->user->find($id);
        $data = $request->all();

        $user->update([
            'name' => $data['name'],
            'street' => $data['street'],
            'number' => $data['number'],
            "district" => $data['district'],
            "city" => $data['city'],
            "state" => $data['state'],
            "country" => $data['country'],
            "complement" => $data['complement'],
            "celphone" => $data['celphone'],
            "phone" => $data['phone'],
            "doc" => $data['doc'],
            "postalcode" => $data['postalcode'],
        ]);

        if($user->verify_cod == 0){
            $user->update([
                'verify_cod' => 1
            ]);
        }

        $request->session()->flash('mensagemVerde', 'Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
