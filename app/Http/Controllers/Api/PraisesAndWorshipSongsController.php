<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PraisesAndWorshipRequest\DeletePraisesAndWorshipSongsRequest;
use App\Http\Requests\PraisesAndWorshipRequest\ImportPraisesAndWorshipSongsRequest;
use App\Http\Requests\PraisesAndWorshipRequest\SavePraisesAndWorshipSongsRequest;
use App\PraisesAndWorshipSongs;

class PraisesAndWorshipSongsController extends Controller
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


    public function getAllPraisesAndWhorshipSongs()
    {
        $allPraisesAndWhorshipSongs =     PraisesAndWorshipSongs::all();
        return apiResponse($allPraisesAndWhorshipSongs);
    }



    public function importPraisesAndWorshipTemplate(ImportPraisesAndWorshipSongsRequest $request)
    {
        return $request->importTemplate();
    }



    public function savePraisesAndWorshipSong(SavePraisesAndWorshipSongsRequest  $request)
    {
        return $request->saveSong($request);
    }

    public function deletePraisesAndWorshipSong(DeletePraisesAndWorshipSongsRequest $request)
    {
        return $request->delete();
    }




}
