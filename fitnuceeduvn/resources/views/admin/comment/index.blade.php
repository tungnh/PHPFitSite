<?php
    use App\Util\Constants; 
?>
@extends('admin.layouts.app')

@section('title', 'Bình luận')

@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa fa-bars"></i> Tin tức
                    </a>
                    <a href="{{ url('/admin/comment/index') }}">
                        <i class="fa fa-bars"></i> Bình luận
                    </a>
                </li>
            </ul>
            <form class="bs-example form-horizontal" name="form" method="GET" action="{{ url('/admin/comment/index') }}">
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
                                            <input id="keysearch" type="text" value="{{ $s }}" class="form-control" placeholder="Tên danh mục, mô tả..." name="search">
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
                        Danh sách bình luận
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
                                    Thông tin người bình luận
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Bài viết
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Nội dung
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
                            <?php $index = ($comments->currentPage() - 1) * Constants::$PAGE_NUMBER + 1; ?>
                            @foreach($comments as $comment)
                            <tr>
                                <td align="center">{{ $index }}</td>
                                <td>{{ $comment->full_name }}</td>
                                <td>{{ $comment->post_id : '' }}</td>
                                <td align="center">{{ $comment->comments_content }}</td>
                                <td align="center">
                                    @if ($comment->is_active == 0)
                                    <div class="label bg-danger"><b>Không hiển thị</b></div>
                                    @endif
                                </td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <form id="delete-form-{{ $comment->id }}" action="{{ url('/admin/comment/delete/'.$comment->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <a href="javascript: void(0);" onclick="event.preventDefault(); if (confirm('Bạn có chắc chắn muốn xóa bản ghi này!')) document.getElementById('delete-form-{{ $comment->id }}').submit();"><i class="fa fa-times text-danger text" style="font-size : 15px;"></i></a>
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
                                Tổng số <strong>{{ $comments->total() }}</strong> dữ liệu
                            </p>
                        </div>
                        <!--                            <div class="col-md-4 hidden-sm">
                                                        <p class="m-t" style="color: #2e3e4e; text-align: center;">
                                                            Hiển thị trang <input type="text" size="5" name="page" value="1" id="pageid"> / 3
                                                        </p>
                                                    </div>-->
                        <div class="col-md-8 col-sm-12 m-t-none m-b-none text-right text-center-xs">
                            {{ $comments->appends(['search' => $search])->render() }}
                        </div>
                    </div>
                </footer>
            </section>
        </section>
    </section>
</section>
@endsection('content')
