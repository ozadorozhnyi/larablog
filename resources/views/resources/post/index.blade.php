@php 
    $categoryUrl = route('categories.show', ['category'=>$post->category->id]);
    $categoryName = strtoupper($post->category->name) ;

    $postUrl = route('posts.show', ['post'=>$post->id]);
    $postContent = Str::words($post->content, 190, '...');
    $commentsQty = (int)$post->comments->count();
@endphp
<div class="post-item shadow-sm px-3 pt-3 pb-1 mb-4 bg-white rounded">
    {{-- Post Name --}}
    <a href="{{$postUrl}}" title="Read the entire post" class="text-body">
        <h4 class="blog-post-title py-2 border-bottom">
            {{$post->name}}
        </h4>
    </a>
    {{-- Post Meta --}}
    <div class="row blog-post-meta pb-3">
        <div class="col text-left">
            {{-- Created At --}}
            <span class="badge badge-secondary font-weight-normal">
                {{$post->created_at->diffForHumans()}}
            </span>
            {{-- Comments Qty --}}
            <span class="badge badge-warning font-weight-normal">
                <a href="{{$postUrl}}#comments" title="Start reading comments for this post">
                    {{$commentsQty}} comments
                </a>
            </span>
            {{-- Category Assigned To --}}
            <span class="badge badge-light font-weight-normal">
                <a href="{{$categoryUrl}}" title="Go To the all category posts" class="text-success">
                    {{$categoryName}}
                </a>
            </span>
            {{-- Download Attached --}}
            <span class="badge badge-light font-weight-normal">
                <a href="/downloads/{{md5($post->name)}}">
                    Download File ({{rand(3,198)}}.{{rand(11,99)}}Mb)
                </a>
            </span>
        </div>
    </div>
    <p>
        {{-- Stock Photo Assigned --}}
        <img src="https://picsum.photos/{{rand(300, 425)}}/{{rand(280, 320)}}" alt="{{$post->name}}" title="{{$post->name}}" class="p-2 float-sm-left border mr-2 rounded-sm">
        {{-- Post Content, truncated --}}
        {{$postContent}}
        {{-- Welcome under the cut --}}
        <a href="{{$postUrl}}" title="Read the entire post" class="mt-2 d-block">
            Continue reading
        </a>
    </p>
</div>