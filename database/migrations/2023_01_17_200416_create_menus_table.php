<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->enum('display', ['Admin', 'User', 'Public'])->default('Admin');
            $table->enum('header', ['Yes', 'No'])->default('No');
            $table->string('menu_title', 255)->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('sort_order')->default(0);
            $table->string('icon', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->integer('permission')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
