<?php

namespace App\Http\Controllers;
use App\Models\Cenarioequipe;
//use App\Models\Profcbott;
//use App\Models\Profequipe;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DadosFiltroController;

use Illuminate\Http\Request;

class informacoesController extends Controller
{
    private $competencias;
    private $competencias_format;
    private $distritos;
    private $unidades;

    /** * Construtor com injeção de dependência. */
    public function __construct( DadosFiltroController $dadosController)
    {

        $this->competencias = $dadosController->getCompetencias();
        $this->competencias_format = $dadosController->getCompetenciasFormatadas();
        $this->distritos = $dadosController->getDistritos();
        $this->unidades = $dadosController->getUnidades();
    }

    public function informacoes(Request $request) {
        // Capturar o tempo inicial
        $startTime = microtime(true);

        // Obter a lista de Unidades
        //$unidades = Cenarioequipe::select('und_nome')->distinct()->get();
        $unidades = $this->unidades;

        // Obter a lista de competências 
        //$competencias = Cenarioequipe::select('desc_compet')->distinct()->orderBy('desc_compet','desc')->get();
        $competencias =  $this->competencias_format;

        //Obter a lista de distritos
        // $distritos = Cenarioequipe::select('dist_nome')->distinct()->pluck('dist_nome');
        $distritos = $this->distritos;

        $competencia = $request->input('competencia'); // Valor padrão
        $distrito = $request->input('distrito');
        $unidadeselect = $request->input('unidades', null);

        $query = Cenarioequipe::whereNull('unid_equi_data_desat')
                                ->orWhere('unid_equi_data_desat','')
                                ->whereIn('dist_nome', ['NORTE', 'SUL', 'LESTE', 'OESTE', 'RURAL']);

        if ($competencia != '-1')
        {
            $query = $query->where('desc_compet', 'like', '%'.$competencia.'%');
        }

        if ($distrito != '-1') {
            $query = $query->where('dist_nome', 'like', $distrito.'%');
        }

        if ($unidadeselect != '-1') {
            $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        }

        $busca_cenario = $query->where('st_alerta', 'COM ALERTA')
                        ->get();

        $total_Registros_Alertas = $busca_cenario->count();

        if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        {

            $busca_cenario = Cenarioequipe::where('st_alerta', 'COM ALERTA')
                                            ->whereIn('dist_nome', ['NORTE', 'SUL', 'LESTE', 'OESTE', 'RURAL'])
                                            ->where(function($query) {
                                                $query->whereNull('unid_equi_data_desat')
                                                    ->orWhere('unid_equi_data_desat', '=', '');
                                            })
                                            ->get();

            $total_Registros_Alertas = $busca_cenario->count();      
        }

        // Capturar o tempo final
        $endTime = microtime(true);

        // Calcular o tempo de execução
        $executionTime = $endTime - $startTime;

        // Registrar no log
        Log::info('Tempo rodando:', ['tempo_execucao' => $executionTime . ' segundos']);

        return view('informacoes', compact('competencias', 'distritos', 'unidades', 'total_Registros_Alertas'));

    }

    public function dadosEquipes(Request $request)
    {
        // Capturar o tempo inicial
        $startTime = microtime(true);

        

        // ****************** CALCULAR EQUIPES ESF ******************************

        $competencia = $request->input('competencia'); // Valor padrão
        $distrito = $request->input('distrito');
        $unidadeselect = $request->input('unidades');

        $query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // $total_Registros_ESF = '';

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }

        // $busca_cenario = $query->where('equi_nome', 'like', 'ESF%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_ESF = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'ESF%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_ESF = $busca_cenario->count();
        // }

        // ****************** CALCULAR EQUIPES EAP ******************************

        // $total_Registros_EAP = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }        

        // $busca_cenario = $query->where('equi_nome', 'like', 'EAP%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_EAP = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'EAP%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_EAP = $busca_cenario->count();
        // }        

        // ****************** CALCULAR EQUIPES ESB ******************************

        // $total_Registros_ESB = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->where('equi_nome', 'like', 'ESB%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_ESB = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'ESB%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_ESB = $busca_cenario->count();    
        // }    

        // // ****************** CALCULAR EQUIPES EMULT ******************************

        // $total_Registros_EMULTI = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }                  

        // $busca_cenario = $query->where('equi_nome', 'like', 'EMULT%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_EMULTI = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'EMULT%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_EMULTI = $busca_cenario->count();      

        // }    
            
        // // ****************** CALCULAR EQUIPES NASF ******************************

        // $total_Registros_ENASF = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->where('equi_nome', 'like', 'NASF%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_ENASF = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'NASF%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_ENASF = $busca_cenario->count();      
        
        // }

        // // ****************** CALCULAR EQUIPES ECR ******************************

        // $total_Registros_ECR = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }           

        // $busca_cenario = $query->where('equi_nome', 'like', 'ECR%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_ECR = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'ECR%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_ECR = $busca_cenario->count();      
        
        // }

        // // ****************** CALCULAR EQUIPES EAPP ******************************

        // $total_Registros_EAPP = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->where('equi_nome', 'like', 'EAPP%')
        //                         ->distinct()
        //                         ->get(['equi_nome']);
        // $total_Registros_EAPP = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('equi_nome', 'like', 'EAPP%')
        //                     ->distinct()
        //                     ->get(['equi_nome']);

        //     $total_Registros_EAPP = $busca_cenario->count();      
        
        // }

        // // ****************** CALCULAR TOTAL DE USF'S ******************************

        // $total_Registros_USF = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }            

        // $busca_cenario = $query->where('und_nome', 'like', 'USF%')
        //                 ->distinct('und_nome')
        //                 ->get();

        // $total_Registros_USF = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('und_nome', 'like', 'USF%')
        //                     ->distinct('und_nome')
        //                     ->get();

        //     $total_Registros_USF = $busca_cenario->count();      
        
        // }

        // // ****************** CALCULAR TOTAL DE UBS'S ******************************

        // $total_Registros_UBS = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->where('und_nome', 'like', 'UBS%')
        //                 ->distinct('und_nome')
        //                 ->get();

        // $total_Registros_UBS = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->distinct('und_nome')
        //                     ->get();

        //     $total_Registros_UBS = $busca_cenario->count();
        
        // }        

        // // ****************** CALCULAR TOTAL DE EQUIPES SNH ******************************

        // $total_Registros_SNH = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }         

        // $busca_cenario = $query->whereNotNull('prt_snh')
        //                 ->distinct('equi_nome')
        //                 ->get();

        // $total_Registros_SNH = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->whereNotNull('prt_snh')
        //                     ->distinct('equi_nome')
        //                     ->get();

        //     $total_Registros_SNH = $busca_cenario->count();      
        
        // } 

        // // ****************** CALCULAR TOTAL DE EQUIPES HOMOLOGADAS ******************************

        // $total_Registros_Homol = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->whereNotNull('prt_homol')
        //                 ->distinct('equi_nome')
        //                 ->get();

        // $total_Registros_Homol = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->whereNotNull('prt_homol')
        //                     ->distinct('equi_nome')
        //                     ->get();

        //     $total_Registros_Homol = $busca_cenario->count();      
        
        // } 

        // // ****************** CALCULAR TOTAL DE EQUIPES INFORMATIZA ******************************

        // $total_Registros_Homol = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->whereNotNull('prt_informatiza')
        //                 ->distinct('equi_nome')
        //                 ->get();

        // $total_Registros_Informatiza = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->whereNotNull('prt_informatiza')
        //                     ->distinct('equi_nome')
        //                     ->get();

        //     $total_Registros_Informatiza = $busca_cenario->count();      
        
        // }     
        
        // ****************** CALCULAR TOTAL DE ALERTAS ******************************

        $total_Registros_Alertas = '';

        //$query = Cenarioequipe::whereNull('unid_equi_data_desat');

        if ($competencia != '-1')
        {
            $query = $query->where('desc_compet', $competencia);
        }

        if ($distrito != '-1') {
            $query = $query->where('dist_nome', 'like', $distrito.'%');
        }

        if ($unidadeselect != '-1') {
            $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        }           

        Log::info($query->toSQL(), $query->getBindings());
        $busca_cenario = $query->where('st_alerta', 'COM ALERTA')
                        ->get();

        $total_Registros_Alertas = $busca_cenario->count();

