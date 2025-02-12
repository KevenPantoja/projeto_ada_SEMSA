<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tb_dim_competencia;
use App\Models\Tb_dim_distrito;
use App\Models\Unidades;
/** Este controlador destina-se a fornecer variáveis para uso em filtros */
class DadosFiltroController extends Controller
{
    /*** Model . */
    private $tb_competencias;
    private $tb_distritos;
    private $tb_unidades;
    /**
     * Construtor com injeção de dependência.     *
     * @param  Tb_dim_competencia  $tb_competencias
     * @param  Tb_dim_distrito     $tb_distritos
     */
    public function __construct(Tb_dim_competencia $tb_competencias, Tb_dim_distrito $tb_distritos, Unidades $tb_unidades)
    {
        $this->tb_competencias = $tb_competencias;
        $this->tb_distritos = $tb_distritos;
        $this->tb_unidades = $tb_unidades;
    }

    public function getCompetencias()
    {
        $competencias = $this->tb_competencias->getCompetencias();
        return $competencias;
    }


    public function getCompetenciasFormatadas()    {


            return $this->tb_competencias->getCompetenciasFormatada();



    }

    public function getDistritos()
    {
        return $this->tb_distritos->getDistritos();

    }



    public function getUnidades()
    {
        return $this->tb_unidades->getUnidades();

    }

}
