<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('record_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->date('date')->nullable();
            $table->string('schedule',40)->nullable();
            $table->time('entry_time')->nullable();
            $table->time('exit_time')->nullable();
            $table->time('clock_in')->nullable();//marca entrada
            $table->time('clock_out')->nullable();//marca salida
            $table->time('delayed_time')->nullable();//tardanza
            $table->time('early_time')->nullable();//temprano
            $table->time('after_hours')->nullable();
            $table->time('worked_time')->nullable();
            $table->time('labor')->nullable();//laboral
            $table->unsignedBigInteger('schedule_id')->nullable();
             
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');

             
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
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
        Schema::dropIfExists('record_schedules');
    }
}
