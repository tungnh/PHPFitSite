<?php

namespace App\Util;

/**
 * Description of Constants
 *
 * @author tungnh
 */
class Constants {
    public static $PAGE_NUMBER = 10;
    
    public static $SESSION_MSG_ERROR = 'msg_success';
    public static $SESSION_MSG_SUCCESS = 'msg_error';
    public static $SESSION_MSG_WARNING = 'msg_warning';
    
    public static $MSG_SUCCESS_ADD = 'Thêm mới dữ liệu thành công.';
    public static $MSG_SUCCESS_EDIT = 'Cập nhật dữ liệu thành công';
    public static $MSG_SUCCESS_DELETE = 'Xóa dữ liệu thành công.';
    
    public static $MSG_ERROR = 'Có lỗi xảy ra, vui lòng thử lại.';
    public static $MSG_ERROR_DATA_NOT_EXIT = 'Dữ liệu không tồn tại.';
}
