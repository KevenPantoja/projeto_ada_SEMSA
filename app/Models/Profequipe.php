<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Profequipe extends Model
{
    // OBS: ESTE MODEL CONSULTA UMA VIEW NO SCHEMA NOVO_ADA

    use HasFactory;
    protected $connection = 'pgsql_ada';

    public function getFormattedDateSaidaAttribute()
    {
        return $this->uns_eqp_prf_saida ? Carbon::parse($this->und_eqp_prf_saida)->format('d/m/Y') : null;
    }
}
