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
<br/>
<a href="/dashboard/notulen" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datanotulen as $data)

<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
		<label for="id_rapat">Rapat</label>
		<select class="form-control" required name="id_rapat">
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
		<label for="pimpinan">Pimpinan Rapat</label>
		<input type="text" name="pimpinan" value="{{$data->pimpinan}}" maxlength="50" required placeholder="Masukan nama lengkap pimpinan rapat ..." class="form-control">
	</div>

	<div class="form-group">
		<label for="pembuat">Pembuat Notulen</label>
		<input type="text" name="pembuat" value="{{$data->pembuat}}" maxlength="50" required placeholder="Masukan nama lengkap pembuat notulen rapat ..." class="form-control">

	</div>
	<div class="form-group">
		<label for="kesimpulan">Kesimpulan Rapat</label>
		<textarea name="kesimpulan"  required placeholder="Masukan kesimpulan rapat ..." class="form-control">{{$data->kesimpulan}}</textarea>

	</div>
	<label>Lihat Notulen :</label>
	<a href="/dashboard/notulen/filenotulen/{{$data->file_notulen}}" target="_blank">
		<i class="far fa-file-pdf"></i>
		{{$data->file_notulen}}
	</a>
	<div class="form-group">
		<label for="file_notulen">File Notulen Rapat Baru</label>
		<input type="file" name="file_notulen" class="form-control-file border" maxlength="100"   placeholder="Masukan file notulen anda ..." class="form-control">
		<small class="form-text text-muted">Format file harus PDF dengan ukuran maksimal 2 MB, pastikan nama file tidak terlalu panjang</small>
	</div>
	<input type="text" name="file_notulen1" maxlength="100"  value="{{$data->file_notulen}}" class="form-control" hidden="hidden">
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach
<!-- /modal form -->
@endsection
@section('skripjava')

@endsection