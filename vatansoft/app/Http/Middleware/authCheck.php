<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\DB;

class authCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if('$xv1623tty' != $request->header('Authorization')){
        DB::table('logs')
        ->updateOrInsert(
            ['ip' => $request->ip()],
            ['attempts' => DB::raw('attempts + 1')]
        );
        $banCheck = Log::where('ip', $request->ip())->first();
        if($banCheck->attempts >= 30){
            return redirect('banned');
        }
        return redirect('noaccess');
        }

        return $next($request);
    }
}
