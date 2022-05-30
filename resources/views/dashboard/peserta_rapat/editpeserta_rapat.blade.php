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
<br/>
<a href="/dashboard/peserta" class="btn btn-link">
		<i class="fas fa-step-backward"></i>Kembali
</a>
@foreach($datapeserta_rapat as $data)

<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<div class="form-group">
		<label for="id_pegawai">Pegawai</label>
		<select class="form-control" required name="id_pegawai">
			<option value="" disabled="disabled">---Pilih pegawai yang akan menjadi peserta rapat---</option>
			@foreach($daftarpegawai as $datap1)
			<option value="{{$datap1->id_pegawai}}" 
					@if($data->id_pegawai==$datap1->id_pegawai)
					selected="selected" 
					@endif
					>
				{{$datap1->nama}} | {{$datap1->nama_opd}}
			</option>
			@endforeach
		</select>
	</div>
	<label for="status">Status</label>
	<div class="form-group">
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="status" value="hadir"
		    @if($data->status=='hadir')
		    	checked="checked"
		    @endif
		    >Hadir
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="status" value="sakit"
		    @if($data->status=='sakit')
		    	checked="checked"
		    @endif
		    >Sakit
		  </label>
		</div>	
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="status" value="izin"
		    @if($data->status=='izin')
		    	checked="checked"
		    @endif
		    >Izin
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="status" value="alpa" 
		    @if($data->status=='alpa')
		    	checked="checked"
		    @endif
		    >Alpa
		  </label>
		</div>
		<div class="form-check-inline">
		  <label class="form-check-label">
		    <input type="radio" class="form-check-input" required name="status" value="dinas_luar"
		    @if($data->status=='dinas_luar')
		    	checked="checked"
		    @endif
		    >Dinas Luar
		  </label>
		</div>					
	</div>
	<div class="form-group">
		<label for="keterangan">Keterangan</label>
		<textarea name="keterangan"  required placeholder="Masukan keterangan ..." class="form-control">{{$data->keterangan}}</textarea>
	</div>
	<input type="submit" name="edit" class="btn btn-warning btn-block" value="Simpan Perubahan">
</form>
@endforeach
<!-- /modal form -->
@endsection
@section('skripjava')

@endsection