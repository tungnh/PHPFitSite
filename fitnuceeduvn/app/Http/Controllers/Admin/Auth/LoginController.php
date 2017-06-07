<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

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
            return redirect(route('getAdminHomeIndex'));
        }
        else
        {
            return redirect()->back()->withInput()->withErrors(['email' => 'Thông tin đăng nhập không chính xác!']);
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
