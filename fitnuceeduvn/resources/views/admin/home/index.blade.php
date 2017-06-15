@extends('admin.layouts.app')

@section('title', 'Trang chủ')

@section('content')
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li class="active">Workset</li>
            </ul>
            <div class="m-b-md"><h3 class="m-b-none">Workset</h3>
                <small>Welcome back, Noteman</small>
            </div>
            <div>
                <div class="btn-group m-b" data-toggle="buttons"><label
                        class="btn btn-sm btn-default active"> <input type="radio" name="options"
                                                                  id="option1"> Timeline </label> <label
                        class="btn btn-sm btn-default"> <input type="radio" name="options" id="option2">
                        Activity </label></div>
                <section class="comment-list block">
                    <article id="comment-id-1" class="comment-item"><span class="fa-stack pull-left m-l-xs"> <i
                                class="fa fa-circle text-info fa-stack-2x"></i> <i
                                class="fa fa-play-circle text-white fa-stack-1x"></i> </span>
                        <section class="comment-body m-b-lg">
                            <header><a href="#"><strong>John smith</strong></a> shared a <a href="#"
                                                                                            class="text-info">video</a>
                                to you <span class="text-muted text-xs"> 24 minutes ago </span></header>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque
                                quam.
                            </div>
                        </section>
                    </article>
                    <!-- .comment-reply -->
                    <article id="comment-id-2" class="comment-reply">
                        <article class="comment-item"><a class="pull-left thumb-sm"> <img
                                    src="images/avatar_default.jpg" class="img-circle"> </a>
                            <section class="comment-body m-b-lg">
                                <header><a href="#"><strong>John smith</strong></a> <span
                                        class="text-muted text-xs"> 26 minutes ago </span></header>
                                <div> Morbi id neque quam. Aliquam.</div>
                            </section>
                        </article>
                        <article class="comment-item"><a class="pull-left thumb-sm"> <img
                                    src="images/avatar.jpg" class="img-circle"> </a>
                            <section class="comment-body m-b-lg">
                                <header><a href="#"><strong>Mike</strong></a> <span
                                        class="text-muted text-xs"> 26 minutes ago </span></header>
                                <div>Good idea.</div>
                            </section>
                        </article>
                    </article>
                    <!-- / .comment-reply -->
                    <article id="comment-id-3" class="comment-item"><span class="fa-stack pull-left m-l-xs"> <i
                                class="fa fa-circle text-danger fa-stack-2x"></i> <i
                                class="fa fa-file-o text-white fa-stack-1x"></i> </span>
                        <section class="comment-body m-b-lg">
                            <header><a href="#"><strong>John Doe</strong></a> <span
                                    class="text-muted text-xs"> 1 hour ago </span></header>
                            <div>Lorem ipsum dolor sit amet, consecteter adipiscing elit.</div>
                        </section>
                    </article>
                    <article id="comment-id-4" class="comment-item"><span class="fa-stack pull-left m-l-xs"> <i
                                class="fa fa-circle text-success fa-stack-2x"></i> <i
                                class="fa fa-check text-white fa-stack-1x"></i> </span>
                        <section class="comment-body m-b-lg">
                            <header><a href="#"><strong>Jonathan</strong></a> completed a task <span
                                    class="text-muted text-xs"> 1 hour ago </span></header>
                            <div>Consecteter adipiscing elit.</div>
                        </section>
                    </article>
                </section>
                <a href="#" class="btn btn-default btn-sm m-b"><i class="fa fa-plus icon-muted"></i>
                    more</a></div>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection