<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivilegeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $routePrivilege
     * @return mixed
     */
    public function handle($request, Closure $next, $routePrivilege)
    {
        $user = Auth::user();
//        error_log(json_encode($user));
        $role = $user['role'];
//        error_log(json_encode($role));
        if($role == null){
            abort(403);
        }
//        error_log(json_encode($role));
        $rolePrivileges = $role['role_privilege'];
//        error_log(json_encode($rolePrivileges));
        foreach ($rolePrivileges as $rolePrivilege) {
            $privilege = $rolePrivilege["privilege"];
            $name = $privilege['name'];
            if (strtolower($name) == strtolower($routePrivilege) && $rolePrivilege['status']) {
                return $next($request);
            }
        }
        abort(403);
    }
}
