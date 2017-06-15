<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use App\Model\Slide;
use App\Util\Constants;

class SlideController extends Controller
{
    public function index(Request $request) 
    {
        try {
            $query = Slide::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('title', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->s.'%');
                });
            }
            if ($request->a != '') {
                $query = $query->where ('is_active', '=', $request->a);
            }
            $slides = $query->paginate(Constants::$PAGE_NUMBER);
            return view('admin.slide.index')->with(['slides' => $slides, 's' => $request->s, 'a' => $request->a]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd() 
    {
        try {
            return view('admin.slide.add');
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postAdd(SlideRequest $request) 
    {
        try {
            $slide = new Slide();
            $slide->title = $request->title;
            $slide->description = $request->description;
            $slide->order_number = $request->order_number;
            $slide->link = $request->link;
            $slide->avatar = $request->avatar;
            $slide->is_active = $request->input('is_active', 0);
            $slide->created_at = Carbon::now();
            $slide->created_by = Auth::user()->id;
            $rs = $slide->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/slide/index');
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
                return redirect()->back();  
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, $ex->getMessage());
            return redirect()->back();
        }
    }
    
    public function getEdit($id)
    {
        try {
            $slide_info = Slide::find($id);
            if ($slide_info) {
                return view('admin.slide.edit')->with(['slide_info' => $slide_info]);
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back(); 
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postEdit(SlideRequest $request, $id)
    {
        try {
            $slide_info = Slide::find($id);
            if ($slide_info) {
                $slide_info->title = $request->title;
                $slide_info->description = $request->description;
                $slide_info->order_number = $request->order_number;
                $slide_info->link = $request->link;
                $slide_info->avatar = $request->avatar;
                $slide_info->is_active = $request->input('is_active', 0);
                $slide_info->updated_at = Carbon::now();
                $slide_info->updated_by = Auth::user()->id;
                $rs = $slide_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/slide/index');
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
            $slide_info = Slide::find($id);
            if ($slide_info) {
                $rs = $slide_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/slide/index');
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
