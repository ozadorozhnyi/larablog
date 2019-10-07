@extends('layouts.master')

@section('title', $post->name)

@php 
    $categoryUrl = route('categories.show', ['category'=>$post->category->id]);
    $categoryName = strtoupper($post->category->name) ;
    
    $postUrl = route('posts.show', ['post'=>$post->id]);
    $commentsQty = (int)$post->comments->count();
@endphp

@section('content')

    <div class="col-md-8">

        {{-- Shadow Block --}}
        <div class="shadow-sm px-3 pt-3 pb-1 mb-4 bg-white rounded">

            {{-- Post Name --}}
            <h4 class="blog-post-title py-2 border-bottom">
                {{$post->name}}
            </h4>
            
            {{-- Post Meta --}}
            @include('resources.post.meta')
    
            {{-- Post Content --}}
            <div class="clearfix">
                {{-- Stock Photo Assigned --}}
                <img src="https://picsum.photos/{{rand(300, 425)}}/{{rand(280, 320)}}" alt="{{$post->name}}" title="{{$post->name}}" class="float-left mr-2 p-2 border">
                
                {{-- Full Post Content --}}
                <p>{{$post->content}}</p>
            </div>

        </div>

        {{-- Post Comments --}}
        @include('resources.post.comments')

    </div>

@endsection