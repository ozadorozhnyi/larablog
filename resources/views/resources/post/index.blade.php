@php 
    $categoryUrl = route('categories.show', ['category'=>$post->category->id]);
    $categoryName = strtoupper($post->category->name) ;
    
    $postUrl = route('posts.show', ['post'=>$post->id]);
    $commentsQty = (int)$post->comments->count();
    
    $postContent = Str::words($post->content, 190, '...');
@endphp

<div class="shadow-sm px-3 pt-3 pb-1 mb-4 bg-white rounded">

    {{-- Post Name --}}
    <a href="{{$postUrl}}" title="Read the entire post" class="text-body">
        <h4 class="blog-post-title py-2 border-bottom">
            {{$post->name}}
        </h4>
    </a>

    {{-- Post Meta --}}
    @include('resources.post.meta')

    {{-- Post Content --}}
    <div class="clearfix">
        {{-- Stock Photo Assigned --}}
        <img src="https://picsum.photos/{{rand(300, 425)}}/{{rand(280, 320)}}" alt="{{$post->name}}" title="{{$post->name}}" class="float-left mr-2 p-2 border">
        
        {{-- Content Truncated --}}
        <p>{{$postContent}}</p>

        {{-- Welcome under the cut --}}
        <a href="{{$postUrl}}" title="Read the entire post" class="d-block mb-2">
            Continue reading
        </a>
    </div>

</div>