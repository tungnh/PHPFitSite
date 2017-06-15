<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Model\Menu;
use App\Model\Post;
use App\Util\Constants;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $menus = Menu::all(['id', 'title']);
            $query = Post::query();
            if (!empty($request->s)) {
                $query = $query->where(function ($q) use ($request) {
                    $q->where('title', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->s.'%')
                            ->orWhere('post_content', 'LIKE', '%'.$request->s.'%');
                });
            }
            if (!empty($request->m)) {
                $query = $query->where ('menu_id', '=', $request->m);
            }

            if (!empty($request->a)) {
                $query = $query->where ('is_active', '=', $request->a);
            }
            $posts = $query->paginate(Constants::$PAGE_NUMBER);
            return view('admin.post.index')->with(['posts'=> $posts, 'menus' => $menus, 's' => $request->s, 'm' => $request->m, 'a' => $request->a]);
        } catch (\Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getAdd()
    {
        try {
            $menus = Menu::all(['id', 'title']);
            return view('admin.post.add')->with('menus', $menus);
        } catch (Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postAdd(PostRequest $request)
    {
        try {
            $post = new Post();
            $post->menu_id = $request->menu_id;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->post_content = $request->post_content;
            $post->meta_keyword = $request->meta_keyword;
            $post->meta_desciption = $request->meta_desciption;
            $post->meta_desciption = $request->meta_desciption;
            $post->avatar = $request->avatar;
            $post->is_home = $request->input('is_home', 0);
            $post->is_shared = $request->input('is_shared', 0);
            $post->is_comment = $request->input('is_comment', 0);
            $post->is_tinlq = $request->input('is_tinlq', 0);
            $post->is_active = $request->input('is_active', 0);;
            $post->created_at = Carbon::now();
            $post->created_by = Auth::user()->id;
            $rs = $post->save();
            if ($rs) {
                Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_ADD);
                return redirect('/admin/post/index');
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
                return redirect()->back();  
            }
        } catch (Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function getEdit($id)
    {
        try {
            $post_info = Post::find($id);
            if ($post_info) {
                $menus = Menu::all(['id', 'title']);
                return view('admin.post.edit')->with(['menus' => $menus, 'post_info' => $post_info]);
            } else {
                Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR_DATA_NOT_EXIT);
                return redirect()->back();
            }
        } catch (Exception $ex) {
            Session::flash(Constants::$SESSION_MSG_ERROR, Constants::$MSG_ERROR);
            return redirect()->back();
        }
    }
    
    public function postEdit(PostRequest $request, $id)
    {
        try {
            $post_info = Post::find($id);
            if ($post_info) {
                $post_info->menu_id = $request->menu_id;
                $post_info->title = $request->title;
                $post_info->description = $request->description;
                $post_info->post_content = $request->post_content;
                $post_info->meta_keyword = $request->meta_keyword;
                $post_info->meta_desciption = $request->meta_desciption;
                $post_info->meta_desciption = $request->meta_desciption;
                $post_info->avatar = $request->avatar;
                $post_info->is_home = $request->input('is_home', 0);
                $post_info->is_shared = $request->input('is_shared', 0);
                $post_info->is_comment = $request->input('is_comment', 0);
                $post_info->is_tinlq = $request->input('is_tinlq', 0);
                $post_info->is_active = $request->input('is_active', 0);
                $post_info->updated_at = Carbon::now();
                $post_info->updated_by = Auth::user()->id;
                $rs = $post_info->save();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_EDIT);
                    return redirect('/admin/post/index');
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
            $post_info = Post::find($id);
            if ($post_info) {
                $rs = $post_info->delete();
                if ($rs) {
                    Session::flash(Constants::$SESSION_MSG_SUCCESS, Constants::$MSG_SUCCESS_DELETE);
                    return redirect('/admin/post/index');
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
