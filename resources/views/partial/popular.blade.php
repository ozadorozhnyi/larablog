@if ($popular->count() > 0)
    <h4 class="pb-2 mb-2 font-italic">
        Most Commented
    </h4>    
    <div class="row mb-2">
        @php $stockImgUrls = (object)config('app.stock_img_urls') @endphp
        {{-- Here, we expects two elements in the collection only and slicing guarantees that. --}}
        @foreach ($popular->slice(0,2) as $post)
            @php 
                $postUrl = route('posts.show', ['post'=>(int)$post->id]);
                $postName = Str::limit($post->name, 20, '');
                $postContent = Str::limit($post->content, 90);
                
                $postImgUrl = $stockImgUrls->unsplash;
                if ($loop->first) {
                    $postImgUrl = $stockImgUrls->picsum;
                }
            @endphp
            <div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-6 shadow-sm h-450 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        {{-- Category Name --}}
                        <span class="d-inline-block text-success">
                            {{$post->category->name}}
                        </span>
                        {{-- Post Name --}}
                        <h3 class="mb-1">
                            {{$postName}}
                        </h3>
                        <div class="d-flex justify-content-left pt-1 pb-2">
                            {{-- Created At --}}
                            <div class="mr-1 badge badge-secondary font-weight-normal">
                                {{$post->created_at->format('M d, Y')}}
                            </div>
                            {{-- Comments Qty --}}
                            <div class="badge badge-warning font-weight-normal">
                                {{$post->comments_count}} comments
                            </div>
                        </div>
                        {{-- Post Content, truncated --}}
                        <p class="card-text mb-auto">
                            {{$postContent}}
                        </p>
                        {{-- Welcome under the cut --}}
                        <a href="{{$postUrl}}" title="{{$post->name}}" class="stretched-link">
                            Continue reading
                        </a>
                    </div>
                    {{-- Stock Photo Assigned --}}
                    <div class="col-auto d-none d-lg-block">
                        <img src="{{$postImgUrl}}" alt="{{$post->name}}" class="p-2">
                    </div>
                </div>
            </div>    
        @endforeach
    </div>
@endif