@extends("user.layout.default")

@section("title")
Gaun
@endsection

@section("sc_header")
<style>
.cursor-pointer{
	cursor:pointer;
}

.img-product{
	height:150px;
	object-fit:cover;
}

.pagination-wareper{
	max-width:350px;
	overflow-x:auto
}
</style>
@endsection

@section("content")
	<div class="container">
		<div class="row">	
        	@foreach($gaun as $item)
				<div class="col-md-3">
					<div class="card">
						<img class="card-img-top cursor-pointer img-product" 
							src="{{ asset('assets/images/gaun/'.$item->foto_gaun )}}"
							onclick="window.location='{{url('user/gaun/'.$item->id)}}'">

						<div class="card-body">
							<div class="clearfix mb-1" style="display: block;">
								<div class="cursor-pointer" 
									onclick="window.location='{{url('user/gaun/'.$item->id)}}'">
									{{ucwords($item->nama_gaun)}}
								</div>
								<div class="">
									{!!$item->get_star!!}
								</div>
							</div>

							<div class="mb-1">
								Rp.{{number_format($item->harga,2)}}
							</div>

							<div class="text-danger mb-3">
								@if($item->status == 'tersewa')
								 <span class="text-danger">Tersewa</span>
								@else
								 <span class="text-success">Tersedia</span>
								@endif
							</div>

							<!-- <div class="text-center">
								<button class="btn btn-success"
									onclick="window.location='{{url('user/order/'.$item->id)}}'">
									Masukan ke invoice
								</button>
							</div> -->
						</div>
					</div>
				</div>
        	@endforeach

        	<div class="pagination-wareper">
        		{{$gaun->links()}}
        	</div>
		</div>
	</div>
@endSection