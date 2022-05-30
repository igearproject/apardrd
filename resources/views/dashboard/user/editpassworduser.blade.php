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
<li class="breadcrumb-item">Edit Password</li>
@endsection
@section('dataname','Data User Aplikasi')
@section('datacontent')
<br/>
<a href="/dashboard/user" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>

<form action="" class="needs-validation" method="post">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<label for="email">Password Sebelumnya </label>
	<div class="input-group mb-3">
		<input type="password" name="passwordlama"  maxlength="100" required="required" class="form-control" placeholder="Password sebelumnya*">
	</div>
	<label for="password">Password Baru</label>
	<div class="input-group mb-3">			  			
		<input type="password" name="password" minlength="8" maxlength="100" required="required" class="form-control" placeholder="Password baru*">
		<input type="password" name="password1" minlength="8" maxlength="100" required="required" class="form-control" placeholder="Konfirmasi Password baru*">
	</div>
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Password Baru">
</form>


@endsection
@section('skripjava')


@endsection