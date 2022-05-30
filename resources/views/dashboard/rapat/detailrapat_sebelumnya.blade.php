@extends('dashboard/maindashboard')
@section('title','Detail Rapat')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menurapatsebelumnya','active')
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
<li class="breadcrumb-item">Detail Rapat</li>
@endsection
@section('dataname','Detail Rapat')
@section('datacontent')
@foreach($datarapat as $data)
<div class="btn btn-secondary py-2 text-left text-middle text-white container">
  <i class="fas far fa-clock fa-spin"></i>  {{ Carbon\Carbon::parse(strtotime($data->tanggal.' '.$data->jam))->diffForHumans()}}
</div>
<div class="card-body border">
  <br/>
  <div class="row border-bottom">
    <div class="col-md-5 border-left">
      <h4 class="lead">{{$data->topik}}</h4>
      <hr>
      <ul style="list-style-type: none;">
        <li>
          <i class="far fa-calendar-alt"></i> <small >
          {{ strftime(Carbon\Carbon::parse($data->tanggal)->formatLocalized('%A, %d %B %Y'))}}, {{$data->jam}}</small></li>
        <li><i class="fas fa-map-marked-alt"></i> <small >{{$data->tempat}}</small></li>
        <li><i class="far fa-question-circle"></i> <small >{{$data->status}}</small></li>
        @foreach($surat as $datas)
        <li>          
          <a href="/dashboard/surat/filesurat/{{$datas->file}}" >
            <i class="far fa-file-pdf"></i>
            Lihat Surat Undangan
          </a>
        </li>
        @endforeach   
            
      </ul>
    </div>
    
    <div class="col-md-5 border-left">
      <p>
        {{$data->deskripsi}}
      </p>
    </div>
    
  </div>
  <br>
  <div class="row border">
    <table class="table table-hover">
      <tr>
        <th class="lead">STATUS KEHADIRAN</th>
        <th class="lead">KETERANGAN</th>
      </tr>
      @foreach($datapeserta_rapat as $datapr)
      <tr>
        <td>{{$datapr->status}}</td>
        <td>{{$datapr->keterangan}}</td>
      </tr>
      @endforeach
    </table>
  </div>
  <br>
  <div class="row border">
    
    <table class="table table-hover">
      <tr>
        <th colspan="2" class="lead">Hasil Rapat</th>
      </tr>
      @foreach($notulen as $datan)
      <tr>
        <th class="lead">Pimpinan Rapat</th><td>{{$datan->pimpinan}}</td>
      </tr>
      <tr>
        <th class="lead">Pembuat Notulen</th><td>{{$datan->pembuat}}</td>
      </tr>
      <tr>
        <th class="lead">Kesimpulan Rapat</th><td><textarea rows="6" disabled class="form-control" style="background-color: transparent;border-color: transparent;padding-left: 0px;">{{$datan->kesimpulan}}</textarea> </td>
      </tr>
      <tr>
        <th class="lead">File Notulen</th>
        <td>
          <a href="/dashboard/notulen/filenotulen/{{$datan->file_notulen}}">
            <i class="far fa-file-pdf"></i>
            {{$datan->file_notulen}}
          </a>
        </td>
      </tr>
      @endforeach
      @if(count($notulen)==0)
        <tr>
          <td colspan="2" >Data Hasil Rapat Tidak Ada!</td>
        </tr>
         
      @endif
    </table>
    
  </div>
  <br>
  <div class="row border">
   
    <table class="table table-hover">
      <tr>
        <th colspan="2" class="lead">Dokumentasi Rapat</th>
      </tr>
      <tr>
        <td colspan="2">
          <div class="row">          
          @foreach($dokumentasi as $datad)
          <div class="col-md-4">
            <img src="{{asset('fotoDokumentasi/'.$datad->nama)}}" class="img-thumbnail" alt="Foto Dokumentasi Kegiatan Rapat" style="width:100%">
          </div>
          @endforeach
          
          </div>
          @if(count($dokumentasi)==0)
            Data Dokumentasi Rapat Tidak Ada! 
          @endif
        </td>
      </tr>
    </table>
    
  </div>
</div>

@endforeach
@endsection
@section('skripjava')


@endsection