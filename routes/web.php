<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\POController;
use App\Http\Controllers\MRController;
use App\Http\Controllers\SOController;
use App\Http\Controllers\SJController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DetailPOController;
use App\Http\Controllers\DetailMRController;
use App\Http\Controllers\DetailSOController;
use App\Http\Controllers\DetailSJController;
use App\Http\Controllers\DetailInvController;
use App\Http\Controllers\RekananController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DB_marketingController;
use App\Http\Controllers\DetailKasController;
use App\Http\Controllers\HppController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KodeAkuntansiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LapMarketingController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\PlanMarketingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use Illuminate\Support\Facades\Route;



use App\Models\karyawan;
use App\Models\gudang;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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
// Test login
    Route::controller(LoginController::class)->group(function(){
        Route::get('/','index')->middleware(('auth'));
        Route::get('/login','index')->name('login');
        
        Route::post('login/proses','proses');
        Route::get('logout','logout');
    });

    Route::group(['middleware'=> ['auth']],function(){
        Route::group(['middleware' => ['CekUserLogin:admin']],function(){
            Route::get('admin',[AdminController::class,'index'])->middleware('auth');
        });
        Route::group(['middleware' => ['CekUserLogin:marketing']],function(){
            Route::resource('/marketing',MarketingController::class);
        });
    });


    Route::get('/',function(){
        return view('programming-test');
    });

    Route::resource('data-transaksi',TransaksiController::class);
    Route::get('last-transaksi',[TransaksiController::class,'last']);
    Route::resource('data-detail',DetailTransaksiController::class);

// End Test Login
// Route::get('/',function(){
//     return view('login');
// });
Route::get('/info',function(){
    return view('info');
});
//Halaman
Route::get('/home',[LayoutController::class,'index'])->middleware('auth');
Route::get('/marketing',[LayoutController::class,'laporan_marketing'])->middleware('auth');
Route::get('/marketing-lapor',[LayoutController::class,'marketing_lapor'])->middleware('auth');
Route::get('/laporan-marketing',[LayoutController::class,'laporan_marketing_personal'])->middleware('auth');
Route::get('/master-karyawan',[LayoutController::class,'data_karyawan'])->middleware('auth');
Route::get('/master-rekanan',[LayoutController::class,'data_rekanan'])->middleware('auth');
Route::get('/cetak-po',[LayoutController::class,'cetak_po'])->middleware('auth');
Route::get('/cetak-sj',[LayoutController::class,'cetak_sj'])->middleware('auth');
Route::get('/cetak-mr',[LayoutController::class,'cetak_mr'])->middleware('auth');
Route::get('/cetak-invoice',[LayoutController::class,'cetak_invoice'])->middleware('auth');
Route::get('/master-barang',[LayoutController::class,'data_barang'])->middleware('auth');
Route::get('/master-akuntansi',[LayoutController::class,'data_akuntansi'])->middleware('auth');
Route::get('/master-asset',[LayoutController::class,'data_asset'])->middleware('auth');
Route::get('/master-gudang',[LayoutController::class,'data_gudang'])->middleware('auth');
Route::get('/purchase-order',[LayoutController::class,'purchaseorder'])->middleware('auth');
Route::get('/material-receive',[LayoutController::class,'materialreceive'])->middleware('auth');
Route::get('/sales-order',[LayoutController::class,'salesorder'])->middleware('auth');
Route::get('/invoice',[LayoutController::class,'invoice'])->middleware('auth');
Route::get('/master-bank',[LayoutController::class,'data_bank'])->middleware('auth');
Route::get('/surat-jalan',[LayoutController::class,'suratjalan'])->middleware('auth');
Route::get('/planning-mingguan',[LayoutController::class,'plan_marketing'])->middleware(('auth'));
Route::get('/laporan-penjualan ',[LayoutController::class,'laporan_penjualan'])->middleware(('auth'));
Route::get('/stock-gudang',[LayoutController::class,'stock_gudang'])->middleware(('auth'));
Route::get('/kartu-stock-gudang',[LayoutController::class,'kartu_stock_gudang'])->middleware(('auth'));
Route::get('/kas-masuk',[LayoutController::class,'kas_masuk'])->middleware(('auth'));
Route::get('/kas-keluar',[LayoutController::class,'kas_keluar'])->middleware(('auth'));
Route::get('/jurnal-kas',[LayoutController::class,'jurnal_kas'])->middleware(('auth'));
Route::get('/laporan-kas',[LayoutController::class,'laporan_kas'])->middleware(('auth'));
Route::get('/laporan-bukubesar',[LayoutController::class,'laporan_bukubesar'])->middleware(('auth'));
Route::get('/search-jurnal',[LayoutController::class,'search_jurnal'])->middleware(('auth'));
Route::get('/database-marketing',[LayoutController::class,'database_marketing'])->middleware(('auth'));



