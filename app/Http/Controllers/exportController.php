<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Response;

class exportController extends Controller
{
    //export absen rapat
    public function exsportabsen($id_rapat){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$absen=DB::table('peserta_rapat')
    		->where('peserta_rapat.id_rapat',$id_rapat)
    		->select('peserta_rapat.*','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
    		->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
    		->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
    		->join('opd','pegawai.id_opd','=','opd.id_opd')
    		->get();
    	$rapat=DB::table('rapat')->where('id_rapat',$id_rapat)->get();
    	$pdf = PDF::loadView('dashboard.export.absen',['dataabsen'=>$absen,'datarapat'=>$rapat]);
		return $pdf->download($waktu_sekarang.' absen.pdf');
		
    }
    //export absen rapat
    public function exsportsurat($id_rapat){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$absen=DB::table('peserta_rapat')
    		->where('peserta_rapat.id_rapat',$id_rapat)
    		->select('peserta_rapat.*','rapat.topik','rapat.tanggal','pegawai.*','opd.id_opd','opd.nama_opd')
    		->join('pegawai','peserta_rapat.id_pegawai','=','pegawai.id_pegawai')
    		->join('rapat','peserta_rapat.id_rapat','=','rapat.id_rapat')
    		->join('opd','pegawai.id_opd','=','opd.id_opd')
    		->get();
    	$rapat=DB::table('rapat')->where('id_rapat',$id_rapat)->get();
    	$surat=DB::table('surat')->where('id_rapat',$id_rapat)->get();
    	$pdf = PDF::loadView('dashboard.export.surat',['dataabsen'=>$absen,'datarapat'=>$rapat ,'datasurat'=>$surat]);
		return $pdf->download($waktu_sekarang.' surat.pdf');
		
    }
}
