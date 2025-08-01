<?php

namespace App\Http\Controllers\Admin\Action;

use App\Models\Gaun;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaunCreateRequest;
use App\Uploads\UploadGaunPhoto;
use App\Helpers\FormatResponse;
use App\Http\Requests\Admin\GaunEditRequest;
use App\Models\PemesananGaun;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function create(Request $request)
    {
        //
    }

    public function edit(Request $request, PemesananGaun $pemesanan)
    {
        try {
            $payload = $request->validate([
                'status' => 'required',
            ]);

            $pemesanan->update($payload);

            return FormatResponse::successBack("Berhasil ubah status");
        } catch (\Exception $e) {
            return FormatResponse::failed($e);
        }
    }
}
