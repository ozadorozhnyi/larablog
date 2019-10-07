@extends('layouts.master')

@section('title', "Create A New Post")

@section('content')

    <div class="col-md-8 blog-main">

        @if ($categories->count() > 0)

            {{-- Status Message --}}
            @include('shared.status-alert')
    
            {{-- Create Category --}}
            <div class="shadow-sm p-3 mb-5 bg-white rounded">
    
                <h5 class="pb-3">
                    Create A New Post
                </h5>
    
                {{-- Form --}}
                <form action="{{route('posts.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
    
                    {{-- Post Category --}}
                    <div class="form-group">
                        <label for="category_id">
                            <span class="text-danger">*</span>Choose Category
                        </label>
                        <select name="category_id" id="category_id" class="form-control" autofocus>
                            @foreach ($categories as $cat)
                                <option value="{{(int)$cat->id}}">
                                    {{$cat->name}}
                                </option>    
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small id="categoryHelp" class="form-text text-muted">
                            Every post should be assigned to the category.
                        </small>
                    </div>
    
                    {{-- Post Name --}}
                    <div class="form-group">
                        <label for="name">
                            <span class="text-danger">*</span>Name
                        </label>
                        <input type="text" name="name" value="{{old('name')}}" 
                            id="name" class="form-control @error('name') is-invalid @enderror" 
                            aria-describedby="nameHelp" placeholder="Enter post name" 
                            minlength="3" maxlength="255" 
                            required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small id="nameHelp" class="form-text text-muted">
                            Maximum length is 255 characters.
                        </small>
                    </div>
    
                    {{-- Post Content --}}
                    <div class="form-group">
                        <label for="content">
                            <span class="text-danger">*</span>Content
                        </label>
                        <textarea name="content" id="content" 
                            class="form-control @error('content') is-invalid @enderror" 
                            rows="6" 
                            aria-describedby="contentHelp" 
                            placeholder="Enter post content" 
                            minlength="10" required >{{old('content')}}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small id="contentHelp" class="form-text text-muted">
                            Min length is 10 characters.
                        </small>
                    </div>

                    {{-- Post Uploaded File --}}
                    @include('resources.post.manage-uploads')
    
                    <div class="pt-4">
                        
                        {{-- Submit Form Button --}}
                        <button type="submit" name="submitBtn" value="create" 
                            title="Create a New Post" class="btn btn-primary">
                            Create
                        </button>
        
                        {{-- Cancel Creation --}}
                        <button type="button" onclick="window.history.go(-1); return false;" 
                            title="Cancel creation" class="btn btn-outline-secondary">
                            Cancel
                        </button>
    
                    </div>    
    
                </form>
            </div>
        @else
            {{-- You cannot create a new post if there are no categories in the application --}}
            <p class="alert alert-primary py-2">
                You cannot create a new post if there are no categories in the application.
                <br>Please, 
                <a href="{{route('categories.create')}}" title="Create a New Category">
                    create a new category
                </a> before.
            </p>
        @endif
    </div>
    
@endsection

{{-- Custom JavaScript Code --}}
@section('javascript')
    @parent
    {{-- Hide Status Message --}}
    <script>
        $('#postUpload').on('change',function(){
            // Get the file name.
            var fileName = $(this).val();

            // Remove C:\fakepath\ from the file name.
            fileName = fileName.replace('C:\\fakepath\\', "");

            // Replace the "Choose a file" label.
            $(this).next('.custom-file-label').text(fileName);
        })
    </script>
@endsection