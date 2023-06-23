<?php

namespace App\Http\Requests\VideoDVDRequest;

use App\User;
use App\UserVideoDVDPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class GetUserVideoDVDListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }


    public function getUserVideoDVDList() {


     $user = User::where('id', auth()->user()->id)
    ->where('user_status', 'ACTIVATED')
    ->where('dvd_access_status', 'VIDEO_DVD')
    ->orWhere('dvd_access_status', 'ALL_DVD')
    ->whereNotNull('video_dvd_permission')
    ->where(function ($query) {
        $query->where('type', 'user')
            ->orWhere('type', 'admin');
    })
    ->first();

if ($user) {
    $userVideoLists = UserVideoDVDPermission::where("permission", $user->video_dvd_permission)
        ->pluck('video_d_v_d_id')
        ->toArray();

    $itemCollection = DB::table('video_d_v_d_s')
        ->whereIn('id', $userVideoLists)
        ->get();

    return apiResponse($itemCollection);
} else {

    return apiResponse("No video found");
    // Handle the case when $user is null
    // You can set appropriate default values or throw an exception
}


        // $user =   User::where('id',auth()->user()->id)
        // ->where('user_status', 'ACTIVATED')
        // ->where('dvd_access_status', 'VIDEO_DVD')
        // ->orWhere('dvd_access_status','ALL')
        // ->whereNotNull('video_dvd_permission')
        // ->where('type', 'user')
        // ->orWhere('type', 'admin')->first();


        // $userAudioLists = UserVideoDVDPermission::where("permission", $user->video_dvd_permission)->pluck('video_d_v_d_id')->toArray();
        // $itemCollection = DB::table('video_d_v_d_s')
        // ->whereIn('id', $userAudioLists)
        // ->get();


        // return apiResponse($itemCollection);
    }

}
