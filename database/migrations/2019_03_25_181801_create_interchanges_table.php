<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interchanges', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('part_id');

            $table->string('brand')->length(100);
            $table->string('sub_brand')->length(100)->nullable();
            $table->string('part_no')->length(100);

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
        Schema::dropIfExists('interchanges');
    }
}
