<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_morador_id')->unsigned();
            $table->bigInteger('pagamento_id')->unsigned();
            $table->bigInteger('how_created')->default(-1);
            $table->bigInteger('how_updated')->default(-1);
            $table->bigInteger('checked_id')->nullable();
            $table->string('file');
            $table->timestamps();
            $table->foreign('user_morador_id')->references('id')->on('user_moradors')->onDelete('cascade');
            $table->foreign('pagamento_id')->references('id')->on('pagamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamento_users');
    }
}
