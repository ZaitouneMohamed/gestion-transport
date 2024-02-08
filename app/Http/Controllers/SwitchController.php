<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\Chaufeur;
use App\Models\Consomation;
use Illuminate\Http\Request;

class SwitchController extends Controller
{
    function SwitchActiveModeForChaufeur($id)
    {
        $product = Chaufeur::find($id);
        $product->statue = !$product->statue;
        $product->save();
        return redirect()->back()->with([
            "success" => "chauffeur Statue Update successful"
        ]);
    }
    function SwitchActiveModeForCamion($id)
    {
        $product = Camion::find($id);
        $product->statue = !$product->statue;
        $product->save();
        return redirect()->back()->with([
            "success" => "chauffeur Statue Update successful"
        ]);
    }
    function SwitchActiveModeForTrajet($id)
    {
        $product = Consomation::find($id);
        $product->status = !$product->status;
        $product->save();
        return redirect()->back()->with([
            "success" => "chauffeur Statue Update successful"
        ]);
    }

    function SwitchIsForAejModeForCamion($id)
    {
        $product = Camion::find($id);
        $product->is_for_aej = !$product->is_for_aej;
        $product->save();
        return redirect()->back()->with([
            "success" => "chauffeur Statue Update successful"
        ]);
    }
}
