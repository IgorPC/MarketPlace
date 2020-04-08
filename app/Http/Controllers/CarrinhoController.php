<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{

    public function index()
    {
        $carrinho = session()->has('carrinho') ? session()->get('carrinho') : [];
        $mensagemVermelha = session()->get('mensagemVermelha');

        return view('carrinho', compact('carrinho', 'mensagemVermelha'));
    }

    public function add(Request $request)
    {
        $produto = $request->get('produto');

        if(session()->has('carrinho')){

            $produtos = session()->get('carrinho');
            $produtosSlug = array_column($produtos, 'slug');

            if(in_array($produto['slug'], $produtosSlug)){
                $produtos = $this->incrementoProduto($produto['slug'], $produto['quantidade'], $produtos);
                session()->put('carrinho', $produtos);
            }else {
                session()->push('carrinho', $produto);
            }
        }else{
            $produtos[] = $produto;
            session()->put('carrinho', $produtos);
        }

        $mensagemVerde = session()->flash('mensagemVerde', 'Produto adicionado ao carrinho');
        return redirect()->back();
    }

    public function remover($slug)
    {
        if(!session()->has('carrinho')){
            return redirect()->route('carrinho.index');
        }

        $produtos = session()->get('carrinho');

        $produtos = array_filter($produtos, function ($linha) use ($slug){
            return $linha['slug'] != $slug;
        });

        session()->put('carrinho', $produtos);
        return redirect()->route('carrinho.index');
    }

    public function cancelar()
    {
        session()->forget('carrinho');
        session()->flash('mensagemVermelha', 'Compra Cancelada');
        return redirect()->route('carrinho.index');
    }

    private function incrementoProduto($slug, $quantidade, $produtos)
    {
        $produtos = array_map(function ($linha) use ($slug, $quantidade)
        {
            if($slug === $linha['slug']){
                $linha['quantidade'] += $quantidade;
            }
            return $linha;
        }, $produtos);

        return $produtos;
    }
}
