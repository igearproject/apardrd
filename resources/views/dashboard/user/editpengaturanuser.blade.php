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
	<form action="" method="post" class="needs-validation" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	@foreach($datauser as $data)
	<div class="col-md-12 border">
		<br>
		<div class="row">
			<div class="col-md-4">
				<img src="/foto/{{$data->foto}}" class="img-circle" width="150px" height="150px"></img>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="foto">Ganti Foto</label>
					<input type="file" name="foto" class="form-control-file border" maxlength="100"    placeholder="Masukan foto anda ..." class="form-control">

				</div>
				<input type="text" name="foto1" value="{{$data->foto}}" hidden="hidden">
			</div>
		</div>
		
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
					<input type="text" name="nama" maxlength="50" value="{{$data->nama}}" required placeholder="Masukan nama lengkap ..." class="form-control" readonly>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-key"></i></td>
				<td>
					<small>NIP</small><br>
					<input type="text" name="nip" readonly maxlength="20" value="{{$data->nip}}" required placeholder="Masukan NIP ..." class="form-control">
				</td>
			</tr>
			<tr>
				<td><i class="far fa-building"></i></td>
				<td>
					<small>OPD</small><br>
					{{$data->nama_opd}}
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-user-plus"></i></td>
				<td>
					<small>Jabatan</small><br>
					<input type="text" name="jabatan" readonly maxlength="30" value="{{$data->jabatan}}" required placeholder="Masukan jabatan ..." class="form-control">
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-toggle-off"></i></td>
				<td>
					<small>Status Pegawai</small><br>
					<select class="form-control" required disabled name="status_pegawai">
						<option value="" disabled="disabled">---Pilih status Pegawai---</option>						
						<option value="aktif"
							@if($data->status_pegawai=='aktif')
							 selected
							@endif
							>Aktif</option>
						<option value="tidak_aktif"
							@if($data->status_pegawai=='tidak_aktif')
							 selected
							@endif
							>Tidak aktif</option>
						<option value="pensiun"
							@if($data->status_pegawai=='pensiun')
							 selected
							@endif
							>Pensiun</option>
					</select>
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
					<div class="form-group">
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" disabled class="form-check-input" required name="jenis_kelamin" value="L"
						    @if($data->jenis_kelamin=='L')
						    	checked="checked"
						    @endif
						     >Laki-laki
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" disabled class="form-check-input" required name="jenis_kelamin" value="P" 
						    @if($data->jenis_kelamin=='P')
						    	checked="checked"
						    @endif
						    >Perempuan
						  </label>
						</div>					
					</div>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-calendar-day"></i></td>
				<td>
					<small>Tanggal Lahir</small><br>
					<input type="date" readonly name="tanggal_lahir" value="{{$data->tanggal_lahir}}" required placeholder="Masukan tanggal lahir ..." class="form-control">
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
					<input type="text" name="no_hp" maxlength="15" value="{{$data->no_hp}}" required placeholder="Masukan no HP ..." class="form-control">
				</td>
			</tr>
			<tr>
				<td><i class="far fa-envelope"></i></td>
				<td>
					<small>Email</small><br>
					<input type="email" name="email" maxlength="100" value="{{$data->email}}" required placeholder="Masukan email ..." class="form-control">
					<small>*Email ini akan digunakan untuk login ke sistem</small>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-map-marker-alt"></i></td>
				<td>
					<small>Alamat</small><br>
					<textarea name="alamat"   required placeholder="Masukan alamat ..." class="form-control">{{$data->alamat}}</textarea>
				</td>
			</tr>
			<tr>
				<td><i class="fas fa-user"></i></td>
				<td>
					<small>Username</small><br>
					<input type="text" name="name" value="{{$data->name}}" maxlength="50" required placeholder="Username*" class="form-control">
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
		<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
	</div>
	</form>
</div>
@endforeach
@endsection
@section('skripjava')


@endsection