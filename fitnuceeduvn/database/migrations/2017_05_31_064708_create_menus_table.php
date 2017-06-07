<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('id_parent')->default(0);
            $table->integer('order_number');
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->text('link')->nullable();
            $table->text('avatar')->nullable();
            $table->boolean('is_home');
            $table->boolean('is_top');
            $table->boolean('is_right');
            $table->boolean('is_menubar');
            $table->boolean('active_flg');
            $table->timestamps();
            $table->integer('created_by')->nullable()->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
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
