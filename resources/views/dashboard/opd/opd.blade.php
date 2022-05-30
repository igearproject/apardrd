@extends('dashboard/maindashboard')
@section('title','OPD')
<!-- pengaturan keaktivan menu sidebar -->
@section('menuhome','')
@section('menuopd','active')
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
<li class="breadcrumb-item">OPD</li>
@endsection
@section('dataname','Organisasi Perangkat Daerah (OPD)')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formopd">
		<i class="far fa-plus-square"></i> Add OPD
	</button> 
  </div>
  <!-- script pencarian buatan kaka -->
  <!-- <div class="ml-auto p-2 bd-highlight">
  	<form action="/dashboard/opd" method="get">
		<div class="input-group">
				<input type="text" id="formcari" name="cari"  maxlength="30" required placeholder="Search ..."
				@if(isset($_GET['cari']))			 	
					value="{{$_GET['cari']}}"
				@endif
				
				class="form-control">
				@if(isset($_GET['cari']))			 	
					<div class="input-group-append">
						<a href="/dashboard/opd" class="btn btn-secondary" ><i class="fas fa-times"></i></a>
					</div>
				@else
					<div class="input-group-append">
						<button type="reset" class="btn btn-secondary" ><i class="fas fa-times"></i></button>
					</div>
				@endif
				
				<div class="input-group-append">
					<button type="submit" class="btn btn-dark" ><i class="fas fa-search"></i> Search</button>
				</div>
		</div>
	</form>
  </div> -->
  <!-- /script pencarian buatan kaka -->
</div>

<div class="table-responsive">
<table id="datatabelopd" class="table table-hover  data">
	<thead class="thead-light">
		
		<tr>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Email</th>
			<th>Website</th>
			<th>Deskripsi</th>	
			<th>Pilihan</th>		
		</tr>
	</thead>
	<tbody>
		@foreach($dataopd as $data)
		<tr>
			<td>{{$data->nama_opd}}</td>
			<td>{{$data->alamat}}</td>
			<td>{{$data->email}}</td>
			<td>{{$data->website}}</td>
			<td>{{$data->deskripsi}}</td>
			<td>
				<a href="/dashboard/opd/{{$data->id_opd}}" class="btn btn-warning">
						<i class="fas fa-edit"></i>Edit
				</a>
			     <form action="{{ action('opdController@hapus',['id'=>$data->id_opd]) }}" method="post">
			     	{{ csrf_field() }}
			     	{{ method_field('DELETE') }}
			     	<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus OPD {{$data->nama_opd}}')" type="submit">
						<i class="far fa-trash-alt"></i>Delete
					</button>
			     	
			     </form>
				
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($dataopd)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/opd">Tampilkan Semua Data?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formopd">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> Organisasi Perangkat Daerah</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="needs-validation" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nama_opd">Nama OPD</label>
						<input type="text" name="nama_opd" maxlength="100" required placeholder="Masukan nama OPD ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea name="alamat"  required placeholder="Masukan alamat ..." class="form-control"></textarea>

					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" maxlength="100" required placeholder="Masukan email ..." class="form-control">

					</div>
					<div class="form-group">
						<label for="website">website</label>
						<input type="text" name="website" maxlength="100" required placeholder="Masukan alamat website ..." class="form-control">
						<div class="valid-feedback">Benar.</div>
						<div class="invalid-feedback">Wajib Diisi.</div>

					</div>
					<div class="form-group">
						<label for="deskripsi">Deskripsi</label>
						<textarea name="deskripsi"  required placeholder="Masukan deskripsi ..." class="form-control"></textarea>
						<div class="valid-feedback">Benar.</div>
						<div class="invalid-feedback">Wajib Diisi.</div>

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
    $('#datatabelopd').DataTable();
  });
</script>

@endsection