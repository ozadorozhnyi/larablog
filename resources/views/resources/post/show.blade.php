@extends('layouts.master')

@section('title', $post->name)

@php 
    $categoryUrl = route('categories.show', ['category'=>$post->category->id]);
    $categoryName = strtoupper($post->category->name) ;

    $postUrl = route('posts.show', ['post'=>$post->id]);
    $commentsQty = (int)$post->comments->count();
@endphp

@section('content')
    <div class="post-item col-md-8 blog-main">
        {{-- Post Name --}}
        <h4 class="blog-post-title py-2 border-bottom">
            {{$post->name}}
        </h4>
        {{-- Post Meta --}}
        <div class="row blog-post-meta pt-1">
            <div class="col text-left">
                {{-- Created At --}}
                <span class="badge badge-secondary font-weight-normal">
                    {{$post->created_at->diffForHumans()}}
                </span>
                {{-- Comments Qty --}}
                <span class="badge badge-warning font-weight-normal">
                    <a href="{{$postUrl}}#comments" title="Start reading comments for this post">
                        {{$commentsQty}} comments
                    </a>
                </span>
                {{-- Category Assigned To --}}
                <span class="badge badge-light font-weight-normal">
                    <a href="{{$categoryUrl}}" title="Go To the all category posts" class="text-success">
                        {{$categoryName}}
                    </a>
                </span>
                {{-- Download Attached --}}
                <span class="badge badge-light font-weight-normal">
                    <a href="/downloads/{{md5($post->name)}}">
                        Download File ({{rand(3,198)}}.{{rand(11,99)}}Mb)
                    </a>
                </span>
            </div>
        </div>
        {{-- Post Content --}}
        <p class="border-bottom py-4 ">
            {{-- Stock Photo Assigned --}}
            <img src="https://picsum.photos/{{rand(300, 425)}}/{{rand(280, 320)}}" alt="{{$post->name}}" title="{{$post->name}}" class="p-2 float-sm-left border mr-2">
            {{$post->content}}
        </p>
        {{-- Post Comments --}}
        <h5 class="py-3" id="comments">
            Comments ({{$commentsQty}})
        </h5>
        {{-- Create Comment Form --}}
        @include('resources.comment.create')
        @if ($commentsQty > 0)
            <h6 class="ml-4 pt-4">
                Other peoples says:
            </h6>
            {{-- 
                Combines loops and includes to display all Comments 
                related with the current Post 
            --}}
            @each('resources.comment.index', $post->comments, 'comment')    
        @else
            <p class="py-3">
                Be first, who leaves a comment for this post.
            </p>
        @endif
    </div>
@endsection