<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use File;

class userController extends Controller
{
    //menampilkan semua user
    public function all(){
    	$user=DB::table('users')
    		->select('users.*','pegawai.nama','pegawai.id_opd','opd.nama_opd')
    		->join('pegawai','users.id_pegawai','=','pegawai.id_pegawai')
    		->join('opd','opd.id_opd','=','pegawai.id_opd')
    		->get();
    	$pegawai=DB::table('pegawai')
    		->join('opd','opd.id_opd','=','pegawai.id_opd')
    		->get();
    	return view('dashboard.user.user',['datauser'=>$user])
	    	->with('daftarpegawai',$pegawai);
    }
    public function tambah(Request $request){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	if ($request->password==$request->password1) {
    		$perintah=DB::table('users')->insert([
    			'id'=>null,
				'name'=>$request->name,
				'email'=>$request->email,
				'email_verified_at'=>null,
				'password'=>bcrypt($request->password),
				'hak_akses'=>$request->hak_akses,
				'id_pegawai'=>$request->id_pegawai,
				'remember_token'=>$request->_token,
				'created_at'=>$waktu_sekarang,
				'updated_at'=>$waktu_sekarang

    		]);
    		if($perintah){
				return redirect()->action('userController@all')->with('success','User '.$request->name.' Berhasil di Inputkan !');
			}else{
				return redirect()->action('userController@all')->with('danger','User '.$request->name.' Gagal di Inputkan !');
			}
	    
    	}else{
    		return redirect()->action('userController@all')->with('danger','User '.$request->name.' Gagal di Inputkan, Karena password yang diinputkan tidak sesuai!');
    	}
    }
    public function hapus(Request $request){
    	$id_user=Crypt::decrypt(Input::get('id'));
    	$perintah=DB::table('users')->where('id',$id_user)->delete();
    	if($perintah){
			return redirect()->action('userController@all')->with('success','User '.$request->name.' Berhasil di Delete !');
		}else{
			return redirect()->action('userController@all')->with('danger','User '.$request->name.' Gagal di Delete !');
		}
    }
    public function show($id){
    	$id_user=Crypt::decrypt($id);
    	$user=DB::table('users')
    		->select('users.*','pegawai.nama','pegawai.id_opd','opd.nama_opd')
    		->where('id',$id_user)
    		->join('pegawai','users.id_pegawai','=','pegawai.id_pegawai')
    		->join('opd','opd.id_opd','=','pegawai.id_opd')
    		->get();
    	$pegawai=DB::table('pegawai')
    		->join('opd','opd.id_opd','=','pegawai.id_opd')
    		->get();
    	return view('dashboard.user.edituser',['datauser'=>$user])
	    	->with('daftarpegawai',$pegawai);
    }
    public function edit(Request $request, $id){
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	$id_user=Crypt::decrypt($id);
    	$perintah=DB::table('users')->where('id',$id_user)->update([
    		'name'=>$request->name,
			'email'=>$request->email,
			'hak_akses'=>$request->hak_akses,
			'remember_token'=>$request->_token,
			'updated_at'=>$waktu_sekarang
    	]);
    	if($perintah){
			return redirect()->action('userController@all')->with('success','User '.$request->name.' Berhasil di Update !');
		}else{
			return redirect()->action('userController@all')->with('danger','User '.$request->name.' Gagal di Update !');
		}
    }
    public function passshow($id){
    	return view('dashboard.user.editpassworduser');
    }
    public function passedit(Request $request, $id){
    	$id_user=Crypt::decrypt($id);
    	$user=DB::table('users')->where('id',$id_user)->get();
    	$waktu_sekarang=date('Y-m-d H:i:s');
    	foreach ($user as $data) {
    		if ($request->password==$request->password1&&Hash::check($request->passwordlama, $data->password)) {
    			$perintah=DB::table('users')->where('id',$id_user)->update([
					'password'=>bcrypt($request->password),
					'remember_token'=>$request->_token,
					'updated_at'=>$waktu_sekarang
		    	]);
		    	if($perintah){
					return redirect()->action('userController@all')->with('success','Password User '.$data->name.' Berhasil di Update !');
				}else{
					return redirect()->action('userController@all')->with('danger','Password User '.$data->name.' Gagal di Update !');
				}
			}else{
	    		return redirect()->action('userController@all')->with('danger','Password User '.$data->name.' Gagal di Update, Karena password yang diinputkan tidak sesuai!');
	    	}
    	}
    	
    }
    public function indexpengaturan_user(){
        $id_pegawai=auth()->user()->id_pegawai;
        $user=DB::table('users')
            ->select('users.*','pegawai.nama','pegawai.foto','pegawai.no_hp','pegawai.nip','pegawai.jabatan','pegawai.jenis_kelamin','pegawai.tanggal_lahir','pegawai.alamat','pegawai.agama','pegawai.status_pegawai','pegawai.id_opd','opd.nama_opd')
            ->where('users.id_pegawai',$id_pegawai)
            ->join('pegawai','users.id_pegawai','=','pegawai.id_pegawai')
            ->join('opd','opd.id_opd','=','pegawai.id_opd')
            ->get();
        return view('dashboard.user.pengaturanuser',['datauser'=>$user]);
    }
    public function indexedit_profile_user(){
        $id_pegawai=auth()->user()->id_pegawai;
        $user=DB::table('users')
            ->select('users.*','pegawai.nama','pegawai.foto','pegawai.no_hp','pegawai.nip','pegawai.jabatan','pegawai.jenis_kelamin','pegawai.tanggal_lahir','pegawai.alamat','pegawai.agama','pegawai.status_pegawai','pegawai.id_opd','opd.nama_opd')
            ->where('users.id_pegawai',$id_pegawai)
            ->join('pegawai','users.id_pegawai','=','pegawai.id_pegawai')
            ->join('opd','opd.id_opd','=','pegawai.id_opd')
            ->get();
        return view('dashboard.user.editpengaturanuser',['datauser'=>$user]);
    }
    public function edit_profile_user(Request $request){
        $this->validate($request,[
            'foto'=>'file|image|mimes:jpeg,png,gif,jpg,webp|max:2048',
        ]);        
        $waktu_sekarang=date('Y-m-d H:i:s');
        $waktu_sekarang_name=date('Y_m_d_His');
        $id_pegawai=auth()->user()->id_pegawai;
        $id_user=auth()->user()->id;
        if($request->hasFile('foto')){
            $request->file('foto')->move('foto/',$waktu_sekarang_name.' '.$request->file('foto')->getClientOriginalName());
            $nama_foto=$waktu_sekarang_name.' '.$request->file('foto')->getClientOriginalName();

        }else{
            $nama_foto=$request->foto1;
        }
        $perintah=DB::table('pegawai')
        ->where('id_pegawai',$id_pegawai)
        ->update([
            'no_hp'=>$request->no_hp,
            'email'=>$request->email,
            'foto'=>$nama_foto,
            'alamat'=>$request->alamat,
            'updated_at'=>$waktu_sekarang
        ]);
        $perintah=DB::table('users')->where('id',$id_user)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'remember_token'=>$request->_token,
            'updated_at'=>$waktu_sekarang
        ]);
        if($perintah){
            if($request->foto1!='default.png'&&$request->hasFile('foto')){
                File::delete('foto/'.$request->foto1);
            }
            return redirect()->action('userController@indexpengaturan_user')->with('success','Data User Berhasil di Edit !');
        }else{
            return redirect()->action('userController@indexpengaturan_user')->with('danger','Data User Gagal di Edit !');
        }
    }
    public function indexedit_password_user(){
        return view('dashboard.user.editpasswordpengaturanuser');
    }
    public function edit_password_user(Request $request){
        $id_user=auth()->user()->id;
        $user=DB::table('users')->where('id',$id_user)->get();
        $waktu_sekarang=date('Y-m-d H:i:s');
        foreach ($user as $data) {
            if ($request->password==$request->password1&&Hash::check($request->passwordlama, $data->password)) {
                $perintah=DB::table('users')->where('id',$id_user)->update([
                    'password'=>bcrypt($request->password),
                    'remember_token'=>$request->_token,
                    'updated_at'=>$waktu_sekarang
                ]);
                if($perintah){
                    return redirect()->action('userController@indexpengaturan_user')->with('success','Password User Berhasil di Update !');
                }else{
                    return redirect()->action('userController@indexpengaturan_user')->with('danger','Password User Gagal di Update !');
                }
            }else{
                return redirect()->action('userController@indexpengaturan_user')->with('danger','Password User Gagal di Update, Karena password yang diinputkan tidak sesuai!');
            }
        }
    }
}
