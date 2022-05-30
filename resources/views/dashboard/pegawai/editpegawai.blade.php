@extends('dashboard/maindashboard')
@section('title','Pegawai')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','active')
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
<li class="breadcrumb-item">Pegawai</li>
@endsection
@section('dataname','Edit Data Pegawai')
@section('datacontent')
<br/>
<a href="/dashboard/pegawai" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datapegawai as $data)

<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
		<label for="nama">Nama Lengkap</label>
		<input type="text" name="nama" maxlength="50" value="{{$data->nama}}" required placeholder="Masukan nama lengkap ..." class="form-control">

	</div>
	<div class="form-group">
		<label for="nip">NIP</label>
		<input type="text" name="nip" maxlength="20" value="{{$data->nip}}" required placeholder="Masukan NIP ..." class="form-control">

	</div>
	<div class="form-group">
		<label for="nama">Jabatan</label>
		<input type="text" name="jabatan" maxlength="30" value="{{$data->jabatan}}" required placeholder="Masukan jabatan ..." class="form-control">

	</div>
	<label for="jenis_kelamin">Jenis Kelamin</label>
	<div class="form-group">
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="jenis_kelamin" value="L"
		    @if($data->jenis_kelamin=='L')
		    	checked="checked"
		    @endif
		     >Laki-laki
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="jenis_kelamin" value="P" 
		    @if($data->jenis_kelamin=='P')
		    	checked="checked"
		    @endif
		    >Perempuan
		  </label>
		</div>					
	</div>
	<div class="form-group">
		<label for="no_hp">No HP</label>
		<input type="text" name="no_hp" maxlength="15" value="{{$data->no_hp}}" required placeholder="Masukan no HP ..." class="form-control">
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" maxlength="100" value="{{$data->email}}" required placeholder="Masukan email ..." class="form-control">
	</div>
	<label for="agama">Agama</label>
	<div class="form-group">
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="agama" value="hindu"
		    @if($data->agama=='hindu')
		    	checked="checked"
		    @endif
		    >Hindu
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="agama" value="islam"
		    @if($data->agama=='islam')
		    	checked="checked"
		    @endif
		    >Islam
		  </label>
		</div>	
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="agama" value="kristen protestan"
		    @if($data->agama=='kristen protestan')
		    	checked="checked"
		    @endif
		    >Kristen Protestan
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="agama" value="katolik"
		    @if($data->agama=='katolik')
		    	checked="checked"
		    @endif
		    >Katolik
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="agama" value="buddha"
		    @if($data->agama=='buddha')
		    	checked="checked"
		    @endif
		    >Buddha
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="agama" value="kong hu cu"
		    @if($data->agama=='kong hu cu')
		    	checked="checked"
		    @endif
		    >Kong Hu Cu
		  </label>
		</div>					
	</div>
	<div class="form-group">
		<label for="tanggal_lahir">Tanggal Lahir</label>
		<input type="date" name="tanggal_lahir" value="{{$data->tanggal_lahir}}" required placeholder="Masukan tanggal lahir ..." class="form-control">
	</div>
	<img src="{{asset('foto/'.$data->foto)}}" class="img-circle" alt="foto Profil" width="200px" height="200px">
	<div class="form-group">
		<label for="foto">Ganti Foto</label>
		<input type="file" name="foto" class="form-control-file border" maxlength="100"    placeholder="Masukan foto anda ..." class="form-control">

	</div>
	<input type="text" name="foto1" value="{{$data->foto}}" hidden="hidden">
	<div class="form-group">
		<label for="alamat">Alamat</label>
		<textarea name="alamat"   required placeholder="Masukan alamat ..." class="form-control">{{$data->alamat}}</textarea>

	</div>
	<div class="form-group">
		<label for="status_pegawai">Satus Pegawai</label>
		<select class="form-control" required name="status_pegawai">
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
	</div>
	
	<div class="form-group">
		<label for="id_opd">OPD</label>
		<select class="form-control" required name="id_opd">
			<option value="" disabled="disabled">---Pegawai dari OPD---</option>
			@foreach($daftaropd as $datap)
			<option value="{{$datap->id_opd}}"
				@if($datap->id_opd==$data->id_opd)
				 selected
				@endif
				>
				{{$datap->nama_opd}}
			</option>
			@endforeach
		</select>

	</div>
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach
<!-- /modal form -->
@endsection
@section('skripjava')

@endsection