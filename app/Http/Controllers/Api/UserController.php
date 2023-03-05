<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\user\ActivateAndDeactivateUserRequest;
use App\Http\Requests\user\ActivateUserRequest;
use App\Http\Requests\user\DeactivateUserRequest;

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




    public function saveUserData(CreateUserRequest $request)
    {
        //$this->authorize('isAdmin');
        return $request->createUser($request);
    }

    public function getUserData()
    {
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



    // public function findUserData()
    // {
    //     if ($search = \Request::get('q')) {
    //         $users = User::where(function($query) use ($search){
    //             $query->where('name','LIKE',"%$search%")
    //                     ->orWhere('email','LIKE',"%$search%");
    //         })->paginate(20);
    //     }else{
    //         $users = User::latest()->paginate(5);
    //     }

    //     return apiResponse($users);
    // }


}
