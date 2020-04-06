<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProdutoFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdutoFotoController extends Controller
{
    public function removerFoto(Request $request)
    {
        $nome = $request->get('nomeFoto');
        if(Storage::disk('public')->exists($nome)){
            Storage::disk('public')->delete($nome);
        }
        $foto = ProdutoFoto::where('imagem', $nome);
        $foto->delete();

        //$request->session()->flash('mensagemVermelha', 'Foto apagada com sucesso');
        return redirect()->back();
    }
}
