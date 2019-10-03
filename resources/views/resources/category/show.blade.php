@extends('layouts.master')

@section('title', $category->name)

@section('content')
    <div class="col-md-8 blog-main">
        <h4 class="pb-2 mt-4 font-italic border-bottom">
            {{$category->name}}
        </h3>
        <p>
            {{$category->description}}
        </p>
    </div>
@endsection