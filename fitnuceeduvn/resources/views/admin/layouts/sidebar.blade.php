<aside class="bg-dark lter aside-md hidden-print" id="nav">
    <section class="vbox">
<!--        <header class="header bg-primary lter text-center clearfix">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i
                        class="fa fa-plus"></i></button>
                <div class="btn-group hidden-nav-xs">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                            data-toggle="dropdown"> Switch Project <span class="caret"></span></button>
                    <ul class="dropdown-menu text-left">
                        <li><a href="#">Project</a></li>
                        <li><a href="#">Another Project</a></li>
                        <li><a href="#">More Projects</a></li>
                    </ul>
                </div>
            </div>
        </header>-->
        <section class="w-f scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0"
                 data-size="5px" data-color="#333333"> <!-- nav -->
                <nav class="nav-primary hidden-xs">
                    <ul class="nav">
                        <!-- Danh mục -->
                        <li {{ (Request::is('admin/menu/*')) ? 'class=active' : '' }}>
                            <a href="/admin/menu/index" {{ (Request::is('admin/menu/*') ? 'class=active' : '') }}>
                                <i class="fa fa-bars icon"><b class="bg-info"></b></i>
                                <span>Danh mục</span>
                            </a>
                        </li>
                        <!-- Tin tức -->
                        <li {{ (Request::is('admin/post/*') || Request::is('admin/comment/*')) ? 'class=active' : '' }}>
                            <a href="#post">
                                <i class="fa fa-tag icon"><b class="bg-info"></b></i>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <span>Tin tức</span>
                            </a>
                            <ul class="nav lt">
                                <li {{ (Request::is('admin/post/*')) ? 'class=active' : '' }}>
                                    <a href="/admin/post/index" {{ (Request::is('admin/post/*')) ? 'class=active' : '' }}>
                                        <i class="fa fa-angle-right"></i>
                                        <span>Bài viết</span>
                                    </a>
                                </li>
                                <li {{ (Request::is('admin/comment/*')) ? 'class=active' : '' }}>
                                    <a href="/admin/comment/index" {{ (Request::is('admin/comment/*')) ? 'class=active' : '' }}>
                                        <i class="fa fa-angle-right"></i>
                                        <span>Bình luận</span>
                                    </a>
                                </li>
                                <li {{ (Request::is('admin/slide/*')) ? 'class=active' : '' }}>
                                    <a href="{{ url('/admin/slide/index') }}" {{ (Request::is('admin/slide/*')) ? 'class=active' : '' }}>
                                        <i class="fa fa-angle-right"></i>
                                        <span>Slide trang chủ</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Văn bản -->
                        <li>
                            <a href="index.html" class="active">
                                <i class="fa fa-file icon"><b class="bg-info"></b></i>
                                <span>Văn bản</span>
                            </a>
                        </li>
                        <!-- Media -->
                        <li>
                            <a href="#layout">
                                <i class="fa fa-camera icon"><b class="bg-info"></b></i>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <span>Media</span>
                            </a>
                            <ul class="nav lt">
                                <li>
                                    <a href="layout-c.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Video</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-r.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Album</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-h.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Hình ảnh</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Điểm thi -->
                        <li>
                            <a href="index.html" class="active">
                                <i class="fa fa-sort-numeric-asc icon"><b class="bg-info"></b></i>
                                <span>Điểm thi</span>
                            </a>
                        </li>
                        <!-- Cựu sinh viên -->
                        <li>
                            <a href="#layout">
                                <i class="fa fa-star icon"><b class="bg-info"></b></i>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <span>Cựu sinh viên</span>
                            </a>
                            <ul class="nav lt">
                                <li>
                                    <a href="layout-c.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Cựu sinh viên</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-r.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Lưu bút ra trường</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Người dùng -->
                        <li {{ (Request::is('admin/user/*') || Request::is('admin/account/*')) ? 'class=active' : '' }}>
                            <a href="#layout" {{ (Request::is('admin/user/*') || Request::is('admin/account/*')) ? 'class=active' : '' }}>
                                <i class="fa fa-group icon"><b class="bg-info"></b></i>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <span>Người dùng</span>
                            </a>
                            <ul class="nav lt">
                                <li>
                                    <a href="{{ url('/admin/user/index') }}">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Người dùng</span>
                                    </a>
                                </li>
                                <li {{ (Request::is('admin/account/*')) ? 'class=active' : '' }}>
                                    <a href="{{ url('/admin/account/index') }}" {{ (Request::is('admin/account/*')) ? 'class=active' : '' }}>
                                        <i class="fa fa-angle-right"></i>
                                        <span>Tài khoản</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-r.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Phân quyền</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Hệ thống -->
                        <li>
                            <a href="#layout">
                                <i class="fa fa-cog icon"><b class="bg-info"></b></i>
                                <span class="pull-right">
                                    <i class="fa fa-angle-down text"></i>
                                    <i class="fa fa-angle-up text-active"></i>
                                </span>
                                <span>Hệ thống</span>
                            </a>
                            <ul class="nav lt">
                                <li>
                                    <a href="layout-c.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Lịch sử truy cập hệ thống</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-r.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Cơ cấu tổ chức</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-h.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Chức vụ</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-c.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Khóa học</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-r.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Quảng cáo</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-h.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Sao lưu dữ liệu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="layout-h.html">
                                        <i class="fa fa-angle-right"></i>
                                        <span>Cấu hình hệ thống</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- / nav -->
            </div>
        </section>
        <footer class="footer lt hidden-xs b-t b-dark">
            <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                    <section class="panel bg-white">
                        <header class="panel-heading b-b b-light">Active chats</header>
                        <div class="panel-body animated fadeInRight"><p class="text-sm">No active chats.</p>

                            <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p></div>
                    </section>
                </section>
            </div>
            <div id="invite" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                    <section class="panel bg-white">
                        <header class="panel-heading b-b b-light"> John <i
                                class="fa fa-circle text-success"></i></header>
                        <div class="panel-body animated fadeInRight"><p class="text-sm">No contacts in your
                                lists.</p>

                            <p><a href="#" class="btn btn-sm btn-facebook"><i
                                        class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p></div>
                    </section>
                </section>
            </div>
            <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon"> <i
                    class="fa fa-angle-left text"></i> <i class="fa fa-angle-right text-active"></i> </a>

            <div class="btn-group hidden-nav-xs">

                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark"
                        data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark"
                        data-toggle="dropdown" data-target="#chat"><i class="fa fa-twitter"></i></button>
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark"
                        data-toggle="dropdown" data-target="#chat"><i class="fa fa-google-plus"></i></button>
            </div>
        </footer>
    </section>
</aside>