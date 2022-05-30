@extends('dashboard/maindashboard')
@section('title','Laporan Rapat')
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
@section('menulaporanrapat','active')
@section('menuuser','')
<!-- /pengaturan keaktivan menu sidebar -->
@section('breadcrumb')
<li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
<li class="breadcrumb-item"><a href="dashboard/rapat">Dashboard</a></li>
<li class="breadcrumb-item">Laporan</li>
@endsection
@section('dataname','Laporan Rapat')
@section('datacontent')
<div class="row"></div>
<div class="col-md-12">
	<form method="post" action="">
		{{ csrf_field() }}
	<div class="form-row">
    <div class="form-group col-md-2">
      	<label for="bulan">Bulan </label>
	    <select name="bulan" class="form-control">
	    	@for($b=1;$b<=12;$b++)
	    	<option value="{{$b}}" 
	    	@if($b==$bulan)
	    	selected 
	    	@endif
	    	>{{$b}}</option>
	    	@endfor
	    </select>
    </div>
    <div class="form-group col-md-4">
      	<label for="tahun" >Tahun </label>
	    <select name="tahun" class="form-control">
	    	@for($b=date('Y')-5;$b<=date('Y');$b++)
	    	<option value="{{$b}}" 
	    	@if($b==$tahun)
	    	selected 
	    	@endif
	    	>{{$b}}</option>
	    	@endfor
	    </select>
    </div>
    <div class="form-group col-md-6">
    	<label>Pilih</label>
      	<button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-chart-bar"></i> Lihat Laporan</button>
    </div>
  </div>
  </form>
</div>
<div class="row"></div>
<div class="col-md-12 table-responsive">
	<hr>
	<center>
	<h3 class="lead">Data Kehadiran Pegawai Bulan {{$bulan}} Tahun {{$tahun}}</h3>
	</center>
	<br>
	<table id="datakehadirantahunan" class="table table-bordered table-sm ">
	<thead class="thead-light">
		
		<tr class="text-center">
			<th rowspan="2">Nama</th>
			<th rowspan="2">Jabatan / Status Pegawai</th>
			<th rowspan="2">NIP</th>
			<th rowspan="2">OPD</th>
			<th colspan="6">Kehadiran</th>		
		</tr>
		<tr class="text-center">
			
			<th>Hadir</th>
			<th>Alpa</th>
			<th>Izin</th>
			<th>Sakit</th>
			<th>Dinas Luar</th>
			<th>Undangan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datakehadiranbulanan as $data)
		<tr>
			<td>{{$data['nama']}}</td>
			<td>{{$data['jabatan']}} <br>({{$data['status_pegawai']}})</td>
			<td>{{$data['nip']}}</td>
			<td>{{$data['nama_opd']}}</td>		
			<td class="text-center">{{$data['hadir']}}</td>
			<td class="text-center">{{$data['alpa']}}</td>
			<td class="text-center">{{$data['izin']}}</td>
			<td class="text-center">{{$data['sakit']}}</td>
			<td class="text-center">{{$data['dinas_luar']}}</td>
			<td class="text-center">{{$data['dinas_luar']+$data['dinas_luar']+$data['sakit']+$data['izin']+$data['alpa']+$data['hadir']}}</td>
		</tr>
		@endforeach

	</tbody>
	
	
</table>
</div>
<div class="row"></div>
<div class="col-md-12 table-responsive">
	<hr>
	<center>
	<h3 class="lead">DATA KEHADIRAN RAPAT PADA TAHUN {{$tahun}}</h3>
	</center>
	<br>
	<table id="datakehadiranbulanan" class="table table-bordered table-sm ">
	<thead class="thead-light">
		
		<tr class="text-center">
			<th rowspan="2">Tanggal</th>
			<th rowspan="2">Topik</th>
			<th colspan="6">Kehadiran</th>		
		</tr>
		<tr class="text-center">
			
			<th>Hadir</th>
			<th>Alpa</th>
			<th>Izin</th>
			<th>Sakit</th>
			<th>Dinas Luar</th>
			<th>Jumlah Peserta</th>
		</tr>
	</thead>
	<tbody>
		@foreach($kehadiranrapatperbulan as $datakrb)
		<tr>
			<td>{{$datakrb['tanggal']}}</td>
			<td>{{$datakrb['topik']}}</td>		
			<td class="text-center">{{$datakrb['hadir']}}</td>
			<td class="text-center">{{$datakrb['alpa']}}</td>
			<td class="text-center">{{$datakrb['izin']}}</td>
			<td class="text-center">{{$datakrb['sakit']}}</td>
			<td class="text-center">{{$datakrb['dinas_luar']}}</td>
			<td class="text-center">{{$datakrb['dinas_luar']+$datakrb['dinas_luar']+$datakrb['sakit']+$datakrb['izin']+$datakrb['alpa']+$datakrb['hadir']}}</td>
		</tr>
		@endforeach

	</tbody>
	
	
</table>
</div>
<hr>
<div class="row"></div>
<div class="col-md-12">
	<div id="grafikabsen"></div>
</div>
<div class="row"></div>
<div class="col-md-12 table-responsive">
	<hr>
	<center>
	<h3 class="lead">Data Kehadiran Semua Pegawai Tahun {{$tahun}}</h3>
	</center>
	<br>
	<table id="datakehadirantahunan" class="table table-bordered table-sm ">
	<thead class="thead-light">
		
		<tr class="text-center">
			<th rowspan="2">Foto</th>
			<th rowspan="2">Nama</th>
			<th rowspan="2">Jabatan / Status Pegawai</th>
			<th rowspan="2">NIP</th>
			<th rowspan="2">OPD</th>
			<th colspan="6">Kehadiran</th>		
		</tr>
		<tr class="text-center">
			
			<th>Hadir</th>
			<th>Alpa</th>
			<th>Izin</th>
			<th>Sakit</th>
			<th>Dinas Luar</th>
			<th>Undangan</th>
		</tr>
	</thead>
	<tbody>
		@foreach($datakehadirantahunan as $data)
		<tr>
			<td><img src="{{asset('foto/'.$data['foto'])}}" class="img-circle" alt="foto Profil" width="100px" height="100px"> </td>
			<td>{{$data['nama']}}</td>
			<td>{{$data['jabatan']}} <br>({{$data['status_pegawai']}})</td>
			<td>{{$data['nip']}}</td>
			<td>{{$data['nama_opd']}}</td>		
			<td class="text-center">{{$data['hadir']}}</td>
			<td class="text-center">{{$data['alpa']}}</td>
			<td class="text-center">{{$data['izin']}}</td>
			<td class="text-center">{{$data['sakit']}}</td>
			<td class="text-center">{{$data['dinas_luar']}}</td>
			<td class="text-center">{{$data['dinas_luar']+$data['dinas_luar']+$data['sakit']+$data['izin']+$data['alpa']+$data['hadir']}}</td>
		</tr>
		@endforeach

	</tbody>
	
	
</table>
</div>

<!-- /modal form -->
@endsection
@section('skripjava')

<script>
  $(document).ready(function() {
    $('#datakehadiranbulanan').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
    $('#datakehadirantahunan').DataTable();
  });
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
Highcharts.chart('grafikabsen', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'KEHADIRAN PESERTA RAPAT DI TAHUN {!! $tahun !!}'
    },
    subtitle: {
        text: 'Source: APPARD | Dewan Riset Daerah Kab. Pesawaran'
    },
    xAxis: {
        categories: [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} orang</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: {!! json_encode($series) !!}
});
</script>

@endsection