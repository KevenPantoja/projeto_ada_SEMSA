<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portaria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = "pgsql_ada";

    // protected $connection = "pgsql";

    protected $table = 'ine_prt_homolog';  // Nome da tabela

    // Defina a chave primária como 'INE'
    protected $primaryKey = 'INE';

    // Indica que a chave primária não é um número incremental
    public $incrementing = false;

    // Tipo de dado da chave primária, que agora é string
    protected $keyType = 'string';

    // Defina as colunas que podem ser atribuídas em massa
    protected $fillable = [
        'INE', 'TIPO', 'PRT_MS', 'STATUS',
    ];

    /**
     * Accessor para o atributo 'status'
     * Converte o valor numérico do banco para uma string legível.
     */
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'ativada' : 'desativada';
    }

    /**
     * Mutator para o atributo 'status'
     * Converte valores legíveis para o formato numérico do banco.
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ($value === 'ativada' || $value == 1) ? 1 : 0;
        
    }

    /**
     * Verifica se a portaria está ativada.
     *
     * @return bool
     */
    public function isAtivada()
    {
        return $this->attributes['status'] == 1;
    }

    /**
     * Verifica se a portaria está desativada.
     *
     * @return bool
     */
    public function isDesativada()
    {
        return $this->attributes['status'] == 0;
    }
}
