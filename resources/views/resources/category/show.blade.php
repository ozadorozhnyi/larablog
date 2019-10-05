@extends('layouts.master')

@section('title', $category->name)

@php $commentsQty = $category->comments->count() @endphp

@section('content')

    <div class="col-md-8 blog-main">

        {{-- Status Message --}}
        @include('shared.status-alert')
        
        {{-- Category Meta --}}
        @include('resources.category.meta')
        
        {{-- Category Posts --}}
        @if ($category->posts->count() > 0)
            {{-- 
                Combines loops and includes to display all Comments 
                related with the current Post 
            --}}
            @each('resources.post.index', $category->posts, 'post')
        @else
            <div class="alert alert-warning" role="alert">
                There is no posts found in this category. It's so sad :(
                {{-- Proposal to create a new post in this category --}}
                <p>
                    But, you can 
                    <a href="{{route('posts.create')}}" title="Create a New Post">
                        create a new post
                    </a>
                    easilly ;)
                </p>
            </div>
        @endif

    </div>
    
@endsection