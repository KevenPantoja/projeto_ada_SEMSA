<?php

namespace App\Http\Controllers;

use App\Models\Cenarioequipe;
use App\Models\Profcbott;
use App\Models\Profequipe;
use App\Models\Unidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CenarioequipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $competencia = $request->input('competencia');
        $distrito = $request->input('distrito');
        $unidade = $request->input('unidade');

        $compet_selec = $competencia;
        $query = Cenarioequipe::query();
        if ($competencia != '-1') {
            $query->where('desc_compet', $competencia);
        }

        if ($distrito != '-1') {
            $query->where('dist_nome', 'LIKE', '%' . $distrito . '%');
        }

        if ($unidade != '-1') {
            $query->where('und_nome', 'LIKE', '%' . $unidade . '%');
        }


        Log::info($query->toSQL(), $query->getBindings());
        $busca_cenario = $query->get();

        $busca_profeq = Profequipe::where('desc_compet', $competencia)->get();
        $ttproftb = new Profcbott();
        $total_prof = $ttproftb->gettotal();

        // Obter a lista distinta de unidades de saúde
        $unidades = Cenarioequipe::distinct()->pluck('und_nome');

        // Obter a lista de competências
<<<<<<<< HEAD:app/Http/Controllers/CenarioequipeController.php
        $competencias = Cenarioequipe::select('desc_compet')->distinct()->orderBy('desc_compet', 'desc')->get();
========
        $competencias = Cenarioequipe::select('desc_compet')->distinct()->get();
