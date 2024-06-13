<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> @yield('title') {{$siteName}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <link href="{{asset('/favicon.ico')}}" rel="shortcut icon" type="image/x-icon"/>

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('/bootstrap/css/bootstrap.css?v=')}}{{$cfRandom}}"/>

    <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="{{asset('/bootstrap/css/bootstrap-ie6.css?v=')}}{{$cfRandom}}"/>
        <![endif]-->
    <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="{{asset('/bootstrap/css/ie.css?v=')}}{{$cfRandom}}"/>
        <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('/css/bloggo.css?v=')}}{{$cfRandom}}"/>

    @yield("css")

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="{{asset('/js/html5shiv.min.js?v=')}}{{$cfRandom}}"></script>
        <![endif]-->

    <!-- Fav and touch icons -->
    {{--/*<link rel="apple-touch-icon" href="/img/192X192.png">*/--}}

</head>
<body>
{{--{{ session('member.user_name') }}
{{ session('isAdmin') }}
<hr/>
{{$cfIsAdmin}}--}}
<div class="container-narrow">
    <div class="masthead">
        <ul class="nav nav-pills pull-right">
            <li><a href="/">首页</a></li>
            <li><a href="/category">目录</a></li>
            <li><a href="/tags">标签</a></li>
            <li><a href="/about">关于</a></li>
            @if(!$cfIsAdmin )
                <li><a href="/{{$cfAdminPath}}/signIn">登录</a></li>
            @endif
        </ul>
        <h3 class="muted"><a href="/">{{$siteName}}</a></h3>
    </div>

    @if($cfIsAdmin)
        <div class="top-nav">
            <ul>
                <li>
                    <input type="hidden" id="hidBloggoPath" value="{{$cfAdminPath}}">
                    <form action="/signOutAction" method="post">
                        <input type="submit" class="btn btn-info" name="doSubmit" value="退出"/>
                        @csrf
                    </form>
                </li>
                <li>
                    <button class="btn">欢迎, <a href="/{{$cfAdminPath}}">{{ $cfMember->user_name }}</a>
                    </button>
                </li>
                <li>
                    <button type="button" class="btn btn-inverse" id="btnCompose">发表博文</button>
                </li>

            </ul>
        </div>
    @endif

    <hr/>

    @yield("body")
    <!--
                  <form class="navbar-search" action="">
                    <input type="text" class="search-query span2" placeholder="Search">
                  </form>
                   <hr>-->
    <div class="footer">

        <p class="feed">
            <a id="scrollToTop" title="回到顶部">▲</a>&nbsp;&nbsp;
            <a target="_blank" title="Rss feed">Rss</a>&nbsp;&nbsp;
            <a target="_blank" title="Atom feed">Atom</a>
        </p>
        <p><span class="hearts">&hearts;</span>
            Powered by <i class="project" title="a project created in golang.">La-Blog</i>, a project created in
            Laravel.
        </p>
        <p>&copy; {{$siteName}} {{$cfYear}} </p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
    </div>

</div> <!-- /container -->

<script type="text/javascript" src="{{asset('/js/jquery.min.js?v=')}}{{$cfRandom}}"></script>
<script type="text/javascript" src="{{asset('/bootstrap/js/bootstrap.js?v=')}}{{$cfRandom}}"></script>
<!--[if lte IE 6]>
    <script type="text/javascript" src="{{asset('/js/bootstrap-ie.js?v=')}}{{$cfRandom}}"></script>
    <![endif]-->
<script type="text/javascript" src="{{asset('/js/layer.js?v=')}}{{$cfRandom}}"></script>
<script type="text/javascript" src="{{asset('/js/public.js?v=')}}{{$cfRandom}}"></script>
<script type="text/javascript" src="{{asset('/js/bloggo.js?v=')}}{{$cfRandom}}"></script>
@yield('javascript')
</body>
</html>
{{--end--}}
