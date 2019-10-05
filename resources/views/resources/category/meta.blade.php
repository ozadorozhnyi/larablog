{{-- Category Meta --}}
<div class="list-group mb-3">
    <div class="list-group-item list-group-item-action shadow-sm p-3 rounded">
        <div class="row">
            {{-- Category Name --}}
            <div class="col">
                <a href="{{route('categories.show', ['category'=>$category->id])}}" title="Go back to the Category Show Page" class="text-muted">
                    <h5 class="mb-2">
                        {{$category->name}}
                    </h5>
                </a>
            </div>
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
                        {{-- List Categories Comments --}}
                        <a href="{{route('categories.comments', ['category'=>$category->id])}}#comments" title="Goto the Category Comments List" class="text-white">
                            {{$commentsQty}} comments
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <h6 class="p-3 border-top bg-light text-dark font-italic">
            {{$category->description}}
        </h6>
    </div>
</div>