<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_dim_distrito extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_ada';
    protected $table = 'tb_dim_distrito';

    /**
     * Retorna os nomes dos distritos que atendem aos critérios.
     *
     * @return array
     */
    public function getDistritos()
    {
        // Obtém os dados filtrados
        $distritos = $this->where('co_seq_dim_distrito', '>', 0)
                          ->where('co_seq_dim_distrito', '<', 7)
                          ->get('dist_nome'); // Substitua 'nome_distrito' pela coluna correta

        // Converte os resultados para um array
        return $distritos->pluck('dist_nome')->map(function ($nome) {
            $partes = explode(' ', $nome);
            return end($partes); // Pega a última parte após o sublinhado
        })->toArray();
    }


}
