<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DadosVulneraveis;

class DadosVulneraveisController extends Controller
{
    public function dadosVulneraveis()
    {
        $dadosVulneraveis = DadosVulneraveis::orderBy('compet')->get();
        return view('dadosvulneraveis', ['dadosvulneraveis' => $dadosVulneraveis]);
    }

}
