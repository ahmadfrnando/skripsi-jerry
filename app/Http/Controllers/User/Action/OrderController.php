<?php

namespace App\Http\Controllers\User\Action;

use App\Http\Controllers\Controller;
use App\Models\{
    Product,
    Invoice,
    Config as ConfigModel,
    Gaun,
    Notification,
    PemesananGaun
};
use App\Helpers\FormatResponse;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class OrderController extends Controller
{

    // public function order(OrderRequest $request){
    //     try{
    //         \DB::beginTransaction();

    //         throw_if(
    //             !date('Y-m-d',strtotime($request->date_start)) === $request->date_start,
    //             new \Exception("Tanggal mulai tidak valid",422)
    //         );     

    //         throw_if(
    //             !now()->addDays(intval(ConfigModel::where('name','payment_day')->first()->value))->isBefore(now()->create($request->date_start)),
    //             new \Exception("Tanggal mulai tidak valid",422)                
    //         );

    //         throw_if(
    //             intval($request->hours) > intval(ConfigModel::where('name','hours')->first()->value),
    //             new \Exception("Jam tidak valid",422)
    //         );

    //         throw_if(
    //             auth()->user()->invoices()->whereIn('status',['pending','payment','running','waiting'])->first(),
    //             new \Exception("Maaf anda masih memiliki invoice yang aktif",422)
    //         );

    //         throw_if(
    //             !$product = Product::where("id",$request->product)->where("status","active")->where("rent",false)->first(),
    //             new \Exception("Product tidak ditemukan",422)
    //         );

    //         auth()->user()->invoices()->create([
    //             "product_id" => $request->product,
    //             "total" => $product->price * $request->hours,
    //             "start_rent" => $request->date_start." ".$request->hour_start.":00:00",
    //             "hour" => $request->hours
    //         ]);

    //         $product->update([
    //             "rent" => true
    //         ]);

    //         \DB::commit();

    //         return FormatResponse::success("/user/invoice","Berhasil membuat invoice");    
    //     }catch(\Exception $e){
    //         \DB::rollback();    

    //         return FormatResponse::failed($e);
    //     }
    // }

    public function order(OrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $gaun = Gaun::findOrFail($id);

            $payload = $request->only("nama_pemesan", "tanggal_sewa_mulai", "tanggal_sewa_selesai", "no_hp", "alamat", "catatan");
            $payload["id_gaun"] = $gaun->id;
            $payload["id_user"] = auth()->user()->id;
            $startDate = Carbon::parse($payload["tanggal_sewa_mulai"]);
            $endDate = Carbon::parse($payload["tanggal_sewa_selesai"]);
            $hari = $startDate->diffInDays($endDate);
            $payload["total_harga"] = $hari > 0 ? $gaun->harga * $hari : $gaun->harga;

            PemesananGaun::create($payload);
            $notif = new Notification();
            $notif->title = 'Penyewaan Gaun';
            $notif->user_id = auth()->user()->id;
            $notif->content = 'Anda telah melakukan penyewaan gaun ' . $gaun->nama_gaun . ' pada tanggal ' . $payload["tanggal_sewa_mulai"] . ' sampai ' . $payload["tanggal_sewa_selesai"];
            $notif->save();

            Invoice::create([
                'user_id' => auth()->user()->id,
                'product_id' => $gaun->id,
                'status' => 'pending',
                'start_rent' => $payload["tanggal_sewa_mulai"],
                'total' => $payload["total_harga"],
                'hour' => $hari
            ]);
            // 'pending','payment','rejected','waiting','running','compeleted','failed','canceled'
            DB::commit();
            return FormatResponse::successBack("Berhasil membuat pesanan");
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponse::failed($e);
        }
    }
}
