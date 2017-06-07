<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use App\Model\Post;
use App\Http\Requests\PostRequest;
use App\Util\Constants;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%'.$request->search.'%')
                ->paginate(Constants::$PAGE_NUMBER);
        return view('admin.post.index')->with('posts', $posts)->with('search', $request->search);
    }
    
    public function getAdd()
    {
        $menus = Menu::all(['id', 'title']);
        return view('admin.post.add')->with('menus', $menus);
    }
    
    public function postAdd(PostRequest $request)
    {
        try {
            $post = new Post();
            $post->menu_id = $request->menu_id;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->new_content = $request->new_content;
            $post->meta_keyword = $request->meta_keyword;
            $post->meta_desciption = $request->meta_desciption;
            $post->meta_desciption = $request->meta_desciption;
            $post->is_home = $request->input('is_home', 0);
            $post->is_shared = $request->input('is_shared', 0);
            $post->is_comment = $request->input('is_comment', 0);
            $post->is_tinlq = $request->input('is_tinlq', 0);
            $post->active_flg = $request->input('active_flg', 0);;
            $post->created_at = Carbon::now();
            $post->created_by = Auth::user()->id;
            $rs = $post->save();
            if ($rs) {
                return redirect('/admin/post/index');
            }
            else
            {
                return redirect()->back();  
            }
        } catch (Exception $ex) {
            return redirect()->back();
        }
    }
    
    public function getEdit($id)
    {
        $post_info = Post::find($id);
        if ($post_info)
        {
            $menus = Menu::all(['id', 'title']);
            return view('admin.post.edit')->with(['menus' => $menus, 'post_info' => $post_info]);
        } else {
            return redirect()->back();
        }
    }
    
    public function postEdit(PostRequest $request, $id)
    {
        try {
            $post_info = Post::find($id);
            if ($post_info)
            {
                $post_info->menu_id = $request->menu_id;
                $post_info->title = $request->title;
                $post_info->description = $request->description;
                $post_info->new_content = $request->new_content;
                $post_info->meta_keyword = $request->meta_keyword;
                $post_info->meta_desciption = $request->meta_desciption;
                $post_info->meta_desciption = $request->meta_desciption;
                $post_info->is_home = $request->input('is_home', 0);
                $post_info->is_shared = $request->input('is_shared', 0);
                $post_info->is_comment = $request->input('is_comment', 0);
                $post_info->is_tinlq = $request->input('is_tinlq', 0);
                $post_info->active_flg = $request->input('active_flg', 0);;
                $post_info->updated_at = Carbon::now();
                $post_info->updated_by = Auth::user()->id;
                $rs = $post_info->save();
                if ($rs) {
                    return redirect('/admin/post/index');
                } else {
                    return redirect()->back()->withErrors(['message-error' => 'Có lỗi xảy ra. Vui lòng thử lại!']);
                }
            } else {
                return redirect()->back()->withErrors(['message-error' => 'Dữ liệu không tồn tại!']);
            }
        } catch (Exception $ex) {
            return redirect()->back()->withErrors(['message-error' => 'Có lỗi xảy ra. Vui lòng thử lại!']);
        }
    }
    
    public function postDelete($id){
        try {
            $post_info = Post::find($id);
            if ($post_info)
            {
                $rs = $post_info->delete();
                if ($rs) {
                    return redirect('/admin/post/index');
                } else {
                    return redirect()->back()->withErrors(['message-error' => 'Có lỗi xảy ra. Vui lòng thử lại!']);
                }
            } else {
                return redirect()->back()->withErrors(['message-error' => 'Dữ liệu không tồn tại!']);
            }
        } catch (Exception $ex) {
            return redirect()->back()->withErrors(['message-error' => 'Có lỗi xảy ra. Vui lòng thử lại!']);
        }
    }
}
