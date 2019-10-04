<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'content',
    ];

    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the Uploaded File associated with the post.
     */
    public function file()
    {
        return $this->hasOne('App\PostUpload');
    }

    /**
     * Get all of the post's comments.
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

        /**
         * Physically removes a file, uploaded for this instance before
         * and remove all relation in the database table.
         * 
         * @todo add this functionality here
         */


        /**
         * Remove this instance.
         */
        return parent::delete();

    }
    
}
