<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiSession;
use App\Helpers\BaseFunction\BaseFunction;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {        
        $token = $request->header('Authorization');

        $request['token'] = $token;
        if(empty($token)){
            return response()->json(['status' => 8, 'message' => 'Token is required.', 'data' => null], 499);
        }

        $checktoken = ApiSession::where('session_id',$token)->first();

        if(empty($checktoken)){
            return response()->json(['status' => 9, 'message' => 'You have been logged out because you signed in on another device', 'data' => null], 498);
        }

        $user = BaseFunction::checkApisSession($token);

        if (empty($user)) {
            return response()->json(['status' => 9, 'message' => 'You have been logged out because you signed in on another device', 'data' => null], 498);
        }
        $request['user_data'] = $user;

        return $next($request);
    }
}
