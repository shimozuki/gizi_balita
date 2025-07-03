<?php

namespace App\Http\Controllers;

use App\Lila;
use Illuminate\Http\Request;

class LilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lila = Lila::orderBy('umur')->get();
        return view('pages.lila.index', compact('lila'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.lila.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'umur' => 'required|integer',
            'min3sd' => 'required|numeric',
            'min2sd' => 'required|numeric',
            'min1sd' => 'required|numeric',
            'median' => 'required|numeric',
            'plus1sd' => 'required|numeric',
            'plus2sd' => 'required|numeric',
            'plus3sd' => 'required|numeric',
        ]);

        Lila::create($request->all());
        return redirect()->route('lila.index')->with('success', 'Data LILA berhasil disimpan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lila $lila)
    {
        $request->validate([
            'umur' => 'required|integer',
            'min3sd' => 'required|numeric',
            'min2sd' => 'required|numeric',
            'min1sd' => 'required|numeric',
            'median' => 'required|numeric',
            'plus1sd' => 'required|numeric',
            'plus2sd' => 'required|numeric',
            'plus3sd' => 'required|numeric',
        ]);

        $lila->update($request->all());
        return redirect()->route('lila.index')->with('success', 'Data LILA berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
