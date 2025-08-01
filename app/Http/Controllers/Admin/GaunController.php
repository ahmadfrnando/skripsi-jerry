<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gaun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaunController extends Controller
{
	public function index(Request $request){
    	$search = $request->search ?? '';

    	$gaun = Gaun::where('nama_gaun','LIKE',"%{$search}%")
    		->orderBy('id','desc')
    		->paginate(10);

    	return view("admin.gaun",compact("gaun","search"));  
    }
}
