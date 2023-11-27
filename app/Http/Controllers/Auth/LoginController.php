<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $user = User::whereRaw("MD5(CONCAT('".$request->otp."', '".$request->fingerPrint."', '".$request->gsalt."', '".$request->snonce."', `no`, '".$request->cnonce."')) = '$request->cuhash'")
                    ->whereRaw("MD5(CONCAT('".$request->otp."', '".$request->fingerPrint."', '".$request->gsalt."', '".$request->snonce."', `md5password`, '".$request->cnonce."')) = '$request->cphash'")->first();
        if(!is_null($user))$request->request->add([$this->username() => $user->no, 'password' => $user->no, 'active' => $user->active]); //add request
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password', 'active');
    }

    public function username()
    {
        return 'no';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            // $this->username() => 'required|string',
            // 'password' => 'required|string',
        ]);
    }


}
