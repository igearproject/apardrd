@extends('dashboard/pengelolaan_rapat/mainpengelolaan_rapat')
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
<li class="breadcrumb-item">Rapat</li>
@endsection
@section('dataname','Data Rapat ')
<!-- pengaturan keaktivan langkah pengelolaan -->
@section('lankahrapat','active')
@section('lankahpeserta','')
@section('lankahsurat','')
@section('lankahabsensi','')
@section('lankahdokumentasi','')
@section('lankahnotulensi','')
<!-- /pengaturan keaktivan langkah pengelolaan -->
@section('datacontent')
<table class="table table-hover table-borderless">
  <tbody>
  	@foreach($datarapatutama as $data)
    <tr>
      <td scope="row">Topik Rapat</td>
      <td>:</td>
      <td>{{$data->topik}}</td>
    </tr>
    <tr>
      <td scope="row"><i class="far fa-calendar-alt"></i> Tanggal</td>
      <td>:</td>
      <td>
      	{{ strftime(Carbon\Carbon::parse($data->tanggal)->formatLocalized('%A, %d %B %Y'))}}
      </td>
    </tr>
    <tr>
      <td scope="row"><i class="far fa-clock"></i> Jam</td>
      <td>:</td>
      <td>{{$data->jam}}</td>
    </tr>
    <tr>
      <td scope="row"><i class="fas fa-map-marked-alt"></i> Tempat</td>
      <td>:</td>
      <td>{{$data->tempat}}</td>
    </tr>
    <tr>
      <td scope="row">Deskripsi</td>
      <td>:</td>
      <td>{{$data->deskripsi}}</td>
    </tr>
    <tr>
      <td scope="row">Status</td>
      <td>:</td>
      <td>
      	<form action="" method="post">
      		{{ csrf_field() }}
			{{ method_field('PUT') }}
			<input type="text" name="topik" value="{{$data->topik}}" hidden="hidden">
			<input type="text" name="id_rapat" value="{{$data->id_rapat}}" hidden="hidden">
			<div class="row">
      			<div class="form-group col-md-5">
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
				<div class="col-md-5">
					<input type="submit" name="tambah" class="btn btn-warning" value="Ubah Status">
				</div>
      		</div>
      	</form>
      </td>
    </tr> 
    @endforeach
  </tbody>
</table>
<a href="/dashboard/rapat" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Rapat</a>
@endsection
@section('skripjava')

@endsection