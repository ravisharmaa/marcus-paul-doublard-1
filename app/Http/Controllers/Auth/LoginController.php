<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use GuzzleHttp\Psr7\Request;
use App\Library\Captcha;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Lang;

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
    protected $redirectTo   =   'cms/dashboard';
    protected $username     =   'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLogin()
    {
        $captcha = new Captcha();
        $cap = $captcha->make();
        return view('auth.new_login')->with('cap', $cap);
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);
        $code = $request->input('CaptchaCode');
        $isHuman = captcha_validate($code);
        if($isHuman){
            $data= $request->only(['username','password']);
            if(!Auth::attempt($data)){
                return redirect()->back()
                    ->withInput($request->only($this->username()))
                    ->with('message',Lang::get('auth.failed'));
            } else {
                return redirect()->route('cms.dashboard');
        }
    } else {
            return redirect()->back()->with(['captcha'=>'Incorrect Captcha']);
        }


    }


    public function validateLogin(Request $request)
    {

        $this->validate($request, [
            $this->username() =>    'required',
            'password'        =>    'required',
        ]);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('cms.login');
    }

    protected function validateCaptcha($captcha)
    {

    }
}
