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
        //pcから + /pc以外へアクセスの場合/pcへリダイレクト
        if(!$this->isSmartPhone() && !$this->isPcPage($request)){
            //PCページにリダイレクト
            return redirect('pc');
        }
        //spから + /pcへアクセスの場合 / へリダイレクト
        if($this->isSmartPhone() && $this->isPcPage($request)){
            return redirect('/');
        }
        return $next($request);
    }

    protected function isSmartPhone(){
        //UserAgentのチェック
        return preg_match("/(".implode("|",$this->agents).")/",Arr::get($_SERVER, 'HTTP_USER_AGENT', "PC"));
    }

    protected function isPcPage($request)
    {
        //パスにpcが含まれる
        return preg_match("(pc)",$request->path());
    }
}
