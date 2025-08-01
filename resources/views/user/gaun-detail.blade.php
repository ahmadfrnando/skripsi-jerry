@extends("user.layout.default")

@section("title")
	Detail gaun
@endsection

@section("sc_header")
<style>
.cursor-pointer{
	cursor:pointer
}
.description{
	background:#eee
}
.font-size-30{
	font-size: 30px;
}
.font-size-25{
	font-size: 25px;
}
.font-size-20{
	font-size: 20px;
}
.other-image{
	height:50px;
	cursor:pointer;
}
</style>
@endsection

@section("content")
	<div class="container">
		<div class="row">
			<div class="col-md-6 bg-white p-3">
				<img src="{{asset('assets/images/gaun/'.$gaun->get_images)}}"
					class="img-fluid">						
			</div>

			<div class="col-md-6 bg-white p-3">
				<div class="font-size-30">
					{{ucwords($gaun->nama_gaun)}}
				</div>

				<div class="text-success mt-2 font-size-20">
					Rp.{{number_format($gaun->harga,2)}} Perhari
				</div>

				<div class="row mt-3">
					<div class="p-4 text-center col-4">
						<i class='fe fe-star font-size-25'></i> 
						<br/>Bintang<br/>
						{!! $gaun->get_star !!}			
					</div>				
					<div class="p-4 text-center col-4">
						<i class='fe fe-sun font-size-25'></i> 
						<br/>Status<br/>
						@if($gaun->status == 'tersewa')
							<span class="text-danger">
								Tersewa
							</span>
						@else
							<span class="text-success">
								Tidak Tersewa
							</span>
						@endif
					</div>
					<div class="p-4 text-center col-4">
						<i class='fe fe-calendar font-size-25'></i>
						<br/>Dipublish Pada<br/>
						<span class='text-success'>
							{{$gaun->get_human_created_at}}
						</span>
					</div>
				</div>
			</div>

			<div class="col-12 mt-4 bg-white">
				<div class="row p-3">
					<div class="col-md-1 col-3 cursor-pointer" 
						onclick="showProductData('#gaun-deskripsi')">
						Deskripsi
					</div>
					<!-- <div class="col-md-1 col-3 cursor-pointer"
						onclick="showProductData('#product-fasilitas')">
						Fasilitas
					</div>
					<div class="col-md-1 col-3 cursor-pointer"
						onclick="showProductData('#product-quesation')">
						Pertanyaan
					</div>
					<div class="col-md-1 col-3 cursor-pointer"
						onclick="showProductData('#product-review')">
						Review
					</div> -->
				</div>

				<div id="product-description" class="product-data p-3">
					{!!$gaun->deskripsi !!}
				</div>
				<button data-toggle="modal" data-target="#modal-order" class="btn btn-primary mb-2">Pesan Sekarang</button>
			</div>
		</div>
	</div>
@endSection

@section("sc_footer")
<div id="modal-order" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:0px solid red">
        <h5>Order Gaun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div> 

      <div class="modal-body">      
        <form method="post" action="{{url('user/gaun/order/'.$gaun->id)}}" enctype="multipart/form-data">

          {{csrf_field()}}        

          <div class="form-group">
            <div class="mb-2 text-muted">
              Nama Pemesan : 
            </div>
            <div>
              <textarea class="form-control" placeholder="Nama Pemesan . . ." name="nama_pemesan"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              No Hp Pemesan : 
            </div>
            <div>
              <input class="form-control" type="number" name="no_hp"/>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Tanggal Mulai : 
            </div>
            <div>
              <input type="date" class="form-control" name="tanggal_sewa_mulai" >
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Tanggal Selesai : 
            </div>
            <div>
              <input type="date" class="form-control" name="tanggal_sewa_selesai" >
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Alamat : 
            </div>
            <div>
              <textarea class="form-control" name="alamat"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="mb-2 text-muted">
              Caatatan : 
            </div>
            <div>
              <textarea class="form-control" name="catatan"></textarea>
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-success btn-block">
              <i class='fe fe-send'></i> 
              Kirim
            </button>
          </div>
        </form>
      </div>          
    </div>
  </div>
</div>
<script>
$(".gaun-data").hide();

function showProductData(id){
	$(".gaun-data").hide();
	$(id).show();
}
</script>
@endSection