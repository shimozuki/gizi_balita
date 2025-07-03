<?php

namespace App\Http\Controllers;

use App\Orangtua;
use App\Balita;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->level === 'kader') {
            $orangtua = Orangtua::where('posyandu', $user->posyandu)->count();
            $balita = Balita::whereHas('orangtua', function ($q) use ($user) {
                $q->where('posyandu', $user->posyandu);
            })->count();
            $admin = null; // Tidak relevan untuk kader

        } else {
            $orangtua = Orangtua::count();
            $balita = Balita::count();
            $admin = User::whereIn('level', ['admin', 'kader'])->count(); // FIXED
        }

        return view('pages.home', compact('orangtua', 'balita', 'admin'));
    }
}
