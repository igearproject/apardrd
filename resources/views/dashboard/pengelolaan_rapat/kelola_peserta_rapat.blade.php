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
@section('lankahpeserta','active')
@section('lankahsurat','')
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
      <th>Foto</th>
      <th>Nama Peserta</th>
      <th>OPD</th>
      <th>Dilihat Pada</th>
    </tr>
  </thead>
  <tbody>
    @foreach($datapeserta_rapat as $data)
    <tr>
      <td><img src="{{asset('foto/'.$data->foto)}}" class="img-circle" alt="foto Profil" width="100px" height="100px"> </td>
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
        @if($data->dilihat_pada!=null)
          <i class="far fa-eye"></i> {{$data->dilihat_pada}}
        @else
          <i class="far fa-eye-slash"></i> Belum dilihat
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<button class="btn btn-primary " data-toggle="modal" data-target="#formpesertarapat">
  <i class="far fa-plus-square"></i> Add Peserta Rapat
</button>

<br>
<br>
@if(count($datapeserta_rapat)!=0)
<a href="/dashboard/peserta/{{$data->id_rapat}}" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Peserta Rapat</a>
@else
<a href="/dashboard/peserta/pilih_rapat" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i> Masuk ke Menu Peserta Rapat</a>
@endif
<!-- modal form -->
<div class="modal fade" id="formpesertarapat">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah >> Peserta Rapat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" class="needs-validation" method="post" >
          {{ csrf_field() }}
          <div class="table-responsive">
          <table class="table table-hover table-borderless" id="datatabelpegawai">
            <thead class="thead-light">
              <tr>
                <th>Foto</th>
                <th>Nama Peserta</th>
                <th><center>Tambah</center> </th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $lihat_data='';
                $x=0;
              ?>
              @foreach($datapegawai as $data)
                @foreach($datapeserta_rapat as $dataq)
                  @if($dataq->id_pegawai==$data->id_pegawai)
                  <?php 
                    $lihat_data='No';
                    break;
                  ?>
                  @endif
                @endforeach
              @if($lihat_data!='No')
              <tr>

                <td><img src="{{asset('foto/'.$data->foto)}}" class="img-circle" alt="foto Profil" width="100px" height="100px"> </td>
                <td>{{$data->nama}}<br/>
                  ({{$data->jabatan}})<br>
                  @if($data->jenis_kelamin=='P')
                  Perempuan
                  @else
                  Laki-Laki
                  @endif
                  <br>
                  {{$data->nama_opd}}
                </td>
                <td>
                  <center>
                  <input type="text" name="id_pegawai[]" value="{{$data->id_pegawai}}" hidden="hidden">
                  <!-- <div class="form-group ">
                      <select class="form-control" name="tambah_peserta[]">
                        <option value="T" selected="selected">Tidak</option>
                        <option value="Y">Ya</option>
                      </select>
                  </div> -->
                  <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="tambah_peserta1[{{$x}}]" value="Y">
                  </div>
                  </center>
                </td>
              </tr>
              @php
                $x++;
              @endphp
              @endif
              <?php 
                $lihat_data='Yes';
                
              ?>
              @endforeach
            </tbody>
          </table>
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