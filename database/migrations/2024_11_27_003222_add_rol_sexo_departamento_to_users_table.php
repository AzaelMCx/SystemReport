<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rol')->nullable();           // Columna para el rol del usuario
            $table->string('sexo')->nullable();          // Columna para el sexo del usuario
            $table->string('departamento')->nullable();  // Columna para el departamento
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rol', 'sexo', 'departamento']);
        });
    }
};
