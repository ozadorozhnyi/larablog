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