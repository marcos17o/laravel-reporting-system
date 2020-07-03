<?php

namespace App\Permission\Models;
use App\Permission\Models\Factura;

use Illuminate\Database\Eloquent\Model;

class Cao_sistema extends Model
{
    protected $fillable = [
        'co_cliente',
        'co_usuario',
        'co_arquitetura',
        'no_sistema',
        'ds_sistema_resumo',
        'ds_caracteristica',
        'ds_requisito',
        'no_diretoria_solic',
        'ddd_telefone_solic',
        'nu_telefone_solic',
        'no_usuario_solic',
        'dt_solicitacao',
        'dt_entrega',
        'co_email'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'co_usuario')->withTimesTamps();
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'cao_sistemas','co_usuario')->withTimesTamps();
    }

}
