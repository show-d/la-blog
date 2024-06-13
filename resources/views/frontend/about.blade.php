@extends('layouts.default')
@section("title",'关于')
@section("keywords",$about->meta_keyword)
@section("description",$about->meta_description)

@section("body")

    <div class="row-fluid index-list">
        <div class="span12">
            <p class="blog-post-meta">
                {!! nl2br($about->cat_content) !!}
            </p>
        </div>

    </div>

    @if($cfIsAdmin)
        <button id="" class="btn btn-primary btnEditAbout" data-Page="about">编辑</button>
    @endif

    <hr>

@endsection
