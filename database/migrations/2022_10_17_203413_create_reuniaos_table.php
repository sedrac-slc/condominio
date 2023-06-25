<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReuniaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reuniaos', function (Blueprint $table) {
            $table->id();
            $table->string('tema');
            $table->time('hora_comeco');
            $table->date('data');
            $table->bigInteger('how_created')->default(-1);
            $table->bigInteger('how_updated')->default(-1);
            $table->timestamps();
            $table->unique(['tema','hora_comeco']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reuniaos');
    }
}
