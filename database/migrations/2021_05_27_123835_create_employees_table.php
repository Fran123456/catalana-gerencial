<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();            
            $table->string('names',255)->nullable();
            $table->string('lastnames',255)->nullable();
            $table->string('dui',255)->nullable();
            $table->string('nit',255)->nullable();
            $table->string('isss',255)->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('enterprise_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->string('enabled',10)->nullable();
            $table->string('coordinator',10)->nullable();
            $table->string('boss_list',10)->nullable();
            
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('enterprise_id')
                ->references('id')
                ->on('enterprises')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
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
        Schema::dropIfExists('employees');
    }
}
