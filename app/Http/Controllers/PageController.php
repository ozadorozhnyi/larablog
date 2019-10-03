<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post as BlogPost;

/**
 * Created to display different, not categorized website pages,
 * static views or views with dynamically added content.
 * 
 */
class PageController extends Controller
{
    /**
     * Displays homepage of the blog.
     * Made to show different ways of working with Laravel Eloquent ORM
     *
     * @return \Illuminate\Http\Response
     */
    public function home ()
    {
        /**
         * Define some limitation for the posts selection.
         * 
         * A different values for this restrictions can be injected 
         * in the future (if needed) by using some getter method, 
         * which receive this values based on user data, or from config file...
         */
        $popularQty = 2;
        $latestQty = 3;

        /**
         * Gets a one random post.
         * In the real project, it can imitate the one "hot news" for example.
         */
        $randomOne = BlogPost::inRandomOrder()->first();
        
        /**
         * Gets the most commented posts.
         * To display how models relations works in the Laravel Eloquent ORM.
         */
        $popular = BlogPost::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit((int)$popularQty)
            ->get();
        
        /**
         * Gets several latest posts.
         * To display how the Laravel Eloquent ORM can save your time.
         */
        $latest = BlogPost::withCount('comments')
            ->latest()
            ->limit((int)$latestQty)
            ->get();

        /**
         * Send a Response
         */
        return view('pages.home', [
            'randomOne' => $randomOne,
            'popular' => $popular,
            'latest' => $latest
        ]);
    }

}
