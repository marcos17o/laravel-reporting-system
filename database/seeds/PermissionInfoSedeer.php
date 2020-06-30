<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;



use Illuminate\Support\Facades\Hash;

class PermissionInfoSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
            DB::Table('role_user')->truncate();
            DB::Table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");

        $useradmin = User::where('email', 'admin@admin.com')->first();
        if($useradmin){
            $useradmin->delete();
        }

        // Create User admin
        $useradmin = User::create([
            'name'       =>  'admin',
            'email'      => 'admin@admin.com',
            'co_usuario' => 'admin',
            'password'   => Hash::make('admin')
        ]);

        // Create Roles
        $roleadmin = Role::create([
           'name' => 'Admin',
           'slug' => 'admin',
           'description' => 'Administrator',
           'full-access' => 'yes'
        ]);

        $roleeditor = Role::create([
            'name' => 'Editor',
            'slug' => 'Editor',
            'description' => 'Editor',
            'full-access' => 'no'
         ]);

         $roleconsultor = Role::create([
            'name' => 'Consultor',
            'slug' => 'Consultor',
            'description' => 'Consultor',
            'full-access' => 'no'
         ]);

        // Table role User
        $useradmin->roles()->sync([$roleadmin->id]);

        // permission
        $permission_all = [];
        $editor         = [];
        $consultor      = [];


        // Permision Role
        $permission = Permission::create([
            'name'        => 'List role',
            'slug'        => 'role.index',
            'description' => 'A User can list Role'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;
        $consultor[]      = $permission->id;

        $permission = Permission::create([
            'name'        => 'Show role',
            'slug'        => 'role.show',
            'description' => 'A User see role'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;
        $consultor[]      = $permission->id;

        $permission = Permission::create([
            'name'        => 'Create role',
            'slug'        => 'role.create',
            'description' => 'A User can Create Role'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;

        $permission = Permission::create([
            'name'        => 'Edit role',
            'slug'        => 'role.edit',
            'description' => 'A User can Edit Role'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;

        $permission = Permission::create([
            'name'        => 'Destroy role',
            'slug'        => 'role.destroy',
            'description' => 'A User can Destroy Role'
        ]);

        $permission_all[] = $permission->id;



        // Permision user
        $permission = Permission::create([
            'name'        => 'List user',
            'slug'        => 'user.index',
            'description' => 'A User can list user'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;
        $consultor[]      = $permission->id;



        $permission = Permission::create([
            'name'        => 'Create user',
            'slug'        => 'user.create',
            'description' => 'A User can Create user'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;

        $permission = Permission::create([
            'name'        => 'Show user',
            'slug'        => 'user.show',
            'description' => 'A User can see user'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;
        $consultor[]      = $permission->id;

        $permission = Permission::create([
            'name'        => 'Edit user',
            'slug'        => 'user.edit',
            'description' => 'A User can Edit user'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;

        $permission = Permission::create([
            'name'        => 'Destroy user',
            'slug'        => 'user.destroy',
            'description' => 'A User can Destroy user'
        ]);

        $permission_all[] = $permission->id;



        // New
        $permission = Permission::create([
            'name'        => 'Show own user',
            'slug'        => 'userown.show',
            'description' => 'A User see own user'
        ]);

        $permission_all[] = $permission->id;
        $consultor[]      = $permission->id;

        $permission = Permission::create([
            'name'        => 'Edit own user',
            'slug'        => 'userown.edit',
            'description' => 'A User can Edit own user'
        ]);

        $permission_all[] = $permission->id;
        $consultor[]      = $permission->id;



        // facturas
        $permission = Permission::create([
            'name'        => 'List Factura',
            'slug'        => 'factura.index',
            'description' => 'A User can list Factura'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;
        $consultor[]      = $permission->id;

        $permission = Permission::create([
            'name'        => 'Show Factura',
            'slug'        => 'factura.show',
            'description' => 'A User see Factura'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;
        $consultor[]      = $permission->id;

        $permission = Permission::create([
            'name'        => 'Create Factura',
            'slug'        => 'factura.create',
            'description' => 'A User can Create Factura'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;

        $permission = Permission::create([
            'name'        => 'Edit Factura',
            'slug'        => 'factura.edit',
            'description' => 'A User can Edit Factura'
        ]);

        $permission_all[] = $permission->id;
        $editor[]         = $permission->id;

        $permission = Permission::create([
            'name'        => 'Destroy Factura',
            'slug'        => 'factura.destroy',
            'description' => 'A User can Destroy Factura'
        ]);

        $permission_all[] = $permission->id;


        // Table permission_role
        // esta es la forma de agregar todos los permidos a un ususrio
        // $roleadmin->permissions()->sync( $permission_all );

        $roleeditor->permissions()->sync( $editor );
        $roleconsultor->permissions()->sync( $consultor );

    }
}
