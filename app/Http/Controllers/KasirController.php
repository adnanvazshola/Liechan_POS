<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class KasirController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('kasir.home', compact('user'));
    }   
}
