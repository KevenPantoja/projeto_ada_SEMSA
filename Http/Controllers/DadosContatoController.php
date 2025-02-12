<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DadosContato;

class DadosContatoController extends Controller
{
    //

    public function relacaoContatos()
    {
        $dadosContatos = DadosContato::all();
        return view('relacaoContatos',['dadosContatos' => $dadosContatos]);
    }
}
