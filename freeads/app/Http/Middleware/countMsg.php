<?php

namespace App\Http\Middleware;

use Closure;
use App\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class countMsg
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
        $countAll = Chat::where('to_id', Auth::id())
        ->where('status', 0)
        ->count();

        View::share('countAll', $countAll);
        return $next($request);
    }
}
