<div class="shadow-lg p-3 mb-4 bg-white rounded">
    
    {{-- For server results --}}
    <div id="server-response"></div>
    
    <h6 class="pb-1">
        Have something to say? Ajax
    </h6>
    
    <form action="{{route('comments.store.async')}}" method="POST" id="comments-store-async">
        
        @csrf

        {{-- Commentable Id --}}
        <input type="hidden" name="commentable_id" id="commentable_id" value="{{$commentableId}}">

        {{-- Commentable Type Alias --}}
        <input type="hidden" name="commentable_type" id="commentable_type" value="{{$commentableType}}">

        <div class="row">

            {{-- First Name --}}
            <div class="col">
                <input type="text" name="first_name" value="{{old('first_name')}}" 
                    id="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                    placeholder="First name" 
                    minlength="3" maxlength="32"
                    required autofocus>
                @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <small class="form-text text-muted">
                    At least 3 characters long
                </small>
            </div>

            {{-- Last Name --}}
            <div class="col">
                <input type="text" name="last_name" value="{{old('last_name')}}" 
                    id="last_name" class="form-control @error('last_name') is-invalid @enderror" 
                    placeholder="Last name" 
                    minlength="3" maxlength="32"
                    required>
                @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <small class="form-text text-muted">
                    At least 3 characters long
                </small>
            </div>

        </div>

        {{-- Comment --}}
        <div class="row pt-3">
            <div class="col">
                <textarea name="content" id="content" 
                    class="form-control @error('content') is-invalid @enderror" 
                    rows="3" placeholder="Put your comment here" 
                    minlength="3" required >{{old('content')}}</textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <small class="form-text text-muted">
                    Write concisely and on the subject. No spam, no insults, please.
                </small>
            </div>
        </div>

        <div class="row pt-3">

            {{-- Submit Form --}}
            <div class="col">
                <input type="submit" name="submitBtn" 
                    value="Post A Comment" title="Post your comment" 
                    class="btn btn-sm btn-primary"/>
            </div>

        </div>

    </form>
</div>

{{-- Custom JavaScript Code --}}
@section('javascript')
    @parent

    {{-- Submit Form by using jQuery ajax method --}}
    <script>
        $(document).ready(function(){
            $("#comments-store-async").submit(function(event)
            {
                event.preventDefault();

                var post_url = $(this).attr("action");
                var request_method = $(this).attr("method");
                var form_data = $(this).serialize();
                
                $.ajax({
                    url : post_url,
                    type: request_method,
                    data : form_data
                }).done(function(response)
                {
                    var respMsg = $.parseJSON(response);
                    if ('error' == respMsg.status) {
                        // display error message
                        $("#server-response").addClass("alert alert-danger py-2").fadeIn().html(respMsg.text);
                    } else {
                        // Clear form (@todo after success response)
                        $("#comments-store-async").trigger("reset");

                        // just display status message
                        $("#server-response").removeClass("alert alert-danger py-2").addClass("alert alert-primary py-2");
                        $("#server-response").fadeIn().html(respMsg.text);

                        // Hide status message with a server response.
                        $("#server-response").delay(4000).fadeOut("slow");

                        // restart browser after delay
                        setTimeout(location.reload.bind(location), 5000);
                    }
                });
            });
        });
    </script>
    
@endsection