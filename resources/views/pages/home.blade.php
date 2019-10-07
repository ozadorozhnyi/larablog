@extends('layouts.master')

@section('title', "Home")

@php $displayCnf = config('app.posts') @endphp

@section('content')

    {{-- Just a Funny Buns --}}
    <div class="container">
        {{-- One Random Post --}}
        @include('partial.jumbotron')

        {{-- Most Commented Posts --}}
        @include('partial.popular')
    </div>

    <div class="col-md-8 blog-main">
        @if ($latest->count() > 0)

            {{-- Sort Collection --}}
            @php $sorted = $latest->sortByDesc('updated_at') @endphp

            {{-- Latest Posts --}}
            <h4 class="pb-2 mt-4 font-italic">
                Latest Posts from {{config('app.marketing_name')}}
            </h4>

            {{-- 
                Combines loops and includes 
                to display all Comments related with the current Post
            --}}
            @each('resources.post.index', $sorted, 'post')

        @else
            <div class="alert alert-warning" role="alert">
                There is no posts found. I'm so sorry :(
            </div>
        @endif
    </div>
@endsection
