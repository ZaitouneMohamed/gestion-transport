<?php

namespace App\Http\Middleware;

use App\Models\Bons;
use Closure;
use Illuminate\Http\Request;

class ValidateCreationBon
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
        $bon_num = $request->numero_bon;
        $nature = $request->nature;
        $consomation_id = $request->consomation_id;
        $bon = Bons::where('numero_bon', $bon_num)->where('consomation_id', $consomation_id)->where('nature', $nature)->get();
        if ($bon->count() === 0) {
            return $next($request);
        } else {
            return redirect()->back()->with([
                "error" => "please try to change numero or nature"
            ]);
        }
    }
}
