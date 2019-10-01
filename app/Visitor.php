<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'visitors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'raw',
        'browser',
        'version',
        'device',
        'platform',
    ];

    public static function unique(\DateTime $date, $skipUnpopular = 3, $limit = 50)
    {
        /**
         * select 
         *  browser, version, count(*) as uniq 
         * from visitors 
         * where 
         *  DATE(created_at) = CURDATE() 
         * group by browser, version 
         * having uniq > 1 
         * order by uniq desc;
         */

        return self::select(\DB::raw('browser, version, count(*) as uniq'))
            ->whereDate('created_at', $date->format("Y-m-d"))
            ->groupBy('browser', 'version')
            ->having('uniq', '>', (int)$skipUnpopular)
            ->orderBy('uniq', 'desc')
            ->limit((int)$limit)
            ->get();
    }
}
