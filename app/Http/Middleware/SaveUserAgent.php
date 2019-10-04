<?php

namespace App\Http\Middleware;

use Closure;
use App\Visitor as Visitor;
use Jenssegers\Agent\Agent;

class SaveUserAgent
{
    /**
     * Saves information about user agent into the storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = new Agent();

        $browser = $agent->browser();

        // Saves UA, got from every http-request into the storage
        Visitor::create([
            'raw' => $request->header('User-Agent'),
            'browser' => $browser,
            'version' => substr($agent->version($browser), 0, 4),
            'device' => $agent->device(),
            'platform' => $agent->platform()
        ]);
        
        return $next($request);
    }
}
