<?php

namespace App\Http\Controllers;

use App\Loja;
use App\OrdemUsuarios;
use App\Payment\Pagseguro\CreditCard;
use App\Payment\Pagseguro\Notificacao;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
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

        if(auth()->user()->verify_cod == 0){
            return view('erro');
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
            $referencia = Uuid::uuid4();

            $creditCard = new CreditCard($cartItems, $usuario, $dataPost, $referencia);
            $result = $creditCard->fazerPagamento();

            $ordemUsuario = [
                'referencia' => $referencia,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
            ];

            $userOrder = $usuario->ordens()->create($ordemUsuario);
            $userOrder->lojas()->sync($lojas);

            $loja = (new Loja())->notificarDonoLojas($lojas);

            session()->forget('carrinho');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => $ordemUsuario,
                    'ordem' => $referencia
                ]
            ]);

        }catch (\Exception $e){
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $e->getMessage(),
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

    public function notificacao()
    {
        try{
            $notificacao = new Notificacao();

            $notificacao = $notificacao->getTransaction();
            $referencia = base64_decode($notificacao->getReference());
            $userOrder = OrdemUsuarios::whereReferencia($referencia);
            $userOrder->update([
                'pagseguro_status' => $notificacao->getStatus()
            ]);

            return response()->json([], 204);
        }catch (\Exception $e){
            return response()->json([$e->getMessage()], 500);
        }
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
