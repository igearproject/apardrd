@extends('dashboard/maindashboard')
@section('title','Pegawai')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','active')
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
<li class="breadcrumb-item">Pegawai</li>
@endsection
@section('dataname','Data Pegawai Setiap OPD')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formpegawai">
		<i class="far fa-plus-square"></i> Add Pegawai
	</button>  	
  </div>
</div>

<div class="table-responsive">
<table id="datatabelpegawai" class="table table-hover  data">
	<thead class="thead-light">
		
		<tr>
			<th>Foto</th>
			<th>Nama</th>
			<th>Jabatan / Status Pegawai</th>
			<th>NIP</th>
			<th>OPD</th>
			<th>Jenis_kelamin</th>
			<th>No_hp</th>
			<th>Email</th>	
			<th>Agama</th>
			<th>Tanggal Lahir</th>
			<th>Alamat</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datapegawai as $data)
		<tr>
			<td><img src="{{asset('foto/'.$data->foto)}}" class="img-circle" alt="foto Profil" width="100px" height="100px"> </td>
			<td>{{$data->nama}}</td>
			<td>{{$data->jabatan}} <br>({{$data->status_pegawai}})</td>
			<td>{{$data->nip}}</td>		
			<td>{{$data->nama_opd}}</td>
			<td>
				@if($data->jenis_kelamin=='P')
				Perempuan
				@else
				Laki-Laki
				@endif
			</td>
			<td>{{$data->no_hp}}</td>
			<td>{{$data->email}}</td>
			<td>{{$data->agama}}</td>
			<td>{{$data->tanggal_lahir}}</td>
			<td>{{$data->alamat}}</td>
			<td>
				<a href="/dashboard/pegawai/{{$data->id_pegawai}}" class="btn btn-warning">
						<i class="fas fa-edit"></i> Edit
				</a>
			     <form action="{{ action('pegawaiController@hapus',['id'=>$data->id_pegawai]) }}" method="post">
			     	{{ csrf_field() }}
			     	{{ method_field('DELETE') }}
			     	<input type="text" name="foto" value="{{$data->foto}}" hidden="hidden">
			     	<input type="text" name="nama_pegawai" value="{{$data->nama}}" hidden="hidden">
			     	<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pegawai dengan nama {{$data->nama}}')" type="submit">
						<i class="far fa-trash-alt"></i> Delete
					</button>
			     	
			     </form>
				
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datapegawai)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/pegawai">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formpegawai">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> Pegawai OPD</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nama">Nama Lengkap</label>
						<input type="text" name="nama" maxlength="50" required placeholder="Masukan nama lengkap ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="nip">NIP</label>
						<input type="text" name="nip" maxlength="20" required placeholder="Masukan NIP ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="nama">Jabatan</label>
						<input type="text" name="jabatan" maxlength="30" required placeholder="Masukan jabatan ..." class="form-control">

					</div>
					<label for="jenis_kelamin">Jenis Kelamin</label>
					<div class="form-group">
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="jenis_kelamin" value="L">Laki-laki
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="jenis_kelamin" value="P">Perempuan
						  </label>
						</div>					
					</div>
					<div class="form-group">
						<label for="no_hp">No HP</label>
						<input type="text" name="no_hp" maxlength="15" required placeholder="Masukan no HP ..." class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" maxlength="100" required placeholder="Masukan email ..." class="form-control">

					</div>
					<label for="agama">Agama</label>
					<div class="form-group">
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="agama" value="hindu">Hindu
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="agama" value="islam">Islam
						  </label>
						</div>	
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="agama" value="kristen protestan">Kristen Protestan
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="agama" value="katolik">Katolik
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="agama" value="buddha">Buddha
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" required name="agama" value="kong hu cu">Kong Hu Cu
						  </label>
						</div>					
					</div>
					<div class="form-group">
						<label for="tanggal_lahir">Tanggal Lahir</label>
						<input type="date" name="tanggal_lahir" required placeholder="Masukan tanggal lahir ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="foto">Foto</label>
						<input type="file" name="foto" class="form-control-file border" maxlength="100"   placeholder="Masukan foto anda ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea name="alamat"  required placeholder="Masukan alamat ..." class="form-control"></textarea>

					</div>
					<div class="form-group">
						<label for="status_pegawai">Satus Pegawai</label>
						<select class="form-control" required name="status_pegawai">
							<option value="" disabled="disabled">---Pilih status Pegawai---</option>						
							<option value="aktif">Aktif</option>
							<option value="tidak_aktif">Tidak aktif</option>
							<option value="pensiun">Pensiun</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="id_opd">OPD</label>
						<select class="form-control" required name="id_opd">
							<option value="" disabled="disabled">---Pegawai dari OPD---</option>
							@foreach($daftaropd as $datap)
							<option value="{{$datap->id_opd}}">{{$datap->nama_opd}}</option>
							@endforeach
						</select>
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
    $('#datatabelpegawai').DataTable();
  });
</script>

@endsection