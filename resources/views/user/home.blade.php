<?php

use Carbon\Carbon;
?>
@extends("user.layout.default")

@section("title")
Home
@endsection

@section("sc_header")
<style>
	.font-size-30 {
		font-size: 30px;
	}

	.font-size-8 {
		font-size: 8px;
	}

	.font-size-15 {
		font-size: 15px;
	}

	#box-tracker {
		border: 0px solid gray;
		border-radius: 20px;
		box-shadow: 0px 3px 0px #eee;
	}
</style>
@endsection

@section("content")
<div class="container">
	@if($pesanan->count() > 0)
	@foreach($pesanan as $item)
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class='col-md-3 mb-3'>
					<img src="{{asset('assets/images/gaun/'.$item->gaun->get_images)}}"
						class="img-fluid">
				</div>
				<div class="col-md-9 mb-3">
					<div class="row">
						<div class="col-12">
							<div class="clearfix">
								<div class="float-left">
									<h4>
										{{$item->gaun->nama_gaun ?? ''}}
									</h4>
								</div>

								<div class="float-right">
									@if($item->status == "proses")
									<span class="badge badge-warning">
										Pending
									</span>
									@elseif($item->status == "berjalan")
									<span class="badge badge-warning">
										Berjalan
									</span>
									@elseif($item->status == "selesai")
									<span class="badge badge-success">
										Selesai
									</span>
									@endif
								</div>
							</div>
						</div>

						<div class="col-12">
							<h5 class='text-success'>
								Rp.{{number_format($item->gaun->harga,2)}} Perhari
							</h5>
						</div>

						<div class="col-12 mt-2">
							<b>
								Total : Rp.{{number_format($item->total_harga,2)}} - ({{ \Carbon\Carbon::parse($item->tanggal_sewa_mulai)->diffInDays(\Carbon\Carbon::parse($item->tanggal_sewa_selesai)) }} hari)
							</b>
						</div>

						<div class="col-12 mt-5">
							<div class="clearfix">
								<div class="float-left text-left">
									<b>
										Tanggal Mulai : {{$item->tanggal_sewa_mulai}}
									</b>
									<b>
										Tanggal Selesai : {{$item->tanggal_sewa_selesai}}
									</b>
								</div>
								<div class="float-right">
									<b>
										Dibuat Pada : {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}
									</b>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@else
	<div class="card">
		<div class="card-body">
			<div class="col-md-8 m-auto text-center">
				<img src="{{asset('assets/images/404.png')}}"
					class="img-fluid">
				<h5>Data pemesanan tidak ditemukan</h5>
			</div>
		</div>
	</div>
	@endif
</div>
@endSection