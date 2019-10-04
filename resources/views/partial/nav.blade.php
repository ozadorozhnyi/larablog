@if ($categories->count() > 0)
    <div class="nav-scroller py-1">
        <nav class="nav d-flex justify-content-between bg-danger">
            @foreach ($categories as $category)
                <a href="{{route('categories.show', ['category'=>$category->id])}}
                    "title="Goto the Category Page" class="p-2 text-white">
                        {{$category->name}}
                </a>
            @endforeach
        </nav>
    </div>
@else
    <div class="alert alert-warning text-center my-2 p-1" role="alert">
        No categories found here
    </div>
@endif