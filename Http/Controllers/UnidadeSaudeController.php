<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadeSaude;

class UnidadeSaudeController extends Controller
{
    //

    public function index()
    {
        $unidadesSaude = UnidadeSaude::all();
        return view('index', ['unidadesSaude' => $unidadesSaude]);
    }
}
