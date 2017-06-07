<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('new_content')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_desciption')->nullable();
            $table->text('avatar')->nullable();
            $table->integer('total_view')->default(0);
            $table->boolean('is_tinlq');
            $table->boolean('is_comment');
            $table->boolean('is_shared');
            $table->boolean('is_home');
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
        Schema::dropIfExists('posts');
    }
}
