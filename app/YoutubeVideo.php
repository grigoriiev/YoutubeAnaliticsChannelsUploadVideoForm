<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class YoutubeVideo extends Model
{

    protected $table = 'youtube_videos';

    protected $guarded=[];

    public function youtubeChannel()
    {
        return $this->belongsTo(YoutubeChannel::class);
    }


}
