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

}
