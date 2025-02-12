<?php

namespace App\Http\Controllers;
use App\Models\Logs;

use Illuminate\Http\Request;

class NovoAdaController extends Controller
{
    public function index()
    {
        $log = new Logs;
        $usuario = Auth()->user();
        $log->sistema = "Novo_Ada";
        $log->login = $usuario->cpf;
        $log->operacao = "Usuario acessou o sistema";
        $log->save();

        return view('principal');
    }
}