>>>>>>>> 2506f9dc62bfa6042486da58ed75c8269c211612:app/Http/Controllers/CenarioequipeController2.php

        //Obter a lista de distritos
        $distritos = Cenarioequipe::select('dist_nome')->distinct()->pluck('dist_nome');


        $compet_format = $this->formatarCompetencia($competencia);
        //dd($distritos, $busca_cenario, $busca_profeq, $total_prof, $competencias, $competencia, $distrito, $unidade, $compet_selec, $compet_format);
        return view('cenario', [
            'busca_cenario' => $busca_cenario,
            'busca_profeq' => $busca_profeq,
            'total_prof' => $total_prof,
            'competencias' => $competencias,
            'distritos' => $distritos,
            'competencia' => $competencia,
            'distrito' => $distrito,
            'unidade' => $unidade,
            'compet_selec' => $compet_selec,
            'compet_format' => $compet_format
        ]);
    }

    public function showProfissionais($equipe, $competencia)
    {
        $equipe = urldecode($equipe);

        $profissionais = Profequipe::where('equi_nome', $equipe)
            ->where('desc_compet', $competencia)
            ->get();

        // Contar o número de profissionais agrupados por cbo_descricao
        $total_prof = Profequipe::where('equi_nome', $equipe)
            ->where('desc_compet', $competencia)
            ->selectRaw('cbo_descricao, COUNT(*) as total')
            ->groupBy('cbo_descricao')
            ->get();

        $compet_format = $this->formatarCompetencia($competencia);

        return view('profissionais', compact('profissionais', 'equipe', 'total_prof', 'competencia', 'compet_format'));
    }

    public function listaProfissionais(Request $request)
    {
        $max_compet = Profequipe::select('desc_compet')->distinct()->max('desc_compet');

        $profsSemEquipes = $request->input('sem-equipes');
        $competencia = $request->input('competencia', $max_compet);
        $distrito = $request->input('distrito');
        $unidade = $request->input('unidade');
        $compet_selec = $competencia;
        $busca_cenario = Cenarioequipe::get();
        $query = Profequipe::query();
        $profsSemEquipes == 'true' ? $query->whereNull('equi_nome') : $query->whereNotNull('equi_nome');

        if ($competencia != '-1') {
            $query->where('desc_compet', $competencia);
        }

        if ($distrito != '-1') {
            $query->where('dist_nome', 'LIKE', '%' . $distrito . '%');
        }

        if ($unidade != '-1') {
            $query->where('und_nome', 'LIKE', '%' . $unidade . '%');
        }
        Log::info($query->toSQL(), $query->getBindings());
        $busca_profeq = $query->get();

        $ttproftb = new Profcbott();
        $busca = $ttproftb->gettotal();

        // Contar o número de profissionais agrupados por cbo_descricao
        $busca = Profequipe::query();
        if ($competencia != '-1') {
            $busca->where('desc_compet', $competencia);
        }

        if ($distrito != '-1') {
            $busca->where('dist_nome', 'LIKE', '%' . $distrito . '%');
        }

        if ($unidade != '-1') {
            $busca->where('und_nome', 'LIKE', '%' . $unidade . '%');
        }
        $total_prof = $busca->selectRaw('cbo_descricao, COUNT(*) as total')
            ->groupBy('cbo_descricao')
            ->get();

        $prof_equipes = $busca
            ->selectRaw('equi_nome, cbo_descricao, COUNT(*) as total')
            ->whereNotNull('equi_nome')  // Filtra apenas as linhas com 'equi_nome' não nulo
            ->groupBy('equi_nome', 'cbo_descricao')  // Agrupa por 'equi_nome' e 'cbo_descricao'
            ->orderBy('equi_nome', 'asc')  // Ordena por 'equi_nome' em ordem ascendente
            ->get();



        $competencias = Profequipe::select('desc_compet')->distinct()->orderBy('desc_compet', 'desc')->get();

        // Obter a lista distinta de unidades de saúde
        $unidades = Profequipe::distinct()->orderBy('und_nome', 'asc')->pluck('und_nome');

        //Obter a lista de distritos
        $distritos = Profequipe::select('dist_nome')->distinct()->pluck('dist_nome');

        $competencias = $competencias->map(function ($item) {
            $item->mes = $this->getMesPorUltimosDigitos($item->desc_compet);
            return $item;
        });

        $compet_selec = $this->formatarCompetencia($competencia);

        return view('listaProfissionais', compact('busca_profeq', 'total_prof', 'competencias', 'distritos', 'unidades', 'compet_selec', 'max_compet', 'prof_equipes', 'competencia', 'distrito', 'unidade'));
    }

    public function getUnidades($distrito)
    {
        $unidadesPorDistrito = Profequipe::where('dist_nome', 'LIKE', '%' . $distrito . '%')
            ->select('und_nome')
            ->distinct()
            ->orderBy('und_nome', 'asc')
            ->pluck('und_nome');

        return response()->json($unidadesPorDistrito);
    }

    private function getMesPorUltimosDigitos($desc_compet)
    {
        $meses = [
            '01' => 'Janeiro',
            '02' => 'Fevereiro',
            '03' => 'Março',
            '04' => 'Abril',
            '05' => 'Maio',
            '06' => 'Junho',
            '07' => 'Julho',
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        $mes = $meses[substr($desc_compet, -2)] ?? null;
        $ano = substr($desc_compet, 0, 4);

        if ($mes) {
            return "{$mes}/{$ano}";
        } else {
            return $desc_compet; // Retorna o valor original caso não seja encontrado um mês correspondente
        }
    }

    private function formatarCompetencia($competencia)
    {
        $ano = substr($competencia, 0, 4);
        $mes = substr($competencia, 4, 2);

        $nomesMeses = [
            '01' => 'JANEIRO',
            '02' => 'FEVEREIRO',
            '03' => 'MARÇO',
            '04' => 'ABRIL',
            '05' => 'MAIO',
            '06' => 'JUNHO',
            '07' => 'JULHO',
            '08' => 'AGOSTO',
            '09' => 'SETEMBRO',
            '10' => 'OUTUBRO',
            '11' => 'NOVEMBRO',
            '12' => 'DEZEMBRO',
        ];

        return isset($nomesMeses[$mes]) ? $nomesMeses[$mes] . '/' . $ano : $competencia;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
