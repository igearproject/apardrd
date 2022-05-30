@extends('dashboard/maindashboard')
@section('title','Peserta Rapat')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','')
@section('menupeserta','active')
@section('menusurat','')
@section('menudokumentasi','')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Peserta Rapat</li>
@endsection
@section('dataname','Data Peserta Rapat')
@section('datacontent')
<div class="card text-center">
  <div class="card-header">
    Pilih Rapat yang akan Dikelola Pesertanya
  </div>
  <div class="card-body">
    <h5 class="card-title">Pilih Rapat </h5>
	    <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<!-- <label for="id_rapat">Pilih Rapat </label> -->
			<select class="form-control" required name="id_rapat">
				<option value="" disabled="disabled">---Pilih Rapat---</option>
				@foreach($daftarrapat as $datap)
					<option value="{{$datap->id_rapat}}">
						({{$datap->tanggal}}){{$datap->topik}}
					</option>
				@endforeach
			</select>
		</div>

		<input type="submit" name="tambah" class="btn btn-primary btn-block" value="Kelola Peserta Rapat ">
	</form>
	@if(count($daftarrapat)==0)
	<div class="alert alert-secondary text-center" role="alert">
		Tidak ada rapat yang dapat dikelola, anda harus membuat
		<a href="/dashboard/rapat"> rapat Baru !</a>
	</div>
	@endif
  </div>
  <div class="card-footer text-muted">
    Rapat yang dapat dikelola jika status rapat adalah draft atau fix. 
  </div>
</div>
@endsection
@section('skripjava')



@endsection