@extends('layouts.master')

@section('title', $post->name)

@section('content')
    <div class="col-md-8 blog-main">
        <h4 class="pb-2 mt-4 font-italic border-bottom">
            {{$post->name}}
        </h3>
        <p>
            {{$post->content}}
        </p>
    </div>
@endsection