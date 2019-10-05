<header class="blog-header py-3 bg-light text-dark">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">&nbsp;</div>
        {{-- Yankee go home --}}
        <div class="col-4 text-center">
            <a href="{{route('home')}}" title="Go to the blog home page" class="blog-header-logo text-dark">
                {{config('app.marketing_name')}}
            </a>
        </div>
        {{-- Create A New Category (Qweek Link) --}}
        <div class="col-4 d-flex justify-content-end align-items-center">
            <a href="{{route('categories.create')}}" title="Create a New Category" class="btn btn-sm btn-outline-success mr-4">
                Create A New Category
            </a>
        </div>
    </div>
</header>