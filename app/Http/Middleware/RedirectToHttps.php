<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->isHttps() && config('app.env') === 'production'){
            return redirect('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        }
        return $next($request);
    }

    public function isHttps()
    {
        return isset($_SERVER['HTTPS']);
//        return isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on');
    }
}
