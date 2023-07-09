<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\ActivateAndDeactivateUserRequest;
use App\Http\Requests\user\ActivateUserRequest;
use App\Http\Requests\user\DeactivateUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

public function getCurrentUser(){
    return apiResponse(auth()->user());
    // $currrentUser = User::where('id', auth()->user()->id)->first();
    // return apiResponse($currrentUser);

}


    public function saveUserData(CreateUserRequest $request)
    {
        //$this->authorize('isAdmin');
        return $request->createUser($request);
    }

    public function getUserData()
    {
        // $currrentUser = User::where('id', auth()->user()->id)->first();
        // return apiResponse(auth()->user());
        //$this->authorize('isAdmin');
        $users = User::latest()->paginate(5);
        return apiResponse($users);
    }

    public function deleteUserData(DeleteUserRequest $request)
    {
         return $request->deleteUser($request);
    }


    public function activateAndDeactivateUserData(ActivateAndDeactivateUserRequest $request)
    {
         return $request->activateAndDeactivateUser($request);
    }

    public function updateUserData(UpdateUserRequest $request)
    {
         return $request->updateeUser($request);
    }



    public function download(Request $request)
    {
        $filePath = Storage::disk('public')->get($request->fileName);
        if(explode(".",$request->fileName)[1] == "xlsx"){
            return (new Response($filePath, 200))->header('Content-Type', 'application/vnd.ms-excel');
        }

		return (new Response($filePath, 200))->header('Content-Type', 'image/jpeg');
    }


}
