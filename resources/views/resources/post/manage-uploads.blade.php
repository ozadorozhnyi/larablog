@if (isset($post))
    @if ((int)$post->file()->count() > 0)
        @php 
            $fileSize = sprintf("%01.2fMb", ($post->file->bytes/1024)/1024);
            $downloadUrl = route('download.attachment', ['file'=>$post->file->name_hash]);
        @endphp
        <div class="bg-light border p-3">
            <strong class="d-block pb-1">
                @php $uploaded_at = $post->file->created_at->diffForHumans() @endphp
                Hey, you have a file uploaded {{$uploaded_at}}!
            </strong>
            <p>
                You can <a href="{{$downloadUrl}}" title="Start downloading" target="_blank">download</a> this file ({{$fileSize}}) 
                or remove it by using appropriate link at the right side bar on
                <a href="{{route('posts.show', ['post'=>$post->id])}}" title="Read the entire post">this page</a>.
            </p>
        </div>
    @else
        {{-- Attach the file Control --}}
        @include('resources.post.attach-file')
    @endif
@else
    {{-- Attach the file Control --}}
    @include('resources.post.attach-file')
@endif