<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gaun;

class GaunController extends Controller
{
    public function index(){    
    	$gaun = Gaun::query()
    		->where('status','tersedia')
    		->orderBy('id','desc')
    		->paginate(8);

    	return view("user.gaun",compact('gaun'));
    }

    public function detail($id){   
    	$gaun = Gaun::query()
            // ->with(["reviews.user"])            
            ->where('status','tersedia')
    		->findOrFail($id);    	

    	return view("user.gaun-detail",compact("gaun"));
    }
}
