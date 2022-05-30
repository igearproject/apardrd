<!DOCTYPE html>
<html>
<head>
	<title>
		APARD | @yield('title')
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="/bootstrap431/css/bootstrap.min.css">
	<script defer src="/fontawesome5.8.2/js/all.js"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<!-- table data biat keren -->
	<link rel="stylesheet" type="text/css" href="/datatable/datatables.min.css">
	<style type="text/css">
		a.list-group-item{
			color: #292929
		}
		a.list-group-item.active{
			background-color: #3C3744;
			border-color: #3C3744;
		}
		a.list-group-item:hover{
			text-decoration-line: none;
			padding-left: 50px;
			background-color: #B4C5E4;
			border-color: #B4C5E4;
			transition: background-color 1s, padding-left 1s;
			-webkit-transition: background-color 1s, padding-left 1s;
		}
	</style>
	

	<!-- /table data biat keren -->

</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<a href="#" class="navbar-brand">APARD</a>
		<span class="navbar-text">
			Dewan Riset Daerah Kabupaten Pesawaran
		</span>
		<!-- tombol menu toggler -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menucollap">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- target menu toggler -->
		<div class="collapse navbar-collapse" id="menucollap">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<!-- <li class="nav-item">
					<a href="#" class="nav-link "  >Home</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link "  >About</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link "  >Contact</a>
				</li> -->
				
			</ul>
		</div>
	</nav>
	<div class="d-flex flex-row " id="wrapper" >
		<!-- sidebar -->
		<div class="bg-light border-right col-md-3" id="sidebar-wrapper">
			<div >
				<div class="row" >
					<div style="padding-top: 10px;padding-left: 10px;">
						<img src="/logodrd.svg" width="50" height="50"> 
					</div>
					<div  style="padding-top: 20px;padding-left: 10px;">
						<h4>APARD</h4>					
					</div>
				</div>
				<hr>
				<p>
					<b>A</b>plikasi <b>P</b>engolaan <b>A</b>dministrasi <b>R</b>apat<br>
					<b>D</b>RD Pada Kabupaten Pesawaran
				</p>
				<hr>
				<div class="list-group list-group-flush">
					<!-- contoh sidebar denngan submenu 
					<a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
						<i class="fa fa-dashboard"></i>
						<span class="d-md-inline">Home</span>
					</a>
					<div class="collapse" id="menu1">
						<a href="#" class="list-group-item bg-dark" data-parent="#menu1">
							<i class="fa fa-dashboard"></i>
							<span class="d-md-inline">submenu 1</span>
						</a>
						<a href="#" class="list-group-item bg-dark" data-parent="#menu1">
							<i class="fa fa-dashboard"></i>
							<span class="d-md-inline">submenu 2</span>
						</a>
					</div> 
					/contoh sidebar denngan submenu 
					-->
					<a href="/dashboard" class="list-group-item d-inline-block collapsed @yield('menuhome')"  data-parent="#sidebar">
						<i class="fas fa-home"></i>
						<span class="d-md-inline">Home</span>
					</a>
					<a href="/dashboard/rapat_sebelumnya" class="list-group-item d-inline-block collapsed @yield('menurapatsebelumnya')"  data-parent="#sidebar">
						<i class="fas fa-calendar-check"></i>
						<span class="d-md-inline">Rapat Sebelumnya</span>
					</a>
					<a href="/dashboard/opd" class="list-group-item d-inline-block collapsed @yield('menuopd')" data-parent="#sidebar">
						<i class="far fa-building"></i>
						<span class="d-md-inline">OPD</span>
					</a>
					<a href="/dashboard/pegawai" class="list-group-item d-inline-block collapsed @yield('menupegawai')" data-parent="#sidebar">
						<i class="fas fa-user-tie"></i>
						<span class="d-md-inline">Pegawai</span>
					</a>
					<a href="#menurapat1" class="list-group-item d-inline-block collapsed @yield('menurapatutama')" data-toggle="collapse" data-parent="#sidebar">
						<i class="far fa-handshake"></i>
						<span class="d-md-inline">Rapat</span>
						<i class="fas fa-angle-down"></i>
					</a>
					<div class="collapse" id="menurapat1">
						<a href="/dashboard/rapat" class="list-group-item @yield('menurapat')" aria-expanded="false" data-parent="#menu1">
							<i class="fas fa-angle-right"></i>
							<i class="far fa-handshake"></i>
							<span class="d-md-inline"> Rapat</span>
						</a>
						<a href="/dashboard/peserta/pilih_rapat" class="list-group-item @yield('menupeserta')" data-parent="#menu1">
							<i class="fas fa-angle-right"></i>
							<i class="fas fa-portrait"></i>
							<span class="d-md-inline"> Peserta</span>
						</a>
						<a href="/dashboard/surat" class="list-group-item @yield('menusurat')" data-parent="#menu1">
							<i class="fas fa-angle-right"></i>
							<i class="fas fa-envelope-open-text"></i>
							<span class="d-md-inline"> Surat</span>
						</a>
						<a href="/dashboard/dokumentasi" class="list-group-item @yield('menudokumentasi')" data-parent="#menu1">
							<i class="fas fa-angle-right"></i>
							<i class="far fa-images"></i>
							<span class="d-md-inline"> Dokumentasi</span>
						</a>
						<a href="/dashboard/notulen" class="list-group-item @yield('menunotulensi')" data-parent="#menu1">
							<i class="fas fa-angle-right"></i>
							<i class="far fa-file-alt"></i>
							<span class="d-md-inline"> Notulensi</span>
						</a>
					</div> 
					<a href="/dashboard/pengelolaan_rapat" class="list-group-item d-inline-block collapsed @yield('menupengelolaanrapat')" data-parent="#sidebar">
						<i class="fas fa-tasks"></i>
						<span class="d-md-inline">Pengelolaan Rapat</span>
					</a>
					<a href="/dashboard/laporan/{{date('Y')}}/{{date('m')}}" class="list-group-item d-inline-block collapsed @yield('menulaporanrapat')" data-parent="#sidebar">
						<i class="fas fa-chart-bar"></i>
						<span class="d-md-inline">Laporan Rapat</span>
					</a>
					<a href="/dashboard/user" class="list-group-item d-inline-block collapsed @yield('menuuser')" data-parent="#sidebar">
						<i class="fas fa-user"></i>
						<span class="d-md-inline">User</span>
					</a>
					<a href="/dashboard/pengaturan_user" class="list-group-item d-inline-block collapsed @yield('menupengaturanuser')" data-parent="#sidebar">
						<i class="fas fa-user-cog"></i>
						<span class="d-md-inline">Pengaturan User</span>
					</a>
				</div>

			</div>
			 
		</div>
		<!-- /sidebar -->
		<!-- content -->
		<div id="page-content-wrapper " class="bg-light main col-md-9 mx-auto container ">
			<div class="jumborton bg-light">
				<a href="href" data-target="#sidebar-wrapper" data-toggle="collapse" aria-expanded="false" class="btn ">
					<i class="fas fa-bars"></i>
					Menu 
				</a>
				<ul class="breadcrumb">
					@yield('breadcrumb')
					<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Rapat</a></li>
					<li class="breadcrumb-item">Agenda</li> -->
				</ul>
			</div>
			@if(session('success'))
			<div class="alert alert-success" role="alert">
				{{session('success')}}
			</div>
			@elseif(session('danger'))
			<div class="alert alert-danger" role="alert">
				{{session('danger')}}
			</div>
			@endif
			@if(session('datapengiriman'))
				@foreach(session('datapengiriman') as $dpeng)
					@if($dpeng[2]=='berhasil')
					<div class="alert alert-success" role="alert">
						Mengirim undangan kepada {{$dpeng[0]}} - {{$dpeng[1]}} | <i class="far fa-check-circle"></i>
					</div>
					@elseif($dpeng->status=='gagal')
					<div class="alert alert-danger" role="alert">
						Mengirim undangan kepada {{$dpeng[0]}} - {{$dpeng[1]}} | <i class="far fa-times-circle"></i>
					</div>
					@endif
				@endforeach
			@endif
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

			<div class="card" >
				<div class="card border container">
					<center>
						<h5 class="lead">
							@yield('dataname')
						</h5>
					</center>
				</div>
				<div class="container " >
					@foreach($datarapatutama as $datautama)

					<ul class="nav nav-tabs">
						<li class="nav-item">
					    <a class="nav-link " href="/dashboard/pengelolaan_rapat">Pilih Rapat</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @yield('lankahrapat')" href="/dashboard/pengelolaan_rapat/{{$datautama->id_rapat}}">1. Rapat</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @yield('lankahpeserta')" href="/dashboard/pengelolaan_rapat/{{$datautama->id_rapat}}/peserta">2. Peserta</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @yield('lankahsurat')" href="/dashboard/pengelolaan_rapat/{{$datautama->id_rapat}}/surat">3. Surat</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @yield('lankahabsensi') 
					    @if($datautama->status=='cancel'||$datautama->status=='draf')
						disabled
						@endif
					    " href="/dashboard/pengelolaan_rapat/{{$datautama->id_rapat}}/absensi">4. Absensi</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @yield('lankahdokumentasi')
					    @if($datautama->status=='cancel'||$datautama->status=='draf')
						disabled
						@endif
					    " href="/dashboard/pengelolaan_rapat/{{$datautama->id_rapat}}/dokumentasi">5. Dokumentasi</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @yield('lankahnotulensi')
					    @if($datautama->status=='cancel'||$datautama->status=='draf')
						disabled
						@endif
					    " href="/dashboard/pengelolaan_rapat/{{$datautama->id_rapat}}/notulensi">6. Notulensi</a>
					  </li>
					  <!-- <li class="nav-item">
					    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
					  </li> -->
					</ul>
					@endforeach
					@yield('datacontent')
				</div>
				<br/>
				<br/>
				<br/>
				<br/>
			</div>

			
		</div>
		<!-- /content -->
	</div>
	<!-- Footer -->
    <div class="bg-dark text-white col-md-12" style="bottom: 0;">
    	<!-- copyright -->
    	<div class="text-center py-5">
    		© 2019 Copyright : <a href="https://igedearya.web.id">Igedearya.web.id</a>
    	</div>
    	<!-- /copyright -->
    </div> 
    <!-- /Footer -->

</body>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="/datatable/datatables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	
	@yield('skripjava')



</html>