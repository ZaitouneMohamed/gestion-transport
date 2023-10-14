<?php

namespace App\Http\Controllers;

use App\Http\Requests\Piece\StorePieceRequest;
use App\Http\Requests\Piece\UpdatePieceRequest;
use App\Models\Piece;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pieces = Piece::latest()->paginate(15);
        return view('gazole.piece.index', compact("pieces"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gazole.piece.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePieceRequest $request)
    {
        $piece = Piece::create([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "date" => $request->date,
            "piece" => $request->piece,
            "fournisseur" => $request->fournisseur,
            "prix" => $request->prix,
            "nature" => $request->nature
        ]);
        return redirect()->route('pieces.index')->with([
            "success" => "piece added with success"
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
        $piece = Piece::find($id);
        return view('gazole.piece.edit', compact('piece'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePieceRequest $request, $id)
    {
        $piece = Piece::find($id);
        $piece->update([
            "chaufeur_id" => $request->chaufeur_id,
            "camion_id" => $request->camion_id,
            "date" => $request->date,
            "piece" => $request->piece,
            "fournisseur" => $request->fournisseur,
            "prix" => $request->prix,
            "nature" => $request->nature
        ]);
        return redirect()->route('pieces.index')->with([
            "success" => "piece updated with success"
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
        $piece = Piece::find($id);
        $piece->delete();
        return redirect()->route('pieces.index')->with([
            "success" => "piece delete with success"
        ]);
    }
}
