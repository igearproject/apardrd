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
<li class="breadcrumb-item">Notulensi Rapat</li>
@endsection
@section('dataname','Data Notulensi Rapat ')
<!-- pengaturan keaktivan langkah pengelolaan -->
@section('lankahrapat','')
@section('lankahpeserta','')
@section('lankahsurat','')
@section('lankahabsensi','')
@section('lankahdokumentasi','')
@section('lankahnotulensi','active')
<!-- /pengaturan keaktivan langkah pengelolaan -->
@section('datacontent')
<br>
<div class="table-responsive">
<table class="table table-hover table-borderless" id="datatabelpesertarapat">
  <thead class="thead-light">
    <tr>
      <th>Pimpinan Rapat</th>
      <th>Pembuat</th>
      <th>Kesimpulan</th>
      <th>File Notulen</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datanotulensi as $data)
    <tr>
      <td>{{$data->pimpinan}}</td>
      <td>{{$data->pembuat}}</td>     
      <td>{{$data->kesimpulan}}</td>
      <td>
        <a href="/dashboard/notulen/filenotulen/{{$data->file_notulen}}" >
          <i class="far fa-file-pdf"></i>
          {{$data->file_notulen}}
        </a>
        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<button class="btn btn-primary " data-toggle="modal" data-target="#formpesertarapat">
  <i class="far fa-plus-square"></i> Add Notulensi Rapat
</button>
<br>
<br>
<a href="/dashboard/notulen" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Notulensi Rapat</a>

<!-- modal form -->
<div class="modal fade" id="formpesertarapat">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah >> Notulensi Rapat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="pimpinan">Pimpinan Rapat</label>
            <input type="text" name="pimpinan" maxlength="50" required placeholder="Masukan nama lengkap pimpinan rapat ..." class="form-control">

          </div>

          <div class="form-group">
            <label for="pembuat">Pembuat Notulen</label>
            <input type="text" name="pembuat" maxlength="50" required placeholder="Masukan nama lengkap pembuat notulen rapat ..." class="form-control">

          </div>
          <div class="form-group">
            <label for="kesimpulan">Kesimpulan Rapat</label>
            <textarea name="kesimpulan"  required placeholder="Masukan kesimpulan rapat ..." class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="file_notulen">File Notulen Rapat</label>
            <input type="file" name="file_notulen" class="form-control-file border" maxlength="100"   placeholder="Masukan file notulen anda ..." class="form-control">
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