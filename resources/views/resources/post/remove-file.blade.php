<span>
    <form action="{{route('posts.uploads.destroy',['post'=>$post->id, 'routeBack'=>'show'])}}" method="POST">
        @method('DELETE')
        @csrf
        @php
            $removeTitle = "Remove uploaded file, related to this post";
            $removeConfirmText = "Are you sure about whatever it is you are doing?";
        @endphp
        <button type="submit" title="{{$removeTitle}}" onclick="return confirm('{{$removeConfirmText}}')" class="list-group-item list-group-item-action text-primary">
            Remove Uploaded File
        </button>
    </form>
</span>