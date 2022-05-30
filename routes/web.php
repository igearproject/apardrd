<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>['auth','cekhakakses:admin']],function(){
	
	// route crud data opd
	//untuk menampilkan opd
	Route::get('/dashboard/opd','opdController@all','opdController@pesan');		
	Route::post('/dashboard/opd','opdController@tambah');
	Route::delete('/dashboard/opd','opdController@hapus');
	Route::get('/dashboard/opd/{id}','opdController@show');
	Route::put('/dashboard/opd/{id}','opdController@edit');
	// end route crud data opd
	// route crud data pegawai
	//untuk menampilkan pegawai
	Route::get('/dashboard/pegawai','pegawaiController@index');
	Route::post('/dashboard/pegawai','pegawaiController@tambah');
	Route::delete('/dashboard/pegawai','pegawaiController@hapus');
	Route::get('/dashboard/pegawai/{id}','pegawaiController@show');
	Route::put('/dashboard/pegawai/{id}','pegawaiController@edit');
	// end route crud data pegawai
	// route crud data rapat
	//untuk menampilkan rapat	
	Route::get('/dashboard/rapat','rapatController@index');
	Route::post('/dashboard/rapat','rapatController@tambah');
	Route::delete('/dashboard/rapat','rapatController@hapus');
	Route::get('/dashboard/rapat/{id}','rapatController@show');
	Route::put('/dashboard/rapat/{id}','rapatController@edit');
	// end route crud data rapat
	// route crud data surat
	//untuk menampilkan surat
	Route::get('/dashboard/surat','suratController@index');
	Route::post('/dashboard/surat','suratController@tambah');
	Route::delete('/dashboard/surat','suratController@hapus');
	Route::get('/dashboard/surat/{id}','suratController@show');
	Route::put('/dashboard/surat/{id}','suratController@edit');

	// end route crud data surat
	// route crud data notulen
	//untuk menampilkan notulen
	Route::get('/dashboard/notulen','notulenController@index');
	Route::post('/dashboard/notulen','notulenController@tambah');
	Route::delete('/dashboard/notulen','notulenController@hapus');
	Route::get('/dashboard/notulen/{id}','notulenController@show');
	Route::put('/dashboard/notulen/{id}','notulenController@edit');

	// end route crud data notulen
	// route crud data dokumentasi
	//untuk menampilkan dokumentasi
	Route::get('/dashboard/dokumentasi','dokumentasiController@index');	
	Route::post('/dashboard/dokumentasi','dokumentasiController@tambah');
	Route::delete('/dashboard/dokumentasi','dokumentasiController@hapus');
	Route::get('/dashboard/dokumentasi/{id}','dokumentasiController@show');
	Route::put('/dashboard/dokumentasi/{id}','dokumentasiController@edit');
	// end route crud data dokumentasi
	// route crud data peserta
	//untuk menampilkan peserta
	Route::get('/dashboard/peserta/pilih_rapat','peserta_rapatController@index_pilih_rapat');
	Route::post('/dashboard/peserta/pilih_rapat','peserta_rapatController@pilih_rapat');
	Route::get('/dashboard/peserta/{id_rapat}','peserta_rapatController@index');
	Route::post('/dashboard/peserta/{id_rapat}','peserta_rapatController@tambah');
	Route::delete('/dashboard/peserta/{id_rapat}/{id_peserta}','peserta_rapatController@hapus');
	Route::get('/dashboard/peserta/{id_rapat}/{id}','peserta_rapatController@show');
	Route::put('/dashboard/peserta/{id_rapat}/{id}','peserta_rapatController@edit');
	// end route crud data peserta
	//route untuk user
	Route::get('/dashboard/user','userController@all');
	Route::get('/dashboard/user/{id}','userController@show');
	Route::put('/dashboard/user/{id}','userController@edit');
	Route::post('/dashboard/user','userController@tambah');
	Route::delete('/dashboard/user','userController@hapus');
	Route::get('/dashboard/user/password/{id}','userController@passshow');
	Route::put('/dashboard/user/password/{id}','userController@passedit');
	//end route untuk user
	// route pengelolaan rapat
	Route::get('/dashboard/pengelolaan_rapat','pengelolaan_rapatController@index');
	Route::post('/dashboard/pengelolaan_rapat','pengelolaan_rapatController@pilih');
	
	//fungsi export
	Route::get('/dashboard/export/absen/{id_rapat}','exportController@exsportabsen');
	Route::get('/dashboard/export/surat/{id_rapat}','exportController@exsportsurat');
	//rapat
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}','pengelolaan_rapatController@indexrapat');	
	Route::put('/dashboard/pengelolaan_rapat/{id_rapat}','pengelolaan_rapatController@editstatusrapat');
	//peserta
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}/peserta','pengelolaan_rapatController@indexpeserta_rapat');	
	Route::post('/dashboard/pengelolaan_rapat/{id_rapat}/peserta','pengelolaan_rapatController@tambahpeserta_rapat');
	//surat
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}/surat','pengelolaan_rapatController@indexsurat');
	Route::post('/dashboard/pengelolaan_rapat/{id_rapat}/surat','pengelolaan_rapatController@tambahsurat');
	//absensi
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}/absensi','pengelolaan_rapatController@indexabsensi');
	Route::put('/dashboard/pengelolaan_rapat/{id_rapat}/absensi','pengelolaan_rapatController@editabsensi');
	//dokumentasi
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}/dokumentasi','pengelolaan_rapatController@indexdokumentasi');
	Route::post('/dashboard/pengelolaan_rapat/{id_rapat}/dokumentasi','pengelolaan_rapatController@tambahdokumentasi');
	//notulensi
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}/notulensi','pengelolaan_rapatController@indexnotulensi');
	Route::post('/dashboard/pengelolaan_rapat/{id_rapat}/notulensi','pengelolaan_rapatController@tambahnotulensi');
	//send undangan melalui email
	Route::get('/dashboard/pengelolaan_rapat/{id_rapat}/kirimemail','pengelolaan_rapatController@kirimemail');
	// end pengelolaan rapat
	//route laporan
	Route::get('/dashboard/laporan/{tahun}/{bulan}','laporanController@index');
	Route::post('/dashboard/laporan/{tahun}/{bulan}','laporanController@pilih_tahun');
	//end route laporan

	
	
	//end fungsi export
});
Route::group(['middleware'=>['auth','cekhakakses:admin,pegawai']],function(){
	Route::get('/', function () {
	    return redirect('/dashboard');
	});
	Route::get('/dashboard','rapatController@indexhome');
	Route::get('/dashboard/detail_rapat/{id_rapat}','rapatController@detailrapat');
	Route::put('/dashboard/detail_rapat/{id_rapat}','rapatController@konfirmasikehadiran');
	Route::get('/dashboard/rapat_sebelumnya','rapatController@indexrapat_sebelumnya');
	Route::get('/dashboard/rapat_sebelumnya/detail/{id_rapat}','rapatController@detailrapat_sebelumnya');
	//route untuk logout
	Route::get('/logout','authuserController@logout');
	//untuk menampilkan file surat
	Route::get('/dashboard/surat/filesurat/{name}','suratController@showpdf');	
	//untuk menampilkan file notulen
	Route::get('/dashboard/notulen/filenotulen/{name}','notulenController@showpdf');
	//route untuk pengaturan user
	Route::get('/dashboard/pengaturan_user','userController@indexpengaturan_user');
	Route::get('/dashboard/pengaturan_user/edit_profile','userController@indexedit_profile_user');
	Route::put('/dashboard/pengaturan_user/edit_profile','userController@edit_profile_user');
	Route::get('/dashboard/pengaturan_user/edit_password','userController@indexedit_password_user');
	Route::put('/dashboard/pengaturan_user/edit_password','userController@edit_password_user');
	
});

// login
Route::get('/login','authuserController@index')->name('login');
Route::post('/login','authuserController@login');
// end login