@extends('dashboard/maindashboard')
@section('title','Notulen')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','')
@section('menunotulensi','active')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Notulen</li>
@endsection
@section('dataname','Data Notulen Rapat')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formpegawai">
		<i class="far fa-plus-square"></i> Add Notulen
	</button>  	
  </div>
</div>

<div class="table-responsive">
<table id="datatabelnotulen" class="table table-hover  data">
	<thead class="thead-light">
<!-- id_notulen
pimpinan
pembuat
kesimpulan
file_notulen
id_rapat -->
		<tr>
			<th>Pimpinan Rapat</th>
			<th>Pembuat</th>
			<th>Kesimpulan</th>
			<th>File Notulen</th>
			<th>Rapat</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datanotulen as $data)
		<tr>
			<td>{{$data->pimpinan}}</td>
			<td>{{$data->pembuat}}</td>			
			<td>{{$data->kesimpulan}}</td>
			<td>
				<a href="/dashboard/notulen/filenotulen/{{$data->file_notulen}}" target="_blank">
					<i class="far fa-file-pdf"></i>
					{{$data->file_notulen}}
				</a>
				
			</td>
			<td>{{$data->topik}} ({{$data->tanggal}})</td>
			<td>
				<a href="/dashboard/notulen/{{$data->id_notulen}}" class="btn btn-warning">
					<i class="fas fa-edit"></i> Edit
				</a>
				<form action="{{ action('notulenController@hapus',['id'=>$data->id_notulen]) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input type="text" name="filenotulen" value="{{$data->file_notulen}}" hidden="hidden">
					<input type="text" name="pembuat" value="{{$data->pembuat}}" hidden="hidden">
					<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Notulen yang dibuat {{$data->pembuat}} dengan nama file {{$data->file_notulen}}')" type="submit">
						<i class="far fa-trash-alt"></i> Delete
					</button>
					
				</form>
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datanotulen)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/notulen">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formpegawai">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> Notulen Rapat</h4>
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
						<label for="pimpinan">Pimpinan Rapat</label>
						<input type="text" name="pimpinan" maxlength="50" required placeholder="Masukan nama lengkap pimpinan rapat ..." class="form-control">

					</div>

					<div class="form-group">
						<label for="pembuat">Pembuat Notulen</label>
						<input type="text" name="pembuat" maxlength="50" required placeholder="Masukan nama lengkap pembuat notulen rapat ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="kesimpulan">Kesimpulan Rapat</label>
						<textarea name="kesimpulan"  required placeholder="Masukan kesimpulan rapat ..." class="form-control"></textarea>

					</div>
					<div class="form-group">
						<label for="file_notulen">File Notulen Rapat</label>
						<input type="file" name="file_notulen" class="form-control-file border" maxlength="100"   placeholder="Masukan file notulen anda ..." class="form-control">
						<small class="form-text text-muted">Format file harus PDF dengan ukuran maksimal 2 MB, pastikan nama file tidak terlalu panjang</small>
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
    $('#datatabelnotulen').DataTable();
  });
</script>

@endsection