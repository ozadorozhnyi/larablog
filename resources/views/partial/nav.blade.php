<div class="nav-scroller py-1 mb-2">
    @if ($categories->count() > 0)
        <nav class="nav d-flex justify-content-between">
            @foreach ($categories as $category)
                <a class="p-2 text-muted" href="/categories/{{$category->id}}" title="{{$category->description}}">
                    {{$category->name}}
                </a>
            @endforeach
        </nav>
    @else
        <p class="d-flex justify-content-center">
            No categories found, sorry :(
        </p>
    @endif
</div>