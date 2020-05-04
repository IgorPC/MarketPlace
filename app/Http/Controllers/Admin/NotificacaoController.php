<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificacaoController extends Controller
{
    public function notificacao()
    {
        $notificacoesNaoLidas = auth()->user()->unreadnotifications;

        return view('admin.notificacoes', compact('notificacoesNaoLidas'));
    }

    public function lerTodas()
    {
        $notificacoesNaoLidas = auth()->user()->unreadnotifications;

        $notificacoesNaoLidas->each(function ($notificacao){
            $notificacao->markAsRead();
        });

        return redirect()->back();
    }

    public function lerNotificacao($notificacao)
    {
        $notificacoes = auth()->user()->notifications()->find($notificacao);
        $notificacoes->markAsRead();

        return redirect()->back();
    }
}
