<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('resources.post.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        /**
         * Remove the specified resource and all related information.
         */
        $post->delete();

        /**
         * Redirect a user on to the Homepage.
         */
        return redirect()->route('home');
    }

    /**
     * Remove all uploads, related to the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function uploadsDestroy(Post $post)
    {
        /**
         * @todo this functionallity.
         */

        /**
         * Redirect a user on to the Post Page.
         */
        return redirect()->route('posts.show', ['post'=>$post->id]);
    }

    /**
     * Remove all comments, related to the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function commentsDestroy(Post $post)
    {
        /**
         * Note, here we can use delete() chain
         * to remove all comments, related to the specified resource.
         */
        $post->comments()->delete();

        /**
         * Redirect a user on to the Post Page.
         */
        return redirect()->route('posts.show', ['post'=>$post->id]);
    }

}
