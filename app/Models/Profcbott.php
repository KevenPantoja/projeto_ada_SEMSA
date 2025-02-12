<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profcbott extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_ada';

    public function gettotal() {
        $proftt = self::selectRaw('SUM(qt_prof) AS total_prof, cbo_descricao')
        ->groupBy('cbo_descricao')
        ->get();
        
        #select('cbo_descricao', self::raw('SUM(qt_prof) as total_prof'))
        #->groupBy('cbo_descricao')
        #->get();

        return $proftt;
    }
}
