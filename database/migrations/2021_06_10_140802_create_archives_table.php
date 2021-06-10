<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('title',300)->nullable();
            $table->string('version',200)->nullable();
            $table->string('edition',120)->nullable();
            $table->boolean('active')->default(true);
            $table->string('download_mark',500)->nullable();
            $table->string('download',500)->nullable();
            $table->string('format',30)->nullable();
            $table->unsignedBigInteger('container_id')->nullable();
            $table->unsignedBigInteger('subcontainer_id')->nullable();
            $table->unsignedBigInteger('archive_type_id')->nullable();
            $table->string('code',30)->nullable();
            $table->dateTime('created_at')->nullable();

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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