//route data master
Route::resource('data-karyawan',KaryawanController::class)->middleware('auth');
Route::resource('data-gudang',GudangController::class)->middleware('auth');
Route::resource('data-barang',BarangController::class)->middleware('auth');
Route::resource('data-rekanan',RekananController::class)->middleware('auth');
Route::resource('data-bank',BankController::class)->middleware('auth');
Route::resource('data-po',POController::class)->middleware('auth');
Route::resource('data-detailpo',DetailPOController::class)->middleware('auth');
Route::resource('data-author',AuthorController::class)->middleware('auth');
Route::resource('data-mr',MRController::class)->middleware('auth');
Route::resource('data-detailmr',DetailMRController::class)->middleware('auth');
Route::resource('data-so',SOController::class)->middleware('auth');
Route::resource('data-detailso',DetailSOController::class)->middleware('auth');
Route::resource('data-sj',SJController::class)->middleware('auth');
Route::resource('data-detailsj',DetailSJController::class)->middleware('auth');
Route::resource('data-inv',InvoiceController::class)->middleware('auth');
Route::resource('data-detailinv',DetailInvController::class)->middleware('auth');
Route::resource('data-akuntansi',KodeAkuntansiController::class)->middleware('auth');
Route::resource('data-lapmarketing',LapMarketingController::class)->middleware('auth');
Route::resource('data-detailkas',DetailKasController::class)->middleware('auth');
Route::resource('jurnal',JurnalController::class)->middleware('auth');
Route::resource('data-kas',KasController::class)->middleware('auth');
Route::resource('data-hpp',HppController::class)->middleware('auth');
Route::resource('data-dbmarketing',DB_marketingController::class)->middleware('auth');
Route::resource('data-planmarketing',PlanMarketingController::class)->middleware('auth');
Route::get('data-lapmarketing/{data_lapmarketing}',[LapMarketingController::class,'show'])->middleware('auth');
Route::get('lap-marketing/{tanggal}',[LapMarketingController::class,'lap_marketing'])->middleware('auth');
Route::get('test',[JurnalController::class,'test'])->middleware('auth');

Route::get('DATA-kas/{dk}',[KasController::class,'data_kas'])->middleware('auth');
route::get('data-jurnalkas',[KasController::class,'jurnal_kas'])->middleware('auth');

//selesai
Route::get('data-po-selesai/{kode}',[POController::class,'selesai'])->middleware('auth');
Route::put('data-mr-selesai/{kode}',[MRController::class,'selesai'])->middleware('auth');
Route::put('data-so-selesai/{kode}',[SOController::class,'selesai'])->middleware('auth');
Route::put('data-sj-selesai/{kode}',[SJController::class,'selesai'])->middleware('auth');
Route::put('data-inv-selesai/{kode}',[InvoiceController::class,'selesai'])->middleware('auth');

Route::get('databarang-detailinv/{inv}',[DetailInvController::class,'databarang_detail'])->middleware('auth');

Route::get('kodeakun',[KodeAkuntansiController::class,'akun'])->middleware('auth');

