<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Util\Constants;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    protected $redirectTo = '/';
    
    public function getLogin()
    {
        return view('admin.auth.login');
    }
    
    public function postLogin(AccountRequest $request)
    {
        //The user is active, not suspended, and exists.
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1
        ];
        if (Auth::attempt($login, $request->input('remember', 0))) {
            return redirect()->intended(route('getAdminHomeIndex'));
        } else {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_LOGIN_FAILURE);
            return redirect()->back()->withInput();
        }
    }
    
    public function postLogout()
    {
        Auth::logout();
        return redirect(route('getAdminAuthLogin'));
    }
    
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'postLogout']);
    }
}
