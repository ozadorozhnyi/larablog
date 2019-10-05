<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        try {
            // Store a newly created resource in storage.
            $created = Category::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);
        } catch (QueryException $e) {
            // Saves errors for the future analysis.
            Log::error($e->getMessage());

            // Sets up status message
            \Session::flash('status', 'Internal error occurred while store a newly created resource in storage.');

            // Backs the user to the creation page against and shows error message.
            return redirect()->route('categories.create');
        }
        
        return redirect()
            ->route('categories.show', ['category'=>$created->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('resources.category.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('resources.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreCategory  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, Category $category)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $category->name = $validated['name'];
        $category->description = $validated['description'];

        // Update the specified resource in storage.
        $category->save();

        // Sets up status message
        \Session::flash('status', 'Data was successfully updated.');

        return redirect()
            ->route('categories.show', ['category'=>$category->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        /**
         * Redirect a user on to the Homepage.
         */
        return redirect()->route('home');
    }

    /**
     * Remove all posts, related to the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function postsDestroy(Category $category)
    {
        foreach ($category->posts as $post)
        {
            $post->delete();
        }

        // Sets up status message
        \Session::flash('status', 'All related posts was successfully removed.');

        /**
         * Redirect a user on to the Category Page.
         */
        return redirect()->route('categories.show', ['category'=>$category->id]);
    }

    /**
     * Remove all comments, related to the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function commentsDestroy(Category $category)
    {
        $category->comments()->delete();
        
        // Sets up status message
        \Session::flash('status', 'All related comments was successfully removed.');

        /**
         * Redirect a user on to the Category Page.
         */
        return redirect()->route('categories.show', ['category'=>$category->id]);
    }

}
