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
            $table->string('ram_memory')->nullable();
            $table->string('motherboard')->nullable();
            $table->string('network')->nullable();
            $table->string('connections')->nullable();
            $table->string('cpu_name')->nullable();
            $table->foreign('cpu_name')->references('name')->on('cpus');
            $table->string('display_size')->nullable();
            $table->string('storage_size')->nullable();
            $table->string('videocard_name')->nullable();
            $table->foreign('videocard_name')->references('name')->on('videocards');
            $table->integer('battery')->nullable();
            $table->integer('price')->nullable();
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
