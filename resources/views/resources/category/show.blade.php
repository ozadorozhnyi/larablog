@extends('layouts.master')

@section('title', $category->name)

@section('content')
    <div class="col-md-8 blog-main">
        {{-- Status Message --}}
        @include('shared.status-alert')
        {{-- Category Header --}}
        <div class="list-group mb-3">
            <div class="list-group-item list-group-item-action shadow-sm p-3 rounded">
                <div class="row">
                    <div class="col">
                        <h5 class="mb-2">
                            {{$category->name}}
                        </h5>
                    </div>
                    {{-- Category Meta --}}
                    <div class="col">
                        <div class="d-flex w-100 justify-content-end">
                            {{-- Created At --}}
                            <span class="badge badge-secondary ml-2 font-weight-normal">
                                {{$category->created_at->format('M d, Y')}}
                            </span>
                            {{-- Posts Qty --}}
                            <span class="badge badge-info ml-2 font-weight-normal">
                                {{$category->posts->count()}} posts
                            </span>
                            {{-- Comments Qty --}}
                            <span class="badge badge-warning ml-2 font-weight-normal">
                                {{$category->comments->count()}} comments
                            </span>
                        </div>
                    </div>
                </div>
                <h6 class="p-3 border-top bg-light text-dark font-italic">
                    {{$category->description}}
                </h6>
            </div>
        </div>
        @if ($category->posts->count() > 0)
            {{-- 
                Category Posts

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