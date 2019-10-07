<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostUpload;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\StorePostUpload as StorePostUploadRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Exceptions\BlogException;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $withFileUploaded = false;

        // Process File Uploads.
        if ($request->hasFile('postUpload'))
        {
            if ($request->file('postUpload')->isValid()) 
            {
                // Apply our custom validation rules to the uploaded file.
                $uploadsValidator = Validator::make(
                    $request->all(), (new StorePostUploadRequest())->rules()
                );

                /**
                 * If some error occurs during validation, 
                 * back the user to the creation form and display error message there
                 */
                if ($uploadsValidator->fails()) {
                    return redirect()->route('posts.create')
                        ->withErrors($uploadsValidator)
                        ->withInput();
                }

                // We should store uploaded file
                $withFileUploaded = true;

            } else {
                // Saves errors for the future analysis.
                Log::error("Uploaded file is not valid.");

                // Sets up status message
                \Session::flash('status', 'Internal error occurred while storing file uploaded.');

                // Backs the user to the creation page against and shows status error message.
                return redirect()->route('posts.create');
            }
        }

        // Retrieve the validated form input data.
        $validated = $request->validated();

        try {
            // Store a newly created resource in storage.
            $created = Post::create([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'content' => $validated['content'],
            ]);

            if ($withFileUploaded)
            {
                // Move uploaded file into the storage on the disk.
                $path = $request->file('postUpload')->store(
                    config('app.uploads_dir_name')
                );                

                // Create appropriate relation in the database.
                $created->file()->create([
                    'path' => $path,
                    'name_original' => $request->file('postUpload')->getClientOriginalName(),
                    'name_hash' => pathinfo(basename($path))['filename'] ,
                    'extension' => $request->file('postUpload')->extension(),
                    'bytes' => $request->file('postUpload')->getClientSize(),
                ]);
            }
        } catch (QueryException $e) {
            // Saves errors for the future analysis.
            Log::error($e->getMessage());

            // Sets up status message
            \Session::flash('status', 'Internal error occurred while store a newly created resource in storage.');

            // Backs the user to the creation page against and shows error message.
            return redirect()->route('posts.create');
        }

        return redirect()
            ->route('posts.show', ['post'=>$created->id]);
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
        return view('resources.post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StorePost  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, Post $post)
    {
        $withFileUploaded = false;

        // Process File Uploads.
        if ($request->hasFile('postUpload'))
        {
            if ($request->file('postUpload')->isValid()) 
            {
                // Apply our custom validation rules to the uploaded file.
                $uploadsValidator = Validator::make(
                    $request->all(), (new StorePostUploadRequest())->rules()
                );

                /**
                 * If some error occurs during validation, 
                 * back the user to the creation form and display error message there
                 */
                if ($uploadsValidator->fails()) {
                    return redirect()->route('posts.create')
                        ->withErrors($uploadsValidator)
                        ->withInput();
                }

                // We should store uploaded file
                $withFileUploaded = true;

            } else {
                // Saves errors for the future analysis.
                Log::error("Uploaded file is not valid.");

                // Sets up status message
                \Session::flash('status', 'Internal error occurred while storing file uploaded.');

                // Backs the user to the creation page against and shows status error message.
                return redirect()->route('posts.create');
            }
        }

        // Retrieve the validated form input data.
        $validated = $request->validated();

        $post->name = $validated['name'];
        $post->content = $validated['content'];
        $post->category_id = $validated['category_id'];

        // Update the specified resource in storage.
        $post->save();

        if ($withFileUploaded)
        {
            // Move uploaded file into the storage on the disk.
            $path = $request->file('postUpload')->store(
                config('app.uploads_dir_name')
            );                

            // Create appropriate relation in the database.
            $post->file()->create([
                'path' => $path,
                'name_original' => $request->file('postUpload')->getClientOriginalName(),
                'name_hash' => pathinfo(basename($path))['filename'] ,
                'extension' => $request->file('postUpload')->extension(),
                'bytes' => $request->file('postUpload')->getClientSize(),
            ]);
        }

        // Sets up status message
        \Session::flash('status', 'Data was successfully updated.');

        return redirect()
            ->route('posts.show', ['post'=>$post->id]);
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
    public function uploadsDestroy(Post $post, $routeBack = 'show')
    {
        $post->fileDelete();

        // Define default back route name.
        $routeBackName = "posts.{$routeBack}";

        // If the requested route exists, use it.
        $redirectRouteName = (\Route::has($routeBackName))? $routeBackName:"posts.show";
        
        // Redirect a user to the specified page.
        return redirect()->route($redirectRouteName, ['post'=>$post->id]);
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
