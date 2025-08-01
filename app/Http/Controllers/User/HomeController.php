<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Config as ConfigModel;
use App\Models\PemesananGaun;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {   
        $id_user = Auth::user()->id;
        $pesanan = PemesananGaun::where('id_user', $id_user)
            ->whereIn('status', ['diproses', 'berjalan'])
            ->where('tanggal_sewa_selesai', '>=', now()->toDateString())
            ->paginate(10);

        return view("user.home", [
            "pesanan" => $pesanan,
        ]);
    }
}
