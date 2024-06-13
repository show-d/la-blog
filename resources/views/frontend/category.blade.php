@extends('layouts.default')
@section('title','目录分类')
@section('keywords','')
@section('description','')


@section("body")

    <div class="row-fluid index-list">
        <div class="span12">

            <div class="blog-post-meta">
                @foreach($categoryList as $v)
                    <div>
                        <a href="/category/{{urlencode($v->cat_name ) }}" class="badge-cat">{{$v->cat_name }} &nbsp;
                            ({{$v->article_count}})</a>
                        @if($cfIsAdmin)
                            <button class="btn btn-primary btnEditAbout" data-Page="{{$v->cat_name }}">编辑</button>
                            <p></p>

                        @endif
                    </div>
                    <div style="clear: both"></div>
                @endforeach
            </div>

        </div>
    </div>


    @if($cfIsAdmin)
        <button id="" class="btn btn-primary btnEditAbout" data-Page="">创建新目录</button>
    @endif

<hr/>

@endsection
