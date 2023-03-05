<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{


    public function __construct()
    {

        // $this->authorize('isAdmin');
        // $this->middleware('auth:api');
    }


    public function saveUserData(CreateUserRequest $request)
    {
        return $request->createUser($request);
    }

    public function getUserData()
    {
        //$this->authorize('isAdmin');
        $users = User::latest()->paginate(10);
        return apiResponse($users);
    }

    public function deleteUserData(DeleteUserRequest $request)
    {
        $this->authorize('isAdmin');
        //dd($request);
         return $request->delete($request);
    }

    public function updateUserData(UpdateUserRequest $request)
    {
        //dd($request);
         return $request->updateeUser($request);
    }



    public function findUserData()
    {
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                        ->orWhere('email','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = User::latest()->paginate(5);
        }

        return apiResponse($users);
    }





}
