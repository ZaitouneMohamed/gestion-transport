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
        $bon = Bons::where('numero_bon', $bon_num)->where('nature',$nature)->get();
        if ($bon->count() === 0) {
            // return redirect()->back()->with([
            //     "messages" => "please try to change numero or nature"
            // ]);
            return $next($request);
        } else {
            return redirect()->back()->with([
                "error" => "please try to change numero or nature"
            ]);
        }
    }
}
