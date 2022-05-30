<!DOCTYPE html>
<html>
<head>
	<title>APPARD | Export Absen</title>
</head>
<style>
	@page {
        margin: 150px 25px 25px 25px;
    }
	body{
		padding-left: 75px;
		padding-right: 50px;
	}
	header{
		top: -125px;
		padding-left: 75px;
		padding-right: 50px;
		border-bottom: 3px;
		position: fixed;
		height: 150px;
	}
	main{
		top: 150px;
	}
	table{
		text-align: center;
	}
    footer {
        position: fixed; 
        bottom: -30px; 
        left: 0px; 
        right: 0px;
        height: 50px; 
        padding-bottom: 30px;

        
        text-align: center;
        line-height: 35px;
    }
</style>

	<header>
		<table width="100%">
			<tr >
		    	<td width="10%">
		    		<img src="{{ public_path('logodrdpng1.png') }}" width="100px" height="100px">
		    	</td>
		    	<td class="text-center" style="font-size: 14;">
		    		
		    			<b>DEWAN RISET DAERAH (DRD) KABUPATEN PESAWARAN</b><br>
		    			SEKRETARIAT<br>
						<font style="font-size: 12;">Komplek Perkantoran Pemerintah Kabupaten Pesawaran Desa Way Layap<br>
						GEDONGTATAAN</font>
		    		
		    	</td>
		    </tr>
		</table>
		<hr>
	    
	</header>

    <footer>        
    		© 2019 Copyright APPARD by : <a href="https://igedearya.web.id">Igedearya.web.id</a>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
    	<center>
    		<h3 style="font-size: 12">
	            <b>DAFTAR HADIR PERTEMUAN RAPAT <br>
				DEWAN RISET DAERAH KABUPATEN PESAWARAN</b>
	        </h3>
    	</center>
    	@foreach($datarapat as $data1)
    	<table width="100%" style="text-align: left;">
    		<tr>
    			<td width="10%">Tanggal</td>
    			<td width="1%">:</td>
    			<td>{{ strftime(Carbon\Carbon::parse($data1->tanggal)->formatLocalized('%A, %d %B %Y'))}}</td>
    		</tr>
    		<tr>
    			<td width="10%">Waktu</td>
    			<td>:</td>
    			<td>{{$data1->jam}} s/d selesai</td>
    		</tr>
    		<tr>
    			<td width="10%">Tempat</td>
    			<td>:</td>
    			<td>{{$data1->tempat}}</td>
    		</tr>
    		<tr>
    			<td width="10%">Acara</td>
    			<td>:</td>
    			<td>Rapat mengenai " <i>{{$data1->topik}}</i>" </td>
    		</tr>
    	</table>
    	@endforeach
    	<br>
    	<table width="100%" border="1" cellspacing="0">
    		<tr>
    			<th>NO</th>
    			<th>NAMA</th>
    			<th>JABATAN / PANGKAT</th>
    			<th>KETERANGAN</th>
    			<th>TANDA TANGAN</th>
    		</tr>
    		@php 
    		$p=1;
    		@endphp
    		@foreach($dataabsen as $data)
    		<tr>
    			<td>{{$p++}}</td>
    			<td>{{$data->nama}}</td>
    			<td>{{$data->jabatan}} {{$data->nama_opd}}</td>
    			<td>{{$data->status}}</td>
    			<td></td>
    		</tr>
    		@endforeach
    	</table>
    	<br>
    	<br>

    	<table width="100%">
    		<tr>
    			<td width="70%"></td>
    			<td style="text-align: right">
    				{{ strftime(Carbon\Carbon::parse($data1->tanggal)->formatLocalized(', %d %B %Y'))}}
    			</td>
    		</tr>
    		<tr>
    			<td></td>
    			<td>
	    			<br>
	    			<br>
	    			<br>
	    			<br>
    			</td>
    		</tr>
    		<tr>
    			<td></td>
    			<td>
    				<u>......................................................</u>
    			</td>
    		</tr>
    	</table>
    </main>
</body>
</html>