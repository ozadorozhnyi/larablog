<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
         */
        $this->fileDelete();

        /**
         * Remove this instance.
         */
        return parent::delete();
    }

    /**
     * Physically removes a file, uploaded for this instance before
     * and remove all relation in the database table.
     * 
     */
    public function fileDelete()
    {
        if ((int)$this->file()->count() > 0)
        {
            if (Storage::exists($this->file->path)) 
            {
                // Physically remove the file from the disk storage.
                Storage::delete($this->file->path);
            }

            // Remove relation in the database.
            $this->file()->delete();
        }
    }
    
}
