<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VariousTonguesRequest\DeleteVariousTonguesSongsRequest;
use App\Http\Requests\VariousTonguesRequest\ImportVariousTonguesSongsRequest;
use App\Http\Requests\VariousTonguesRequest\SaveVariousTonguesSongsRequest;
use App\SongsInVariousTongues;

class VariousTonguesSongsController extends Controller
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


    public function getAllSongsInVariousTonguesSongs()
    {
        $allSongsInVariousTongues =     SongsInVariousTongues::all();
        return apiResponse($allSongsInVariousTongues);
    }



    public function importSongsInVariousTonguesTemplate(ImportVariousTonguesSongsRequest $request)
    {
        return $request->importTemplate();
    }



    public function saveSongsInVariousTonguesSong(SaveVariousTonguesSongsRequest  $request)
    {
        return $request->saveSong($request);
    }

    public function deleteSongsInVariousTonguesSong(DeleteVariousTonguesSongsRequest $request)
    {
        return $request->delete();
    }
}
