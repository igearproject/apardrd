@extends('dashboard/maindashboard')
@section('title','Pengelolaan Rapat')
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
@section('menupengelolaanrapat','active')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Pengelolaan Rapat</li>
@endsection
@section('dataname','Pengelolaan Rapat')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<a href="/dashboard/rapat" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Rapat</a>
  </div>
</div>
<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group">
	<label for="id_rapat">Pilih Rapat </label>
	<select class="form-control" required name="id_rapat">
		<option value="" disabled="disabled">---Pilih Rapat---</option>
		@foreach($daftarrapat as $datap)
			<option value="{{$datap->id_rapat}}">
				({{$datap->tanggal}}){{$datap->topik}} | {{$datap->status}}
			</option>
		@endforeach
	</select>
</div>

<input type="submit" name="tambah" class="btn btn-primary btn-block" value="Kelola Rapat ">
</form>
@if(count($daftarrapat)==0)
<div class="alert alert-secondary text-center" role="alert">
	Tidak ada rapat yang dapat dikelola, anda harus membuat
	<a href="/dashboard/rapat"> rapat Baru !</a>
</div>
@endif
@endsection
@section('skripjava')


@endsection