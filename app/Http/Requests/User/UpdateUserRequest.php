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

        $rules = [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
        ];

        // Add the password rule only when it is provided in the request
        if ($request->filled('password')) {
            $rules['password'] = 'sometimes|min:6';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'user_status' =>  $request->user_status,
            'dvd_access_status' => $request->dvd_access_status,
            'audio_dvd_permission' => $request->audio_dvd_permission,
            'video_dvd_permission' => $request->video_dvd_permission,
        ];

        // Update the password only when it is provided in the request
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $userData = User::updateOrCreate(['id' => $request->id], $data);

        return apiResponse($userData);

    }
}
