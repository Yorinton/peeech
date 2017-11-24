<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;

class RedirectIfPC
{
    /**
     * The USER_AGENTs element.
     *
     * @var array
     */
    protected $agents = [
        "Android",
        "iPhone",
        "iPad",
        "googlebot-mobile",
        "iemobile",
        "opera mobile",
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->isSmartPhone($request)){
            //PCページにリダイレクト
            return redirect("http://asobiba101.com");
        }

        return $next($request);
    }

    protected function isSmartPhone($request){
        //UserAgentのチェック
        return preg_match("/(".implode("|",$this->agents).")/",Arr::get($_SERVER, 'HTTP_USER_AGENT', "PC"));
    }
}
