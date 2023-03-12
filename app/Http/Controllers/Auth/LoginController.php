<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;





class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     /**
     * Show the application's login form.
     *
     * @
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {


        $this->validateLogin($request);

        $user = $this->attemptManualLogin($request);

        if ($user) {

            if ($user->user_status == User::STATUS_DISABLED || $user->user_status == User::STATUS_PENDING){
                return redirect()
                    ->route('login')
                    ->with('message', 'Account inactive, Kindly contact ADMIN.');
            }
            // else if ($this->acitivateTwoFactorAuth($user)) {
            //     return $this->sendVerificationCode($user, $request, "/");
            // }

            else {
                Auth::login($user);


            //$token = $user->createToken('API Token')->accessToken;







                // if($user->api_token == NULL ) {
                //     $user->update([
                //         "api_token" => Str::random(60).$user->id,
                //     ]);
                // }
                return redirect()->route('home');
                //dd($user);
                // dd($user->id);
                // dd(Auth::login($user->id, TRUE));
                // Auth::login($user);
                // $this->logLogin($user->id);
                // if(request()->has('link') && env('APP_TRAIL_TEST', false)) {
                //     return redirect('/' . '?link=' . request()->link);
                // }

            }


        }


    }

    private function attemptManualLogin($request){
        $user = User::where("email", $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)){
                return $user;
            }
        }

        return false;
    }


}
