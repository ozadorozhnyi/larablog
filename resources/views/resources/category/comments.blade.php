@extends('layouts.master')

@section('title', $category->name)

@php $commentsQty = $category->comments->count() @endphp

@section('content')

    <div class="col-md-8 blog-main">
        
        {{-- Status Message --}}
        @include('shared.status-alert')
        
        {{-- Category Meta --}}
        @include('resources.category.meta')
        
        {{-- Post Comments --}}
        <h5 class="py-3" id="comments">
            Comments ({{$commentsQty}})
        </h5>

        {{-- Create Comment Form --}}
        @include('resources.comment.create', [
            'commentableId' => $category->id,
            'commentableType' => 'category'
        ])
        
        @if ($commentsQty > 0)
            <h6 class="ml-4 pt-4">
                Other peoples says:
            </h6>

            {{-- Sort Collection --}}
            @php $sorted = $category->comments->sortByDesc('updated_at') @endphp

            {{-- 
                Combines loops and includes to display all Comments 
                related with the current Category 
            --}}
            @each('resources.comment.index', $sorted, 'comment')    
        @else
            <p class="py-3">
                Be first, who leaves a comment here.
            </p>
        @endif

    </div>

@endsection