<?php

namespace App\Http\Controllers;

use App\Models\Chaufeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ChaufeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chaufeurs = Chaufeur::with('Consomations')->latest()->paginate(12);
        return view('gazole.chaufeur.index', compact('chaufeurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.chaufeur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "full_name" => "required",
            "code" => " unique:chaufeurs,code",
            "phone" => " required",
        ]);
        Chaufeur::create([
            "full_name" => $request->full_name,
            "code" => $request->code,
            "numero_2" => $request->numero_2,
            "adresse" => $request->adresse,
            "phone" => $request->phone,
            "email" => $request->email,
            "cnss" => $request->cnss,
            "cni"   => $request->cni,
        ]);
        Cache::forget('chauffeur_count');
        Cache::forget('active_chauffeurs');
        return redirect()->route('chaufeur.index')->with([
            "success" => "chaufeur added successly"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chaufeur = Chaufeur::find($id);
        return view('gazole.chaufeur.edit', compact('chaufeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "full_name" => "required",
            "phone" => "required"
        ]);
        $chaufeur = Chaufeur::find($id);
        $chaufeur->update([
            "full_name" => $request->full_name,
            "code" => $request->code,
            "numero_2" => $request->numero_2,
            "adresse" => $request->adresse,
            "phone" => $request->phone,
            "email" => $request->email,
            "cnss" => $request->cnss,
            "cni"   => $request->cni,
        ]);
        Cache::forget('chauffeur_count');
        Cache::forget('active_chauffeurs');
        return redirect()->route('chaufeur.index')->with([
            "success" => "chaufeur updated successly"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chaufeur::find($id)->delete();
        Cache::forget('chauffeur_count');
        Cache::forget('active_chauffeurs');
        return redirect()->route('chaufeur.index')->with([
            "success" => "chaufeur deleted successly"
        ]);
    }
}
