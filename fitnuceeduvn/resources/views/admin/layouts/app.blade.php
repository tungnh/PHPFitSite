
<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>Quản trị - @yield('title')</title>
    <meta name="description"
          content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    {{ Html::style('css/app.v2.css') }}
    {{ Html::style('css/styles.css') }}
    {{ Html::style('css/font.css') }}
    {{ Html::style('js/calendar/bootstrap_calendar.css', ['cache' => 'false']) }}
    {{ Html::style('js/select2/select2.css', ['cache' => 'false']) }}
    {{ Html::style('js/select2/theme.css', ['cache' => 'false']) }}
    {{ Html::style('js/fuelux/fuelux.css', ['cache' => 'false']) }}
    
    <!-- Bootstrap --> <!-- App -->
    {{ Html::script('js/app.v2.js') }}
    
    <!-- Fuelux -->
    {{ Html::script('js/fuelux/fuelux.js', ['cache' => 'false']) }}
<!--Charts 
    {{ Html::script('js/charts/easypiechart/jquery.easy-pie-chart.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/sparkline/jquery.sparkline.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.tooltip.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.resize.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.grow.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/demo.js', ['cache' => 'false']) }}
    Calendar
    {{ Html::script('js/calendar/bootstrap_calendar.js', ['cache' => 'false']) }}
    {{ Html::script('js/calendar/demo.js', ['cache' => 'false']) }}
    {{ Html::script('js/sortable/jquery.sortable.js', ['cache' => 'false']) }}
    Select2 
    {{ Html::script('js/select2/select2.min.js', ['cache' => 'false']) }}-->
    <!--Select2--> 
    {{ Html::script('js/select2/select2.min.js', ['cache' => 'false']) }}
    <!-- parsley -->
    {{ Html::script('js/parsley/parsley.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/parsley/parsley.extend.js', ['cache' => 'false']) }}
</head>
<body>
<section class="vbox">
    <!-- .header -->
    @include('admin.layouts.header')
    <!-- /.header -->
    <section>
        <section class="hbox stretch"> 
            <!-- .aside -->
            @include('admin.layouts.sidebar')
            <!-- /.aside -->
            <!-- .content -->
            @yield('content')
            <!-- /.content -->
            <aside class="bg-light lter b-l aside-md hide" id="notes">
                <div class="wrapper">Notification</div>
            </aside>
        </section>
    </section>
</section>
<div class="modal fade" id="modal-changepassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>
                        <p>Sign in to meet your friends.</p>
                        <form role="form">
                            <div class="form-group">
                                <label>Email</label> <input type="email" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Password</label> <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="checkbox m-t-lg">
                                <button type="submit" class="btn btn-sm btn-success pull-right text-uc m-t-n-xs">
                                    <strong>Log in</strong></button>
                                <label> <input type="checkbox"> Remember me </label></div>
                        </form>
                    </div>
                    <div class="col-sm-6"><h4>Not a member?</h4>
                        <p>You can create an account <a href="#" class="text-info">here</a></p>
                        <p>OR</p>
                        <a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a> 
                        <a href="#" class="btn btn-twitter btn-block m-b-sm"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a>
                        <a href="#" class="btn btn-gplus btn-block"><i class="fa fa-google-plus pull-left"></i>Sign in with Google+</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>