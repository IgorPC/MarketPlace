<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $produtos;

    public function __construct(Produto $produto)
    {
        $this->produtos = $produto;
    }

    public function index()
    {
        $produtos = $this->produtos->limit(9)->orderBy('id', 'desc')->get();
        return view('welcome', compact('produtos'));
    }

    public function single($slug)
    {
        $produto = $this->produtos->whereSlug($slug)->first();
        $mensagemVerde = session()->get('mensagemVerde');

        return view('single', compact('produto', 'mensagemVerde'));
    }
}
