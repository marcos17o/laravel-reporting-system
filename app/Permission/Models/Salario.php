<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{

    protected $fillable = [
        'user_id',
        'brut_salario',
        'liq_salario',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimesTamps();
    }
}
