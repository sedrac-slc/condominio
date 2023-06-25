<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartamentoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartamento_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_morador_id')->unsigned();
            $table->bigInteger('apartamento_id')->unsigned();
            $table->bigInteger('how_created')->default(-1);
            $table->bigInteger('how_updated')->default(-1);
            $table->timestamps();
            $table->foreign('user_morador_id')->references('id')->on('user_moradors')->onDelete('cascade');
            $table->foreign('apartamento_id')->references('id')->on('apartamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartamento_users');
    }
}
