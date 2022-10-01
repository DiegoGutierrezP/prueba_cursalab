<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCursosCapitulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_cursos_capitulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_curso_id');
            $table->foreign('user_curso_id')
                ->references('id')
                ->on('user_curso')->onDelete('cascade');

            $table->unsignedBigInteger('capitulo_id');
            $table->foreign('capitulo_id')
                ->references('id')
                ->on('capitulos')->onDelete('cascade');

            $table->enum('estado',[0,1,2])->default(0);

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
        Schema::dropIfExists('users_cursos_capitulos');
    }
}
