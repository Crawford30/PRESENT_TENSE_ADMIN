<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\VideoDVD;
use App\VideoDVDView;
use Illuminate\Http\Request;
use App\UserVideoDVDPermission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\VideoDVDRequest\SaveVideoDVDRequest;
use App\Http\Requests\VideoDVDRequest\DeleteVideoDVDRequest;
use App\Http\Requests\VideoDVDRequest\GetUserVideoDVDListRequest;

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




    public function getAllDVDVideos(){
        $videos = VideoDVD::orderByDesc("created_at")->withCount("views")->get();
        return apiResponse($videos);
    }

    public function getDVDList(GetUserVideoDVDListRequest $request ){
        return $request->getUserVideoDVDList();
    }



    public function deleteVideoDVD(DeleteVideoDVDRequest $request)
    {
        return $request->deleteVideo();
    }








}
