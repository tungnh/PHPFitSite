<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Util\Constants;

class CommentController extends Controller
{
    public function index() {
        try {
            $query = Comment::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('full_name', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('email', 'LIKE', '%'.$request->s.'%');
                });
            }
            if ($request->a != '') {
                $query = $query->where ('is_active', '=', $request->a);
            }
            $comments = $query->paginate(Constants::$PAGE_NUMBER);
            return view('admin.comment.index')->with(['comments' => $comments, 's' => $request->s, 'a' => $request->a]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd() {
        return view('admin.comment.index');
    }
    
    public function postAdd() {
        return redirect()->back();
    }
}
