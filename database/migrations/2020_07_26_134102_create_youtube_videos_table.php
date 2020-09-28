<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('channel_Id');
            $table->string('youtube_channel_Id');
            $table->string('description');
            $table->string('publishedAt');
            $table->string('title');
            $table->integer('categoryId');
            $table->string('privacyStatus');
            $table->integer('publicStatsViewable');
            $table->integer('viewCount');
            $table->integer('likeCount');
            $table->integer('dislikeCount');
            $table->integer('favoriteCount');
            $table->integer('commentCount');

            $table->foreign('channel_Id')
                ->references('id')
                ->on('youtube_channels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();

            DB::statement('ALTER TABLE youtube_videos ADD FULLTEXT search(title)');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {     Schema::table('youtube_videos',function (Blueprint $table){
        $table->dropForeign('youtube_videos_channel_Id_foreign');
    });
        Schema::dropIfExists('youtube_videos');
    }
}
