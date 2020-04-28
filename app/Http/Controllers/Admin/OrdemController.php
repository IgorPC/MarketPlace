<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrdemUsuarios;
use Illuminate\Http\Request;

class OrdemController extends Controller
{
    private $ordem;

    public function __construct(OrdemUsuarios $ordem)
    {
        $this->ordem = $ordem;
    }

    public function index()
    {
        $ordens = auth()->user()->loja->ordens()->paginate(10);

        return view('admin.ordens.index', compact('ordens'));
    }
}
