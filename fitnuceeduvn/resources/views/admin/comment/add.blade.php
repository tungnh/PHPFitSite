@extends('admin.layouts.app')

@section('title', 'Thêm mới bình luận')

@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="#">
                        <i class="fa fa-tag"></i> Tin tức
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/comment/index') }}">
                        Bình luận
                    </a>
                </li>
                <li>
                    <a href="">
                        Thêm mới bình luận
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="fcomment" method="post" action="{{ url('/admin/comment/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin bình luận
                                </h5>
                                <input hidden value="{{ $comment_reply ? $comment_reply->id : '' }}" id="reply_id" />
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Bài viết <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <select name="post_id" id="post_id" style="width: 100%;" onchange="javascript: changePost();" }}
                                                data-required="true" data-required-message="<b>Bài viết</b> không được để trống">
                                            <option value="">Lựa chọn bài viết</option>
                                            @foreach($posts as $post)
                                                <option value="{{ $post->id }}" {{ $comment_reply ? ($post->id == $comment_reply->post_id ? 'selected' : '') : '' }}>{{ $post->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Bình luận cha :</label>
                                    <div class="col-lg-6" id="div-comments"></div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Nội dung <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="comments_content" id="comments_content"
                                                  data-required="true" data-required-message="<b>Nội dung</b> không được để trống"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Trạng thái hiển thị</label>
                                    <div class="col-sm-10">
                                        <label class="switch"><input type="checkbox" name="is_active" value="1" checked><span></span></label>
                                    </div>
                                </div>
                                <div class="line line-dashed line-lg pull-in"></div>
                                <div class="form-group m-b-xs">
                                    <span class="col-lg-2 control-span"></span>
                                    <div class="col-lg-6">
                                        <input type="submit" class="btn btn-s-sm btn-primary" value="Lưu">
                                        <a href="{{ url('/admin/comment/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
</section>
<script>
    $('#post_id').select2();
    
    changePost();
    function changePost(){
        var url = '/admin/comment/commentsbypost/' + $('#post_id').val() + '/' + $('#reply_id').val();
        $('#div-comments').load(url);
    }
</script>
@endsection


