<?php

namespace PterodactylCN\Addon\ApiFix\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAllowCors
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (str_starts_with($request->getRequestUri(), '/api')) {
            // 如果有 Origin 头的话
            if ($request->headers->has('Origin')) {
                $response->header('Access-Control-Allow-Origin', $request->header('Origin'));
                // 还要设定 Access-Control-Allow-Credentials
                $response->header('Access-Control-Allow-Credentials', 'true');
                // 设定 Access-Control-Allow-Headers
                $response->header('Access-Control-Allow-Headers', 'Authorization');
                // 设定 Access-Control-Allow-Methods
                $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                // 如果来源不匹配 APP_URL，则丢掉 set-cookie
//            if ($request->header('Origin') !== env('APP_URL')) {
//                $response->headers->remove('Set-Cookie');
//            }
            }
        }
        return $response;
    }
}
