<?php

namespace App\Http\Controllers;

use App\Loja;
use Illuminate\Http\Request;

class LojaController extends Controller
{

    private $loja;

    public function __construct(Loja $loja)
    {
        $this->loja = $loja;
    }

    public function index($slug)
    {
        $loja = $this->loja->whereSlug($slug)->first();

        return view('loja', compact('loja'));
    }
}
