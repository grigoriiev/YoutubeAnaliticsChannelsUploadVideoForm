<?php

namespace App\Http\Controllers;

use App\LocalVideo;
use Dawson\Youtube\Facades\Youtube;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * Class YoutubeUploadVideoController
 * @package App\Http\Controllers
 */
class YoutubeUploadVideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $LocalVideos=  LocalVideo::all();

        return view('youtube.upload.index',compact('LocalVideos'));
    }

    /**
     * @param LocalVideo $localVideo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LocalVideo $localVideo){

        return view('youtube.upload.edit',compact('localVideo') );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

        $localVideo= new LocalVideo();

        return view('youtube.upload.create',compact('localVideo') );
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video'=>'required|file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            'image'=>'required|image|mimes:jpeg,bmp,png',
            'title'=>'required|unique:local_videos|string',
            'description'=>'required|unique:local_videos|string',
            'tag_1'=>'required|string',
            'tag_2'=>'required|string',
            'tag_3'=>'required|string',
            'category_id'=>'required|integer',
            'check'=>'required|string'
        ]);


     try {

            $fullPathToVideo = $request->file('video')->store('uploads/video', 'public');

            $imagePath = $request->file('image')->store('uploads/realImage', 'public');

            $imagePathResize = $request->file('image')->store('uploads/resizeImage', 'public');

            $fullPathToImageResize = Image::make(public_path("storage/{$imagePathResize}"))->resize(50, 50);

            $fullPathToImageResize->save();

            $tags = [$request->input('tag_1'), $request->input('tag_2'), $request->input('tag_3')];

            $tagsSerialize = serialize($tags);

            $video = Youtube::upload('storage/' . $fullPathToVideo, [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'tags' => $tags,
              'category_id' => (string)$request->input('category_id')
            ])->withThumbnail('storage/' . $imagePathResize);

            $localVideo = auth()->user()->localVideos()->create([
                'fullPathToImage' => $imagePath,
                'fullPathToVideo' => $fullPathToVideo,
                'fullPathToImageResize' => $imagePathResize,
                'video_id' => $video->getVideoId(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'tags' => $tagsSerialize,
                'category_id' => (string)$request->input('category_id'),
            ]);

      }catch (Exception $exception){
        abort(403,$exception->getMessage());
    }
        return redirect('/youtube/upload')->with('store', 'Your channel has been successfully store');
    }

    /**
     * @param Request $request
     * @param LocalVideo $localVideo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function  updatingVideo(Request $request, LocalVideo $localVideo)
    {

        $request->validate([
            'video'=>'required|file|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            'image'=>'required|image|mimes:jpeg,bmp,png',
            'title'=>'required|unique:local_videos|string',
            'description'=>'required|unique:local_videos|string',
            'tag_1'=>'required|string',
            'tag_2'=>'required|string',
            'tag_3'=>'required|string',
            'category_id'=>'required|integer',
            'check'=>'required|string'
        ]);

        try {

            unlink('storage/' . $localVideo->fullPathToImage);

            unlink('storage/' . $localVideo->fullPathToImageResize);

            unlink('storage/' . $localVideo->fullPathToVideo);

            $fullPathToVideo = $request->file('video')->store('uploads/video', 'public');

            $imagePath = $request->file('image')->store('uploads/realImage', 'public');

            $imagePathResize = $request->file('image')->store('uploads/resizeImage', 'public');

            $fullPathToImageResize = Image::make(public_path("storage/{$imagePathResize}"))->resize(50, 50);

            $fullPathToImageResize->save();

            $tags = [$request->input('tag_1'), $request->input('tag_2'), $request->input('tag_3')];

            $tagsSerialize = serialize($tags);

            $video = Youtube::update('storage/'.$localVideo->video_id, [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'tags' => $tags,
                'category_id' => (string)$request->input('category_id')
            ])->withThumbnail('storage/' . $imagePathResize);

            $localVideo = $localVideo->update([
                'fullPathToImage' => $fullPathToVideo,
                'fullPathToVideo' => $imagePath,
                'fullPathToImageResize' => $imagePathResize,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'tags' => $tagsSerialize,
                'category_id' => (string)$request->input('category_id'),
            ]);
        }catch (Exception $exception){
            abort(403,$exception->getMessage());
        }
        return redirect('/youtube/upload')->with('update', 'Your channel has been successfully update');
    }

    /**
     * @param LocalVideo $localVideo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws Exception
     */
    public function   destroy(LocalVideo $localVideo){

        try {

            unlink('storage/' . $localVideo->fullPathToImage);

            unlink('storage/' . $localVideo->fullPathToImageResize);

            unlink('storage/' . $localVideo->fullPathToVideo);

           

            $localVideo->delete();
        }catch (Exception $exception){

            abort(403,$exception->getMessage());
        }

        return redirect('/youtube/upload')->with('delete', 'Your channel has been successfully delete');
    }


}
