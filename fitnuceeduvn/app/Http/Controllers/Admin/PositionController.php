<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Model\Position;
use App\Util\Constants;

class PositionController extends Controller
{
    public function index(Request $request) 
    {
        try {
            $query = Position::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('position_name', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->s.'%');
                });
            }
            $positions = $query->paginate(Constants::$PAGE_NUMBER);
            return view('admin.position.index')->with(['positions' => $positions, 's' => $request->s]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd() 
    {
        try {
            return view('admin.position.add');
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postAdd(PositionRequest $request) 
    {
        try {
            $position = new Position();
            $position->position_name = $request->position_name;
            $position->description = $request->description;
            $position->order_number = $request->order_number;
            $position->created_at = Carbon::now();
            $position->created_by = Auth::user()->id;
            $rs = $position->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/position/index');
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
            $position_info = Position::find($id);
            if ($position_info) {
                return view('admin.position.edit')->with(['position_info' => $position_info]);
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back(); 
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postEdit(PositionRequest $request, $id)
    {
        try {
            $position_info = Position::find($id);
            if ($position_info) {
                $position_info->position_name = $request->position_name;
                $position_info->description = $request->description;
                $position_info->order_number = $request->order_number;
                $position_info->updated_at = Carbon::now();
                $position_info->updated_by = Auth::user()->id;
                $rs = $position_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/position/index');
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
            $position_info = Position::find($id);
            if ($position_info) {
                $rs = $position_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/position/index');
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