        if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        {

            $busca_cenario = Cenarioequipe::where('st_alerta', 'COM ALERTA')
                                            ->whereIn('dist_nome', ['NORTE', 'SUL', 'LESTE', 'OESTE', 'RURAL'])
                                            ->where(function($query) {
                                                $query->whereNull('unid_equi_data_desat')
                                                    ->orWhere('unid_equi_data_desat', '=', '');
                                            })
                                            ->get();

            $total_Registros_Alertas = $busca_cenario->count();      
        }         


        // // ****************** CALCULAR TOTAL DE EQUIPES INCOMPLETAS ******************************

        // $total_Registros_EqIncomp = '';

        // //$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // if ($distrito != '-1') {
        //     $query = $query->where('dist_nome', 'like', $distrito.'%');
        // }

        // if ($unidadeselect != '-1') {
        //     $query = $query->where('und_nome', 'like', $unidadeselect.'%');
        // }          

        // $busca_cenario = $query->where('st_alerta', 'COM ALERTA')
        //                 ->where('desc_alerta', 'like', '%SEM%')
        //                 ->distinct('equi_nome')
        //                 ->get();

        // $total_Registros_EqIncomp = $busca_cenario->count();

        // if (($distrito == -1) && ($competencia == -1) && ($unidadeselect == -1))
        // {
        //     $busca_cenario = Cenarioequipe::whereNotNull('unid_equi_data_desat')
        //                     ->where('st_alerta', 'COM ALERTA')
        //                     ->where('desc_alerta', 'like', '%SEM%')
        //                     ->distinct('equi_nome')
        //                     ->get();

        //     $total_Registros_EqIncomp = $busca_cenario->count();      
        
        // } 

        // ****************** CALCULAR TOTAL DE EQUIPES ******************************

        //$total_equipes = $total_Registros_ESF + $total_Registros_EAP + $total_Registros_ECR + $total_Registros_ESB + $total_Registros_EMULTI + $total_Registros_ENASF + $total_Registros_EAPP;

        $total_equipes = '';
        if ($competencia != '-1')
        {
            $total_equipes = Cenarioequipe::where('desc_compet', $competencia)
                ->distinct('equi_ine')
                ->count('equi_ine');
        }else{
            $total_equipes = Cenarioequipe::distinct('equi_ine')->count('equi_ine');
        }
        

        // ****************** CALCULAR TOTAL DE UNIDADES POR DISTRITO ******************************

        ////$query = Cenarioequipe::whereNotNull('unid_equi_data_desat');

        // if ($competencia != '-1')
        // {
        //     $query = $query->where('desc_compet', $competencia);
        // }

        // $busca_cenario_Unidades = Cenarioequipe::selectRaw('dist_nome, COUNT(DISTINCT und_nome) as total_und_nome')
        //                         ->where('desc_compet', $competencia)
        //                         ->groupBy('dist_nome')
        //                         ->get();        

        $dadosEquipes = [
            //'busca_cenario' => $busca_cenario,
            //'total_Registros_ESF' => $total_Registros_ESF,
            //'total_Registros_EAP' => $total_Registros_EAP,
            //'total_Registros_ESB' => $total_Registros_ESB,
            //'total_Registros_EMULTI' => $total_Registros_EMULTI,
            //'total_Registros_USF' => $total_Registros_USF,
            //'total_Registros_UBS' => $total_Registros_UBS,
            //'total_Registros_SNH' => $total_Registros_SNH,
            //'total_Registros_Homol' => $total_Registros_Homol,
            //'total_Registros_Informatiza' => $total_Registros_Informatiza,
            'total_Registros_Alertas' => $total_Registros_Alertas, //esse aqui
            //'busca_cenario_Unidades' => $busca_cenario_Unidades,
            //'total_Registros_ENASF' => $total_Registros_ENASF,
            //'total_Registros_ECR' => $total_Registros_ECR,
            //'total_Registros_EAPP' => $total_Registros_EAPP,
            //'total_Registros_EqIncomp' => $total_Registros_EqIncomp,
            'total_equipes' => $total_equipes //esse aqui
        ];

        // Capturar o tempo final
        $endTime = microtime(true);

        // Calcular o tempo de execução
        $executionTime = $endTime - $startTime;

        // Registrar no log
        Log::info('Tempo rodando função 2:', ['tempo_execucao' => $executionTime . ' segundos']);
        
        return response()->json($dadosEquipes);
    }

}
