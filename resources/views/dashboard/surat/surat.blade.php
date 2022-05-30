@extends('dashboard/maindashboard')
@section('title','Surat')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','')
@section('menupeserta','')
@section('menusurat','active')
@section('menudokumentasi','')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Surat</li>
@endsection
@section('dataname','Data Surat Rapat')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formpegawai">
		<i class="far fa-plus-square"></i> Add Surat
	</button>  	
  </div>
</div>

<div class="table-responsive">
<table id="datatabelpegawai" class="table table-hover  data">
	<thead class="thead-light">
		<tr>
			<th>No Surat</th>
			<th>Tempat, Tanggal Pembuatan</th>
			<th>Perihal</th>
			<th>File</th>
			<th>Topik Rapat (Tanggal)</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datasurat as $data)
		<tr>
			<td>{{$data->no_surat}}</td>
			<td>{{$data->tempat_pembuatan}}, {{$data->tanggal_pembuatan}}</td>			
			<td>{{$data->perihal}}</td>
			<td>
				<a href="/dashboard/surat/filesurat/{{$data->file}}" target="_blank">
					<i class="far fa-file-pdf"></i>
					{{$data->file}}
				</a>
				
			</td>
			<td>{{$data->topik}} ({{$data->tanggal}})</td>
			<td>
				<a href="/dashboard/surat/{{$data->id_surat}}" class="btn btn-warning">
					<i class="fas fa-edit"></i> Edit
				</a>
				<form action="{{ action('suratController@hapus',['id'=>$data->id_surat]) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input type="text" name="filesurat" value="{{$data->file}}" hidden="hidden">
					<input type="text" name="no_surat" value="{{$data->no_surat}}" hidden="hidden">
					<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus surat dengan no {{$data->no_surat}}')" type="submit">
						<i class="far fa-trash-alt"></i> Delete
					</button>
					
				</form>
			
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datasurat)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/surat">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formpegawai">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> Data Surat</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="id_rapat">Rapat</label>
						<select class="form-control" required name="id_rapat">
							<option value="" disabled="disabled">---Pilih Rapat---</option>
							@php
								$tampil='';
							@endphp
							@foreach($daftarrapat as $datap)
								@foreach($datasurat as $data)
									@php
										if($datap->id_rapat==$data->id_rapat){
											$tampil='No';
										}										
									@endphp
								@endforeach
								@if($tampil!='No')
								<option value="{{$datap->id_rapat}}">
									({{$datap->tanggal}}){{$datap->topik}}
								</option>
								@endif
								@php
									$tampil='Yes';
								@endphp
							@endforeach
						</select>
						<small id="rapatpesan" class="form-text text-muted">Rapat hanya memiliki satu surat</small>
					</div>
					<div class="form-group">
						<label for="no_surat">No Surat</label>
						<input type="text" name="no_surat" maxlength="100" required placeholder="Masukan no surat ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="tanggal_pembuatan">Tanggal Pembuatan Surat</label>
						<input type="date" name="tanggal_pembuatan" required class="form-control">

					</div>
					<div class="form-group">
						<label for="tempat_pembuatan">Tempat Pembuatan Surat</label>
						<input type="text" name="tempat_pembuatan" maxlength="30" required placeholder="Masukan tempat pembuatan surat ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="perihal">Perihal</label>
						<input type="text" name="perihal" maxlength="50" required placeholder="Masukan perihal surat ..." class="form-control">
					</div>
					<div class="form-group">
						<label for="file">File Surat</label>
						<input type="file" name="file" maxlength="100" required class="form-control-file border">
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
    $('#datatabelpegawai').DataTable();
  });
</script>

@endsection