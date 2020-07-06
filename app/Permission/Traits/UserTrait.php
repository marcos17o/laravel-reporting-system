<?php
namespace App\Permission\Traits;
use App\Permission\Models\Role;
use App\Permission\Models\Factura;
use App\Permission\Models\Cao_sistema;
use App\Permission\Models\Salario;

trait UserTrait{
    // es: de aqui
    // en: from hear

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimesTamps();
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
