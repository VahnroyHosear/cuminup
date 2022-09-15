<?php

namespace App\Http\Middleware;

use Closure;

class CheckApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public $ApiToken = 'mytoken';
    public function handle($request, Closure $next)
    {
        $ApiToken = 'mytoken';
        $token=$request->header('ApiToken');
        if($token!=$ApiToken){
            $response = [
                'success' => false,
                'message' => "your token is not valid!",
            ];
            return response()->json($response, 200);
        }else{
            return $next($request);
        }
       
    }
}
