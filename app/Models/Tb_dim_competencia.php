<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_dim_competencia extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_ada';
    protected $table = 'tb_dim_competencia';  // Nome da tabela


    /**
     * Retorna os 6 primeiros dígitos das competências onde comp_valido é true.
     *
     * @return array
     */
    public function getCompetencias()
    {
        // Retorna os registros onde comp_valido é true
        return $this->where('comp_valido', true)->orderBy('comp_competencia','desc')->pluck('comp_competencia');
    }



    public function getCompetenciasFormatada()
{
    // Retorna os primeiros 6 dígitos das competências válidas
    return $this->where('comp_valido', true)
                ->orderBy('comp_competencia','desc')
                ->pluck('comp_competencia') // Extrai diretamente a coluna
                ->map(function ($value) {
                    return substr($value, 0, 6); // Retorna os 6 primeiros dígitos
                })
                ->toArray(); // Converte para um array
}

}
