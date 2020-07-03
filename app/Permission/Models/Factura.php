<?php

namespace App\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use App\Permission\Models\Cao_sistema;

class Factura extends Model
{
    protected $fillable = [
        'co_sistema',
        'co_os',
        'num_nf',
        'total',
        'valor',
        'data_emissao',
        'corpo_nf',
        'comissao_cn',
        'total_imp_inc',
        'co_fatura'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimesTamps();
    }

    public function co_arquitetura()
    {
        return $this->belongsToMany('App\Permission\Models\Cao_arquitetura_os')->withTimesTamps();
    }

    public function cao_sistema()
    {
        return $this->belongsToMany(Cao_sistema::class, 'cao_sistemas','co_usuario')->withPivot('co_usuario')->withTimesTamps();
    }


}
