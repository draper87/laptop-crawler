<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->integer('laptop_id');
            $table->string('name');
            $table->string('brand');
            $table->string('ram_memory');
            $table->string('motherboard');
            $table->string('network');
            $table->string('connections');
            $table->string('cpu_brand');
            $table->string('display_size');
            $table->string('storage_size');
            $table->string('video_card');
            $table->integer('battery');
            $table->integer('weight');
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
        Schema::dropIfExists('laptops');
    }
}
