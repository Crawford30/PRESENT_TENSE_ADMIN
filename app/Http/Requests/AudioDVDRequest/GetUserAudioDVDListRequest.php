<?php

namespace App\Http\Requests\AudioDVDRequest;

use App\User;
use App\UserAudioDVDPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class GetUserAudioDVDListRequest extends FormRequest
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


    public function getAudioDVDList() {
        $user = User::where('id', auth()->user()->id)
        ->where('user_status', 'ACTIVATED')
        ->where(function ($query) {
            $query->where('dvd_access_status', 'AUDIO_DVD')
                ->orWhere('dvd_access_status', 'ALL_DVD');
        })
        ->whereNotNull('audio_dvd_permission')
        ->where(function ($query) {
            $query->where('type', 'user')
                ->orWhere('type', 'admin');
        })
        ->first();



            if ($user) {
                $userAudioLists = UserAudioDVDPermission::where(function ($query) use ($user) {
                        $query->where("permission", $user->audio_dvd_permission)
                            ->orWhereNull("permission");
                    })
                    ->whereNotNull('audio_d_v_d_id')
                    ->pluck('audio_d_v_d_id')
                    ->toArray();

                $itemCollection = DB::table('audio_d_v_d_s')
                    ->whereIn('id', $userAudioLists)
                    ->get();

                     return apiResponse($itemCollection);
            } else {
                return apiResponse("No data found");

            }

    }
}
