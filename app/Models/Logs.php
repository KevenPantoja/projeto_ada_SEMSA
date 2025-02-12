<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $connection = 'pgsql_did'; // Banco do portaldid
}
