<?php

namespace App\Http\Controllers;

use App\User;
use App\AudioDVD;
use Illuminate\Http\Request;
use App\UserAudioDVDPermission;
use Illuminate\Support\Facades\DB;

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


        $user =   User::where('id',auth()->user()->id)
        ->where('user_status', 'ACTIVATED')
        ->where('dvd_access_status', 'AUDIO_DVD')
        ->orWhere('dvd_access_status','ALL')
        ->whereNotNull('audio_dvd_permission')
        ->where('type', 'user')
        ->orWhere('type', 'admin')->first();


        $userAudioLists = UserAudioDVDPermission::where("permission", $user->audio_dvd_permission)->pluck('audio_d_v_d_id')->toArray();
        $itemCollection = DB::table('audio_d_v_d_s')
        ->whereIn('id', $userAudioLists)
        ->get();


        // $user = User::where("id", auth()->user()->id)->first();

       // dd(  $user);

        // if($user->user_status == "ACTIVATED" && $user->dvd_access_status == "AUDIO_DVD" && $user->audio_dvd_permission != NULL){
        //     $userAudioLists = UserAudioDVDPermission::where("permission", $user->audio_dvd_permission)->pluck('audio_d_v_d_id')->toArray();
        //     $itemCollection = DB::table('audio_d_v_d_s')
        //     ->whereIn('id', $userAudioLists)
        //     ->get();
        // }

       // dd($itemCollection);

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