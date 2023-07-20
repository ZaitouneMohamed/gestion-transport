<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;

class NatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $natures = Nature::orderBy('id','desc')->Paginate(5);
        return view('gazole.nature.index',compact('natures'));
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
        $this->validate($request,[
            "name" => 'required|max:200'
        ]);
        Nature::create([
            "name" => $request->name
        ]);
        return redirect()->route('nature.index')->with([
            "success" => "nature created successfly"
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
        $nature = Nature::find($id);
        return view('gazole.nature.edit',compact('nature'));
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
        $nature = Nature::find($id);
        $this->validate($request,[
            "name" => 'required|max:200'
        ]);
        $nature->update([
            "name" => $request->name
        ]);
        return redirect()->route('nature.index')->with([
            "success" => "nature updated successfly"
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
        Nature::find($id)->delete();
        return redirect()->route('nature.index')->with([
            "success" => "nature deleted successfly"
        ]);
    }
}
