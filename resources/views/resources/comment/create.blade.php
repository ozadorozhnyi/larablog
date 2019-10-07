<div class="shadow-lg p-3 mb-4 bg-white rounded">
    
    <h6 class="pb-1">
        Have something to say?
    </h6>
    
    <form action="{{route('comments.store')}}" method="POST">
        
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
                <button type="submit" name="submitBtn" value="postComment" title="Post your comment" class="btn btn-sm btn-primary">
                    Post A Comment
                </button>
            </div>

        </div>

    </form>
</div>