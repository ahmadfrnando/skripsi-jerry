@extends("admin.layout.default")

@section("title")
Gaun
@endsection

@section("content")
<div class="container">
	<div class="clearfix mb-4">
		<div class="float-left">
			<h3>Kelola Gaun</h3>
		</div>

		<div class="float-right">
			<form>
				<input type="text" class="form-control" placeholder="Search . . ." value="{{$search}}"
					name="search"
					onkeyup="event.key == 13 ? this.form.submit() : ''">
			</form>
		</div>
	</div>

  <div class="table-responsive bg-white p-3">
    <div class="mt-3 mb-3">
      <button class="btn btn-primary"
        data-toggle="modal" data-target="#modal-add">
        <i class='fe fe-plus'></i> 
        Tambah
      </button>
    </div>

  	<table class="table">
  		<tr>
  			<th>Id</th>
        <th class="text-center">Gambar</th>
  			<th>Nama Gaun</th>
  			<th>Bintang</th>
  			<th>Harga Sewa</th>
        <th>Status</th>
  			<th>Opsi</th>
  		</tr>

  		@foreach($gaun as $key => $item)
  		<tr>
  			<td>{{$key + 1}}</td>
  			<td class="p-0 text-center"> 
          <a href="{{asset('assets/images/gaun/'.$item->get_images)}}" target="_blank">
            <img src="{{asset('assets/images/gaun/'.$item->get_images)}}" width="100px" />
          </a>
        </td>
  			<td>{{$item->nama_gaun}}</td>
  			<td>{!! $item->get_star !!}</td>
  			<td>Rp.{{number_format($item->harga,2)}}</td>  			
        <td>
          @if($item->status == "tersedia")
            <span class="badge badge-success">
              Tersedia
            </span>
          @else
            <span class="badge badge-danger">
              Tersewa
            </span>
          @endif
        </td>
  			<td>
          <button class="btn btn-success"
            data-toggle="modal" data-target="#modal-edit-{{$item->id}}">
            <i class='fe fe-edit'></i> 
            Edit
          </button>
  			</td>
  		</tr>  		

      <div id="modal-edit-{{$item->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header" style="border:0px solid red">
              <h5>Edit Gaun {{$item->id}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div> 

            <div class="modal-body">      
              <form method="post" action="{{url('admin/gaun/edit/'.$item->id)}}" enctype="multipart/form-data">

                {{csrf_field()}}        

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Nama gaun : 
                  </div>
                  <div>
                    <textarea class="form-control" placeholder="Alamat . . ." name="address">{{$item->nama_gaun}}</textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Harga : 
                  </div>
                  <div>
                    <input type="text" class="form-control" placeholder="Harga . . ." name="price"  value="{{$item->harga}}">
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Status : 
                  </div>
                  <div>
                    <select class="form-control" name="status">
                      <option value="tersedia" {{$item->status == 'tersedia' ? 'selected' : ''}}>
                        Aktif
                      </option>
                      <option value="tersewa" {{$item->staus == "tersewa" ? 'selected' : ''}}>
                        Nonaktif
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Deskripsi : 
                  </div>
                  <div>
                    <textarea id="summernote-edit-{{$item->id}}-deskripsi" class="form-control" name="deskripsi"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <div class="mb-2 text-muted">
                    Gambar: 
                  </div>
                  <div>
                    <input type="file" class="form-control" name="foto_gaun">
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
  		@endforeach

  		@if(!count($gaun))
  		<tr>
        <td colspan="10">
          <div class="col-4 m-auto text-center p-4">
            <img src="{{asset('assets/images/404.png')}}"
              class="img-fluid">
            <h5>Data tidak ditemukan</h5>
          </div>
        </td>
      </tr>
  		@endif
  	</table>

  	<div class="p-3">
  		{{$gaun->links()}}
  	</div>
  </div>
</div>
@endSection

@section("sc_footer")
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:0px solid red">
        <h5>Tambah Gaun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div> 

      <div class="modal-body">      
        <form method="post" action="{{url('admin/gaun/add')}}" enctype="multipart/form-data">

          {{csrf_field()}}        

          <div class="form-group">
            <div class="mb-2 text-muted">
              Nama Gaun : 
            </div>
            <div>
              <textarea class="form-control" placeholder="Nama Gaun . . ." name="nama_gaun"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Harga : 
            </div>
            <div>
              <input type="text" class="form-control" placeholder="Harga . . ." name="harga" >
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Status : 
            </div>
            <div>
              <select class="form-control" name="status">
                <option value="tersedia">
                  Tersedia
                </option>
                <option value="tersewa">
                  Tersewa
                </option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Deskripsi : 
            </div>
            <div>
              <textarea id="summernote-add-description" class="form-control" name="deskripsi"></textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="mb-2 text-muted">
              Gambar : 
            </div>
            <div>
              <input type="file" class="form-control" name="foto_gaun">
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

<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script>

$('#summernote-add-description').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-add-description").summernote("code","<p>Deskripsi</p>");

$('#summernote-add-fasilitas').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-add-fasilitas").summernote("code","<p>Fasilitas</p>");
</script>

@foreach($gaun as $item)
<script>

$('#summernote-edit-{{$item->id}}-description').summernote({
  height : 200, 
  toolbar : [
    ['style',['bold','italic','underline']],
    ['color',['color']],
    ['para',['ul','ol']]
  ]
});
$("#summernote-edit-{{$item->id}}-description").summernote("code","{!! $item->description !!}");
</script>
@endforeach
@endSection