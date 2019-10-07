@extends('layouts.master')

@section('title', "Create A New Category")

@section('content')

    <div class="col-md-8 blog-main">

        {{-- Status Message --}}
        @include('shared.status-alert')

        {{-- Create Category --}}
        <div class="shadow-sm p-3 mb-5 bg-white rounded">

            <h5 class="pb-3">
                Create A New Category
            </h5>

            {{-- Form --}}
            <form action="{{route('categories.store')}}" method="POST">
                @csrf

                {{-- Category Name --}}
                <div class="form-group">
                    <label for="name">
                        <span class="text-danger">*</span>Name
                    </label>
                    <input type="text" name="name" value="{{old('name')}}" 
                        id="name" class="form-control @error('name') is-invalid @enderror" 
                        aria-describedby="nameHelp" placeholder="Enter category name" 
                        minlength="3" maxlength="128" 
                        autofocus required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small id="nameHelp" class="form-text text-muted">
                        Maximum length is 128 characters.
                    </small>
                </div>

                {{-- Category Description --}}
                <div class="form-group">
                    <label for="description">
                        <span class="text-danger">*</span>Description
                    </label>
                    <textarea name="description" id="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="3" aria-describedby="descriptionHelp" 
                        placeholder="Enter category description" 
                        minlength="3" maxlength="255" 
                        required >{{old('description')}}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small id="descriptionHelp" class="form-text text-muted">
                        Maximum length is 255 characters.
                    </small>
                </div>

                <div class="pt-2">
                    
                    {{-- Submit Form Button --}}
                    <button type="submit" name="submitBtn" value="create" title="Create a New Category" class="btn btn-primary">
                        Create
                    </button>
    
                    {{-- Cancel Creation --}}
                    <a href="{{route('home')}}" title="Cancel and back to the Homepage" class="btn btn-outline-secondary">
                        Cancel
                    </a>

                </div>    

            </form>

        </div>
    </div>
    
@endsection