<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoDVDRequest\DeleteVideoDVDRequest;
use App\Http\Requests\VideoDVDRequest\SaveVideoDVDRequest;
use App\VideoDVD;
use App\VideoDVDView;

class VideoDVDController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function saveVideoDVD(SaveVideoDVDRequest $request){
        return $request->save();
    }


    //video_d_v_d_id

    public function getAllDVDVideos(){
        $videos = VideoDVD::orderByDesc("created_at")->withCount("views")->get();
        return apiResponse($videos);
    }


    public function deleteVideoDVD(DeleteVideoDVDRequest $request)
    {
        return $request->deleteVideo();
    }




    // public function saveVideoView(){
    //     $view=  VideoDVDView::create([
    //           "video_id"=> request("video_id"),
    //           "user_id"=> auth()->user()->id
    //       ]);
    //       return apiResponse($view);
    //   }




}