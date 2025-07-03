<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaderController extends Controller
{
    public function index()
    {
        $kaders = AppUser::where('level', 'kader')->get();
        return view('pages.kader.index', compact('kaders'));
    }

    public function create()
    {
        return view('pages.kader.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
            'posyandu' => 'required|string'
        ]);

        AppUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'level'    => 'kader',
            'posyandu' => $request->posyandu,
        ]);

        return redirect()->route('kader.index')->with('success', 'Kader berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kader = AppUser::findOrFail($id);
        return view('pages.kader.edit', compact('kader'));
    }

    public function update(Request $request, $id)
    {
        $kader = AppUser::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:user,email,' . $kader->id,
            'posyandu' => 'required|string'
        ]);

        $kader->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'posyandu' => $request->posyandu,
        ]);

        return redirect()->route('kader.index')->with('success', 'Kader berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kader = AppUser::findOrFail($id);
        $kader->delete();

        return redirect()->route('kader.index')->with('success', 'Kader berhasil dihapus.');
    }
}
