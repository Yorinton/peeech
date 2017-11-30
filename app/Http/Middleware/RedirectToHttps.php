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
//            return redirect('https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);
        }
        return $next($request);
    }

    public function isHttps()
    {
        dd($_SERVER);
        return array_key_exists('HTTPS', $_SERVER) && ($_SERVER["HTTPS"] == "on");
    }
}
