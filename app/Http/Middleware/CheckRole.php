<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class CheckRole
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
        $actions = $request->route()->getAction();
        $role    = isset($actions['role']) ? intval($actions['role']) : null;
        if (!$role) {
            return $next($request);
        }
        $arr_request = $request->all();
        if (isset($arr_request['remember_token'])) {
            $remember_token = $arr_request['remember_token'];
            $user = \App\User::where('remember_token', $arr_request['remember_token'])->first();
            \Auth::setUser($user);
        }
        if ($request->user() === null) {
            // return response('Please login user has permission', 401);
            return new Response(view('welcome', array('error'=>'Please login user has permission')));
        }
        if ($request->user()->hasRole($role)) {
            return $next($request);
        }

        return new Response(view('welcome', array('error'=>'Please login user has permission')));
        // return response('Please login user has permission', 401);
        // return $next($request);
    }
}
