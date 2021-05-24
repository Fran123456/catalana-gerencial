<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            
            $table->unsignedBigInteger('id');            
            $table->string('area');
            $table->unsignedBigInteger('enterprise_id');
            $table->timestamps();            
            $table->primary('id');

            
            $table->foreign('enterprise_id')
                ->references('id')
                ->on('enterprises')
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
        Schema::dropIfExists('areas');
    }
}
