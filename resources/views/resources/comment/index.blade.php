<div class="comment-item shadow-sm p-3 mb-3 ml-4 bg-white rounded">
    <div class="comment-meta d-block pb-1 text-muted">
        <small>
            <a href="/authors/{{rand(1,1000)}}" title="Go to the author profile page" class="text-muted font-weight-bold">
                {{$comment->author}}
            </a>
        </small>
        &nbsp;·&nbsp;
        <small class="text-muted">
            {{$comment->created_at->diffForHumans()}}
        </small>
    </div>
    <span class="comment-content">
        {{$comment->content}}
    </span>
</div>