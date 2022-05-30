<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="font-family: Verdana;font-size: 24px;">
	
	<div style="width: 100%; background-color: #F2F3F4 ;padding: 20px 20px 20px 20px">
		<h2>UNDANGAN RAPAT DRD</h2>
		<hr>
		<P>Tabik Pun!</P>
		<p><b>Dewan Riset Daerah Kabupaten Pesawaran</b> mengundang tuan/nyonya untuk mengikuti rapat mengenai "<i>{{$topik}}</i>" pada :</p>
		<ul style="list-style-type: none;">
	        <li>
	          <i class="far fa-calendar-alt"></i> <small >
	          {{ strftime(Carbon\Carbon::parse($tanggal)->formatLocalized('%A, %d %B %Y'))}}, {{$jam}}</small>
	      	</li>
	        <li>
	        	<i class="fas fa-map-marked-alt"></i> <small >{{$tempat}}</small>
	        </li>
		</ul>
		<p>Kehadiran tuan/nyonya sangat diharapkan pada rapat ini</p>
		<br>
		<button style="background-color: #3498DB;color: #F2F3F4 ;padding: 5px 5px 5px 5px;font-size: 24px;">Klik Untuk Info Lebih Lengkap</button>
	</div>
	
</body>
</html>