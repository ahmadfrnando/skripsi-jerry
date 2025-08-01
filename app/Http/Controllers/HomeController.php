<?php

namespace App\Http\Controllers;

use App\Models\Gaun;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $foto = Gaun::all();
        return view('home', compact('foto'));
    }
}
