@extends('admin.layouts.app')

@section('title', 'Thêm mới chức vụ')

@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="#">
                        <i class="fa fa-sitemap"></i> Cơ cấu tổ chức
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/position/index') }}">
                        Chức vụ
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        Thêm mới chức vụ
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="fmenu" method="post" action="{{ url('/admin/position/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin chức vụ
                                </h5>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Tên chức vụ <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="position_name" class="form-control"
                                               data-required="true" data-required-message="<b>Tên chức vụ</b> không được để trống">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Mô tả :</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="description" id="description"
                                                  data-maxlength="500" data-maxlength-message="<b>Mô tả</b> không được vượt quá 500 ký tự" ></textarea>
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
                                <div class="line line-dashed line-lg pull-in"></div>
                                <div class="form-group m-b-xs">
                                    <span class="col-lg-2 control-span"></span>
                                    <div class="col-lg-6">
                                        <input type="submit" class="btn btn-s-sm btn-primary" value="Lưu">
                                        <a href="{{ url('/admin/position/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
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
@endsection