Route::get('dropdown-supplier',[RekananController::class,'dropdownsupplier'])->middleware('auth');
Route::get('dropdown-konsumen',[RekananController::class,'dropdownkonsumen'])->middleware('auth');
Route::get('dropdown-po-mr',[MRController::class,'dropdownpo'])->middleware('auth');
Route::get('dropdown-bank',[BankController::class,'dropdownbank'])->middleware('auth');
Route::get('dropdown-so-sj',[SJController::class,'dropdownso'])->middleware('auth');
Route::get('dropdown-so-inv',[InvoiceController::class,'dropdownso'])->middleware('auth');
Route::get('dropdown-gudang',[GudangController::class,'dropdown'])->middleware('auth');
Route::get('dropdown-marketing',[KaryawanController::class,'dropdownmarketing'])->middleware('auth');
Route::get('dropdown-barangso/{so}',[SJController::class,'dropdownbarangso'])->middleware('auth');
Route::get('dropdown-barangmr/{gudang}',[DetailMRController::class,'dropdownbarang'])->middleware('auth');
Route::get('dropdown-barangpo/{po}',[JurnalController::class,'dropdownbarangpo'])->middleware('auth');
Route::get('dropdown-barangsj/{sj}',[DetailSJController::class,'dropdownbarangsj'])->middleware('auth');
Route::get('dropdown-baranginv/{inv}',[DetailInvController::class,'dropdownbaranginv'])->middleware('auth');
Route::get('dropdown-sj/{jenis}',[SJController::class,'dropdownsj'])->middleware('auth');
Route::get('dropdown-sjinv/{so}',[InvoiceController::class,'dropdownsj'])->middleware('auth');
Route::get('dropdown-akuntansi',[KodeAkuntansiController::class,'dropdownakun'])->middleware('auth');
Route::get('dropdown-akundebit',[KodeAkuntansiController::class,'akundebit'])->middleware('auth');
Route::get('dropdown-akunkredit',[KodeAkuntansiController::class,'akunkredit'])->middleware('auth');
Route::get('dropdown-kas',[KodeAkuntansiController::class,'dropdownkas'])->middleware('auth');
Route::get('dropdown-inv',[InvoiceController::class,'dropdowninv'])->middleware('auth');
Route::get('dropdown-invsd',[InvoiceController::class,'dropdowninvsd'])->middleware('auth');
Route::get('dropdown-inv/{rekanan}',[InvoiceController::class,'dropdowninvrekanan'])->middleware('auth');
Route::get('dropdown-uangmasuk',[KodeAkuntansiController::class,'dropdownuangmasuk'])->middleware('auth');
Route::get('dropdown-uangkeluar',[KodeAkuntansiController::class,'dropdownuangkeluar'])->middleware('auth');
Route::get('dropdown-keperluan',[KodeAkuntansiController::class,'dropdownkeperluan'])->middleware('auth');
Route::get('hpp-barang/{barang}',[JurnalController::class,'hpp_barang'])->middleware('auth');

