<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villes = Ville::latest()->paginate(15);
        return view('gazole.ville.index', compact("villes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.ville.create');
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
            'name' => 'required|unique:villes,name',
            "km_proposer" => "required"
        ]);
        Ville::create([
            "name" => $request->name,
            "km_proposer" => $request->km_proposer
        ]);
        return redirect()->route("ville.index")->with([
            "success" => "ville created with success"
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
        $ville = Ville::find($id);
        return view('gazole.ville.edit', compact("ville"));
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
            'name' => 'required',
            "km_proposer" => "required"
        ]);
        $ville = Ville::find($id);
        $ville->update([
            "name" => $request->name,
            "km_proposer" => $request->km_proposer
        ]);
        return redirect()->route("ville.index")->with([
            "success" => "ville updated with success"
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
        $ville = Ville::find($id);
        $ville->delete();
        return redirect()->route("ville.index")->with([
            "success" => "ville deleted with success"
        ]);

    }
}
