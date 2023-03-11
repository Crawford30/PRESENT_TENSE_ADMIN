<?php

namespace App\Http\Controllers\Api;

use App\GodTenMajorSongs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GodTenMajorRequest\ImportGodTenMajorSongsRequest;

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


}
