<div class="jumbotron p-4 p-md-5 text-white rounded">
    <div class="col-md-10 px-0">
        <h1 class="display-5">
            {{$randomOne->name}}
        </h1>
        <p class="lead my-3">
            {{Str::words($randomOne->content, 65, '...')}}
        </p>
        <p class="lead mb-0">
            @php
                $urlShow = route('posts.show', ['post'=>$randomOne->id]);
                $urlTitle = sprintf("Continue reading the post: %s", $randomOne->name);
            @endphp
            {{-- Welcome under the cut --}}
            <a href="{{$urlShow}}" title="{{$urlTitle}}" class="text-white font-weight-bold">
                Continue reading
            </a>
        </p>
    </div>
</div>