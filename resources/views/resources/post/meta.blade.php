{{-- Post Meta --}}
<div class="row blog-post-meta mb-2">
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

        {{-- Uploads Attached --}}
        <span class="badge badge-light font-weight-normal">
            @if ($post->file()->count() > 0)
                @php 
                    $fileSize = sprintf("%01.2fMb", ($post->file->bytes/1024)/1024);
                    $downloadUrl = route('download.attachment', ['file'=>$post->file->name_hash]);
                @endphp
                <a href="{{$downloadUrl}}" title="Start downloading" target="_blank">
                    Download File ({{$fileSize}})
                </a>
            @else
                No File Attached
            @endif
        </span>

    </div>
</div>