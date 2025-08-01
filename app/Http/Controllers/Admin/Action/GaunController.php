<?php

namespace App\Http\Controllers\Admin\Action;

use App\Models\Gaun;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaunCreateRequest;
use App\Uploads\UploadGaunPhoto;
use App\Helpers\FormatResponse;
use App\Http\Requests\Admin\GaunEditRequest;
use Illuminate\Http\Request;

class GaunController extends Controller
{
    public function create(GaunCreateRequest $request){
      try{
        $payload = $request->only("nama_gaun","deskripsi","harga","status");
        // var_dump($payload);exit;
        
        if($request->hasFile('foto_gaun')){
          $payload["foto_gaun"] = UploadGaunPhoto::upload($request->file('foto_gaun'));
        }

        Gaun::create($payload);

        return FormatResponse::successBack("Berhasil tambah product");
      }catch(\Exception $e){
        return FormatResponse::failed($e);
      }
    }

    public function edit(GaunEditRequest $request,Gaun $gaun){
        try{
          $payload = $request->only("nama_gaun","deskripsi","harga","status");

          $payload["images"] = [];

          if($request->hasFile('foto_gaun')){
              $payload["images"][] = UploadGaunPhoto::upload($request->file('foto_gaun'));        

              if(isset($product->get_images)){
                UploadGaunPhoto::delete($product->get_images);
              }
          }
          
          if(count($payload["images"])){
            $payload["images"] = json_encode($payload["images"]);
          }else{
            unset($payload["images"]);
          }

          $gaun->update($payload);

          return FormatResponse::successBack("Berhasil edit product");
      }catch(\Exception $e){
          return FormatResponse::failed($e);
      }
    }
}
