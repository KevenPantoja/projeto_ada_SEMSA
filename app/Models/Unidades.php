<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    use HasFactory;
    protected $table = 'tb_dim_unidade';
    protected $primaryKey = 'co_seq_dim_unidade';
    protected $connection = 'pgsql_ada';


    public function getUnidades()
    {
        // Retorna os registros de Unidades de Saúde por nome
        return $this->distinct()->pluck('und_nome');

    }
}
