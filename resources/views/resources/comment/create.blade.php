<div class="shadow-lg p-3 mb-4 bg-white rounded">
    <h6 class="pb-1">
        Have something to say?
    </h6>
    <form action="{{route('comments.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name="first_name" value="" class="form-control" placeholder="First name">
                <small class="form-text text-muted">
                    At least three characters long
                </small>
            </div>
            <div class="col">
                <input type="text" name="last_name" value="" class="form-control" placeholder="Last name">
                <small class="form-text text-muted">
                    At least three characters long
                </small>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <textarea name="comment" class="form-control" rows="3" placeholder="Put your comment here"></textarea>
                <small class="form-text text-muted">
                    Write concisely and on the subject. No spam, no insults, please.
                </small>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <button type="submit" name="submit" value="submit" class="btn btn-sm btn-primary">
                    Comment
                </button>
            </div>
        </div>
    </form>
</div>