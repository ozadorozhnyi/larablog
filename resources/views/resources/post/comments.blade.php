{{-- Post Comments --}}
<h5 class="py-3" id="comments">
    Comments ({{$commentsQty}})
</h5>

{{-- Create Comment Form --}}
@include('resources.comment.create')

@if ($commentsQty > 0)
    <h6 class="ml-4 pt-4">
        Other peoples says:
    </h6>
    {{-- 
        Combines loops and includes to display all Comments 
        related with the current Post 
    --}}
    @each('resources.comment.index', $post->comments, 'comment')    
@else
    <p class="py-3">
        Be first, who leaves a comment for this post.
    </p>
@endif