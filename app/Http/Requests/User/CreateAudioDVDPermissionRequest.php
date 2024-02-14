<?php

namespace App\Http\Requests\User;

use App\User;
use App\AudioDVD;
use App\UserAudioDVDPermission;
use Illuminate\Foundation\Http\FormRequest;

class CreateAudioDVDPermissionRequest extends FormRequest
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
            "permissions" => "sometimes|array",
        ];
    }


    public function save()
    {

        UserAudioDVDPermission::truncate();

         // Check if $this->permissions is an array
    if (!is_null($this->permissions) && is_array($this->permissions)) {
        foreach ($this->permissions as $key => $permission) {

            $audioDVD = AudioDVD::find($key);

            if($audioDVD != NULL) {
                foreach($permission as $perm) {
                    UserAudioDVDPermission::create([
                        "audio_d_v_d_id" => $key,
                        "permission" => $perm
                    ]);
                }
            }
        }
    }

        // foreach ($this->permissions as $key => $permission) {

        //     $audioDVD = AudioDVD::find($key);

        //     if($audioDVD != NULL) {
        //             foreach($permission as $perm) {
        //                 UserAudioDVDPermission::create([
        //                     "audio_d_v_d_id" => $key,
        //                     "permission" => $perm
        //                 ]);
        //             }
        //     }
        // }
    }
}
