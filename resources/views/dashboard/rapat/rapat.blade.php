@extends('dashboard/maindashboard')
@section('title','Rapat')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','')
@section('menupegawai','')
@section('menurapatutama','active')
@section('menurapat','active')
@section('menupeserta','')
@section('menusurat','')
@section('menudokumentasi','')
@section('menunotulensi','')
@section('menupengelolaanrapat','')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">Rapat</li>
@endsection
@section('dataname','Data Rapat')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formpegawai">
		<i class="far fa-plus-square"></i> Add Rapat
	</button>  	
  </div>
</div>

<div class="table-responsive">
<table id="datatabelpegawai" class="table table-hover  data">
	<thead class="thead-light">
		
		<tr>
			<th>Tanggal</th>
			<th>Jam</th>
			<th>Topik</th>
			<th>Tempat</th>
			<th>Status</th>
			<th>Deskripsi</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datarapat as $data)
		<tr>
			<td>{{$data->tanggal}}</td>			
			<td>{{$data->jam}}</td>
			<td>{{$data->topik}}</td>
			<td>{{$data->tempat}}</td>
			<td>{{$data->status}}</td>
			<td>{{$data->deskripsi}}</td>
			<td>
				<a href="/dashboard/rapat/{{$data->id_rapat}}" class="btn btn-warning">
						<i class="fas fa-edit"></i> Edit
				</a>
				<form action="{{ action('rapatController@hapus',['id'=>$data->id_rapat]) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input type="text" name="topik" value="{{$data->topik}}" hidden="hidden">
					<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Rapat dengan topik {{$data->topik}}')" type="submit">
					<i class="far fa-trash-alt"></i> Delete
				</button>
					
				</form>
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datarapat)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/rapat">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formpegawai">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> Rapat Selanjutnya</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="needs-validation" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="topik">Topik Rapat</label>
						<input type="text" name="topik" maxlength="200" required placeholder="Masukan topik rapat ..." class="form-control">
					</div>
					<div class="form-group">
						<label for="tanggal">Tanggal</label>
						<input type="date" name="tanggal" required class="form-control">

					</div>					
					<div class="form-group">
						<label for="jam">Jam</label>
						<input type="time" name="jam" required class="form-control">
					</div>
					<div class="form-group">
						<label for="tempat">Tempat</label>
						<textarea name="tempat"  required placeholder="Masukan tempat ..." class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" required name="status">
							<option value="" disabled="disabled">---Pilih Status Rapat---</option>
							<option value="draf">draf - rapat hanya dapat dilihat admin</option>
							<option value="fix">fix - rapat dapat dilihat pegawai</option>
							<option value="pass">pass - rapat sudah selesai</option>
							<option value="cancel">cancel - rapat dibatalkan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="deskripsi">Deskripsi</label>
						<textarea name="deskripsi"  required placeholder="Masukan deskripsi rapat ..." class="form-control"></textarea>
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