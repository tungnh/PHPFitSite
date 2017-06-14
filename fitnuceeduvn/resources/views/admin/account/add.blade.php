@extends('admin.layouts.app')

@section('title', 'Thêm mới tài khoản')

@section('content')
<!--- ckfinder -->
{{ Html::script('js/ckfinder/ckfinder.js') }}

<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="/admin/menu/index">
                        <i class="fa fa-bars"></i> Người dùng
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        Thêm mới tài khoản
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="f_account" method="post" action="{{ url('/admin/account/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin tài khoản
                                </h5>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Tên tài khoản <font color="red">*</font> :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="username" class="form-control" 
                                               data-required="true" data-required-message="<b>Tên tài khoản</b> không được để trống"
                                               data-maxlength="255" data-maxlength-message="<b>Tên tài khoản</b> phải nhỏ hơn 255 ký tự">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Email <font color="red">*</font> :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="email" class="form-control" 
                                               data-required="true" data-required-message="<b>Email</b> không được để trống"
                                               data-maxlength="255" data-maxlength-message="<b>Email</b> phải nhỏ hơn 255 ký tự"
                                               data-type="email" data-type-email-message="<b>Email</b> nhập sai định dạng">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Mật khẩu <font color="red">*</font> :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="password" id='password' class="form-control" 
                                               data-required="true" data-required-message="<b>Mật khẩu</b> không được để trống"
                                               data-minlength="6" data-minlength-message="<b>Mật khẩu</b> phải lớn hơn 6 ký tự"
                                               data-maxlength="255" data-maxlength-message="<b>Mật khẩu</b> phải nhỏ hơn 255 ký tự">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Nhập lại mật khẩu <font color="red">*</font> :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="re_password" id="re_password" class="form-control" 
                                               data-required="true" data-required-message="<b>Nhập lại mật khẩu</b> không được để trống"
                                               data-minlength="6" data-minlength-message="<b>Nhập lại mật khẩu</b> phải lớn hơn 6 ký tự"
                                               data-maxlength="255" data-maxlength-message="<b>Nhập lại mật khẩu</b> phải nhỏ hơn 255 ký tự"
                                               data-equalto="#password" data-equalto-message="<b>Nhập lại mật khẩu</b> không chính xác">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Trạng thái hoạt động</label>
                                    <div class="col-sm-10">
                                        <label class="switch"><input type="checkbox" name="is_active" value="1"><span></span></label>
                                    </div>
                                </div>
                                <div class="line line-dashed line-lg pull-in"></div>
                                <div class="form-group m-b-xs">
                                    <span class="col-lg-2 control-span"></span>
                                    <div class="col-lg-6">
                                        <input type="submit" class="btn btn-s-sm btn-primary" value="Lưu">
                                        <a href="{{ url('/admin/account/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
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


