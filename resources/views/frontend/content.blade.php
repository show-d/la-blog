@extends('layouts.default')

@section('title',$content->title)
@section('keywords',$content->keyword)
@section('description',$content->description)

@section('body')
    <div class="row-fluid index-list">
        <div class="span12 content-container">
            <h1><a class="title"> {{$content->title}}</a></h1>
            <p class="blog-post-meta">
                <span class="date"> {{$content->publish_time}}</span>

                <i class="icon-remove icon-tags" title="tags"></i>
                @foreach( explode(',',$content->keyword) as $item)
                    <a href="/tags/{{ $item }}" class="tag">{{ $item }}</a>
                @endforeach

                &nbsp;
                <i class="icon-remove icon-folder-open" title="category"></i>
                <a href="/category/{{ $category->cat_name }}" class="category">{{$category->cat_name}} </a>
            </p>
            <div class="content">

                {!! $content->content !!}

            </div>

        </div>
        @if($cfIsAdmin)

            <div class="top-nav">
                <ul>
                    <li>
                        <form action="/{{$cfAdminPath}}/deleteContentAction" method="post">
                            <button type="submit" class="span uneditable-input btn btnDeleteContent">
                                <i class="icon-remove icon-remove"></i>
                            </button>
                            <input type="hidden" name="content_id" value="{{$content->content_id}}"/>
                        </form>
                    </li>
                    <li>
                        <button type="button" class="btn btnEdit" data-contentId="{{$content->content_id}}"/>
                        <i class="icon-remove icon-edit"></i>
                        编辑
                        </button>
                    </li>
                    <li>
                        <label for="" class="btn ">
                            <i class="icon-remove icon-circle-arrow-up"></i>
                            {{$content->hits}}
                        </label>
                    </li>
                    <li>
                        @if ($content->status == -1)
                            <label class="span uneditable-input btn btn-danger">
                                trash
                            </label>
                        @elseif($content->status == 1)
                            <label class="span uneditable-input btn ">
                                <i class="icon-remove icon-bell"></i>draft
                            </label>
                        @else
                            @if($content->publish_time> $cfUnixTimestamp)
                                <label class="span uneditable-input btn btn-warning">to be published</label>
                            @endif
                        @endif
                    </li>

                </ul>
            </div>

        @endif

        <hr>
        {{--*------------------------------------------------------*--}}
        <div class="span12 content-comment">
            <h4>评论列表</h4>
            <div id="commentList">
                @foreach($commentList as $v)
                    <span>
                    <p class="comment-user-region">
                        <a href="{{$v->site_url}}" target="_blank">{{$v->user_name}}</a>
                        <span class="date2">{{$v->input_time}}</span>
                        <span class="address">{{$v->address}}</span>
                        @if($cfIsAdmin)
                            <label class="btn btn-mini btn-danger btnRemove" data-commentId="{{$v->comment_id}}">
                                删除
                            </label>
                        @endif
                    </p>
                    <p class="comment-block">
                        {{$v->comment}}
                    </p>

                    <hr class="dotted"/>
                    </span>
                @endforeach
            </div>

            <button type="button" class="btn btn-success show-comment-form">发表评论</button>
            <hr/>

            <form id="formComment" method="post">
                <p>
                    <label for="">您的大名:</label> <input name="user_name" type="text"/>
                    <span class="red">*</span>
                </p>
                <p>
                    <label for="">邮箱:</label> <input name="email" type="text"/>
                </p>
                <p>
                    <label for="">个人主页:</label> <input name="site_url" type="text"/>
                </p>

                <p>
                    <label for="">评论内容:</label>
                    <textarea name="comment" class="category-textarea"></textarea>
                    <span class="red">*</span>
                </p>

                <p><label for="">验证码:</label>
                    <input name="captchaCode" type="text" maxlength="5" autocomplete="off"/>
                    <span class="red">*</span>
                </p>
                <p>
                    <img id="captchaImg" src="" alt="captcha" title="点击刷新验证码"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                </p>

                <p>
                    <input type="hidden" name="content_id" id="hidContentId" value="{{$content->content_id}}">
                    <button type="button" class="btn btn-success" name="doSubmit" id="btnComment">提交
                    </button>
                </p>

                </ul>
            </form>

        </div>
        {{-- /*------------------------------------------------------*/ --}}

    </div>

    {{--
    <input type="hidden" name="content_id" id="hidContentId" value="{{$content->content_id}}"/>
--}}
    <hr>

@endsection

@section("css")
    <link rel="stylesheet" href="{{asset('js/highlight/styles/github.min.css?v=')}} {{$cfRandom }}">
    <link rel="stylesheet" href="{{asset('js/highlight/highlightjs-line-numbers.css?v=')}} {{$cfRandom }}">
@endsection

@section("javascript")
    <script src="{{asset('js/navigation.js?v=')}}{{$cfRandom }}"></script>
    <script src="{{asset('js/highlight/highlight.min.js?v=')}}{{$cfRandom }}"></script>
    <script src="{{asset('js/highlight/highlightjs-line-numbers.min.js?v=')}}{{$cfRandom }}"></script>
    <script src="{{asset('js/comment.js?v=')}}{{$cfRandom }}"></script>
    <script type="text/javascript">
        hljs.highlightAll();
        hljs.initLineNumbersOnLoad();
    </script>
@endsection
