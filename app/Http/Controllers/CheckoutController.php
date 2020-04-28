<?php

namespace App\Http\Controllers;

use App\Payment\Pagseguro\CreditCard;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\exception_for;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
        if(!session()->get('carrinho')){
            return redirect()->route('home');
        }

        $this->criarSessaoPagSeguro();

        $cardItens = array_map(function ($linha){
           return $linha['quantidade'] * $linha['preco'];
        }, session()->get('carrinho'));

        $cardItens = array_sum($cardItens);

        return view('checkout', compact('cardItens'));
    }

    public function proccess(Request $request)
    {
        try {
            $dataPost = $request->all();
            $usuario = auth()->user();
            $cartItems = session()->get('carrinho');
            $lojas = array_unique(array_column($cartItems, 'loja_id'));
            $referencia = 'XPTO';

            $creditCard = new CreditCard($cartItems, $usuario, $dataPost, $referencia);
            $result = $creditCard->fazerPagamento();

            $ordemUsuario = [
                'referencia' => $referencia,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                'loja_id' => 47
            ];
            $userOrder = $usuario->ordens()->create($ordemUsuario);
            $userOrder->lojas()->sync($lojas);

            session()->forget('carrinho');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => $ordemUsuario
                ]
            ]);

        }catch (\Exception $e){
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => 'Erro ao processar pedido!',
                    'ordem' => $referencia
                ]
            ], 401);
        }
    }

    public function obrigado()
    {
        $ordem = session()->get('ordem');
        return view('obrigado', compact('ordem'));
    }

    private function criarSessaoPagSeguro()
    {
        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
