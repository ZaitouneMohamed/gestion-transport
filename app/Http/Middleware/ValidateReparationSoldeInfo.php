<?php

namespace App\Http\Middleware;

use App\Models\Reparation;
use Closure;
use Illuminate\Http\Request;

class ValidateReparationSoldeInfo
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
        $prix = $request->prix;

        $reparation = Reparation::find($request->reparation_id);

        $solde = $reparation->prix;

        $full_reparation_solde_now = $reparation->Info->SUM('prix');

        $prix_request = $prix + $full_reparation_solde_now;

        if ($prix_request > $solde) {
            $solde_need = $solde - $full_reparation_solde_now;
            return redirect()->back()->with([
                "error" => "the solde is " . $solde . " and the prix is " . $prix_request . " and the full reparation actually is " . $solde_need
            ]);
        } else {
            return $next($request);
        }
    }
}
