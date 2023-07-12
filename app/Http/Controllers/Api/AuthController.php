<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\RefreshToken;
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
            'message' => 'Wrong Credentials'
        ], 401);

        }else{

            return response()->json([
                        'message' => 'Wrong Credentials'
                    ], 401);

        }


    }



    public function register(Request $request)
    {

        $userName = Str::of($request->email)
        ->before('@')
        ->replaceMatches('/[0-9]+/', '')
        ->headline();

        $user =   User::create([
            'name' => $request->name== null ?  $userName :  $request->name,
            'email' => $request->email,
            'password' => Hash::make( $request->password),
        ]);


        $token = $user->createToken('API Token')->accessToken;

        return apiResponse([ 'user' => $user, 'token' => $token]);


    }


    public function logout(Request $request)
    {
        $user = Auth::logout();
      return apiResponse("Successfully logged out");

    }





    private function proceedToLogin($user)
    {
        try {
            Auth::login($user);


           // $token = $user->createToken('API Token')->accessToken;

            // return response(['user' => auth()->user(), 'token' => $token]);

            $tokenResult = $user->createToken('API Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            return response()->json([
                'message' => "API_MESSAGE_PASS",
                'user' => auth()->user(),
                'token' => $tokenResult->accessToken,
                // 'token' => encrypt($user->id),
                // 'access_token' => $tokenResult->accessToken,
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
