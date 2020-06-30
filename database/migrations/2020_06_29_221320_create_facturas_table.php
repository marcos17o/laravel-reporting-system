<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->integer('co_sistema',8)->default('0');
            $table->integer('co_os',8)->default('0');
            $table->integer('num_nf',10)->default('0');
            $table->float('total')->default('0');
            $table->float('valor')->default('0');
            $table->date('data_emissao')->default('1000-01-01');
            $table->text('corpo_nf');
            $table->float('comissao_cn')->default('0');
            $table->float('total_imp_inc')->default('0');
            $table->primary('co_fatura');
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
        Schema::dropIfExists('facturas');
    }
}
