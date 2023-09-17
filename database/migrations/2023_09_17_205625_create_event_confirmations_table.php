<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_confirmations', function (Blueprint $table) {
            $table->id(); // ID padrão
            $table->unsignedBigInteger('idevento');
            $table->unsignedBigInteger('idusuario');
            $table->tinyInteger('convidado')->default(0); // 0 para cadastrado e 1 para convidado
            $table->string('nome')->nullable(); // Nome do convidado (se for o caso)
            $table->string('cell')->nullable(); // Celular do convidado (se for o caso)
            
            $table->timestamps();

            // Adicionando restrições de chave estrangeira (se você tiver as tabelas de eventos e usuários definidas)
            $table->foreign('idevento')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('idusuario')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_confirmations');
    }
};
