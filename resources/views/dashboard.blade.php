@extends('dashboard/maindashboard')
@section('title','Home')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','active')
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
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Home</li>
@endsection
@section('dataname','Daftar Rapat')
@section('datacontent')
@foreach($datarapat as $data)
<div class="card  mb-3">
  <div class="card-header bg-success  text-white">
  	<p class="card-text"><i class="fas far fa-clock fa-spin"></i>  {{ Carbon\Carbon::parse(strtotime($data->tanggal.' '.$data->jam))->diffForHumans()}}</p>
  </div>
  <div class="card-body ">
    <h5 class="card-title lead">{{$data->topik}}</h5>
    <hr>
    <ul style="list-style-type: none;">
    	<li>
    		<i class="far fa-calendar-alt"></i> <small >
    		{{ strftime(Carbon\Carbon::parse($data->tanggal)->formatLocalized('%A, %d %B %Y'))}}, {{$data->jam}}</small></li>
    	<li><i class="fas fa-map-marked-alt"></i> <small >{{$data->tempat}}</small></li>
    	<li><i class="far fa-question-circle"></i> <small >{{$data->status}}</small></li>
    </ul>
  </div>
  <div class="card-footer bg-transparent  text-white">
  	<a href="/dashboard/detail_rapat/{{$data->id_rapat}}" class="btn btn-info text-white"><i class="far fa-eye"></i> Detail Rapat</a>
  </div>
</div>
@endforeach
@endsection
@section('skripjava')


@endsection