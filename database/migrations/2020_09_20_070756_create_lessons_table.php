<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('season_id')->nullable()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_free')->default(false);
            $table->longText('body')->nullable();
            $table->tinyInteger('time')->unsigned()->nullable();
            $table->integer('number')->unsigned()->nullable();
            $table->enum('confirmation_status', \Cyaxaress\Course\Models\Lesson::$confirmationStatuses)
                ->default(\Cyaxaress\Course\Models\Lesson::CONFIRMATION_STATUS_PENDING);
            $table->enum('status', \Cyaxaress\Course\Models\Lesson::$statuses)
                ->default(\Cyaxaress\Course\Models\Lesson::STATUS_OPENED);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
