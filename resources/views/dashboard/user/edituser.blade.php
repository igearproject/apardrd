@extends('dashboard/maindashboard')
@section('title','User')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','')
@section('menurapat','')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','active')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item"><a href="/dashboard/user">User</a></li>
<li class="breadcrumb-item">Edit</li>
@endsection
@section('dataname','Data User Aplikasi')
@section('datacontent')
<br/>
<a href="/dashboard/user" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datauser as $data)

<form action="" class="needs-validation" method="post">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
		<label for="name">Username</label>
		<input type="text" name="name" value="{{$data->name}}" maxlength="50" required placeholder="Username*" class="form-control">
	</div>
	<label for="email">Email </label>
	<div class="input-group mb-3">
		<input type="email" name="email" value="{{$data->email}}" maxlength="100" required="required" class="form-control" placeholder="Email*">
	</div>
	<div class="form-group">
		<label for="hak_akses">Hak Akses</label>
		<select class="form-control" required name="hak_akses">
			<option value="" disabled="disabled">---Pilih Hak Akses Untuk User---</option>						
			<option value="admin" 
			@if($data->hak_akses=='admin')
				selected
			@endif
			>
				Admin
			</option>
			<option value="pegawai" 
			@if($data->hak_akses=='pegawai')
				selected
			@endif
			>
				Pegawai
			</option>
			<option value="nonaktif" 
			@if($data->hak_akses=='nonaktif')
				selected
			@endif
			>
				Nonaktif
			</option>
		</select>
	</div>
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach

@endsection
@section('skripjava')

@endsection