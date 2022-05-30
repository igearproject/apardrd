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
<li class="breadcrumb-item">Peserta Rapat</li>
@endsection
@section('dataname','Data Peserta Rapat ')
<!-- pengaturan keaktivan langkah pengelolaan -->
@section('lankahrapat','')
@section('lankahpeserta','')
@section('lankahsurat','')
@section('lankahabsensi','active')
@section('lankahdokumentasi','')
@section('lankahnotulensi','')
<!-- /pengaturan keaktivan langkah pengelolaan -->
@section('datacontent')
<br>
 <form action="" class="needs-validation" method="post" >
{{ csrf_field() }}
{{ method_field('PUT')}}
<div class="table-responsive">
<table class="table table-hover table-borderless" id="datatabelpesertarapat">
  <thead class="thead-light">
    <tr>
      <th>Nama Peserta</th>
      <th>OPD</th>
      <th>Status Absensi</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datapeserta_rapat as $data)
    <tr>
      <td>{{$data->nama}}<br/>
        ({{$data->jabatan}})<br>
        @if($data->jenis_kelamin=='P')
        Perempuan
        @else
        Laki-Laki
        @endif
      </td>     
      <td>{{$data->nama_opd}}</td>
      <td>
        <input type="text" name="id_peserta[]" value="{{$data->id_peserta}}" hidden="hidden">
        <div class="form-group ">
            <select class="form-control" name="status_absensi[]">              
              <option value="hadir" 
              @if($data->status=="hadir")
              selected="selected"
              @endif
              >hadir</option>
              <option value="alpa" 
              @if($data->status=="alpa")
              selected="selected"
              @endif
              >alpa</option>
              <option value="sakit" 
              @if($data->status=="sakit")
              selected="selected"
              @endif
              >sakit</option>
              <option value="izin" 
              @if($data->status=="izin")
              selected="selected"
              @endif
              >izin</option>
              <option value="dinas_luar" 
              @if($data->status=="dinas_luar")
              selected="selected"
              @endif
              >Dinas Luar</option>
            </select>
        </div>
      </td>
      <td>
        <div class="form-group">
          <textarea name="keterangan[]"  required placeholder="Masukan keterangan ..." class="form-control">{{$data->keterangan}}</textarea>

        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@if(count($datapeserta_rapat)!=0)
<input type="submit" name="tambah" class="btn btn-primary btn-block" value="Simpan Absensi">
@endif
</form>
<br>
<br>
@if(count($datapeserta_rapat)!=0)
<a class="btn btn-info " href="/dashboard/export/absen/{{$data->id_rapat}}">
  <i class="far far fa-file-pdf"></i> Export Absensi Peserta Rapat
</a>
@endif
<a href="/dashboard/peserta" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu  Peserta Rapat</a>

@endsection
@section('skripjava')
<script>
  $(document).ready(function() {
    $('#datatabelpesertarapat').DataTable();
  });
</script>
@endsection