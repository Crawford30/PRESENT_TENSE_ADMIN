<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function downloadSongTemplate(Request $request)
    {
        $format = now()->format("Ymd");
        $public_path = public_path("templates/song_template.xlsx");
        $fileName = "Templates.Song.$format.xlsx";
        return response()->download($public_path, $fileName);
    }



    public function downloadFile(Request $request)
    {
        return response()->download(storage_path("/app/public/{$request->file_path}"));
    }

}
