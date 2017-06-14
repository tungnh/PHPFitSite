<?php
    use App\Util\Constants; 
?>
<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
    <meta charset="utf-8" />
    <title>Đăng nhập</title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    {{ Html::style('css/app.v2.css', ['cache' => 'false']) }}
    {{ Html::style('css/font.css', ['cache' => 'false']) }}
</head>
<body>
    <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
        <div class="container aside-xxl">
            <a class="navbar-brand block" href="index.html">Fit.nuce.edu.vn</a>
            <section class="panel panel-default bg-white m-t-lg">
                <header class="panel-heading text-center">
                    <strong>ĐĂNG NHẬP</strong>
                </header>
                <form role="form" data-validate="parsley" method="POST" action="{{ url('/admin/auth/login') }}" class="panel-body wrapper-lg">
                    {{ csrf_field() }}
                    <div class="form-group{{ Session::has(Constants::$SESSION_MSG_ERROR) ? ' has-error' : '' }}">
                        <label class="control-label">Email</label>
                        <input name="email" placeholder="test@example.com" class="form-control input-lg" autofocus
                               value="{{ old('email') }}"
                               data-required="true" data-required-message="<b>Email</b> không được để trống"
                               data-type="email" data-type-email-message="<b>Email</b> nhập sai định dạng">
                        @if (Session::has(Constants::$SESSION_MSG_ERROR))
                            <span class="help-block">
                                <strong>{{ Session::get(Constants::$SESSION_MSG_ERROR) }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mật khẩu</label>
                        <input type="password" name="password" id="inputPassword" placeholder="Mật khẩu" class="form-control input-lg"
                               data-required="true" data-required-message="<b>Mật khẩu</b> không được để trống">
                    </div>
                    <div class="checkbox">
                        <label> <input type="checkbox" name="remember" value="1"> Giữ tôi luôn đăng nhập</label>
                    </div>
                    <a href="{{ url('/admin/auth/password/reset') }}" class="pull-right m-t-xs"><small>Quên mật khẩu?</small></a>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
<!--                    <div class="line line-dashed"></div>
                    <a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a>
                    <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a>
                    <div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Do not have an account?</small></p>
                    <a href="signup.html" class="btn btn-default btn-block">Create an account</a>-->
                </form>
            </section>
        </div>
    </section> <!-- footer -->
    <footer id="footer">
        <div class="text-center padder">
            <p> <small>Khoa Công nghệ thông tin - Trường đại học xây dựng<br>&copy; 2017</small> </p>
        </div>
    </footer>
    <!-- / footer -->
    {{ Html::script('js/app.v2.js') }} <!-- Bootstrap --> <!-- App -->
    <!-- parsley -->
    {{ Html::script('js/parsley/parsley.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/parsley/parsley.extend.js', ['cache' => 'false']) }}
</body>
</html>


<!--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
