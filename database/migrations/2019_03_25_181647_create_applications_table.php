<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('part_id');

            $table->string('catalog')->length(50);
            $table->string('part_terminology')->length(50);
            $table->string('make')->length(50);
            $table->string('model')->length(100);
            $table->smallInteger('year')->length(4);
            $table->decimal('liters', 3, 1)->nullable();
            $table->smallInteger('cid')->length(4)->nullable();
            $table->string('engine_type')->length(50);
            $table->string('remarks');

            $table->foreign('part_id')
                ->references('id')->on('parts')
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
        Schema::dropIfExists('applications');
    }
}
