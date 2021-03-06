@extends('admin.layouts.app')

@section('title', 'Thêm mới bài viết')

@section('content')
<!--- CkEditor -->
{{ Html::script('js/ckeditor/ckeditor.js') }}
<!--- CkFinder -->
{{ Html::script('js/ckfinder/ckfinder.js') }}

<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-tag"></i> Tin tức
                    </a>
                </li>
                <li>
                    <a href="/admin/new/index">
                        Bài viết
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        Thêm mới bài viết
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="fmenu" method="post" action="{{ url('/admin/post/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin bài viết
                                </h5>
                                <div class="form-group m-b-xs" id="div-link">
                                    <label class="col-sm-2 control-label">Danh mục chứa <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <select name="menu_id" class="form-control"
                                                data-required="true" data-required-message="<b>Danh mục chứa</b> không được để trống">
                                            <option value="">Lựa chọn</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs" id="div-link">
                                    <label class="col-sm-2 control-label">Tiêu đề <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="title" class="form-control"
                                               data-required="true" data-required-message="<b>Tiêu đề</b> không được để trống">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Trích dẫn :</label>
                                    <div class="col-lg-10">
                                        <textarea id="description" name="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Nội dung bài viết :</label>
                                    <div class="col-lg-10">
                                        <textarea id="post_content" name="post_content" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Meta keyword :</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="meta_keyword" id="meta_keyword"
                                                  data-maxlength="500" data-maxlength-message="<b>Meta keyword</b> không được vượt quá 500 ký tự" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Meta description :</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="meta_desciption" id="meta_desciption"
                                                  data-maxlength="500" data-maxlength-message="<b>Meta description</b> không được vượt quá 500 ký tự" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs" id="div-link">
                                    <label class="col-sm-2 control-label">Ảnh đại diện :</label>
                                    <div class="col-lg-6">
                                        <input hidden name="avatar" id="avatar" value="/images/no-image.jpg" />
                                        <img src="/images/no-image.jpg" id="select_avatar" class="img-avatar"/>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Tùy chọn hiển thị :</label>
                                    <div class="col-lg-6">
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_home" value="1"><i class="fa fa-fw fa-square-o"></i> Hiển thị trên Trang chủ</label>
                                        </div>
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_shared" value="1" checked="checked"><i class="fa fa-fw fa-square-o"></i> Cho phép chia sẻ</label>
                                        </div>
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_comment" value="1"><i class="fa fa-fw fa-square-o"></i> Cho phép bình luận</label>
                                        </div>
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_tinlq" value="1"><i class="fa fa-fw fa-square-o"></i> Hiển thị tin liên quan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Trạng thái hiển thị :</label>
                                    <div class="col-sm-10">
                                        <label class="switch"><input type="checkbox" name="is_active" value="1" checked><span></span></label>
                                    </div>
                                </div>
                                <div class="line line-dashed line-lg pull-in"></div>
                                <div class="form-group m-b-xs">
                                    <span class="col-lg-2 control-span"></span>
                                    <div class="col-lg-6">
                                        <input type="submit" class="btn btn-s-sm btn-primary" value="Lưu">
                                        <a href="{{ url('/admin/post/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
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
    CKEDITOR.replace('description', { height: 100 });
    CKEDITOR.replace('post_content');
    
    $(function () {
        $('#select_avatar').click(function () {
            var ckfinder = new CKFinder();
            ckfinder.selectActionFunction = function (fileUrl) {
                $('#select_avatar').attr("src", fileUrl);
                $('#avatar').val(fileUrl);
            };
            ckfinder.popup();
        });
    });
</script>
@endsection

