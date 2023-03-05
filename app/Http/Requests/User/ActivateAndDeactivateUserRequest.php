<?php

namespace App\Http\Requests\user;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ActivateAndDeactivateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
        // if(auth()->user()->type == 'admin'){
        //     return true;
        // } else{
        //     return false;

        // }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_id" => "required",
            "user_status" => "required",
        ];
    }

    public function activateAndDeactivateUser()
    {
        //dd($this->all());
         $user = User::findOrFail($this->user_id);
         if($this->user_status == 1){
            $user->user_status = 'ACTIVATED';
         }else{
            $user->user_status = 'DEACTIVATED';
         }
         $user->save();

        return apiResponse($user, 200);

    }

}
