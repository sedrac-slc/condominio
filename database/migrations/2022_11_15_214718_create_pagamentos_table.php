<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao',100);
            $table->integer('valor');
            $table->enum('mes',[
                'JANEIRO','FEVEREIRO','MARCO','ABRIL',
                'MAIO','JUNHO','JULHO','AGOSTO',
                'SETEMBRO','OUTUBRO','NOVEMBRO','DEZEMBRO'
            ]);
            $table->bigInteger('ano');
            $table->bigInteger('how_created')->default(-1);
            $table->bigInteger('how_updated')->default(-1);
            $table->timestamps();
            $table->unique(['mes', 'ano']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
