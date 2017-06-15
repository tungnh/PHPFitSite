@extends('admin.layouts.app')

@section('title', 'Thêm mới slide')

@section('content')
<!--- ckfinder -->
{{ Html::script('js/ckfinder/ckfinder.js') }}

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
                    <a href="{{ url('/admin/slide/index') }}">
                        Slide
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        Thêm mới slide
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="fmenu" method="post" action="{{ url('/admin/slide/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin slide
                                </h5>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Ảnh đại diện :</label>
                                    <div class="col-lg-6">
                                        <input hidden name="avatar" id="avatar" value="/images/no-image.jpg" />
                                        <img src="/images/no-image.jpg" id="select_avatar" class="img-avatar"/>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Tiêu đề <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="title" class="form-control"
                                               data-required="true" data-required-message="<b>Tiêu đề</b> không được để trống">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Mô tả <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="description" id="description"
                                                  data-required="true" data-required-message="<b>Mô tả</b> không được để trống"
                                                  data-maxlength="200" data-maxlength-message="<b>Mô tả</b> không được vượt quá 200 ký tự" ></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Đường dẫn :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="link" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Số thứ tự <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="order_number" class="form-control " 
                                               data-type="number" data-type-number-message="Phải nhập đúng định dạng số" 
                                               data-required="true" data-required-message="<b>Số thứ tự</b> không được để trống">
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
                                        <a href="{{ url('/admin/slide/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
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
