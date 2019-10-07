{{-- Post Uploaded File --}}
<div class="bg-light border p-3">
    <strong class="d-block pb-1">
        Have some file for upload?
    </strong>
    <div class="custom-file">
        @php
            $mimesRestrictions = '';
            if (count (config('app.upload_mimes')) > 0 ) {
                $mimesRestrictions = ".".implode(",", config('app.upload_mimes'));
            }
        @endphp
        <input type="file" name="postUpload" id="postUpload" 
            class="custom-file-input @error('postUpload') is-invalid @enderror" 
            aria-describedby="postUploadHelp"  accept="{{$mimesRestrictions}}">
        <label class="custom-file-label" for="postUpload">
            Choose file...
        </label>
        @error('postUpload')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <small id="postUploadHelp" class="form-text text-muted">
            Only pdf files with 2Mb size max is accepted.
        </small>
    </div>
</div> 