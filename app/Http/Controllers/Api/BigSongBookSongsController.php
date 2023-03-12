<?php

namespace App\Http\Controllers\Api;

use App\BigSongBookSongs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BigSongBookRequest\DeleteBigSongBookSongsRequest;
use App\Http\Requests\BigSongBookRequest\ImportBigSongBookSongsRequest;
use App\Http\Requests\BigSongBookRequest\SaveBigSongBookSongsRequest;

class BigSongBookSongsController extends Controller
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


    public function getAllBigSongBookSongs()
    {
        $allBigSongBookSong =     BigSongBookSongs::all();
        return apiResponse($allBigSongBookSong);
    }



    public function importBigSongBookTemplate(ImportBigSongBookSongsRequest $request)
    {
        return $request->importTemplate();
    }



    public function saveBigSongBookSong(SaveBigSongBookSongsRequest  $request)
    {
        return $request->saveSong($request);
    }

    public function deleteBigSongBookSong(DeleteBigSongBookSongsRequest $request)
    {
        return $request->delete();
    }


}
