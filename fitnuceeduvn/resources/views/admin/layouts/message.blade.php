<?php
    use App\Util\Constants; 
?>
@if (Session::has(Constants::$SESSION_MSG_ERROR))
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h4>Lỗi!</h4>
    <p>{{ Session::get(Constants::$SESSION_MSG_ERROR) }}</p>
    @if (Session::has(Constants::$SESSION_MSG_ERROR_EXEPTION))
    <p>{{ Session::get(Constants::$SESSION_MSG_ERROR_EXEPTION) }}</p>
    @endif
</div>
@endif
@if (Session::has(Constants::$SESSION_MSG_SUCCESS))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h4>Thành công!</h4>
    <p>{{ Session::get(Constants::$SESSION_MSG_SUCCESS) }}</p>
</div>
@endif
@if (Session::has(Constants::$SESSION_MSG_WARNING))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <h4>Thành công!</h4>
    <p>{{ Session::get(Constants::$SESSION_MSG_WARNING) }}</p>
</div>
@endif
