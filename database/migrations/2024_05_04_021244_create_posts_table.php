<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->string('title');
            $table->string('content');
            $table->boolean('is_solved')->default(false);
            $table->integer('replies_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->uuid('user_id');
            $table->uuid('topic_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate("CASCADE")->onDelete("CASCADE");
            $table->foreign('topic_id')->references('id')->on('topics')->onUpdate("CASCADE")->onDelete("CASCADE");
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
        Schema::dropIfExists('posts');
    }
};
