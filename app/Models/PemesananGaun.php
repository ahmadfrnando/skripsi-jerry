<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class PemesananGaun extends Model
{
    protected $table = 'pemesanan_gaun';

    protected $guarded = [];

    protected $appends = ['get_hari'];

    public function gaun()
    {
        return $this->belongsTo(Gaun::class, 'id_gaun');
    }

    public function getHari($tanggal_mulai, $tanggal_selesai)
    {
        $startDate = Carbon::parse($tanggal_mulai);
        $endDate = Carbon::parse($tanggal_selesai);
        return $startDate->diffInDays($endDate);
    }
}
