<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcontainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcontainers', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('title',300)->nullable();
            $table->integer('order')->nullable();
            $table->unsignedBigInteger('back')->nullable();
            $table->string('code',20)->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->dateTime('created_at')->nullable();

            $table->foreign('container_id')
                ->references('id')
                ->on('containers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcontainers');
    }
}
