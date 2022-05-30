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
<li class="breadcrumb-item">Dokumentasi Rapat</li>
@endsection
@section('dataname','Data Dokumentasi Rapat ')
<!-- pengaturan keaktivan langkah pengelolaan -->
@section('lankahrapat','')
@section('lankahpeserta','')
@section('lankahsurat','')
@section('lankahabsensi','')
@section('lankahdokumentasi','active')
@section('lankahnotulensi','')
<!-- /pengaturan keaktivan langkah pengelolaan -->
@section('datacontent')
<br>
<table class="table table-hover table-borderless" id="datatabelpesertarapat">
  <thead class="thead-light">
    <tr>
      <th>Foto</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datadokumentasi as $data)
    <tr>
      <td align="center">
        <div class="card" style="width: 18rem;">
          <img src="{{asset('fotoDokumentasi/'.$data->nama)}}" class="card-img-top" alt="Foto Dokumentasi Kegiatan Rapat">
          <div class="card-body">
            <div class="card-title">
              <h5>{{$data->topik}}<br>({{$data->tanggal}})</h5>
            </div>
            <p class="card-text">{{$data->nama}}</p>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<button class="btn btn-primary " data-toggle="modal" data-target="#formpesertarapat">
  <i class="far fa-plus-square"></i> Add Dokumentasi Rapat
</button>
<br>
<br>
<a href="/dashboard/dokumentasi" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Dokumentasi Rapat</a>

<!-- modal form -->
<div class="modal fade" id="formpesertarapat">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah >> Dokumentasi Rapat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="gambar">Gambar </label>
            <input type="file" name="gambar" class="form-control-file border" maxlength="100"   placeholder="Masukan foto anda ..." class="form-control">
            <small class="form-text text-muted">Format file (jpeg, png, gif, jpg, webp) dengan ukuran maksimal 2MB, pastikan nama gambar tidak terlalu panjang</small>

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