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
    @foreach($datasurat as $data) 
    <main style="line-height: 20px;font-size: 14px;">
        <table width="100%" style="text-align: left;">
            <tr>
                <td width="50%"></td>
                <td width="10%"></td>
                <td >{{$data->tempat_pembuatan}}, {{ strftime(Carbon\Carbon::parse($data->tanggal_pembuatan)->formatLocalized('%d %B %Y'))}}<br><br></td>
            </tr>
            <tr>
                <td width="50%"></td>
                <td width="10%"></td>
                <td >Kepada,</td>
            </tr>
            <tr>
                <td width="50%">
                    <table style="text-align: left;">
                        <tr>
                            <td>Nomor</td>
                            <td> : </td>
                            <td>{{$data->no_surat}}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td> : </td>
                            <td>1 (satu) Lembar</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td> : </td>
                            <td><u>{{$data->perihal}}</u> </td>
                        </tr>
                    </table>  
                </td>
                <td width="10%"></td>
                <td >
                    <i>(Daftar Undangan Terlampir)</i><br>
                    Di - <br>
                    <p style="padding-left: 10px;"><b><u>Tempat</u></b></p>
                </td>
            </tr>
                  
        </table>
        @foreach($datarapat as $data1)
        <p style="padding-left: 100px;text-align: justify;text-indent:50px ">
            Sehubungan dengan akan dilaksanakannya Rapat Pembahasan {{$data1->topik}}, maka dengan ini Kami mengharapkan kehadiran Saudara pada: 
        </p>
        <table width="100%" style="text-align: left;padding-left: 150px;">
            <tr>
                <td width="25%">Hari / Tanggal</td>
                <td width="2%">:</td>
                <td>{{ strftime(Carbon\Carbon::parse($data1->tanggal)->formatLocalized('%A / %d %B %Y'))}}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>Pukul {{$data1->jam}} WIB s/d selesai</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>:</td>
                <td>
                    {{$data1->tempat}}
                </td>
            </tr>
            
                <td colspan="3"><br>Demikian, atas kehadiran saudara diucapkan terima kasih.</td>
            </tr>

        </table>
        @endforeach
        <br>
        <br>
    	<table width="100%">
    		<tr>
    			<td width="50%"></td>
    			<td style="text-align: center">
    				<b>KETUA DEWAN RISET DAERAH<br>
                    KABUPATEN PESAWARAN</b>

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
        <p>Tembusan; <u><i>disampaikan Kepada Yth.</i></u><p>
            <ol>
                <li>Bupati Pesawaran (sebagai laporan)</li>
                <li>Pertinggal</li>
            </ol>
        <br >
        @endforeach
        <p style="page-break-before: always;">
                
        </p>
        <table width="100%">
            <tr>
                <td>
                    <table width="50%" style="text-align: left;" align="right">
                        <tr style="text-align: left;">
                            <td colspan="3">Lampiran Surat Sekretariat</td>
                        </tr>
                        <tr style="text-align: left;">
                            <td>Nomor</td>
                            <td> : </td>
                            <td>{{$data->no_surat}}</td>
                        </tr>
                        <tr style="text-align: left;">
                            <td>Tanggal</td>
                            <td> : </td>
                            <td>{{ strftime(Carbon\Carbon::parse($data->tanggal_pembuatan)->formatLocalized('%d %B %Y'))}}</td>
                        </tr>
                        <tr style="text-align: left;">
                            <td>Perihal</td>
                            <td> : </td>
                            <td><u>{{$data->perihal}}</u> </td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p><b>DAFTAR UNDANGAN</b></p>
                </td>
            </tr>
        </table>
        
        <ol>
            @foreach($dataabsen as $data)
            <li>{{$data->nama}} - {{$data->jabatan}} {{$data->nama_opd}}</li>
            @endforeach
        </ol>
        
    </main>

</body>
</html>