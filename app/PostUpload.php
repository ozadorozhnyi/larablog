<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostUpload extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_uploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'path',
        'name_original',
        'name_hash',
        'extension',
        'bytes',
    ];

    /**
     * Get the post that owns the uploaded file.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * Get the route key for the model.
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name_hash';
    }

}
