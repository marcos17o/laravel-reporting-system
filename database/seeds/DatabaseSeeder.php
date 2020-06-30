<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call(PermissionInfoSedeer::class);
        $this->call(Cao_arquitetura_osSedeer::class);
        $this->call(UserSedeer::class);
        $this->call(FacturasSedeer::class);
        // $this->call(Cao_sistemaSedeer::class);
    }
}
