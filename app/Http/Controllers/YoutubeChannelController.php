<?php

namespace App\Http\Controllers;




use Alaouy\Youtube\Youtube;

use App\YoutubeChannel;

use App\YoutubeVideo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Class YoutubeChannelController
 * @package App\Http\Controllers
 */
class YoutubeChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public $videosId=[];

    /**
     * YoutubeChannelController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Youtube|bool
     */
    private function getYoutube(){

        try {

            return new Youtube(config('youtube.key'));

        } catch (Exception $e) {

            abort(403);

            return false;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {


        $YoutubeChannels=YoutubeChannel::all();

        return view('youtube.index',compact('YoutubeChannels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
       if (!Gate::allows('create-youtubeChannel')) {
            return view('youtube.index');
        }
        return view('youtube.create');
    }

    /**
     * @param $youtubeDataChannel
     * @return mixed
     */
    public function storeYoutubeChannel($youtubeDataChannel ){

        return YoutubeChannel::create([
            'title' => (string)$youtubeDataChannel->snippet->title,
            'description' => (string)$youtubeDataChannel->snippet->description,
            'publishedAt' => (string)$youtubeDataChannel->snippet->publishedAt,
            'viewCount' => (isset($youtubeDataChannel->statistics->viewCount) ? (integer)$youtubeDataChannel->statistics->viewCount:0),
            'commentCount' =>(isset($youtubeDataChannel->statistics->commentCount) ? (integer)$youtubeDataChannel->statistics->commentCount:0),
            'subscriberCount' =>(isset($youtubeDataChannel->statistics->subscriberCount) ? (integer)$youtubeDataChannel->statistics->subscriberCount :0),
            'hiddenSubscriberCount' => (isset($youtubeDataChannel->statistics->hiddenSubscriberCount) ? (integer)$youtubeDataChannel->statistics->hiddenSubscriberCount:0),
            'videoCount' => ( isset($youtubeDataChannel->statistics->videoCount) ? (integer)$youtubeDataChannel->statistics->videoCount: 0),
            'user_id' => (integer)Auth::user()->id,
        ]);
    }

    /**
     * @param $storeYoutubeChannel
     * @param $video
     * @return mixed
     */
    public function storeVideoChannel($storeYoutubeChannel, $video){

       return $youtubeVideo = YoutubeVideo::create([
                'channel_Id' => (integer)$storeYoutubeChannel->id,
                'youtube_channel_id' => (string)$video->snippet->channelId,
                'description' => (string)$video->snippet->description,
                'publishedAt' => (string)$video->snippet->publishedAt,
                'title' => (string)$video->snippet->title,
                'categoryId' => (integer)$video->snippet->categoryId,
                'privacyStatus' => (string)$video->status->privacyStatus,
                'publicStatsViewable' => (integer)$video->status->publicStatsViewable,
                'viewCount' => (isset($video->statistics->viewCount) ? (integer)$video->statistics->viewCount:0),
                'likeCount' => (isset($video->statistics->likeCount) ? (integer)$video->statistics->likeCount :0),
                'dislikeCount' => (isset($video->statistics->dislikeCount) ? (integer)$video->statistics->dislikeCount : 0),
                'favoriteCount' => (isset($video->statistics->favoriteCount) ? (integer)$video->statistics->favoriteCount: 0),
                'commentCount' => (isset($video->statistics->commentCount) ? (integer)$video->statistics->commentCount: 0)
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function store(Request $request)
    {
        if (!Gate::allows('store-youtubeChannel')) {
            return  redirect()->back();
        }else {
            $request->validate([
                'channel_Id' => 'required|unique:youtube_videos|string|max:255',
                'check' => 'required|string'
            ]);
            try {

            $Youtube = $this->getYoutube();

            $youtubeDataChannel = $Youtube->getChannelById(trim($request->channel_Id));

            $storeYoutubeChannel = $this->storeYoutubeChannel($youtubeDataChannel);

            $youtubeListChannelVideos = $Youtube->listChannelVideos(trim($request->channel_Id), 10000);

            foreach ($youtubeListChannelVideos as $key => $value) {

                array_push($this->videosId, $value->id->videoId);

            }
            foreach ($this->videosId as $key => $value) {

                $video = $Youtube->getVideoInfo($value);

                $this->storeVideoChannel($storeYoutubeChannel, $video);

            }
            }catch (Exception $exception){
                abort(403,$exception->getMessage());
            }
            return redirect('/youtube/create')->with('store', 'Your youtube channel has been successfully store');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\YoutubeChannel $youtubeChannel
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws Exception
     */
    public function destroy(YoutubeChannel $youtubeChannel)
    {
        if (!Gate::allows('destroy-youtubeChannel')) {
            return  redirect()->back();
        }else {
            $youtubeChannel->delete();

        }
        return redirect('/youtube')->with('delete', 'Your channel has been successfully delete');
    }
}
