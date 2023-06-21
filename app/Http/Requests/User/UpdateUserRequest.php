<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
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

        ];
    }


    public function updateeUser($request){


        $user = User::findOrFail($request->id);

       // dd($user);


        // $this->Validator::make($request, [
        //     "name" => "required|string|max:191",
        //     "email" => 'required|string|email|max:191|unique:users,email,'.$user->id,
        //     "password" => "sometimes|min:6",
        // ]);


        $request->validate([
        "name" => "required|string|max:191",
        "email" => 'required|string|email|max:191|unique:users,email,'.$user->id,
        "password" => "sometimes|min:6"]);



        // name: "",
        // email: "",
        // songPermission: "",
        // audioDVDPermission: "",
        // videoDVDPermission: "",
        // password: "",
        // type: "",

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "type" => $request->type,
            "user_status" => $request->user_status,
            "dvd_access_status" => $request->dvd_access_status,
            "audio_dvd_permission" => $request->audio_dvd_permission,
            "video_dvd_permission" => $request->video_dvd_permission,
            "password" => Hash::make($request->password),

        ];


        $userData = user::updateOrCreate([
            'id' => $request->id], $data);
          return apiResponse($userData);

        // $user->update($request->all());

        // return apiResponse($user);


    }
}
