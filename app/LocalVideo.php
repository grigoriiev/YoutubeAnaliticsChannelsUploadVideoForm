<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalVideo extends Model
{
    //
    protected $table = 'local_videos';

    protected $guarded=[];


    public function user(){

        return $this->belongsTo(User::class);
    }
}
