<?php

namespace App\Http\Controllers;

use App\Models\Cenarioequipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\LogController;
use App\Models\Logs;

class AlertasController extends Controller
{

    private $competencias;
    private $competencias_format;
    private $distritos;
    private $unidades;

    private $log;

    /** * Construtor com injeção de dependência. */
    public function __construct(DadosFiltroController $dadosController, LogController $log)
    {

        $this->competencias = $dadosController->getCompetencias();
        $this->competencias_format = $dadosController->getCompetenciasFormatadas();
        $this->distritos = $dadosController->getDistritos();
        $this->unidades = $dadosController->getUnidades();
        $this->log = $log;
    }


    public function receberDados(Request $request)
    {
        // $this->log->setLog('Novo_ADA', 'Usuario Acessou a aba Informações Gerais');

        $competencia = $request->input('competencia');
        $distrito = $request->input('distrito');
        $comp1 = $request->input('competencia1');
        $comp2 = $request->input('competencia2');

        $params =
            [
                'competencia' => $competencia,
                'comp1' => $comp1,
                'comp2' => $comp2,
                'distrito' => $distrito
            ];

        return response()->json($params);
    }

    public function enviarDados(Request $request)
    {
         // Registrar o log específico
        $this->log->setLog('Novo_ADA', 'Usuario acessou a Aba Informações Gerais na Guia Total de Alertas');

        $competencia = $request->input('competencia');
        //dump($competencia);
        $distrito = $request->input('distrito');

        $comp1 = $request->input('competencia1');
        $comp2 = $request->input('competencia2');

        $total_Registros_Alertas = '';
        if ($comp2 && $comp2 != '-1') {
            $total_alertas_distrito = Cenarioequipe::where('st_alerta', 'COM ALERTA')
                ->whereNull('unid_equi_data_desat')
                ->whereBetween('desc_compet', [$comp1, $comp2])
                ->selectRaw('dist_nome, COUNT(*) as totalalertas')
                ->groupBy('dist_nome')
                ->get();

            $u = Cenarioequipe::where('st_alerta', 'COM ALERTA');
            if ($distrito != '-1') {
                $u->where('dist_nome', 'LIKE', '%' . $distrito . '%');
            }

            $total_alertas_unidades = $u->whereNull('unid_equi_data_desat')
                ->whereBetween('desc_compet', [$comp1, $comp2])
                ->selectRaw('und_nome, COUNT(*) as totalalertasunidades')
                ->groupBy('und_nome')
                ->orderBy('totalalertasunidades', 'desc')
                ->get();

            $a = Cenarioequipe::where('st_alerta', 'COM ALERTA');
            if ($distrito != '-1') {
                $a->where('dist_nome', 'LIKE', '%' . $distrito . '%');
            }
            $total_alertas = $a->whereNull('unid_equi_data_desat')
                ->whereBetween('desc_compet', [$comp1, $comp2])
                ->selectRaw('desc_alerta, COUNT(*) as totalocorrencias')
                ->groupBy('desc_alerta')
                ->get();

            $l = Cenarioequipe::where('st_alerta', 'COM ALERTA');
            if ($distrito != '-1') {
                $l->where('dist_nome', 'LIKE', '%' . $distrito . '%');
            }

            $lista_unidades = $l->whereNull('unid_equi_data_desat')
                ->whereBetween('desc_compet', [$comp1, $comp2])
                ->orderBy('dist_nome')
                ->orderBy('und_nome')
                ->get();


            $norte_alertas = $total_alertas_distrito[1]->totalalertas ?? 0;
            $sul_alertas = $total_alertas_distrito[4]->totalalertas ?? 0;
            $leste_alertas = $total_alertas_distrito[0]->totalalertas ?? 0;
            $oeste_alertas = $total_alertas_distrito[2]->totalalertas ?? 0;
            $rural_alertas = $total_alertas_distrito[3]->totalalertas ?? 0;

            $total = $norte_alertas + $sul_alertas + $leste_alertas + $oeste_alertas + $rural_alertas;
            $competencias = $this->competencias_format;
            $distritos = $this->distritos;

            return view('alertas', compact(
                'total_Registros_Alertas',
                'total_alertas_distrito',
                'distrito',
                'distritos',
                'total_alertas_unidades',
                'competencia',
                'lista_unidades',
                'total_alertas',
                'norte_alertas',
                'sul_alertas',
                'leste_alertas',
                'oeste_alertas',
                'rural_alertas',
                'total',
                'competencias',
                'comp1',
                'comp2'
            ));
        }


        $competencia = $competencia == null ? $comp1 : $competencia;

        $d = Cenarioequipe::where('st_alerta', 'COM ALERTA');
        if (!in_array('-1', [$competencia, $comp1])) {
            $d->where('desc_compet', $competencia);
        }
        $total_alertas_distrito  = $d->whereNull('unid_equi_data_desat')
            ->selectRaw('dist_nome, COUNT(*) as totalalertas')
            ->groupBy('dist_nome')
            ->get();


        $u = Cenarioequipe::where('st_alerta', 'COM ALERTA');
        if ($distrito != '-1') {
            $u->where('dist_nome', 'LIKE', '%' . $distrito . '%');
        }
        if (!in_array('-1', [$competencia, $comp1])) {
            $u->where('desc_compet', $competencia);
        }

        $total_alertas_unidades = $u->whereNull('unid_equi_data_desat')
            ->selectRaw('und_nome, COUNT(*) as totalalertasunidades')
            ->groupBy('und_nome')
            ->orderBy('totalalertasunidades', 'desc')
            ->get();

        $a = Cenarioequipe::where('st_alerta', 'COM ALERTA');
        if ($distrito != '-1') {
            $a->where('dist_nome', 'LIKE', '%' . $distrito . '%');
        }
        if (!in_array('-1', [$competencia, $comp1])) {
            $a->where('desc_compet', $competencia);
        }
        $total_alertas = $a->whereNull('unid_equi_data_desat')
            ->selectRaw('desc_alerta, COUNT(*) as totalocorrencias')
            ->groupBy('desc_alerta')
            ->get();

        $l = Cenarioequipe::where('st_alerta', 'COM ALERTA');
        if ($distrito != '-1') {
            $l->where('dist_nome', 'LIKE', '%' . $distrito . '%');
        }
        if (!in_array('-1', [$competencia, $comp1])) {
            $l->where('desc_compet', $competencia);
        }
        $lista_unidades = $l->whereNull('unid_equi_data_desat')
            ->orderBy('dist_nome')
            ->orderBy('und_nome')
            ->get();

        $norte_alertas = $total_alertas_distrito[1]->totalalertas ?? 0;
        $sul_alertas = $total_alertas_distrito[4]->totalalertas ?? 0;
        $leste_alertas = $total_alertas_distrito[0]->totalalertas ?? 0;
        $oeste_alertas = $total_alertas_distrito[2]->totalalertas ?? 0;
        $rural_alertas = $total_alertas_distrito[3]->totalalertas ?? 0;

        $competencias = $this->competencias_format;
        $distritos = $this->distritos;
        $total = $norte_alertas + $sul_alertas + $leste_alertas + $oeste_alertas + $rural_alertas;

        return view('alertas', compact(
            'total_Registros_Alertas',
            'total_alertas_distrito',
            'distrito',
            'distritos',
            'total_alertas_unidades',
            'competencia',
            'lista_unidades',
            'total_alertas',
            'norte_alertas',
            'sul_alertas',
            'leste_alertas',
            'oeste_alertas',
            'rural_alertas',
            'total',
            'competencias',
            'comp1',
            'comp2'
        ));
    }

