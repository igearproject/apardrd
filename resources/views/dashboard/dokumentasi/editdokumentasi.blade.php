@extends('dashboard/maindashboard')
@section('title','Dokumentasi')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','active')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Dokumentasi</li>
@endsection
@section('dataname','Edit Data Dokumentasi')
@section('datacontent')
<br/>
<a href="/dashboard/dokumentasi" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datadokumentasi as $data)

<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
						<label for="id_rapat">Rapat</label>
						<select class="form-control" required name="id_rapat">
							<option value="" disabled="disabled">---Pilih Rapat---</option>
							@foreach($daftarrapat as $datap)
								<option value="{{$datap->id_rapat}}"
									@if($datap->id_rapat==$data->id_rapat)
									 selected
									@endif
									>
									({{$datap->tanggal}}){{$datap->topik}}
								</option>
							@endforeach
						</select>
					</div>
					<div class="card" style="width: 18rem;">
					  <img src="{{asset('fotoDokumentasi/'.$data->nama)}}" class="card-img-top" alt="Foto Dokumentasi Kegiatan Rapat">
					  <div class="card-body">
					    <p class="card-text">{{$data->nama}}</p>
					  </div>
					</div>
					<div class="form-group">
						<label for="gambar">Ubah Gambar</label>
						<input type="file" name="gambar" class="form-control-file border" maxlength="100"   placeholder="Masukan gambar baru anda ..." class="form-control" required="required">
						<small class="form-text text-muted">Format file (jpeg, png, gif, jpg, webp) dengan ukuran maksimal 2MB, pastikan nama gambar tidak terlalu panjang</small>
					</div>
					<input type="text" name="gambar1" value="{{$data->nama}}" hidden="hidden">
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach
<!-- /modal form -->
@endsection
@section('skripjava')

@endsection