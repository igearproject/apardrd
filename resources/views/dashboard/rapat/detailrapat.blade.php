@extends('dashboard/maindashboard')
@section('title','Detail Rapat')
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
<li class="breadcrumb-item">Detail Rapat</li>
@endsection
@section('dataname','Detail Rapat')
@section('datacontent')
@foreach($datarapat as $data)
<div class="btn btn-success py-2 text-left text-middle text-white container">
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
  
</div>
@if($data->status=='fix')

    <center>
     <button class="btn btn-info btn-block" data-toggle="modal" data-target="#formpesertarapat">
      <i class="far fa-check-circle "></i> Informasikan Kehadiran Anda
    </button>
    <br>
    </center> 
    
@endif
<!--
  perintah untuk mengirim pesan melalui aplikasi wa di HP
  whatsapp://send?text= -->
@if($data->status=='fix')
  <a class="btn btn-outline-success share-handphone" href="https://api.whatsapp.com/send?text=*Tabik Pun!!! Info penting* pada {{ strftime(Carbon\Carbon::parse($data->tanggal)->formatLocalized('%A, %d %B %Y'))}}, {{$data->jam}} ada rapat yang akan dilaksanakan *Dewan Riset Daerah (DRD) Kabupaten Pesawaran* Mengenai {{$data->topik}} untuk info lebih lengkap dan menkonfirmasi kehadiran anda di appard.pesawarankab.go.id" data-action="share/whatsapp/share" target="_blank">
    <i class="fab fa-whatsapp"></i> Share ke Whatsapp
  </a>
@else
  <a class="btn btn-outline-success share-handphone" href="https://api.whatsapp.com/send?text=*Tabik Pun!!! Info penting* rapat pada
  {{ strftime(Carbon\Carbon::parse($data->tanggal)->formatLocalized('%A, %d %B %Y'))}}, {{$data->jam}}
  yang akan dilaksanakan 
  Dewan Riset Daerah (DRD) Kabupaten Pesawaran 
  Mengenai {{$data->topik}} *DIBATALKAN* 
  Untuk info lebih lengkap dan menkonfirmasi kehadiran anda di 
  appard.pesawarankab.go.id" data-action="share/whatsapp/share" target="_blank">
    <i class="fab fa-whatsapp"></i> Share ke Whatsapp
  </a>
@endif
<!-- modal form -->
<div class="modal fade" id="formpesertarapat">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title lead">Ubah >> Status Kehadiran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        @foreach($datapeserta_rapat as $data)
        <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}          
          <div class="form-group">
            <label for="id_pegawai">Pegawai</label>
            <select class="form-control" required name="id_pegawai" disabled>
              <option value="" disabled="disabled">---Pilih pegawai yang akan menjadi peserta rapat---</option>
              @foreach($daftarpegawai as $datap1)
              <option value="{{$datap1->id_pegawai}}">
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
          <input type="submit" name="edit" class="btn btn-primary btn-block" value="Simpan">
        </form>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
  
</div>

<!-- /modal form -->

@endforeach
@endsection
@section('skripjava')


@endsection