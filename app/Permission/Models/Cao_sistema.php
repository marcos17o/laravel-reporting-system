<?php

namespace App\Permission\Models;

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

}
