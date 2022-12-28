<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Auth;
use Alert;

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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if ($this->loginValidate() == 0) {
                $log = new Attendance;
                $log->empcode = Auth::user()->id;
                $log->company_id = Auth::user()->company_id;
                $log->date = \today();
                $log->time_in = \now();
                $log->save();
            }
            $attendance = Attendance::where('empcode', Auth::user()->id)->latest('id')->get()->first();
            $request->session()->put('attendance', $attendance);
            Alert::toast('Login Successfull', 'success');
            return redirect()->intended('home');
        } else
            return $this->sendFailedLoginResponse($request);
    }

    public function loginValidate()
    {
        return $loginCheck = Attendance::where('empcode', Auth::user()->id)->where('date', \today())->count();
    }
}