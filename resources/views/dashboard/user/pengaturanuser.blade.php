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
@section('menuuser','')
@section('menupengaturanuser','active')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Pengaturan User</li>
@endsection
@section('dataname','Pengaturan User Aplikasi')
@section('datacontent')
<br>
<div class="row container">
	@foreach($datauser as $data)
	<div class="col-md-8 border">
		<br>
		<img src="/foto/{{$data->foto}}" class="img-circle" width="150px" height="150px"></img>
		<br>
		<br>
		<table class="table table-borderless">
			<tr>
				<td colspan="2" class="lead">
					Profile
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="far fa-user"></i></td>
				<td>
					<small>Nama</small><br>
					{{$data->nama}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-key"></i></td>
				<td>
					<small>NIP</small><br>
					{{$data->nip}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="far fa-building"></i></td>
				<td>
					<small>OPD</small><br>
					{{$data->nama_opd}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-user-plus"></i></td>
				<td>
					<small>Jabatan</small><br>
					{{$data->jabatan}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-toggle-off"></i></td>
				<td>
					<small>Status Pegawai</small><br>
					{{$data->status_pegawai}}
					<hr>
				</td>
			</tr>
			<tr>
				<td>
					@if($data->jenis_kelamin=='P')
						<i class="fas fa-female"></i>
					@else
						<i class="fas fa-male"></i>
					@endif
				</td>
				<td>
					<small>Jenis Kelamin</small><br>
					{{$data->jenis_kelamin}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-calendar-day"></i></td>
				<td>
					<small>Tanggal Lahir</small><br>
					{{$data->tanggal_lahir}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-pray"></i></td>
				<td>
					<small>Agama</small><br>
					{{$data->agama}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-phone"></i></td>
				<td>
					<small>No HP</small><br>
					{{$data->no_hp}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="far fa-envelope"></i></td>
				<td>
					<small>Email</small><br>
					{{$data->email}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-map-marker-alt"></i></td>
				<td>
					<small>Alamat</small><br>
					{{$data->alamat}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-user"></i></td>
				<td>
					<small>Username</small><br>
					{{$data->name}}
					<hr>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-layer-group"></i></td>
				<td>
					<small>Hak Akses</small><br>
					{{$data->hak_akses}}
					<hr>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md-4 border">
		<br>
		<a href="/dashboard/pengaturan_user/edit_profile" class="btn btn-success btn-block">
			<i class="fas fa-user-edit"></i> Ubah Profile
		</a>
		<a href="/dashboard/pengaturan_user/edit_password" class="btn btn-info btn-block">
			<i class="fas fa-lock"></i> Ganti Password
		</a>
		<a href="/logout" class="btn btn-outline-danger btn-block">
			<i class="fas fa-sign-out-alt"></i> Logout
		</a>
	</div>
</div>
@endforeach
@endsection
@section('skripjava')


@endsection