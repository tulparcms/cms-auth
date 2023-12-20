<?php

namespace App\Http\Middleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TcmsAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            return $next($request);
        } else {
            return redirect(route('admin.login'));
        }
    }
    public function login(Request $request){
        $data = [];
        return TCMS()->loadAdminTemplate( 'admin.login', $data, AUTH_FOLDER);
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect(route('admin.login'));

    }
    public function loginCheck(Request $request){
        $user = User::first();
        \Auth::login($user);
        return redirect(route('admin.home.index'));
    }
}
