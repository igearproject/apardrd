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
<br/>
<a href="/dashboard/surat" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datasurat as $data)

<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
		<label for="id_rapat">Rapat</label>
		<select class="form-control" required name="id_rapat" disabled="disabled">
			<option value="" disabled="disabled">---Pilih Rapat---</option>
			@foreach($daftarrapat as $datap)
				<option value="{{$datap->id_rapat}}" 
					@if($data->id_rapat==$datap->id_rapat)
					selected="selected" 
					@endif
					>
					({{$datap->tanggal}}){{$datap->topik}}
				</option>
			@endforeach
		</select>

	</div>
	<div class="form-group">
		<label for="no_surat">No Surat</label>
		<input type="text" name="no_surat" value="{{$data->no_surat}}" maxlength="100" required placeholder="Masukan no surat ..." class="form-control">
	</div>
	<div class="form-group">
		<label for="tanggal_pembuatan">Tanggal Pembuatan Surat</label>
		<input type="date" name="tanggal_pembuatan" value="{{$data->tanggal_pembuatan}}"  required class="form-control">
	</div>
	<div class="form-group">
		<label for="tempat_pembuatan">Tempat Pembuatan Surat</label>
		<input type="text" name="tempat_pembuatan" value="{{$data->tempat_pembuatan}}" maxlength="30" required placeholder="Masukan tempat pembuatan surat ..." class="form-control">
	</div>
	<div class="form-group">
		<label for="perihal">Perihal</label>
		<input type="text" name="perihal" value="{{$data->perihal}}" maxlength="50" required placeholder="Masukan perihal surat ..." class="form-control">
	</div>
	<label>Lihat surat :</label>
	<a href="/dashboard/surat/filesurat/{{$data->file}}" target="_blank">
		<i class="far fa-file-pdf"></i>
		{{$data->file}}
	</a>
	<div class="form-group">
		<label for="file">Ganti File Surat</label>
		<input type="file" name="file" maxlength="100" value="{{$data->file}}" class="form-control-file border">
		<small class="form-text text-muted">Format file harus PDF dengan ukuran maksimal 2 MB, pastikan nama file tidak terlalu panjang</small>

	</div>
	<input type="text" name="file1" maxlength="100"  value="{{$data->file}}" class="form-control" hidden="hidden">
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach
<!-- /modal form -->
@endsection
@section('skripjava')

@endsection