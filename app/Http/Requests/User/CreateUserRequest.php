<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            "name" => "required|string|max:191",
            "email" => "required|string|email|max:191|unique:users",
            "password" => "required|string|min:6",
        ];
    }


    public function createUser($request){

        //dd($this->$request);

        // return $request->all;

        // User::create([
        //     'name' =>

        // ])

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "type" => $request->type,
            "password" => Hash::make($request->password),
        ];


        if($this->has($request->id)) {
            $user = User::updateOrCreate(["id" =>  $request->id, "email" =>  $request->email], $data);
            // FormTimeline::create([
            //     'form_id' => $form->id,
            //     'user_id' => auth()->user()->id,
            //     'title' => 'Updated a new form, ' . $form->form_name,
            //     'icon' => 'fas fa-pen',
            //     'color' => randomColor(),
            //     'timeline_by' => auth()->user()->name
            // ]);
            $token = $user->createToken('API Token')->accessToken;

            return apiResponse([ 'user' => $user, 'token' => $token]);

        } else {
            $user = User::create($data);

            $user->update([
                "api_token" => Str::random(60) . $user->id,
            ]);

            $token = $user->createToken('API Token')->accessToken;
            // FormTimeline::create([
            //     'form_id' => $form->id,
            //     'user_id' => auth()->user()->id,
            //     'title' => 'Created a new form, ' . $form->form_name,
            //     'icon' => 'fas fa-plus',
            //     'color' => randomColor(),
            //     'timeline_by' => auth()->user()->name
            // ]);
        }




        return apiResponse([ 'user' => $user, 'token' => $token]);





        // return apiResponse($user);

       // return ['message' => "I have your data"];


    }

}
