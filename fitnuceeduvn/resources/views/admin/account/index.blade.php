<?php
    use App\Util\Constants;
?>
@extends('admin.layouts.app')

@section('title', 'Danh mục')

@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="index.html">
                        <i class="fa fa-bars"></i> Nguời dùng
                    </a>
                </li>
            </ul>
            <form class="bs-example form-horizontal" name="form" method="GET" action="{{ url('/admin/account/index') }}">
                <div class="row hide" id="panel-search">
                    <div class="col-sm-12">
                        <section class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-lg-9">
                                    <div class="form-group m-b-sm">
                                        <label class="col-lg-2 control-label">
                                            Từ khóa :
                                        </label>
                                        <div class="col-lg-9">
                                            <input id="keysearch" name="s" type="text" value="{{ $s }}" class="form-control" placeholder="Tên người dùng, email...">
                                        </div>
                                    </div>
                                    <div class="form-group m-b-sm">
                                        <label class="col-lg-2 control-label">
                                        </label>
                                        <div class="col-lg-9">
                                            <select name="a" class="form-control">
                                                <option>Trạng thái hoạt động</option>
                                                <option value="1" {{ $a != '' && $a == 1 ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="0" {{ $a != '' && $a == 0 ? 'selected' : '' }}>Không hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group m-b-sm text-center">
                                        <button type="submit" id="btn_search" onclick="search();" class="btn btn-sm btn-s-sm btn-primary">
                                            <i class="fa fa-search"></i> Tìm kiếm
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="clear_filter();">
                                            <i class="fa fa-trash-o"></i> Xóa điều kiện
                                        </button>
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
                        Danh sách người dùng
                    </label>
                    <div class="pull-right">
                        <button href="#panel-search" class="btn btn-sm btn-s-sm btn-default" data-toggle="class:show"> 
                            <i class="fa fa-filter text"></i> 
                            <span class="text">Mở tìm kiếm</span> 
                            <i class="fa fa-filter text-active"></i> 
                            <span class="text-active">Đóng tìm kiếm</span> 
                        </button>
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
                                    Tên tài khoản
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Email
                                </th>
                                <th class="text-center" style="vertical-align: middle; width: 150px;">
                                    Trạng thái hiển thị
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Sửa
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Xóa
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $index = ($accounts->currentPage() - 1) * Constants::$PAGE_NUMBER + 1; ?>
                            @foreach($accounts as $account)
                            <tr>
                                <td align="center">{{ $index }}</td>
                                <td>{{ $account->username }}</td>
                                <td>{{ $account->email }}</td>
                                <td align="center">
                                    @if ($account->is_active == 0)
                                    <div class="label bg-danger"><b>Không hiển thị</b></div>
                                    @endif
                                </td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <a href="{{ url('/admin/account/edit/'.$account->id) }}"><i class="fa fa-edit text-dark text" style="font-size : 15px;"></i></a>
                                </td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <form id="delete-form-{{ $account->id }}" action="{{ url('/admin/account/delete/'.$account->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <a href="javascript: void(0);" onclick="event.preventDefault(); if (confirm('Bạn có chắc chắn muốn xóa bản ghi này!')) document.getElementById('delete-form-{{ $account->id }}').submit();"><i class="fa fa-times text-danger text" style="font-size : 15px;"></i></a>
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
                                Tổng số <strong>{{ $accounts->total() }}</strong> dữ liệu
                            </p>
                        </div>
                        <!--                            <div class="col-md-4 hidden-sm">
                                                        <p class="m-t" style="color: #2e3e4e; text-align: center;">
                                                            Hiển thị trang <input type="text" size="5" name="page" value="1" id="pageid"> / 3
                                                        </p>
                                                    </div>-->
                        <div class="col-md-8 col-sm-12 m-t-none m-b-none text-right text-center-xs">
                            {{ $accounts->appends(['s' => $s])->render() }}
                        </div>
                    </div>
                </footer>
            </section>

        </section>
    </section>
</section>
@endsection('content')
