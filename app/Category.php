<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the posts for the blog category.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get all of the category comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * Remove the specified instance, all related entities and 
     * all relations from a storage.
     */
    public function delete()
    {
        /**
         * Remove all comments, related to the current instance.
         */
        $this->comments()->delete();
        
        foreach ($this->posts as $post)
        {
            /**
             * Remove every single post, assigned to this instance 
             * and all related with this post information.
             * 
             * Don't use $this->posts()->delete() chain here.
             * We should go through every post and call
             * his delete() method, which goes with extended functionallity.
             * 
             * It's important.
             */
            $post->delete();
        }

        /**
         * Remove this instance.
         */
        return parent::delete();
    }

}
