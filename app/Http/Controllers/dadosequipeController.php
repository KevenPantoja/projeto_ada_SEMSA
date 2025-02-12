<?php

namespace App\Http\Controllers;

use App\Models\dadosequipe;
use Illuminate\Http\Request;

class dadosequipeController extends Controller
{
    //

    public function listar()
    {
        $dadosequipe = dadosequipe::all();
        return view('listarequipes', ['dadosequipes' => $dadosequipe]);
    }

    public function relacao()
    {
        
    }    
}
