@extends('dashboard/maindashboard')
@section('title','OPD')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','active')
@section('menupegawai','')
@section('menurapatutama','')
@section('menurapat','')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">OPD</li>
@endsection
@section('dataname','Edit Organisasi Perangkat Daerah')
@section('datacontent')
<a href="/dashboard/opd" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
<!-- modal form -->
@foreach($dataopdedit as $data)
<form action="" class="needs-validation" method="post">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<input type="hidden" name="id_opd" value="{{$data->id_opd}}">
	<div class="form-group">
		<label for="nama_opd">Nama OPD</label>
		<input type="text" name="nama_opd" value="{{$data->nama_opd}}" maxlength="100" required placeholder="Masukan nama OPD ..." class="form-control">
		<div class="valid-feedback">Benar.</div>
		<div class="invalid-feedback">Wajib Diisi.</div>

	</div>
	<div class="form-group">
		<label for="alamat">Alamat</label>
		<textarea name="alamat" required placeholder="Masukan alamat ..." class="form-control">{{$data->alamat}}</textarea>
		<div class="valid-feedback">Benar.</div>
		<div class="invalid-feedback">Wajib Diisi.</div>

	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" value="{{$data->email}}" maxlength="100" required placeholder="Masukan email ..." class="form-control">
		<div class="valid-feedback">Benar.</div>
		<div class="invalid-feedback">Wajib Diisi.</div>

	</div>
	<div class="form-group">
		<label for="website">website</label>
		<input type="text" name="website" value="{{$data->website}}" maxlength="100" required placeholder="Masukan alamat website ..." class="form-control">
		<div class="valid-feedback">Benar.</div>
		<div class="invalid-feedback">Wajib Diisi.</div>

	</div>
	<div class="form-group">
		<label for="deskripsi">Deskripsi</label>
		<textarea name="deskripsi" required placeholder="Masukan deskripsi ..." class="form-control">{{$data->deskripsi}}</textarea>
		<div class="valid-feedback">Benar.</div>
		<div class="invalid-feedback">Wajib Diisi.</div>

	</div>
	<button type="submit" name="edit" class="btn btn-warning btn-block" ><i class="far fa-save"></i> Simpan Perubahan</button>
</form>
@endforeach
<!-- /modal form -->
@endsection
@section('skripjava')
<script type="text/javascript">
	$(document).ready(function(){
		var table=$('#tableopd').DataTable();
	})
</script>

@endsection