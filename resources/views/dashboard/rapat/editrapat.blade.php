@extends('dashboard/maindashboard')
@section('title','Rapat')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','active')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Rapat</li>
@endsection
@section('dataname','Data Rapat')
@section('datacontent')
<br/>
<a href="/dashboard/rapat" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datarapat as $data)
<form action="" class="needs-validation" method="post">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="form-group">
		<label for="topik">Topik Rapat</label>
		<input type="text" name="topik" maxlength="200" value="{{$data->topik}}" required placeholder="Masukan topik rapat ..." class="form-control">
	</div>
	<div class="form-group">
		<label for="tanggal">Tanggal</label>
		<input type="date" name="tanggal" value="{{$data->tanggal}}" required class="form-control">
	</div>
	<label for="jam">Jam</label>
	<div class="form-group">
		<input type="time" name="jam" value="{{$data->jam}}" required class="form-control">	
	</div>
	<div class="form-group">
		<label for="tempat">Tempat</label>
		<textarea name="tempat"  required placeholder="Masukan tempat ..." class="form-control">{{$data->tempat}}</textarea>
	</div>
	<div class="form-group">
		<label for="status">Status</label>
		<select class="form-control" required name="status">
			<option value="" disabled="disabled">---Pilih Status Rapat---</option>
			<option value="draf"  
			@if($data->status=='draf')
				selected 
			@endif 
			>draf - rapat hanya dapat dilihat admin</option>
			<option value="fix"  
			@if($data->status=='fix')
				selected 
			@endif 
			>fix - rapat dapat dilihat pegawai</option>
			<option value="pass"  
			@if($data->status=='pass')
				selected 
			@endif 
			>pass - rapat sudah selesai</option>
			<option value="cancel"  
			@if($data->status=='cancel')
				selected 
			@endif 
			>cancel - rapat dibatalkan</option>
		</select>
	</div>
	<div class="form-group">
		<label for="deskripsi">Deskripsi</label>
		<textarea name="deskripsi"  required placeholder="Masukan deskripsi rapat ..." class="form-control">{{$data->deskripsi}}</textarea>

	</div>

	<input type="submit" name="tambah" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach
@endsection
@section('skripjava')



@endsection