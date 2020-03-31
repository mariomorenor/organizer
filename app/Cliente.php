<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table='clientes';
    protected $primaryKey = 'codigo';
    protected $keyType = 'string';
    protected $guarded=[''];

}