Route::get('lastkode-barang',[BarangController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-rekanan',[RekananController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-po/{data}',[POController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-so/',[SOController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-mr',[MRController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-sj',[SJController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-inv',[InvoiceController::class,'lastkode'])->middleware('auth');
Route::get('lastkode-kas',[KasController::class,'lastkode'])->middleware('auth');

Route::get('dropdown-barang',[BarangController::class,'dropdownbarang'])->middleware('auth');
Route::delete('hapus-detailpo/{kode}',[DetailPOController::class,'hpsdetailpo'])->middleware('auth');
Route::delete('hapus-kas/{kode}',[DetailKasController::class,'hapuskas'])->middleware('auth');
Route::get('vat-detailso',[DetailSOController::class,'editvat'])->middleware('auth');
Route::delete('hps-detail-mr/{kode}',[DetailMRController::class,'hpsdetailmr'])->middleware('auth');
Route::delete('hps-detail-so/{kode}',[DetailSOController::class,'hpsdetailso'])->middleware('auth');
Route::delete('hps-detail-sj/{kode}',[DetailSJController::class,'hpsdetailsj'])->middleware('auth');
Route::get('hps-edt-detail-sj/{kode}',[DetailSJController::class,'hpsedtdetailsj'])->middleware('auth');
Route::delete('hps-detail-inv/{kode}',[DetailInvController::class,'hpsdetailinv'])->middleware('auth');
Route::get('sjinvoice/{kode}',[SJController::class,'suratjalaninv'])->middleware('auth');
Route::get('gudangso/{kode}',[DetailMRController::class,'gudangso'])->middleware('auth');
Route::get('data-detailsobarang/{kode}',[DetailSOController::class,'detailbarang'])->middleware('auth');
Route::get('cek-username',[KaryawanController::class,'cekusername'])->middleware('auth');
Route::get('kode-detail-sj',[DetailSJController::class,'kodedetail'])->middleware('auth');
Route::get('datadetailsj/{sj}',[DetailSJController::class,'datadetailsj'])->middleware('auth');
Route::put('status-kas/{kode}',[KasController::class,'statuskas'])->middleware('auth');

//jurnal
Route::get('jurnal-detailpo/{kode}',[JurnalController::class,'detail_po'])->middleware('auth');
Route::get('jurnal-detailmr/{kode}',[JurnalController::class,'detail_mr'])->middleware('auth');
Route::get('jurnal-detailso/{kode}',[JurnalController::class,'detail_so'])->middleware('auth');
Route::get('jurnal-detailsj/{kode}',[JurnalController::class,'detail_sj'])->middleware('auth');
Route::get('jurnal-detailinvoice/{kode}',[JurnalController::class,'detail_invoice'])->middleware('auth');
Route::get('jurnal-laporan-penjualan',[JurnalController::class,'laporan_penjualan'])->middleware('auth');
Route::get('detail-penjualan/{kode}',[JurnalController::class,'detail_penjualan'])->middleware('auth');
Route::get('rekap-jurnal',[JurnalController::class,'rekap_jurnal'])->middleware('auth');

//data Stock barang
Route::get('total-so',[JurnalController::class,'total_so'])->middleware('auth');
Route::get('total-sj',[JurnalController::class,'total_sj'])->middleware('auth');
Route::get('total-inv',[JurnalController::class,'total_invoice'])->middleware('auth');
Route::get('data-stock-gudang',[JurnalController::class,'stock_gudang'])->middleware('auth');
Route::get('data-kartu-stock-gudang',[JurnalController::class,'kartu_stock_gudang'])->middleware('auth');


Route::get('data-lap-bukubesar',[JurnalController::class,'data_bukubesar'])->middleware('auth');

//Import Barang
Route::post('import-barang',[BarangController::class,'importbarang']);
Route::post('upload-barang',[BarangController::class,'uploadbarang']);
//Import Rekanan
Route::post('import-rekanan',[RekananController::class,'importrekanan']);
Route::post('upload-rekanan',[RekananController::class,'uploadrekanan']);
//import DB MARKETING
Route::post('import-dbmarketing',[DB_marketingController::class,'importdatabase']);
Route::post('upload-dbmarketing',[DB_marketingController::class,'uploaddatabase']);


Route::post('ubah-password',[KaryawanController::class,'ubahpassword'])->middleware('auth');

Route::get('stock-barangmr/{kode}',[DetailMRController::class,'stockbarang'])->middleware('auth');
Route::get('cekinvoice-sj/{kode}',[SJController::class,'cekinvoice'])->middleware('auth');

Route::get('cetak-invoice/{kode}',[InvoiceController::class,'cetakinv'])->middleware('auth');
Route::get('cetakpodetail/{kode}',[POController::class,'cetakpo'])->middleware('auth');
Route::get('cetaksjdetail/{kode}',[SJController::class,'cetaksj'])->middleware('auth');
Route::get('cetakmr/{kode}',[MRController::class,'cetakmr'])->middleware('auth');


