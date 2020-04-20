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
            $cardItens = session()->get('carrinho');
            $referencia = 'XPTO';

            $creditCard = new CreditCard($cardItens, $usuario, $dataPost, $referencia);
            $result = $creditCard->fazerPagamento();

            //var_dump($result);
            $ordemUsuario = [
                'referencia' => $referencia,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cardItens),
                'loja_id' => 47
            ];

            $usuario->ordens()->create($ordemUsuario);
            session()->forget('carrinho');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido concluido com sucesso!'
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
        return view('obrigado');
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
