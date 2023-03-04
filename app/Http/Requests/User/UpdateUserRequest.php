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



        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "bio" => $request->bio,
            "photo" => $request->photo,
            "type" => $request->type,
            "password" => Hash::make($request->password),
        ];


        $user->update($request->all());

        return apiResponse($user);


    }
}