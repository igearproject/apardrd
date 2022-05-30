@extends('dashboard/maindashboard')
@section('title','Dokumentasi')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','active')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Dokumentasi</li>
@endsection
@section('dataname','Data Dokumentasi Kegiatan Rapat')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formdokumentasi">
		<i class="far fa-plus-square"></i> Add Dokumentasi
	</button>  	
  </div>
</div>

<div class="table-responsive">
<table id="datatabelpegawai" class="table table-hover  data">
	<thead class="thead-light">
<!-- id_dokumentasi
nama
id_rapat -->
		<tr>
			<th>Rapat (Tanggal)</th>
			<th>Foto</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datadokumentasi as $data)
		<tr>
			<td>{{$data->topik}}<br/> ({{$data->tanggal}})</td>
			<td>
				<div class="card" style="width: 18rem;">
				  <img src="{{asset('fotoDokumentasi/'.$data->nama)}}" class="card-img-top" alt="Foto Dokumentasi Kegiatan Rapat">
				  <div class="card-body">
				    <p class="card-text">{{$data->nama}}</p>
				  </div>
				</div>
			</td>
			<td>
				<a href="/dashboard/dokumentasi/{{$data->id_dokumentasi}}" class="btn btn-warning">
						<i class="fas fa-edit"></i> Edit
				</a>
			     <form action="{{ action('dokumentasiController@hapus',['id'=>$data->id_dokumentasi]) }}" method="post">
			     	{{ csrf_field() }}
			     	{{ method_field('DELETE') }}
			     	<input type="text" name="nama" value="{{$data->nama}}" hidden="hidden">
			     	<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus foto dokumentasi dengan nama {{$data->nama}}')" type="submit">
						<i class="far fa-trash-alt"></i> Delete
					</button>
			     	
			     </form>
				
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datadokumentasi)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/dokumentasi">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formdokumentasi">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> Dokumentasi Kegiatan Rapat</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="id_rapat">Rapat</label>
						<select class="form-control" required name="id_rapat">
							<option value="" disabled="disabled">---Pilih Rapat---</option>
							@foreach($daftarrapat as $datap)
								<option value="{{$datap->id_rapat}}">
									({{$datap->tanggal}}){{$datap->topik}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="gambar">Gambar </label>
						<input type="file" name="gambar" class="form-control-file border" maxlength="100"   placeholder="Masukan foto anda ..." class="form-control" required="required">
						<small class="form-text text-muted">Format file (jpeg, png, gif, jpg, webp) dengan ukuran maksimal 2MB, pastikan nama gambar tidak terlalu panjang</small>
					</div>
					<input type="submit" name="tambah" class="btn btn-primary btn-block" value="Tambah">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	
</div>

<!-- /modal form -->
@endsection
@section('skripjava')

<script>
  $(document).ready(function() {
    $('#datatabelpegawai').DataTable();
  });
</script>

@endsection