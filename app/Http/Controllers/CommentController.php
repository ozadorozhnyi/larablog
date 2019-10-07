<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            /**
             * Apply different validation rules,
             * based on the commentable_type value.
             */
            (new StoreComment)->rules($request->commentable_type)
        );

        if ($validator->fails())
        {
            /**
             * Backs the user with errors & old input 
             * to the previous page.
             */
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Store a newly created resource in storage.
            $created = Comment::create([
                'commentable_id' => $request->commentable_id,
                'commentable_type' => Comment::getcommentableClass(
                    $request->commentable_id,
                    $request->commentable_type
                ),
                'author' => sprintf("%s %s", $request->first_name, $request->last_name),
                'content' => $request->content,
            ]);
        } catch (QueryException $e) {
            // Saves errors for the future analysis.
            Log::error($e->getMessage());

            // Sets up status message
            \Session::flash('status', 'Internal error occurred while store a newly created resource in storage.');
        }

        // Sets up status message
        \Session::flash('status', 'Thanks! Your comment was successfully added.');

        // Backs the user to the previous page and shows error message.
        return redirect()->back();
    }

}
