@extends('admin.layouts.app')

@section('title', 'Lỗi')

@section('content')
<div class="row m-n">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="text-center m-b-lg">
            <h1 class="h text-white animated fadeInDownBig">404</h1>
        </div>
        <div class="list-group m-b-sm bg-white m-b-lg">
            <a href="{{ url('/admin/menu/index') }}" class="list-group-item"><i class="fa fa-chevron-right icon-muted"></i><i class="fa fa-fw fa-home icon-muted"></i> Quay về trang chủ</a>
            <a href="#" class="list-group-item"> <i class="fa fa-chevron-right icon-muted"></i> <i class="fa fa-fw fa-question icon-muted"></i> Send us a tip </a>
            <a href="#" class="list-group-item"> <i class="fa fa-chevron-right icon-muted"></i> <span class="badge">021-215-584</span> <i class="fa fa-fw fa-phone icon-muted"></i> Call us </a> 
        </div>
    </div>
</div>
@endsection