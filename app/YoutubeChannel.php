<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class YoutubeChannel extends Model
{

    //
    protected $table = 'youtube_channels';

    protected $guarded=[];


    public function youtubeVideos()
    {
        return $this->hasMany(YoutubeVideo::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }


}
