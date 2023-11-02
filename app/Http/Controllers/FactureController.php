<?php

namespace App\Http\Controllers;

use App\Models\facture;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = facture::orderBy('date', 'desc');

        if ($request->has('date')) {
            $date = $request->input('date');
            $query->where('date', $date);
        }

        $factures = $query->paginate(15);
        return view('gazole.factures.index',compact("factures"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'date' => 'required',
            'prix' => 'required',
            'station_id' => 'required',
            'n_bon' => 'required|unique:factures,n_bon',
        ]);
        $facture = facture::create([
            "date" => $request->date,
            "prix" => $request->prix,
            "station_id" => $request->station_id,
            "n_bon" => $request->n_bon,
        ]);
        return redirect()->route('factures.index')->with([
            "success" => "facture added with success"
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
        $facture = facture::find($id);
        return view('gazole.factures.edit',compact('facture'));
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
            'date' => 'required',
            'prix' => 'required',
            'station_id' => 'required',
            'n_bon' => 'required',
        ]);
        $facture = facture::find($id);
        $facture->update([
            "date" => $request->date,
            "prix" => $request->prix,
            "station_id" => $request->station_id,
            "n_bon" => $request->n_bon,
        ]);
        return redirect()->route('factures.index')->with([
            "success" => "facture updated with success"
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
        $facture = facture::find($id);
        $facture->delete();
        return redirect()->route('factures.index')->with([
            "success" => "facture deleted with success"
        ]);
    }
}
