<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Model\Account;
use App\Util\Constants;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Account::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('username', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('email', 'LIKE', '%'.$request->s.'%');
                });
            }
            if ($request->a != '') {
                $query = $query->where ('is_active', '=', $request->a);
            }
            $accounts = $query->paginate(Constants::$PAGE_NUMBER);
            return view('admin.account.index')->with(['accounts' => $accounts, 's' => $request->s, 'a' => $request->a]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd()
    {
        try {
            return view('admin.account.add');
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postAdd(AccountRequest $request)
    {
        try {
            $account = new Account();
            $account->username = $request->username;
            $account->email = $request->email;
            $account->password = bcrypt($request->password);
            $account->is_active = $request->input('is_active', 0);
            $account->is_delete = 0;
            $account->created_at = Carbon::now();
            $account->created_by = Auth::user()->id;
            $rs = $account->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/account/index');
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
                return redirect()->back();  
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getEdit($id)
    {
        try {
            $account_info = Account::find($id);
            if ($account_info) {
                return view('admin.account.edit')->with(['account_info' => $account_info]);
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back(); 
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postEdit(AccountRequest $request, $id)
    {
        try {
            $account_info = Account::find($id);
            if ($account_info) {
                $account_info->username = $request->username;
                $account_info->email = $request->email;
                $account_info->password = bcrypt($request->password);
                $account_info->is_active = $request->input('is_active', 0);
                $account_info->updated_at = Carbon::now();
                $account_info->updated_by = Auth::user()->id;
                $rs = $account_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/account/index');
                } else {
                    Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
                    return redirect()->back();
                }
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postDelete($id){
        try {
            $account_info = Account::find($id);
            if ($account_info) {
                $rs = $account_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/account/index');
                } else {
                    Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
                    return redirect()->back();
                }
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
}
