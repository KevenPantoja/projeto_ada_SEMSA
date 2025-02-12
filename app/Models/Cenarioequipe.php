<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cenarioequipe extends Model
{
    use HasFactory;// é umna view

    protected $connection = 'pgsql_ada';

    public function getFormattedDateAtivAttribute()
    {
        return Carbon::parse($this->unid_equi_data_ativ)->format('d/m/Y');
    }

    public function getFormattedDateDesatAttribute()
    {
        return $this->unid_equi_data_desat ? Carbon::parse($this->unid_equi_data_desat)->format('d/m/Y') : null;
    }
}
