<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaoSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cao_sistemas', function (Blueprint $table) {
            $table->id();
            $table->string('co_sistema');
            $table->decimal('co_cliente',10,0)->unsigned()->default(0);
            $table->string('co_usuario',50)->default(0);
            $table->decimal('co_arquitetura',3,0)->unsigned()->default(0);
            $table->string('no_sistema',200)->nullable()->default(null);
            $table->text('ds_sistema_resumo');
            $table->text('ds_caracteristica');
            $table->text('ds_requisito');
            $table->string('no_diretoria_solic',100)->nullable()->default(null);
            $table->string('ddd_telefone_solic',5)->nullable()->default(null);
            $table->string('nu_telefone_solic',20)->nullable()->default(null);
            $table->string('no_usuario_solic',100)->nullable()->default(null);
            $table->date('dt_solicitacao')->nullable()->default(null);
            $table->date('dt_entrega')->nullable()->default(null);
            $table->decimal('co_email',30,0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cao_sistemas');
    }
}
