<?php

namespace App\Http\Controllers;

use App\YoutubeChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class YoutubeStatisticsController
 * @package App\Http\Controllers
 */
class YoutubeStatisticsController extends Controller
{
    /**
     * YoutubeStatisticsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

    }



    /**
     * @param YoutubeChannel $youtubeChannel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function  likesDislikesChannelStatistics (YoutubeChannel $youtubeChannel){

        $likesDislikeStatistics = DB::table('youtube_channels')
            ->select(DB::raw('sum(youtube_videos.likeCount) as youtubeChannelsSumLikeVideos, sum(youtube_videos.dislikeCount) as youtubeChannelsSumDislikeVideos, youtube_channels.id as channelID,  youtube_channels.title  as channelTitle'))
            ->join('youtube_videos', 'youtube_channels.id', '=', 'youtube_videos.channel_id')
            ->where('youtube_videos.channel_Id', '=', $youtubeChannel->id)
            ->groupBy('youtube_videos.youtube_channel_id')
            ->get();

            return view('youtube.statistics.channel',compact('likesDislikeStatistics'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function topNChannelsStatistics(){

        $topNlDiffLikesStatistics = DB::table('youtube_videos')
            ->select(DB::raw('sum(youtube_videos.likeCount) - sum(youtube_videos.dislikeCount) as youtubeChannelsDiffSumLikeDislikeVideos, youtube_channels.id as channelsID,  youtube_channels.title  as channelsTitle'))
            ->join('youtube_channels', 'youtube_channels.id', '=', 'youtube_videos.channel_id')
            ->where('youtube_channels.user_id', '=', Auth::user()->id)
            ->groupBy('youtube_videos.youtube_channel_Id')
            ->orderBy('youtubeChannelsDiffSumLikeDislikeVideos', 'DESC')
            ->get();

            return view('youtube.statistics.topN',compact('topNlDiffLikesStatistics'));



    }

}
