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
                    <a href="{{ url('/admin/department/index') }}">
                        Phòng ban
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        Thêm mới bộ môn, phòng ban
                    </a>
                </li>
            </ul>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <form data-validate="parsley" class="form-horizontal" enctype="multipart/form-data" name="fmenu" method="post" action="{{ url('/admin/department/add') }}">
                                {{ csrf_field() }}
                                <h5 class="page-header m-t-xs" style="font-weight: 600;">
                                    <i class="fa fa-foursquare"></i> Thông tin bộ môn, phòng ban
                                </h5>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Bộ môn, phòng ban cha :</label>
                                    <div class="col-lg-6">
                                        <select name="parent_id" class="form-control">
                                            <option value="0">Root</option>
                                            @foreach($departments_parent as $department)
                                                <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Tên bộ môn, phòng ban <font color="red">*</font>:</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="department_name" class="form-control"
                                               data-required="true" data-required-message="<b>Tên bộ môn, phòng ban</b> không được để trống"
                                               data-maxlength="200" data-maxlength-message="<b>Tên bộ môn, phòng ban</b> không được vượt quá 200 ký tự">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Số điện thoại :</label>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control"
                                               data-maxlength="200" data-maxlength-message="<b>Số điện thoại</b> không được vượt quá 200 ký tự">
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Địa chỉ :</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="address" id="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group m-b-xs">
                                    <label class="col-sm-2 control-label">Mô tả :</label>
                                    <div class="col-lg-6">
                                        <textarea cols="50" rows="3" class="form-control" name="description" id="description"></textarea>
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
                                        <a href="{{ url('/admin/department/index') }}" class="btn btn-s-sm btn-danger">Hủy bỏ</a>
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
