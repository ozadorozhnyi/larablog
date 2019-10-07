<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
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
    public function rules($commentableType = 'category')
    {
        $existsRule = [
            "category" => '|exists:categories,id',
            "post" => '|exists:posts,id',
        ];

        return [
            'commentable_id' => sprintf('required|numeric|integer%s', $existsRule[$commentableType]),
            'commentable_type' => sprintf('required|string|in:%s', implode(',', array_keys($existsRule))),
            'first_name' => 'required|string|min:3|max:32',
            'last_name' => 'required|string|min:3|max:32',
            'content' => 'required|string|min:10',
        ];
    }
}
