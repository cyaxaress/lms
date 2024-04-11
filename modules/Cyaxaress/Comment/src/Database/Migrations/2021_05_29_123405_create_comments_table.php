<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('comment_id')->nullable();
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type', 50);
            $table->text('body');
            $table->enum('status', \Cyaxaress\Comment\Models\Comment::$statues)
                ->default(\Cyaxaress\Comment\Models\Comment::STATUS_NEW);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
