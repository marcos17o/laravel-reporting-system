<?php
namespace App\Permission\Traits;

trait UserTrait{
    // es: de aqui
    // en: from hear

    public function roles()
    {
        return $this->belongsToMany('App\Permission\Models\Role')->withTimesTamps();
    }

    public function salarios()
    {
        return $this->hasOne('App\Permission\Models\Salario')->withTimesTamps();
    }

    public function facturas()
    {
        return $this->belongsToMany('App\Permission\Models\Factura')->withTimesTamps();
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
