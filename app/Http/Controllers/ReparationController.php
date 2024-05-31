<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reparation\CreateReparationRequest;
use App\Http\Requests\Reparation\UpdateReparationRequest;
use App\Models\Reparation;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reparations = Reparation::latest();
        if ($request->has('date')) {
            $reparations->whereDate('date', $request->date);
        }
        $reparations = $reparations->paginate(15);
        return view('gazole.reparation.index', compact('reparations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.reparation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReparationRequest $request)
    {
        Reparation::create([
            "date" => $request->date,
            "prix" => $request->solde,
            "n_bon" => $request->n_bon,
        ]);
        return redirect()->route('reparations.index')->with([
            "success" => "reparation added with success"
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
        $data = Reparation::find($id);
        return view('gazole.reparation.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Reparation::find($id);
        return view('gazole.reparation.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReparationRequest $request, $id)
    {
        $reparation = Reparation::find($id);
        $reparation->update([
            "date" => $request->date,
            "prix" => $request->solde,
            "n_bon" => $request->n_bon,
        ]);
        return redirect()->route('reparations.index')->with([
            "success" => "reparation updated with success"
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
        $piece = Reparation::find($id);
        $piece->delete();
        return redirect()->route('reparations.index')->with([
            "success" => "reparation delete with success"
        ]);
    }
}
