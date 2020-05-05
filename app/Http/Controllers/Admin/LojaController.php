<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LojaRequest;
use App\Loja;
use App\Produto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Str;

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

        //Mensagens de aviso personalizadas
        $mensagemVerde = $request->session()->get('mensagemVerde');
        $mensagemVermelha = $request->session()->get('mensagemVermelha');
        $mensagemAmarela = $request->session()->get('mensagemAmarela');

        return view('admin.lojas.index', compact('loja', 'numLoja', 'mensagemVermelha', 'mensagemAmarela', 'mensagemVerde'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.lojas.create', compact('users'));
    }

    public function store(LojaRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();

        if($request->hasFile('logo')){
            $data['logo'] = $this->uploadImagem($request, 'logo');
        }

        $user->loja()->create($data);

        $request->session()->flash('mensagemVerde', 'A loja foi cadastrada com sucesso');
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

        $data = $request->all();

        if($request->hasFile('logo')){
            if(Storage::disk('public')->exists($loja->logo)){
                Storage::disk('public')->delete($loja->logo);
            }
            $data['logo'] = $this->uploadImagem($request, 'logo');
        }

        $loja->update($data);

        $request->session()->flash('mensagemAmarela', 'Os dados da loja foram atualizados com sucesso');
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

        $request->session()->flash('mensagemVermelha', 'A loja foi removida com sucesso');

        return redirect()->route('home');
    }

    public function uploadImagem(Request $request)
    {
        $imagem = $request->file('logo');

        $uploadImagem = $imagem->store('logo', 'public');

        return $uploadImagem;
    }
}
