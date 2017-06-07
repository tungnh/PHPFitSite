<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8"/>
    <title>Quản trị - @yield('title')</title>
    <meta name="description"
          content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    {{ Html::style('css/app.v2.css') }}
    {{ Html::style('css/font.css') }}
    {{ Html::style('js/calendar/bootstrap_calendar.css', ['cache' => 'false']) }}
    {{ Html::style('js/select2/select2.css', ['cache' => 'false']) }}
    {{ Html::style('js/select2/theme.css', ['cache' => 'false']) }}
    {{ Html::style('js/fuelux/fuelux.css', ['cache' => 'false']) }}
    
    <!-- Bootstrap --> <!-- App -->
    {{ Html::script('js/app.v2.js') }}
    
    <!-- Fuelux -->
    {{ Html::script('js/fuelux/fuelux.js', ['cache' => 'false']) }}
    <!-- Charts -->
    {{ Html::script('js/charts/easypiechart/jquery.easy-pie-chart.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/sparkline/jquery.sparkline.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.tooltip.min.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.resize.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/jquery.flot.grow.js', ['cache' => 'false']) }}
    {{ Html::script('js/charts/flot/demo.js', ['cache' => 'false']) }}
    {{ Html::script('js/calendar/bootstrap_calendar.js', ['cache' => 'false']) }}
    {{ Html::script('js/calendar/demo.js', ['cache' => 'false']) }}
    {{ Html::script('js/sortable/jquery.sortable.js', ['cache' => 'false']) }}
    <!-- select2 -->
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
</body>
</html>