<?php

namespace App\Http\Controllers\Api;

use App\AudioDVD;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AudioDVDRequest\DeleteAudioDVDRequest;
use App\Http\Requests\AudioDVDRequest\SaveAudioDVDRequest;

class AudioDVDController extends Controller
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


    public function saveAudioDVD(SaveAudioDVDRequest $request){
        return $request->save();
    }


    //video_d_v_d_id

    public function getAllDVDAudios(){
        $videos = AudioDVD::orderByDesc("created_at")->withCount("views")->get();
        return apiResponse($videos);
    }


    public function deleteAudioDVD(DeleteAudioDVDRequest $request)
    {
        return $request->deleteVideo();
    }


}