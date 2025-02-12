<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadeSaude;
use App\Models\Logs;
use App\Http\Controllers\LogController;

class UnidadeSaudeController extends Controller
{
    //
    private $log;

    public function __construct( LogController $log )
    {
        $this->log = $log;

    }

    public function index()
    {
        $this->log->setLog('Novo_ADA', 'Usuário acessou a view index a função Unidades de Saude');
        $unidadesSaude = UnidadeSaude::all();
        return view('index', ['unidadesSaude' => $unidadesSaude]);
    }
}
