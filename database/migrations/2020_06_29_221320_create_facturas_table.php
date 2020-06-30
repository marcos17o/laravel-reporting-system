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
            // $table->string('co_fatura')->unsigned();
            $table->string('co_cliente')->nullable();
            $table->string('co_sistema')->nullable();
            $table->string('co_os')->nullable();
            $table->integer('num_nf')->nullable();
            $table->decimal('total')->nullable();
            $table->decimal('valor')->nullable();
            $table->date('data_emissao')->nullable();
            $table->text('corpo_nf')->nullable();
            $table->decimal('comissao_cn')->nullable();
            $table->decimal('total_imp_inc')->nullable();
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

