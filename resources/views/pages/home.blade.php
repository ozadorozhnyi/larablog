@extends('layouts.master')

@section('title', "Home")

@section('content')
    {{-- Just a Funny Buns --}}
    <div class="container">
        @include('partial.jumbotron')
        @include('partial.popular')
    </div>
    <div class="col-md-8 blog-main">
        <h4 class="pb-2 mt-4 font-italic border-bottom">
            Latest Posts from {{config('app.marketing_name')}}
        </h4>
        @php $displayCnf = config('app.posts') @endphp
        @if ($latest->count() > 0)
            @foreach ($latest as $post)
                @php 
                    $categoryUrl = route('categories.show', ['category'=>$post->category->id]);
                    $categoryName = $post->category->name;

                    $postUrl = route('posts.show', ['post'=>$post->id]);
                    $postContent = Str::words($post->content, 250, '...');
                @endphp
                <div class="blog-post">
                    {{-- Post Name --}}
                    <h3 class="blog-post-title">
                        <a href="{{$postUrl}}" title="Read entire post">
                            {{$post->name}}
                        </a>
                    </h3>
                    {{-- Post Meta --}}
                    <p class="blog-post-meta">
                        {{$post->created_at->diffForHumans()}}
                        <span class="text-muted">|</span>
                        <a href="{{$categoryUrl}}" title="Show all posts in this category" class="text-success">
                            {{$post->category->name}}
                        </a>
                        <span class="text-muted">|</span>
                        <strong>{{$post->comments_count}}</strong> comments
                    </p>
                    {{-- Post Content, truncated --}}
                    <p>{{ $postContent }}</p>
                    {{-- Welcome under the cut --}}
                    <a href="{{$postUrl}}" title="{{$post->name}}" class="mt-2 d-block">
                        Continue reading
                    </a>
                </div>
                <hr class="pb-4">
            @endforeach
        @else
            <p>
                There is no posts found from {{config('app.marketing_name')}}
            </p>
        @endif
    </div>
@endsection
