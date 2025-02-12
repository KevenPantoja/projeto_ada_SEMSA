<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;

class LogController extends Controller
{
    private Logs $log;

    public function __construct(Logs $log)
    {
        $this->log = $log;
    }
    //public function setLog(String $sistema, String $operacao, String $router, String $method)
    public function setLog(string $sistema, string $operacao): void
    {
        $usuario = Auth()->user();
        $this->log->sistema = $sistema;
        $this->log->login = $usuario->cpf;
        $this->log->operacao = $operacao;
        $this->log->save();
        //return view($router, [$method => $usuario]);
    }
}
