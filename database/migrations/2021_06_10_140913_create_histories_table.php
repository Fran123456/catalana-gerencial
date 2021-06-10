<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();            
            $table->unsignedBigInteger('container_id')->nullable();
            $table->unsignedBigInteger('subcontainer_id')->nullable();
            $table->unsignedBigInteger('archive_type_id')->nullable();
            $table->unsignedBigInteger('archive_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->dateTime('date')->nullable();

            $table->foreign('container_id')
                ->references('id')
                ->on('containers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('subcontainer_id')
                ->references('id')
                ->on('subcontainers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            
            $table->foreign('archive_type_id')
                ->references('id')
                ->on('archive_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('archive_id')
                ->references('id')
                ->on('archives')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
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
        Schema::dropIfExists('histories');
    }
}
