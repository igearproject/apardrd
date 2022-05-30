@extends('dashboard/maindashboard')
@section('title','User')
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
@section('menupengelolaanrapat','')
@section('menuuser','active')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item">User</li>
@endsection
@section('dataname','Data User Aplikasi')
@section('datacontent')
<div class="d-flex bd-highlight mb-3">
  <div class="p-2 bd-highlight">
  	<button class="btn btn-primary " data-toggle="modal" data-target="#formpegawai">
		<i class="far fa-plus-square"></i> Add User
	</button>  	
  </div>
</div>
<!-- id
name
email
password
hak_akses
id_pegawai -->
<div class="table-responsive">
<table id="datatabelnotulen" class="table table-hover  data">
	<thead class="thead-light">
		<tr>
			<th>Nama Lengkap (OPD)</th>
			<th>User name </th>
			<th>Email</th>
			<th>Hak Akses</th>			
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datauser as $data)
		<tr>
			<td>{{$data->nama}}<br>({{$data->nama_opd}})</td>
			<td>{{$data->name}}</td>
			<td>{{$data->email}}</td>
			<td>{{$data->hak_akses}}</td>
			<td>
				<a href="/dashboard/user/{{Crypt::encrypt($data->id)}}" class="btn btn-warning">
					<i class="fas fa-edit"></i> Edit
				</a>
				<a href="/dashboard/user/password/{{Crypt::encrypt($data->id)}}" class="btn btn-info btn-sm">
					<i class="fas fa-lock"></i> Ganti Password
				</a>
				<form action="{{ action('userController@hapus',['id'=>Crypt::encrypt($data->id)]) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input type="text" name="name" value="{{$data->name}}" hidden="hidden">
					<input type="text" name="email" value="{{$data->email}}" hidden="hidden">
					<button href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus User dengan username {{$data->name}} dan email {{$data->email}}')" type="submit">
						<i class="far fa-trash-alt"></i> Delete
					</button>
					
				</form>
				
			</td>
			
		</tr>
		@endforeach
	</tbody>
	
	
</table>
@if(count($datauser)==0)
<div class="alert alert-secondary text-center" role="alert">
	Data tidak ada atau data yang anda cari tidak ditemukan ! 
	<a href="/dashboard/user">Refresh ?</a>
</div>
@endif
</div>
<!-- modal form -->
<div class="modal fade" id="formpegawai">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah >> User Baru</h4>
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
			                	$lihat_data='Yes';
			              	?>
							@foreach($daftarpegawai as $datap1)
								@foreach($datauser as $dataq)
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
						<div class="valid-feedback">Benar.</div>
						<div class="invalid-feedback">Wajib Diisi.</div>
					</div>
					<div class="form-group">
						<label for="name">Username</label>
						<input type="text" name="name" maxlength="50" required placeholder="Username*" class="form-control">
						<div class="valid-feedback">Benar.</div>
						<div class="invalid-feedback">Wajib Diisi.</div>

					</div>
					<label for="email">Email </label>
					<div class="input-group mb-3">
						
			  			<input type="email" name="email"  maxlength="100" required="required" class="form-control" placeholder="Email*">
			  		</div>
			  		<label for="password">Password </label>
			  		<div class="input-group mb-3">			  			
			  			<input type="password" name="password" minlength="8" maxlength="100" required="required" class="form-control" placeholder="Password*">
			  			<input type="password" name="password1" minlength="8" maxlength="100" required="required" class="form-control" placeholder="Konfirmasi Password*">
			  		</div>
			  		<div class="form-group">
						<label for="hak_akses">Hak Akses</label>
						<select class="form-control" required name="hak_akses">
							<option value="" disabled="disabled">---Pilih Hak Akses Untuk User---</option>						
							<option value="admin">
								Admin
							</option>
							<option value="pegawai">
								Pegawai
							</option>
							<option value="nonaktif">
								Nonaktif
							</option>
						</select>
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
    $('#datatabelnotulen').DataTable();
  });
</script>

@endsection