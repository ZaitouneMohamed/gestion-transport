<?php

namespace App\Http\Controllers;

use App\Models\Natures;
use Illuminate\Http\Request;

class NaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $natures = Natures::latest()->paginate(15);
        return view('gazole.nature.index', compact("natures"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.nature.create');
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
            "name" => "required|unique:natures,name",
            "type" => "required|unique:natures,type"
        ]);
        Natures::create([
            "name" => $request->name,
            "type" => $request->type
        ]);
        return redirect()->route('natures.index')->with([
            "success" => "nature added with success"
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
        $nature = Natures::find($id);
        return view('gazole.nature.edit', compact("nature"));
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
        $nature = Natures::find($id);
        $this->validate($request, [
            "name" => "required",
            "type" => "required"
        ]);
        $nature->update([
            "name" => $request->name,
            "type" => $request->type
        ]);
        return redirect()->route('natures.index')->with([
            "success" => "nature update with success"
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
        Natures::find($id)->delete();
        return redirect()->route('natures.index')->with([
            "success" => "nature delete with success"
        ]);
    }
}
