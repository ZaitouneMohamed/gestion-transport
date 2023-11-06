<?php

namespace App\Http\Controllers;

use App\Models\Camion;
use App\Models\Chaufeur;
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
}
