<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullPathToImage');
            $table->string('fullPathToImageResize');
            $table->string('fullPathToVideo');
            $table->string('video_id');
            $table->string('title');
            $table->string('description');
            $table->string('tags');
            $table->integer('category_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::table('local_videos',function (Blueprint $table){
            $table->dropForeign('local_videos_user_id_foreign');
        });
        Schema::dropIfExists('local_videos');
    }
}
