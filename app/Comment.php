<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'author',
        'content',
    ];

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * This method is used to determine owner of this object.
     * Only Category or Post can has comments in the current 
     * realization.
     * 
     * @param int $id (not used right now)
     * @param string $classAlias
     * 
     * @return string
     */
    public static function getcommentableClass($id, $classAlias)
    {
        /**
         * This value can and should be injected 
         * to make the code more flexible and supported.
         * 
         * Or, you can change this method
         * by adding functionallity to check morphTo(), yours choice...
         * 
         * More simple way is used here.
         */
        $commentables = [
            "category" => 'App\Category',
            "post" => 'App\Post',
        ];

        return $commentables[$classAlias];
    }
}
