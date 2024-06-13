{{--define "title"--}}{{--end--}}
{{--define "keywords"--}}{{-- .categoryModel.MetaKeyword--}}{{--end--}}
{{--define "description"--}}{{-- .categoryModel.MetaDescription --}}{{--end--}}

@section('title', '首页')
@section('keywords', 'Index keywords')
@section('description', 'Index description')
@extends('layouts.default')

@section('body')
    <div class="row-fluid index-list">
        <div class="span12">

            {{--if .haveData--}}

            @foreach( $contentList as $v)

                <h4><a href="/field/{{$v->html_name}}" class="title">{{ $v->title }}</a></h4>
                <p class="blog-post-meta">
                    <span class="date">{{ $v-> publish_time }}</span>

                    {{--/*<i class="icon-remove icon-tags"></i>*/--}}
                    {{-- range $index, $tag := cfSplit .Keyword "," --}}
                    <a href="/tags/{{-- $tag --}}" class="tag">{{-- $tag --}}</a>
                {{-- end --}}

                @if($cfIsAdmin)
                    <div class="top-nav li-bo">
                        <ul>
                            <li>
                                <form action="/{{$cfAdminPath}}/deleteContentAction" method="post">
                                    <button type="submit" class="span uneditable-input btn btnDeleteContent">
                                        <i class="icon-remove icon-remove"></i>
                                    </button>
                                    @csrf
                                    <input type="hidden" name="content_id" value="{{$v->content_id}}"/>
                                </form>
                            </li>
                            <li>
                                <button type="button" class="btn btnEdit" data-contentId="{{$v->content_id}}"/>
                                <i class="icon-remove icon-edit"></i>
                                编辑
                                </button>
                            </li>
                            <li>
                                <label for="" class="btn ">
                                    <i class="icon-remove icon-circle-arrow-up"></i>
                                    {{$v->hits}}
                                </label>
                            </li>
                            <li>
                                @if($v->status == -1)
                                    <label class="span uneditable-input btn btn-danger">
                                        trash
                                    </label>
                                @elseif($v->status == 1)
                                    <label class="span uneditable-input btn ">
                                        <i class="icon-remove icon-bell"></i>草稿
                                    </label>
                                @else
                                    @if($v->publish_time >$cfUnixTimestamp)
                                        <label class="span uneditable-input btn btn-warning">待发布</label>
                                    @endif
                                @endif
                            </li>

                        </ul>
                    </div>
                @endif

                <hr>
            @endforeach


            {{--if gt .pageCount 1--}}
            <div class="pagination pagination-centered">

                {{ $contentList->links()}}
                {{--                <ul>
                                    --}}{{--/*<li><a href="#">«</a></li>*/--}}{{--
                                    --}}{{--- range $pageIndex := cfLoop64 1 .pageCount--}}{{--
                                    <li><a href="/--}}{{--  $pageIndex --}}{{--">--}}{{--  $pageIndex --}}{{--</a></li>
                                    --}}{{--- end --}}{{--
                                    --}}{{--/*<li><a href="#">»</a></li>*/--}}{{--
                                </ul>--}}
            </div>
            {{--end--}}

            {{--else--}}

            @if(!$contentList)
                无数据.
            @endif

            {{--end--}}

        </div>
    </div>
    <hr/>
    {{--end--}}
@endsection

