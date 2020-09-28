<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_channels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->string('publishedAt');
            $table->integer('viewCount');
            $table->integer('commentCount');
            $table->integer('subscriberCount');
            $table->integer('hiddenSubscriberCount');
            $table->integer('videoCount');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();

            DB::statement('ALTER TABLE youtube_channels ADD FULLTEXT search(title)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   Schema::table('youtube_channels',function (Blueprint $table){
        $table->dropForeign('youtube_channels_user_id_foreign');
    });
        Schema::dropIfExists('youtube_channels');
    }
}
