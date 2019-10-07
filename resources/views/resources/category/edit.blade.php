@extends('layouts.master')

@section('title', "Edit Category")

@section('content')

    <div class="col-md-8 blog-main">

        {{-- Status Message --}}
        @include('shared.status-alert')

        {{-- Edit Category --}}
        <div class="shadow-sm p-3 mb-5 bg-white rounded">

            <h5 class="pb-3">
                Edit Category
            </h5>

            {{-- Form --}}
            <form action="{{route('categories.update', ['category'=>$category->id])}}" method="POST">
                @method('PATCH')
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label for="name">
                        <span class="text-danger">*</span>Name
                    </label>
                    <input type="text" name="name" value="{{$category->name}}" id="name" class="form-control @error('name') is-invalid @enderror" aria-describedby="nameHelp" placeholder="Enter category name" minlength="3" maxlength="128" autofocus required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small id="nameHelp" class="form-text text-muted">
                        Maximum length is 128 characters.
                    </small>
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label for="description">
                        <span class="text-danger">*</span>Description
                    </label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" aria-describedby="descriptionHelp" placeholder="Enter category description" minlength="3" maxlength="255" required >{{$category->description}}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small id="descriptionHelp" class="form-text text-muted">
                        Maximum length is 255 characters.
                    </small>
                </div>

                {{-- Created At --}}
                <div class="form-group">
                    <label for="created_at">
                        Created At
                    </label>
                    <input class="form-control" type="text" placeholder="{{$category->created_at->format('M d, Y')}}" disabled readonly>
                </div>

                {{-- Updated At --}}
                <div class="form-group">
                    <label for="created_at">
                        Last Updated At
                    </label>
                    <input class="form-control" type="text" placeholder="{{$category->created_at->diffForHumans()}}" disabled readonly>
                </div>
                
                <div class="pt-2">

                    {{-- Submit Form --}}
                    <button type="submit" name="submitBtn" value="update" title="Update Category" class="btn btn-primary">
                        Update
                    </button>
    
                    {{-- Cancel Updating --}}
                    <a href="{{route('categories.show', ['category'=>$category->id])}}" title="Back to the Category Page" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    
                </div>

            </form>

        </div>
    </div>

@endsection