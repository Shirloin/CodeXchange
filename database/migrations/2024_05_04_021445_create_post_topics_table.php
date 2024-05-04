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
        Schema::create('post_topics', function (Blueprint $table) {
            $table->uuid('post_id', 36);
            $table->uuid('topic_id', 36);
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('topic_id')->references('id')->on('topics')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->primary(['post_id', 'topic_id']);
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
        Schema::dropIfExists('post_topics');
    }
};
