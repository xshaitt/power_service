<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;

class ApiTokenMiddleware
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
        $hashPwd = $request->header('Api-Token');
        if(Hash::check(env('API_TOKEN'),$hashPwd))
        {
            return $next($request);
        }else{
            return response()->json(['status'=>443,'message'=>'访问令牌验证错误']);
        }
    }
}
