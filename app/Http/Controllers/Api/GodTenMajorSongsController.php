<?php

namespace App\Http\Controllers\Api;

use App\GodTenMajorSongs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GodTenMajorRequest\DeleteGodTenMajorSongsRequest;
use App\Http\Requests\GodTenMajorRequest\ImportGodTenMajorSongsRequest;
use App\Http\Requests\GodTenMajorRequest\SaveGodTenMajorSongsRequest;

class GodTenMajorSongsController extends Controller
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


    public function getAllGodMajorSongs()
    {
        $allGodTenMajorSongs =     GodTenMajorSongs::all();
        return apiResponse($allGodTenMajorSongs);
    }


    public function importGodTenMajorTemplate(ImportGodTenMajorSongsRequest $request)
    {
        return $request->importTemplate();
    }



    public function saveTenMajorSong(SaveGodTenMajorSongsRequest  $request)
    {
        return $request->saveSong($request);
    }

    public function deleteTenMajorSong(DeleteGodTenMajorSongsRequest $request)
    {
        return $request->delete();
    }


}
