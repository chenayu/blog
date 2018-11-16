<?php

namespace App\Http\Middleware;

use Closure;

class Access
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
       $id = session('id');
       $id = isset($id)? session('id') : '访客';
       $mail = session('mail');
       $path = $request->path();
       $date = date('Y-m');
       @mkdir('access');
       @mkdir('access/'.$date);
       $str = '['.date('Y-m-d H:i:s').']'.$request->ip().'---'.$path.'---ID:'.$id;
       file_put_contents('access/'.$date.'/contents.log',$str."\r\n",FILE_APPEND);
       return $next($request);
    }
}
