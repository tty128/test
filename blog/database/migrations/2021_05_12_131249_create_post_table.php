<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->unsignedBigInteger('post_author')->default(0);
            $table->unsignedBigInteger('post_update_author')->nullable();
            $table->timestamps(0);
            $table->text('post_title');
            $table->longText('post_content');
            $table->string('post_status',20)->default('private');
            $table->string('post_password', 16)->nullable();
            $table->string('post_name', 200)->nullable();
            $table->unsignedBigInteger('post_parent')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
