<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarProdutoController extends Controller
{
    private $produtos;

    public function __construct(Produto $produtos)
    {
        $this->produtos = $produtos;
    }

    public function buscar(Request $request)
    {
        $produto = $request->get('buscar');
        $produtos = DB::table('produtos')->where('nome', 'like', '%'.$produto.'%')->paginate(9);

        return view('buscar', compact('produtos'));
    }
}
