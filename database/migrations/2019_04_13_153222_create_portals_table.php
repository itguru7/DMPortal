<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subdomain_id')->index();
            $table->string('name')->nullable()->default('');
            $table->string('title')->nullable()->default('');
            $table->email('contact')->nullable()->default('');
            $table->string('color')->nullable()->default('#000000');
            $table->string('logo')->nullable()->default('');
            $table->string('background')->nullable()->default('');
            $table->boolean('access')->default(true);
            $table->string('password')->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portals');
    }
}
