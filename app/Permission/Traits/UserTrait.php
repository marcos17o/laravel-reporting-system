<?php
namespace App\Permission\Traits;
use App\Permission\Models\Role;
use App\Permission\Models\Factura;
use App\Permission\Models\Cao_sistema;

trait UserTrait{
    // es: de aqui
    // en: from hear

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimesTamps();
    }

    public function salarios()
    {
        return $this->hasOne('App\Permission\Models\Salario')->withTimesTamps();
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class)->withTimesTamps();
    }

    public function cao_sistema()
    {
        return $this->belongsToMany(Cao_sistema::class, 'cao_sistemas','co_usuario')->withPivot('co_usuario')->withTimesTamps();
    }

    public function havePermission($permission){
        foreach ($this->roles as $role) {
            if ($role['full-access'] == 'yes') {
                return true;
            };

            foreach ($role->permissions as $perm) {
                if ($perm->slug == $permission) {
                    return true;
                };
            }

            return false;
        }
    }
}
