@extends('admin.layouts.app')

@section('title', 'Thêm mới danh mục')

@section('content')
<!--- ckfinder -->
{{ Html::script('js/ckfinder/ckfinder.js') }}

<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="/admin/menu/index">
                        <i class="fa fa-bars"></i> Danh mục
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        Thêm mới danh mục
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row animated fadeInRightBig">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="fmenu" method="post" action="{{ url('/admin/menu/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin danh mục
                                </h5>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Danh mục cha :</label>
                                    <div class="col-lg-6">
                                        <select name="parent_id" class="form-control">
                                            <option value="0">Root</option>
                                            @foreach($menus_root as $menu)
                                                <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Tên danh mục <font color="red">*</font> :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="title" class="form-control" 
                                               data-required="true" data-required-message="<b>Tên danh mục</b> không được để trống">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-lg-2 control-label">
                                        <input type="button" id="brower" value="Chọn ảnh">
                                    </label>
                                    <div class="col-lg-6">
                                        <input hidden value="/Images/no-image.jpg" name="avatar" id="attachFilepath">
                                        <img src="/Images/no-image.jpg" id="images" style="max-width: 200px;">
                                    </div>
                                </div>
<!--                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Loại đường dẫn :</label>
                                    <div class="col-lg-6">
                                        <div class="radio">
                                            <label class="radio-custom">
                                                <input type="radio" name="radio" checked="checked"><i class="fa fa-circle-o"></i> Đường dẫn mặc định
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label class="radio-custom">
                                                <input type="radio" name="radio"><i class="fa fa-circle-o"></i> Đường dẫn chuyên mục
                                            </label>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="form-group m-b-xs" id="div-link">
                                    <label class="col-sm-2 control-label">Đường dẫn :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="link" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Mô tả :</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="description" id="description"
                                                  data-maxlength="200" data-maxlength-message="<b>Mô tả</b> không được vượt quá 200 ký tự" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Số thứ tự <font color="red">*</font> :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="order_number" class="form-control " 
                                               data-type="number" data-type-number-message="Phải nhập đúng định dạng số" 
                                               data-required="true" data-required-message="<b>Số thứ tự</b> không được để trống">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Vị trí hiển thị:</label>
                                    <div class="col-lg-6">
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_top" value="1"><i class="fa fa-fw fa-square-o"></i> Danh mục Top</label>
                                        </div>
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_menubar" value="1" checked="checked"><i class="fa fa-fw fa-square-o"></i> Danh mục Chính </label>
                                        </div>
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_home" value="1"><i class="fa fa-fw fa-square-o"></i> Danh mục Trang chủ</label>
                                        </div>
                                        <div class="checkbox">
                                            <label class="checkbox-custom"><input type="checkbox" name="is_right" value="1"><i class="fa fa-fw fa-square-o"></i> Danh mục Bên phải </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="line line-dashed line-lg pull-in"></div>
                                <div class="form-group m-b-xs">
                                    <span class="col-lg-2 control-span"></span>
                                    <div class="col-lg-6">
                                        <input type="submit" class="btn btn-s-sm btn-primary" value="Lưu">
                                        <a href="{{ url('/admin/menu/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
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
    $(function () {
        $('#brower').click(function () {
            var ckfinder = new CKFinder();
            ckfinder.selectActionFunction = function (fileUrl) {
                $('#images').attr("src", fileUrl);
                $('#attachFilepath').val(fileUrl);
            };
            ckfinder.popup();
        });
    });
</script>
@endsection
