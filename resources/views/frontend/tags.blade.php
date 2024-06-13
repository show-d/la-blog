@extends('layouts.default')

@section('title','标签')
@section('keywords','')
@section('description','')

@section('body')

    <div class="row-fluid index-list">
        <div class="span12">

            <p class="blog-post-meta">
                @foreach($tagList as $key => $count)
                   <a href="/tags/{{ $key }}" class="badge-c">{{ $key }} &nbsp ({{ $count }})</a>
                @endforeach
            </p>

        </div>
    </div>


{{--    @if($cfIsAdmin)
        <button id="" class="btn btn-primary btnEditAbout" data-Page="tags">Edit</button>
    @endif--}}

    <hr/>
@endsection
