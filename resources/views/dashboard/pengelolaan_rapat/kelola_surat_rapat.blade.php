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
<li class="breadcrumb-item">Surat Rapat</li>
@endsection
@section('dataname','Data Surat Rapat ')
<!-- pengaturan keaktivan langkah pengelolaan -->
@section('lankahrapat','')
@section('lankahpeserta','')
@section('lankahsurat','active')
@section('lankahabsensi','')
@section('lankahdokumentasi','')
@section('lankahnotulensi','')
<!-- /pengaturan keaktivan langkah pengelolaan -->
@section('datacontent')
<br>
<div class="table-responsive">
<table class="table table-hover table-borderless" id="datatabelpesertarapat">
  <thead class="thead-light">
    <tr>
      <th>No Surat</th>
      <th>Tempat, Tanggal Pembuatan</th>
      <th>Perihal</th>
      <th>File</th>
      <th>Topik Rapat (Tanggal)</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datasurat as $data)
    <tr>
      <td>{{$data->no_surat}}</td>
      <td>{{$data->tempat_pembuatan}}, {{$data->tanggal_pembuatan}}</td>      
      <td>{{$data->perihal}}</td>
      <td>
        <a href="/dashboard/surat/filesurat/{{$data->file}}" >
          <i class="far fa-file-pdf"></i>
          {{$data->file}}
        </a>
        
      </td>
      <td>{{$data->topik}} ({{$data->tanggal}})</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@if(count($datasurat)==0)
<div class="alert alert-danger text-center" role="alert">
  Tambahkan surat Baru >>  
  <button class="btn btn-primary " data-toggle="modal" data-target="#formdatasurat">
    <i class="far fa-plus-square"></i> Add Surat
  </button>
</div>

@endif
<br>
<br>
<a href="/dashboard/surat" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Surat</a>

<!-- modal form -->
<div class="modal fade" id="formdatasurat">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah >> Peserta Rapat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="no_surat">No Surat</label>
            <input type="text" name="no_surat" maxlength="100" required placeholder="Masukan no surat ..." class="form-control">

          </div>
          <div class="form-group">
            <label for="nama">Tanggal Pembuatan Surat</label>
            <input type="date" name="tanggal_pembuatan" required class="form-control">

          </div>
          <div class="form-group">
            <label for="tempat_pembuatan">Tempat Pembuatan Surat</label>
            <input type="text" name="tempat_pembuatan" maxlength="30" required placeholder="Masukan tempat pembuatan surat ..." class="form-control">
          </div>
          <div class="form-group">
            <label for="perihal">Perihal</label>
            <input type="text" name="perihal" maxlength="50" required placeholder="Masukan perihal surat ..." class="form-control">
          </div>
          <div class="form-group">
            <label for="file">File Surat</label>
            <input type="file" name="file" maxlength="100" required class="form-control-file border">
            <small class="form-text text-muted">Format file harus PDF dengan ukuran maksimal 2 MB, pastikan nama file tidak terlalu panjang</small>
          </div>
          <input type="submit" name="tambah" class="btn btn-primary btn-block" value="Tambah">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@foreach($datasurat as $data)
<a class="btn btn-info " href="/dashboard/export/surat/{{$data->id_rapat}}">
  <i class="far far fa-file-pdf"></i> Export Surat Rapat
</a>
  @if($data->status=='fix')
    <a class="btn btn-primary " href="/dashboard/pengelolaan_rapat/{{$data->id_rapat}}/kirimemail">
      <i class="far fa-paper-plane"></i> Kirim Pesan Undangan Melalui Email
    </a>
  @endif
@endforeach

<!-- /modal form -->
@endsection
@section('skripjava')
<script>
  $(document).ready(function() {
    $('#datatabelpesertarapat').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
    $('#datatabelpegawai').DataTable();
  });
</script>
@endsection