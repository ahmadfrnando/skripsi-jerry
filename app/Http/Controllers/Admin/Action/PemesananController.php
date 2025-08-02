<?php

namespace App\Http\Controllers\Admin\Action;

use App\Models\Gaun;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GaunCreateRequest;
use App\Uploads\UploadGaunPhoto;
use App\Helpers\FormatResponse;
use App\Http\Requests\Admin\GaunEditRequest;
use App\Models\Notification;
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
                'status' => 'required|in:diproses,berjalan,selesai',
            ]);

            $pemesanan->update(['status' => $payload['status']]);

            Notification::create([
                "user_id" => $pemesanan->id_user,
                "title" => "Status invoice telah diperbarui",
                "content" => "Status invoice untuk " . ($pemesanan->gaun->nama_gaun ?? 'N/A') . " berubah menjadi " . ($pemesanan->status ?? 'N/A')
            ]);

            return FormatResponse::successBack("Status berhasil diperbarui");
        } catch (\Throwable $e) {
            return FormatResponse::failed($e);
        }
    }
}
