<?php

namespace App\Http\Middleware;

use Closure;
use Session,DB;

class Session_check
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
        if (Session::has('userdata')) {
            $session_data=Session::get('userdata');
            if($session_data->role==1){
                $session_password=$session_data->password;
                $exist_password=DB::table('usermanages')->where('id',1)->first()->password;
                if($session_password==$exist_password){
                 return $next($request);

                }else{
                    session()->forget('userdata');
                    return redirect()->route('login');
                }

            }
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
