<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    public function index($slug)
    {
        $categoria = $this->categoria->whereSlug($slug)->first();

        return view('categoria', compact('categoria'));
    }
}
