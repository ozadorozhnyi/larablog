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
        'hash',
        'original',
        'bytes'
    ];

    /**
     * Get the post that owns the uploaded file.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

}
