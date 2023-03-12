<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PresentTenseRequest\DeletePresentTenseSongsRequest;
use App\Http\Requests\PresentTenseRequest\ImportPresentTenseSongsRequest;
use App\Http\Requests\PresentTenseRequest\SavePresentTenseSongsRequest;
use App\PresentTenseSongs;

class PresentTenseSongsController extends Controller
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


    public function getAllPresentTenseSongs()
    {
        $allPresentTenseSongs =     PresentTenseSongs::all();
        return apiResponse($allPresentTenseSongs);
    }



    public function importPresentTenseTemplate(ImportPresentTenseSongsRequest $request)
    {
        return $request->importTemplate();
    }



    public function savePresentTenseSong(SavePresentTenseSongsRequest  $request)
    {
        return $request->saveSong($request);
    }

    public function deletePresentTenseSong(DeletePresentTenseSongsRequest $request)
    {
        return $request->delete();
    }



}
