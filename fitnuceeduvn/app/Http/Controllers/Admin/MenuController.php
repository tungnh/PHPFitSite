<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Model\Menu;
use App\Util\Constants;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        try {
            $menus = Menu::where('title', 'LIKE', '%'.$request->search.'%')
                    ->paginate(Constants::$PAGE_NUMBER);
            return view('admin.menu.index')->with('menus', $menus)->with('search', $request->search);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd()
    {
        try {
            $menus_root = Menu::all(['id', 'title']);
            return view('admin.menu.add')->with('menus_root', $menus_root);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postAdd(MenuRequest $request)
    {
        try {
            $menu = new Menu();
            $menu->parent_id = $request->parent_id;
            $menu->title = $request->title;
            $menu->description = $request->description;
            $menu->order_number = $request->order_number;
            $menu->link = $request->link;
            $menu->avatar = $request->avatar;
            $menu->is_home = $request->input('is_home', 0);
            $menu->is_top = $request->input('is_top', 0);
            $menu->is_right = $request->input('is_right', 0);
            $menu->is_menubar = $request->input('is_menubar', 0);
            $menu->is_active = 1;
            $menu->created_at = Carbon::now();
            $menu->created_by = Auth::user()->id;
            $rs = $menu->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/menu/index');
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
            $menu_info = Menu::find($id);
            if ($menu_info) {
                $menus_root = Menu::all(['id', 'title']);
                return view('/admin/menu/edit')->with(['menu_info'=> $menu_info, 'menus_root' => $menus_root]);
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back();
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postEdit(MenuRequest $request, $id)
    {
        try {
            $menu_info = Menu::find($id);
            if ($menu_info)
            {
                $menu_info->parent_id = $request->parent_id;
                $menu_info->title = $request->title;
                $menu_info->description = $request->description;
                $menu_info->order_number = $request->order_number;
                $menu_info->link = $request->link;
                $menu_info->avatar = $request->avatar;
                $menu_info->is_home = $request->input('is_home', 0);
                $menu_info->is_top = $request->input('is_top', 0);
                $menu_info->is_right = $request->input('is_right', 0);
                $menu_info->is_menubar = $request->input('is_menubar', 0);
                $menu_info->is_active = $request->input('is_active', 0);
                $menu_info->updated_at = Carbon::now();
                $menu_info->updated_by = Auth::user()->id;
                $rs = $menu_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/menu/index');
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
            $menu_info = Menu::find($id);
            if ($menu_info) {
                $rs = $menu_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/menu/index');
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
