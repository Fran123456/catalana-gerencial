<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->integer('day')->nullable();
            $table->time('exit_time')->nullable();
            $table->time('entry_time')->nullable();
            $table->boolean('break')->nullable();
            $table->time('lunch')->nullable();
            $table->string('day_name',40)->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();
            
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('week_schedules');
    }
}
