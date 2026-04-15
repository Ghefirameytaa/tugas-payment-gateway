<?php

namespace App\Http\Controllers;

use App\Models\PaketLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function beranda()
    {
        $pakets = PaketLayanan::latest()->take(4)->get();
        return view('beranda', compact('pakets'));
    }
}
