<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where("email", $request->email)->first();

        if($user){

        if(Hash::check($request->password, $user->password)) {
            return $this->proceedToLogin($user);
        }

        return response()->json([
            'message' => 'WrongCredentials'
        ], 401);

        }else{

            return response()->json([
                        'message' => 'WrongCredentials'
                    ], 401);

        }


    }



    private function proceedToLogin($user)
    {
        try {
            Auth::login($user);

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            return response()->json([
                'message' => "API_MESSAGE_PASS",
                'user' => auth()->user(),
                'token' => encrypt($user->id),
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

}