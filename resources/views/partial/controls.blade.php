@php $currentRouteName = Route::currentRouteName() @endphp
@switch($currentRouteName)
    {{-- Manage Post Resource --}}
    @case("posts.show")
        @php $resourceType = 'Post' @endphp
        <h5 class="pl-4">
            Manage {{$resourceType}} Resource
        </h5>
        <div class="p-4 mb-3 bg-light rounded">
            <div class="list-group list-group-flush">
                {{-- Create a New Post --}}
                <a href="{{route('posts.create')}}" title="Create a New Post" class="list-group-item list-group-item-action text-primary">
                    Create a New Post
                </a>
                {{-- Edit Current Post --}}
                <a href="{{route('posts.edit', ['post'=>$post->id])}}" title="Edit Current Post" class="list-group-item list-group-item-action text-primary">
                    Edit Current Post
                </a>
                {{-- Remove the Post --}}
                <span>
                    <form action="{{route('posts.destroy',['post'=>$post->id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        @php
                            $removeTitle = "Remove this post and all related information";
                            $removeConfirmText = "Are you sure about whatever it is you are doing?";
                        @endphp
                        <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action text-primary">
                            Remove Post
                        </button>
                    </form>
                </span>
                {{-- Remove Uploaded File --}}
                @if ((int)$post->file->count() > 0)
                    <span>
                        <form action="{{route('posts.uploads.destroy',['post'=>$post->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @php
                                $removeTitle = "Remove uploaded file, related to this post";
                                $removeConfirmText = "Are you sure about whatever it is you are doing?";
                            @endphp
                            <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action text-primary">
                                Remove Uploaded File
                            </button>
                        </form>
                    </span>
                @endif
                {{-- Remove Post Comments Only --}}
                @if ((int)$post->comments->count() > 0)
                    <span>
                        <form action="{{route('posts.comments.destroy',['post'=>$post->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @php
                                $removeTitle = "Remove all comments, related to this post";
                                $removeConfirmText = "Are you sure about whatever it is you are doing?";
                            @endphp
                            <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action text-primary">
                                Remove Post Comments
                                <span class="badge badge-primary">
                                    {{$post->comments->count()}}
                                </span>
                            </button>
                        </form>
                    </span>
                @endif
            </div>
        </div>
    @break

    {{-- Manage Category Resource --}}
    @case("categories.show")
        @php $resourceType = 'Category' @endphp
        <h5 class="pl-4">
            Manage {{$resourceType}} Resource
        </h5>
        <div class="p-4 mb-3 bg-light rounded">
            <div class="list-group list-group-flush">
                {{-- Create a New Category --}}
                <a href="{{route('categories.create')}}" title="Create a New Category" class="list-group-item list-group-item-action text-primary">
                    Create a New Category
                </a>
                {{-- Edit Current Category --}}
                <a href="{{route('categories.edit', ['category'=>$category->id])}}" title="Edit Current Category" class="list-group-item list-group-item-action text-primary">
                    Edit Current Category
                </a>
                {{-- Remove the Category --}}
                <span>
                    <form action="{{route('categories.destroy',['category'=>$category->id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        @php
                            $removeTitle = "Remove this category and all related information";
                            $removeConfirmText = "Are you sure about whatever it is you are doing?";
                        @endphp
                        <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action  text-primary">
                            Remove Category
                        </button>
                    </form>
                </span>
                {{-- Remove Category Posts Only --}}
                @if ((int)$category->posts->count() > 0)
                    <span>
                        <form action="{{route('categories.posts.destroy',['category'=>$category->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @php
                                $removeTitle = "Remove all posts from this category";
                                $removeConfirmText = "Are you sure about whatever it is you are doing?";
                            @endphp
                            <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action  text-primary">
                                Remove Category Posts 
                                <span class="badge badge-primary">
                                    {{$category->posts->count()}}
                                </span>
                            </button>
                        </form>
                    </span>
                @endif
                {{-- Remove Category Comments Only --}}
                @if ((int)$category->comments->count() > 0)
                    <span>
                        <form action="{{route('categories.comments.destroy',['category'=>$category->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            @php
                                $removeTitle = "Remove all comments, related to this category";
                                $removeConfirmText = "Are you sure about whatever it is you are doing?";
                            @endphp
                            <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action  text-primary">
                                Remove Category Comments
                                <span class="badge badge-primary">
                                    {{$category->comments->count()}}
                                </span>
                            </button>
                        </form>
                    </span>
                @endif
            </div>
        </div>
    @break

@endswitch