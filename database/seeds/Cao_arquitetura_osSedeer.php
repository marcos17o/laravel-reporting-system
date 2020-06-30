<?php

use Illuminate\Database\Seeder;
use App\Permission\Models\Cao_arquitetura_os;


class Cao_arquitetura_osSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cao_arquitetura_os::create([
            'ds_arquitetura' => 'ASP'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'Java'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  '.NET'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'PHP'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'HTML'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'Perl'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'PL/SQL'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'Ruby on Rails'
        ]);

        Cao_arquitetura_os::create([
            'ds_arquitetura'      =>  'Python / Django'
        ]);
    }
}
