<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestions', function (Blueprint $table) {            
            $table->unsignedBigInteger('id')->primary();
            $table->text('suggestion')->nullable();
            $table->unsignedBigInteger('suggestion_type_id')->nullable();
            $table->string('suggestion_type',200)->nullable();
            $table->dateTime('date')->nullable();
            $table->string('reading',10)->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();            

            $table->foreign('suggestion_type_id')
                ->references('id')
                ->on('suggestion_types')
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
        Schema::dropIfExists('suggestions');
    }
}
