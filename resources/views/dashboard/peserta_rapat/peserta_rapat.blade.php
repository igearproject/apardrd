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
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formpesertarapat">
		<i class="far fa-plus-square"></i> Add Peserta Rapat
	</button>  	
  </div>
</div>

<div class="table-responsive">
<table id="datatabelpesertarapat" class="table table-hover  data">
	<thead class="thead-light">
<!-- id_peserta
id_pegawai
id_rapat
status
keterangan -->
		<tr>
			<th>Foto</th>
			<th>Nama Peserta</th>
			<th>OPD</th>
			<th>Rapat (Tahun/Bulan/Tanggal)</th>
			<th>Status</th>
			<th>Keterangan</th>
			<th>Dilihat Pada</th>
			<th>Pilihan</th>
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
			<td>{{$data->topik}}<br/> ({{$data->tanggal}})</td>
			<td>{{$data->status}}</td>
			<td>{{$data->keterangan}}</td>
			<td>
				@if($data->dilihat_pada!=null)
				  <i class="far fa-eye"></i> {{$data->dilihat_pada}}
				@else
				  <i class="far fa-eye-slash"></i> Belum dilihat
				@endif
			</td>
			<td>
				<a href="/dashboard/peserta/{{$data->id_rapat}}/{{$data->id_peserta}}" class="btn btn-warning">
						<i class="fas fa-edit"></i> Edit
				</a>
			     <form action="/dashboard/peserta/{{$data->id_rapat}}/{{$data->id_peserta}}" method="post">
			     	{{ csrf_field() }}
			     	{{ method_field('DELETE') }}
			     	<input type="text" name="nama_rapat" value="{{$data->topik}} ({{$data->tanggal}})" hidden="hidden">
			     	<input type="text" name="nama_peserta" value="{{$data->nama}}" hidden="hidden">
			     	<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus peserta dengan nama {{$data->nama}} pada Rapat {{$data->topik}} ({{$data->tanggal}})')" type="submit">
						<i class="far fa-trash-alt"></i> Delete
					</button>
			     	
			     </form>
				
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datapeserta_rapat)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/peserta">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formpesertarapat">
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
						<label for="id_pegawai">Pegawai</label>
						<select class="form-control" required name="id_pegawai">
							<option value="" disabled="disabled">---Pilih pegawai yang akan menjadi peserta rapat---</option>
							<?php 
			                	$lihat_data='';
			             	?>
							@foreach($daftarpegawai as $datap1)
								@foreach($datapeserta_rapat as $dataq)
				                  @if($dataq->id_pegawai==$datap1->id_pegawai)
				                  <?php 
				                    $lihat_data='No';
				                    break;
				                  ?>
				                  @endif
				                @endforeach
				            @if($lihat_data!='No')
							<option value="{{$datap1->id_pegawai}}">
								{{$datap1->nama}} | {{$datap1->nama_opd}}
							</option>
							@endif
				            <?php 
				            	$lihat_data='Yes';
				            ?>
							@endforeach
						</select>
					</div>
					<label for="status">Status</label>
					<div class="form-group">
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="status" value="hadir">Hadir
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="status" value="sakit">Sakit
						  </label>
						</div>	
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="status" value="izin">Izin
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="status" value="alpa" checked="checked">Alpa
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="status" value="dinas_luar">Dinas Luar
						  </label>
						</div>					
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<textarea name="keterangan"  required placeholder="Masukan keterangan ..." class="form-control">Tidak ada Keterangan ...</textarea>

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

@endsection