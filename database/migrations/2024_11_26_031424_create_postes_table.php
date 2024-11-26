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
    Schema::create('datos_postes', function (Blueprint $table) {
        $table->id();
        $table->string('NameCamera');
        $table->string('location');
        $table->string('Brand');
        $table->string('Model');
        $table->ipAddress('IP');
        $table->ipAddress('Gateway');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('datos_postes');
}
};
