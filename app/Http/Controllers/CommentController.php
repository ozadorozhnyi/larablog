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

            // Backs the user to the previous page and shows error message.
            return redirect()->back();
        }

        // Sets up status message
        \Session::flash('status', 'Thanks! Your comment was successfully added.');

        // Backs the user to the previous page and shows error message.
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     * All incoming data was send via XHR.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function storeAsync(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            (new StoreComment)->rules($request->commentable_type)
        );

        if ($validator->fails()) {
            $this->AsyncResponse($validator->errors()->first());
        }

        try {
            // Create a new resource instance.
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

            // Write error msg into the system log.
            Log::error($e->getMessage());

            // Send error message intended for the human eyes back
            $this->AsyncResponse(
                'Internal error occurred while store a newly created resource in storage.'
            );
        }

        // Send error message intended for the human eyes back
        $this->AsyncResponse(
            'Your comment has been successfully saved and will appear soon.',
            'ok'
        );
    }

    /**
     * Allows easily change the sending method 
     * as well as the format of the data being sent.
     * 
     * @param strign $str
     */
    private function AsyncResponse($str, $status = 'error')
    {
        echo json_encode([
            'status'=>$status,
            'text'=>$str
        ]);

        exit;
    }

    public function testAsync()
    {
        echo json_encode([
            'status'=>'error',
            'text'=>'error text goes there...'.rand(12,23)
        ]);
    }

}
