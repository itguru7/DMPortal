<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('part_number')->length(50)->index();
            $table->string('vendor')->length(50)->index();

            $table->string('image_page_link');
            $table->string('attribute_page_link');
            $table->string('buyers_guide_link');
            $table->string('tabs_link');
            $table->string('description_page_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
