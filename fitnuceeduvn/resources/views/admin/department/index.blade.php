<?php
    use App\Util\Constants; 
?>
@extends('admin.layouts.app')

@section('title', 'Bộ môn, phòng ban')

@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-sitemap"></i> Cơ cấu tổ chức
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/department/index') }}">Bộ môn, phòng ban</a>
                </li>
            </ul>
            <div class="row m-b-sm">
                <div class="col-lg-12">
                    <div class="pull-left">
                        <button href="#panel-search" class="btn btn-sm btn-s-sm btn-default" data-toggle="class:show"> 
                            <i class="fa fa-search-plus text"></i> 
                            <span class="text">Mở tìm kiếm</span> 
                            <i class="fa fa-search-minus text-active"></i> 
                            <span class="text-active">Đóng tìm kiếm</span> 
                        </button>
                    </div>
                </div>
            </div>
            <form class="bs-example form-horizontal" name="form" method="GET" action="{{ url('/admin/department/index') }}">
                <div class="row hide" id="panel-search">
                    <div class="col-sm-12">
                        <section class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group m-b-sm">
                                    <div class="col-lg-9">
                                        <label class="col-lg-2 control-label text-center">
                                            Từ khóa
                                        </label>
                                        <div class="col-lg-9">
                                            <input id="keysearch" type="text" value="{{ $s }}" class="form-control" placeholder="Tên, số điện thoại, mô tả..." name="s">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="text-center">
                                            <button type="submit" id="btn_search" onclick="search();" class="btn btn-sm btn-s-sm btn-primary">
                                                <i class="fa fa-search"></i> Tìm kiếm
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="clear_filter();">
                                                <i class="fa fa-trash-o"></i> Xóa điều kiện
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
            @include('admin.layouts.message') <!-- Message alert -->
            <div class="row m-b-sm">
                <div class="col-lg-12">
                    <label class="control-span m-t-xs">
                        Danh sách bộ môn, phòng ban
                    </label>
                    <div class="pull-right">
                        <a href="add" class="btn btn-sm btn-s-sm btn-primary">
                            <i class="fa fa-plus"></i> Thêm mới
                        </a>
                    </div>
                </div>
            </div>
            <section class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped m-b-none">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align: middle; width : 40px;">
                                    STT
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Tên bộ môn, phòng ban
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Số điện thoại
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Địa chỉ
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Mô tả
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Số thứ tự
                                </th>
                                <th class="text-center" style="vertical-align: middle; width : 40px;">
                                    Sửa
                                </th>
                                <th class="text-center" style="vertical-align: middle; width : 40px;">
                                    Xóa
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = ($departments->currentPage() - 1) * Constants::$PAGE_NUMBER + 1; ?>
                            @foreach($departments as $department)
                            <tr>
                                <td align="center">{{ $index }}</td>
                                <td>{{ $department->department_name }}</td>
                                <td>{{ $department->phone }}</td>
                                <td>{{ $department->address }}</td>
                                <td align="center">{{ $department->description }}</td>
                                <td align="center">{{ $department->order_number }}</td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <a href="{{ url('/admin/department/edit/'.$department->id) }}"><i class="fa fa-edit text-dark text"></i></a>
                                </td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <form id="delete-form-{{ $department->id }}" action="{{ url('/admin/department/delete/'.$department->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <a href="javascript: void(0);" onclick="event.preventDefault(); if (confirm('Bạn có chắc chắn muốn xóa bản ghi này!')) document.getElementById('delete-form-{{ $department->id }}').submit();"><i class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>
                            <?php $index++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="footer bg-white b-t">
                    <div class="row text-center-xs">
                        <div class="col-md-4 hidden-sm">
                            <p class="m-t" style="color: #2e3e4e;">
                                Tổng số <strong>{{ $departments->total() }}</strong> dữ liệu
                            </p>
                        </div>
                        <!--                            <div class="col-md-4 hidden-sm">
                                                        <p class="m-t" style="color: #2e3e4e; text-align: center;">
                                                            Hiển thị trang <input type="text" size="5" name="page" value="1" id="pageid"> / 3
                                                        </p>
                                                    </div>-->
                        <div class="col-md-8 col-sm-12 m-t-none m-b-none text-right text-center-xs">
                            {{ $departments->appends(['s' => $s])->render() }}
                        </div>
                    </div>
                </footer>
            </section>
        </section>
    </section>
</section>
@endsection('content')
