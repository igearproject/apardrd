<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class laporanController extends Controller
{
    public function index($tahun,$bulan){
    	$pegawaidrdbulanini=DB::table('rapat')->whereYear('tanggal','=',$tahun)->count();
    	if ($pegawaidrdbulanini>0) {
	    	$rapat=DB::table('rapat')
	    		->whereYear('tanggal','=',$tahun)
	    		->where('status','=','pass')
	    		->get();
	    	foreach ($rapat as $datarapat) {
	    		$kehadiranrapatperbulan[]=array(
	    			'id_rapat'=>$datarapat->id_rapat,
	    			'topik'=>$datarapat->topik,
	    			'tanggal'=>$datarapat->tanggal,
	    			'hadir'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','hadir')
	    				->where('rapat.status','=','pass')
	    				->where('rapat.id_rapat','=',$datarapat->id_rapat)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'alpa'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','alpa')
	    				->where('rapat.status','=','pass')
	    				->where('rapat.id_rapat','=',$datarapat->id_rapat)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'izin'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','izin')
	    				->where('rapat.status','=','pass')
	    				->where('rapat.id_rapat','=',$datarapat->id_rapat)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'sakit'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','sakit')
	    				->where('rapat.status','=','pass')
	    				->where('rapat.id_rapat','=',$datarapat->id_rapat)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'dinas_luar'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','dinas_luar')
	    				->where('rapat.status','=','pass')
	    				->where('rapat.id_rapat','=',$datarapat->id_rapat)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    		);
	    	}
	    }else{
	    	$kehadiranrapatperbulan[]=array(
		    	'id_rapat'=>0,
				'topik'=>'Tidak ada rapat pada tahun'.$tahun,
				'tanggal'=>'kosong',
				'hadir'=>0,
				'alpa'=>0,
				'izin'=>0,
				'sakit'=>0,
				'dinas_luar'=>0
			);
	    }
    	$pegawaidrdbulanini=DB::table('rapat')->whereMonth('tanggal','=',$bulan)->whereYear('tanggal','=',$tahun)->count();
    	if ($pegawaidrdbulanini>0) {
    		$pegawai=DB::table('pegawai')
	    		->join('opd','pegawai.id_opd','=','opd.id_opd')
	    		->get();
	    	foreach ($pegawai as $data) {
	    		$datakehadiranbulanan[]=array(
	    			'id_pegawai'=>$data->id_pegawai,
	    			'foto'=>$data->foto,
	    			'nama'=>$data->nama,
	    			'id_pegawai'=>$data->id_pegawai,
	    			'jabatan'=>$data->jabatan,
	    			'status_pegawai'=>$data->status_pegawai,
	    			'nip'=>$data->nip,
	    			'nama_opd'=>$data->nama_opd,
	    			'hadir'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','hadir')
	    				->where('rapat.status','=','pass')
	    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->whereMonth('tanggal','=',$bulan)
	    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'alpa'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','alpa')
	    				->where('rapat.status','=','pass')
	    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->whereMonth('tanggal','=',$bulan)
	    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'izin'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','izin')
	    				->where('rapat.status','=','pass')
	    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->whereMonth('tanggal','=',$bulan)
	    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'sakit'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','sakit')
	    				->where('rapat.status','=','pass')
	    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->whereMonth('tanggal','=',$bulan)
	    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count(),
	    			'dinas_luar'=>DB::table('peserta_rapat')
	    				->where('peserta_rapat.status','=','dinas_luar')
	    				->where('rapat.status','=','pass')
	    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
	    				->whereYear('rapat.tanggal','=',$tahun)
	    				->whereMonth('tanggal','=',$bulan)
	    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
	    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
	    				->count()
	    		);
	    	}
    	}else{
    		$datakehadiranbulanan[]=array(
	    			'id_pegawai'=>'kosong',
	    			'foto'=>'kosong',
	    			'nama'=>'Tidak ada rapat pada bulan '.$bulan,
	    			'id_pegawai'=>'kosong',
	    			'jabatan'=>'kosong',
	    			'status_pegawai'=>'kosong',
	    			'nip'=>'kosong',
	    			'nama_opd'=>'kosong',
	    			'hadir'=>0,
	    			'alpa'=>0,
	    			'izin'=>0,
	    			'sakit'=>0,
	    			'dinas_luar'=>0
	    		);
    	}
    	// $kehadiranpegawaitahunan=DB::table('peserta_rapat')
    	// 	->select(array('peserta_rapat.*','pegawai.nama',DB::raw('COUNT(peserta_rapat.id_pegawai) as jumlah')))
    	// 	->where('rapat.status','pass')
    	// 	->where('rapat.tanggal','like',$tahun.'%')
    	// 	->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
    	// 	->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    	// 	->groupBy('peserta_rapat.id_pegawai','peserta_rapat.status')
    	// 	->get();
    	
    	$pegawai=DB::table('pegawai')
    		->join('opd','pegawai.id_opd','=','opd.id_opd')
    		->get();
    	foreach ($pegawai as $data) {
    		$datakehadirantahunan[]=array(
    			'id_pegawai'=>$data->id_pegawai,
    			'foto'=>$data->foto,
    			'nama'=>$data->nama,
    			'id_pegawai'=>$data->id_pegawai,
    			'jabatan'=>$data->jabatan,
    			'status_pegawai'=>$data->status_pegawai,
    			'nip'=>$data->nip,
    			'nama_opd'=>$data->nama_opd,
    			'hadir'=>DB::table('peserta_rapat')
    				->where('peserta_rapat.status','=','hadir')
    				->where('rapat.status','=','pass')
    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
    				->whereYear('rapat.tanggal','=',$tahun)
    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    				->count(),
    			'alpa'=>DB::table('peserta_rapat')
    				->where('peserta_rapat.status','=','alpa')
    				->where('rapat.status','=','pass')
    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
    				->whereYear('rapat.tanggal','=',$tahun)
    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    				->count(),
    			'izin'=>DB::table('peserta_rapat')
    				->where('peserta_rapat.status','=','izin')
    				->where('rapat.status','=','pass')
    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
    				->whereYear('rapat.tanggal','=',$tahun)
    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    				->count(),
    			'sakit'=>DB::table('peserta_rapat')
    				->where('peserta_rapat.status','=','sakit')
    				->where('rapat.status','=','pass')
    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
    				->whereYear('rapat.tanggal','=',$tahun)
    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    				->count(),
    			'dinas_luar'=>DB::table('peserta_rapat')
    				->where('peserta_rapat.status','=','dinas_luar')
    				->where('rapat.status','=','pass')
    				->where('peserta_rapat.id_pegawai','=',$data->id_pegawai)
    				->whereYear('rapat.tanggal','=',$tahun)
    				->join('pegawai','pegawai.id_pegawai','=','peserta_rapat.id_pegawai')
    				->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    				->count()
    		);
    	}
    	// dd($kehadiranpegawaitahunan,$datakehadirantahunan);
    	$category=[];
    	$series[0]['name']='hadir';
    	$series[1]['name']='alpa';
    	$series[2]['name']='izin';
    	$series[3]['name']='sakit';
    	$series[4]['name']='dinas luar';
    	for ($i=1; $i<=12 ; $i++) { 
    		$category[]=$i;

    		$series[0]['data'][]=DB::table('peserta_rapat')
    			->where('peserta_rapat.status','hadir')
    			->where('rapat.status','pass')
    			->whereYear('rapat.tanggal','=',$tahun)
    			->whereMonth('rapat.tanggal','=',$i)
    			->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    			->count();
    		$series[1]['data'][]=DB::table('peserta_rapat')
    			->where('peserta_rapat.status','alpa')
    			->where('rapat.status','pass')
    			->whereYear('rapat.tanggal','=',$tahun)
    			->whereMonth('rapat.tanggal','=',$i)
    			->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    			->count();
    		$series[2]['data'][]=DB::table('peserta_rapat')
    			->where('peserta_rapat.status','izin')
    			->where('rapat.status','pass')
    			->whereYear('rapat.tanggal','=',$tahun)
    			->whereMonth('rapat.tanggal','=',$i)
    			->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    			->count();
    		$series[3]['data'][]=DB::table('peserta_rapat')
    			->where('peserta_rapat.status','sakit')
    			->where('rapat.status','pass')
    			->whereYear('rapat.tanggal','=',$tahun)
    			->whereMonth('rapat.tanggal','=',$i)
    			->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    			->count();
    		$series[4]['data'][]=DB::table('peserta_rapat')
    			->where('peserta_rapat.status','dinas_luar')
    			->where('rapat.status','pass')
    			->whereYear('rapat.tanggal','=',$tahun)
    			->whereMonth('rapat.tanggal','=',$i)
    			->join('rapat','rapat.id_rapat','=','peserta_rapat.id_rapat')
    			->count();
    	}

    	return view('dashboard/rapat/laporan',[
    		'category'=>$category,
    		'series'=>$series,
    		'tahun'=>$tahun,
    		'bulan'=>$bulan,
    		'datakehadirantahunan'=>$datakehadirantahunan,
    		'datakehadiranbulanan'=>$datakehadiranbulanan,
    		'kehadiranrapatperbulan'=>$kehadiranrapatperbulan
    	]);

    }
    public function pilih_tahun(Request $request){
    	return redirect('/dashboard/laporan/'.$request->tahun.'/'.$request->bulan);
    }
}