    public function alertasUnidade(Request $request)
    {
         // Registrar o log específico
        $this->log->setLog('Novo_ADA', 'Usuário acessou a função Alertas por Unidades');

        $competencia = $request->input('competencia');
        $unidade = $request->input('unidade');
        $comp1 = $request->input('comp1');
        $comp2 = $request->input('comp2');

        if ($comp2 && $comp2 != '-1') {
            $l = Cenarioequipe::where('st_alerta', 'COM ALERTA');
            $l->whereNull('unid_equi_data_desat')
                ->where('und_nome', $unidade)
                ->whereBetween('desc_compet', [$comp1, $comp2])
                ->orderBy('dist_nome')
                ->orderBy('und_nome');
            Log::info($l->toSQL(), $l->getBindings());
            $alertas_unidades = $l->get();
        } else {
            $l = Cenarioequipe::where('st_alerta', 'COM ALERTA');
            if (!in_array('-1', [$competencia, $comp1])) {
                $l->where('desc_compet', $competencia);
            }
            $alertas_unidades = $l->whereNull('unid_equi_data_desat')
                ->where('und_nome', $unidade)
                ->orderBy('dist_nome')
                ->orderBy('und_nome')
                ->get();
        }

        return view('alertas-unidade', compact('unidade', 'competencia', 'alertas_unidades', 'comp1', 'comp2'));
    }

    public function alertasOcorrencias(Request $request)
    {
         // Registrar o log específico
        $this->log->setLog('Novo_ADA', 'Usuário acessou a função Alertas de Ocorrencias');

        $competencia = $request->input('competencia');
        $alerta = $request->input('alerta');



        if ($competencia != '-1') {
            $dadosOcorrencias = Cenarioequipe::whereRaw('TRIM(desc_alerta) = ?', [$alerta])
                ->where('desc_compet', $competencia)
                ->orderBy('und_nome')
                ->get(['desc_alerta', 'und_nome', 'equi_nome', 'desc_compet']);
        } else {
            $dadosOcorrencias = Cenarioequipe::whereRaw('TRIM(desc_alerta) = ?', [$alerta])
                ->orderBy('und_nome')
                ->get(['desc_alerta', 'und_nome', 'equi_nome', 'desc_compet']);
        }

        return view('alertas-ocorrencias', compact('alerta', 'competencia', 'dadosOcorrencias'));
    }

    public function acompanhamentoAlerta(Request $request)
    {
        //$dados = $request->all();

         // Registrar o log específico
        $this->log->setLog('Novo_ADA', 'Usuário acessou a função Acompanhar alerta');


        $ocorrencia = $request->input('ocorrencia');
        $unidade = $request->input('unidade');
        $equipe = $request->input('equipe');
        $competencia = $request->input('competencia');


        $dadosAlerta = [
            'ocorrencia' => $ocorrencia,
            'unidade' => $unidade,
            'equipe' => $equipe,
            'competencia' => $competencia,
        ];

        //dd($dadosAlerta);

        return view('acompanhamento', compact('dadosAlerta'));
    }
}
