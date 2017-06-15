<?php
    use App\Util\Constants; 
?>
@extends('admin.layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
<!--- ckfinder -->
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
                    <a href="javascript: void(0);">
                        Bài viết
                    </a>
                </li>
            </ul>
            <form class="bs-example form-horizontal" name="form" method="GET" action="{{ url('/admin/post/index') }}">
                <div class="row hide" id="panel-search">
                    <div class="col-sm-12">
                        <section class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-lg-9">
                                    <div class="form-group m-b-xs">
                                        <label class="col-lg-2 control-label">
                                            Từ khóa :
                                        </label>
                                        <div class="col-lg-9">
                                            <input id="keysearch" type="text" value="{{ $s }}" class="form-control" placeholder="Tiêu đề, trích dẫn, nội dung..." name="s">
                                        </div>
                                    </div>
                                    <div class="form-group m-b-xs">
                                        <label class="col-lg-2 control-label">
                                            Lọc theo:
                                        </label>
                                        <div class="col-lg-5">
                                            <select class="form-control" name="m">
                                                <option value="">Danh mục chứa</option>
                                                @foreach ($menus as $menu)
                                                <option value="{{ $menu->id }}" {{ $menu->id == $m ? 'selected' : '' }}>{{ $menu->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="a">
                                                <option value="">Trạng thái hiển thị</option>
                                                <option value="1" {{ $a == 1 ? 'selected' : '' }}>Hiển thị</option>
                                                <option value="0" {{ $a == 0 ? 'selected' : '' }}>Không hiển thị</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group m-b-xs text-center">
                                            <button type="submit" id="btn_search" class="btn btn-sm btn-s-sm btn-primary">
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
                        Danh sách bài viết
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
                                <th width="40px;" class="text-center" style="vertical-align: middle;">
                                    <input type="checkbox">
                                </th>
                                <th class="text-center" style="vertical-align: middle; width : 40px;">
                                    STT
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Ảnh đại diện
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Tiêu đề
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Trích dẫn
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Danh mục chứa
                                </th>
                                <th class="text-center" style="vertical-align: middle; width: 150px;">
                                    Trạng thái hiển thị
                                </th>
                                <th class="text-center" style="vertical-align: middle;">
                                    Link
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
                            <?php $index = ($posts->currentPage() - 1) * Constants::$PAGE_NUMBER + 1; ?>
                            @foreach($posts as $post)
                            <tr>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <input type="checkbox" />
                                </td>
                                <td align="center" style="vertical-align: middle;">{{ $index }}</td>
                                <td width="150px"><img src="{{ $post->avatar }}" class="img-thumbnail"/></td>
                                <td>{{ $post->title }}</td>
                                <td align="center">{!! $post->description !!}</td>
                                <td align="center" style="vertical-align: middle;">{{ $post->menu ? $post->menu->title : '' }}</td>
                                <td align="center" style="vertical-align: middle;">
                                    @if ($post->is_active == 0)
                                    <div class="label bg-danger"><b>Không hiển thị</b></div>
                                    @endif
                                </td>
                                <td align="center" style="vertical-align: middle;"></td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <a href="{{ url('/admin/post/edit/'.$post->id) }}"><i class="fa fa-edit text-dark text" style="font-size : 15px;"></i></a>
                                </td>
                                <td width="40px;" class="text-center" style="vertical-align: middle;">
                                    <form id="delete-form-{{ $post->id }}" action="{{ url('/admin/post/delete/'.$post->id) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    <a href="javascript: void(0);" onclick="event.preventDefault(); if (confirm('Bạn có chắc chắn muốn xóa bản ghi này!')) document.getElementById('delete-form-{{ $post->id }}').submit();"><i class="fa fa-times text-danger text" style="font-size : 15px;"></i></a>
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
                                Tổng số <strong>{{ $posts->total() }}</strong> dữ liệu
                            </p>
                        </div>
                        <div class="col-md-8 col-sm-12 m-t-none m-b-none text-right text-center-xs">
                            {{ $posts->appends(['s' => $s, 'm' => $m, 'a' => $a])->render() }}
                        </div>
                    </div>
                </footer>
            </section>
        </section>
    </section>
</section>
@endsection