<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\AudioDVD;
use Illuminate\Http\Request;
use App\UserAudioDVDPermission;

use App\UserVideoDVDPermission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AudioDVDRequest\SaveAudioDVDRequest;
use App\Http\Requests\AudioDVDRequest\DeleteAudioDVDRequest;
use App\Http\Requests\AudioDVDRequest\GetUserAudioDVDListRequest;

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




    public function getAllDVDAudios(){
        $videos = AudioDVD::orderByDesc("created_at")->withCount("views")->get();
        return apiResponse($videos);
    }


    public function getAudioDVDList(GetUserAudioDVDListRequest $request ){
        return $request->getAudioDVDList();
    }



    public function deleteAudioDVD(DeleteAudioDVDRequest $request)
    {
        return $request->deleteAudio();
    }


}