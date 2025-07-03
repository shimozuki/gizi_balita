<?php

namespace App\Http\Controllers;

use App\LingkarKepala;
use Illuminate\Http\Request;

class LingkarKepalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LingkarKepala::orderBy('umur')->get();
        return view('pages.lingkar_kepala.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.lingkar_kepala.create');
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

        LingkarKepala::create($request->all());
        return redirect()->route('lingkar-kepala.index')->with('success', 'Data lingkar kepala berhasil disimpan');
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
    public function edit(LingkarKepala $lingkar_kepala)
    {
        return view('pages.lingkar_kepala.edit', compact('lingkar_kepala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LingkarKepala $lingkar_kepala)
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

        $lingkar_kepala->update($request->all());
        return redirect()->route('lingkar-kepala.index')->with('success', 'Data lingkar kepala berhasil diperbarui');
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
