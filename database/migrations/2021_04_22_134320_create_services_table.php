<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('DNI')->unique();
            $table->boolean('data')->default(false);
            $table->integer('data_type')->default(0);
            $table->boolean('fiber')->default(false);
            $table->integer('fiber_type')->default(0);
            $table->boolean('phone')->default(false);
            $table->integer('phone_type')->default(0);
            $table->boolean('tv')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
