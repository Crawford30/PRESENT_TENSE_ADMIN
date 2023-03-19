<?php

namespace App\Http\Requests\User;

use App\UserVideoDVDPermission;
use App\VideoDVD;
use Illuminate\Foundation\Http\FormRequest;

class CreateVideoDVDPermissionRequest extends FormRequest
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
            "permissions" => "required" //array
        ];
    }



    public function save()
    {

        UserVideoDVDPermission::truncate();

        foreach ($this->permissions as $key => $permission) {

            $audioDVD = VideoDVD::find($key);

            if($audioDVD != NULL) {
                    foreach($permission as $perm) {
                        UserVideoDVDPermission::create([
                            "video_d_v_d_id" => $key,
                            "permission" => $perm
                        ]);
                    }
            }
        }
    }
}
