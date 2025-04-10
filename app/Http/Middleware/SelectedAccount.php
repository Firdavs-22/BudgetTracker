<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SelectedAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $account = $request->session()->get("account_id",null);
        if (!$account) {
            return redirect()->route("account.index")->with("error", "Please select an account to continue.");
        }
        $request->attributes->set("account_id", $account);

        return $next($request);
    }
}
