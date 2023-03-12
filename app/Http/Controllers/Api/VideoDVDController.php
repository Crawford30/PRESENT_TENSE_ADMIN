<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoDVDRequest\SaveVideoDVDRequest;
use App\VideoDVD;

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
        $videos = VideoDVD::orderBy("id")->withCount("views")->get();
        return apiResponse($videos);
    }


}
