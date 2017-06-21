<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Model\Department;
use App\Util\Constants;

class DepartmentController extends Controller
{
    public function index(Request $request) 
    {
        try {
            $query = Department::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('department_name', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('phone', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('address', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->s.'%');
                });
            }
            $departments = $query->paginate(Constants::$PAGE_NUMBER);
            return view('admin.department.index')->with(['departments' => $departments, 's' => $request->s]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd() 
    {
        try {
            $departments_parent = Department::all(['id', 'department_name']);
            return view('admin.department.add')->with(['departments_parent' => $departments_parent]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postAdd(DepartmentRequest $request) 
    {
        try {
            $department = new Department();
            $department->department_name = $request->department_name;
            $department->parent_id = $request->parent_id;
            $department->description = $request->description;
            $department->phone = $request->phone;
            $department->address = $request->address;
            $department->link = $request->link;
            $department->order_number = $request->order_number;
            $department->created_at = Carbon::now();
            $department->created_by = Auth::user()->id;
            $rs = $department->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/department/index');
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
            $department_info = Department::find($id);
            $departments_parent = Department::where('id', '!=', $id)->get(['id', 'department_name']);
            if ($department_info) {
                return view('admin.department.edit')->with(['department_info' => $department_info, 'departments_parent' => $departments_parent]);
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back(); 
            }
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postEdit(DepartmentRequest $request, $id)
    {
        try {
            $department_info = Department::find($id);
            if ($department_info) {
                $department_info->department_name = $request->department_name;
                $department_info->parent_id = $request->parent_id;
                $department_info->description = $request->description;
                $department_info->phone = $request->phone;
                $department_info->address = $request->address;
                $department_info->link = $request->link;
                $department_info->order_number = $request->order_number;
                $department_info->updated_at = Carbon::now();
                $department_info->updated_by = Auth::user()->id;
                $rs = $department_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/department/index');
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
            $department_info = Department::find($id);
            if ($department_info) {
                $rs = $department_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/department/index');
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
