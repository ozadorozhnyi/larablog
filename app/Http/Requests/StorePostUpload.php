<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostUpload extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Imposes restriction by the file mime types
        $mimesRestrictions = '';
        if (count (config('app.upload_mimes')) > 0 ) {
            $mimesRestrictions = sprintf("|mimes:%s", implode(",", config('app.upload_mimes')));
        }

        // Imposes restriction by the file size (in Kb)
        $sizeRestrictions = sprintf("|max:%d", config('app.upload_max_filesize'));

        return [
            'postUpload' => "required|file{$mimesRestrictions}{$sizeRestrictions}"
        ];
    }
}
