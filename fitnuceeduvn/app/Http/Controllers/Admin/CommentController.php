<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Model\Post;
use App\Http\Requests\CommentRequest;
use App\Util\Constants;

class CommentController extends Controller
{
    public function index(Request $request) 
    {
        try {
            $query = Comment::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('full_name', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('email', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('comments_content', 'LIKE', '%'.$request->s.'%');
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
    
    public function getCommentsByPost($id = null, $reply_id = null) 
    {
        $comments = Comment::where('post_id', '=', $id)
                ->where('id', '!=', $reply_id)->get();
        return view('admin.comment.comments_by_post')->with(['comments' => $comments, 'reply_id' => $reply_id]);
    }
    
    public function getReply($id) 
    {
        $posts = Post::all(['id', 'title']);
        $comment_reply = Comment::find($id);
        return view('admin.comment.add')->with(['posts' => $posts, 'comment_reply' => $comment_reply]);
    }
    
    public function getAdd()
    {
        $posts = Post::all(['id', 'title']);
        return view('admin.comment.add')->with(['posts' => $posts, 'comment_reply' => null]);
    }
    
    public function postAdd(CommentRequest $request) 
    {
        try {
            $comment = new Comment();
            $comment->account_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->parent_id = $request->parent_id;
            $comment->comments_content = $request->comments_content;
            $comment->total_like = 0;
            $comment->is_active = $request->input('is_active', 0);
            $comment->created_at = Carbon::now();
            $comment->created_by = Auth::user()->id;
            $rs = $comment->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/comment/index');
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
        $comment_info = Comment::find($id);
        $posts = Post::all(['id', 'title']);
        return view('admin.comment.edit')->with(['comment_info' => $comment_info, 'posts' => $posts, 'comment_reply' => $comment_info]);
    }
    
    public function postEdit(CommentRequest $request, $id)
    {
        try {
            $comment_info = Comment::find($id);
            if ($comment_info) {
                $comment_info->account_id = Auth::user()->id;
                $comment_info->post_id = $request->post_id;
                $comment_info->parent_id = $request->parent_id;
                $comment_info->comments_content = $request->comments_content;
                $comment_info->total_like = 0;
                $comment_info->is_active = $request->input('is_active', 0);
                $comment_info->updated_at = Carbon::now();
                $comment_info->updated_by = Auth::user()->id;
                $rs = $comment_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/comment/index');
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
            $comment_info = Comment::find($id);
            if ($comment_info) {
                $rs = $comment_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/comment/index');
                } else {
                    Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
                    return redirect()->back();
                }
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back();
            }
        } catch (Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
}
