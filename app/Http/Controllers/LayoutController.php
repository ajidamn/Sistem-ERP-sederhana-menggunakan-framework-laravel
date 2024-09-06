<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\karyawan;

class LayoutController extends Controller
{
    //
    public function index()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        return view('main')->with([
            'user'=>Auth::user(),
            'detail'=>$karyawan,
       ]);
    }
    public function login()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if ($login == null){
            return view('login');
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
            
        }
        
    }
    public function laporan_marketing()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'marketing'){
            return view('laporan-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login == 'manager-marketing'){
            return view('laporan-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login == 'ceo'){
            return view('laporan-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login == 'superadmin'){
            return view('laporan-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }
    }
    public function marketing_lapor()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'marketing'){
            return view('laporan-harian-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'superadmin'){
            return view('laporan-harian-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('laporan-harian-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'manager-marketing'){
            return view('laporan-harian-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }
    }
    
    public function laporan_marketing_personal()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'marketing'){
            return view('laporan-personal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'manager-marketing'){
            return view('laporan-personal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'superadmin'){
            return view('laporan-personal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('laporan-personal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }
    }

    public function data_karyawan()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-karyawan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('data-karyawan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('data-karyawan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }
    }
    public function data_rekanan()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-rekanan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('data-rekanan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('data-rekanan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'purchasing'){
            return view('data-rekanan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function cetak_po()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('cetak-po')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('cetak-po')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('cetak-po')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else if($login->level == 'purchasing'){
            return view('cetak-po')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('cetak-po')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function cetak_mr()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('cetak-mr')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('cetak-mr')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('cetak-mr')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else if($login->level == 'staff-gudang'){
            return view('cetak-mr')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('cetak-mr')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function cetak_sj()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('cetak-sj')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('cetak-sj')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('cetak-sj')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'staff-gudang'){
            return view('cetak-sj')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'manager-operational'){
            return view('cetak-sj')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);

        }
        
    }
    public function cetak_invoice()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('cetak-invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('cetak-invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('cetak-invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'purchasing'){
            return view('cetak-invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function data_barang()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-barang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('data-barang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('data-barang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'purchasing'){
            return view('data-barang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function data_akuntansi()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-akuntansi')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('data-akuntansi')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('data-akuntansi')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }  elseif($login->level == 'accounting'){
            return view('data-akuntansi')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function data_asset()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-asset')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('data-asset')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('data-asset')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'purchasing'){
            return view('data-asset')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function data_gudang()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('data-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('data-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'purchasing'){
            return view('data-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function purchaseorder()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('purchase-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('purchase-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('purchase-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'purchasing'){
            return view('purchase-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function materialreceive()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('material-receive')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('material-receive')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('material-receive')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'staff-gudang'){
            return view('material-receive')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'manager-operational'){
            return view('material-receive')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function salesorder()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('sales-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('sales-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('sales-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        }  elseif($login->level == 'accounting'){
            return view('sales-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'marketing'){
            return view('sales-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'manager-marketing'){
            return view('sales-order')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function invoice()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'ceo'){
            return view('invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } elseif($login->level == 'admin'){
            return view('invoice')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
           ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
        
    }
    public function data_bank()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('data-bank')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('data-bank')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  elseif($login->level == 'ceo'){
            return view('data-bank')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function suratjalan()
    {   
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('surat-jalan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('surat-jalan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('surat-jalan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'staff-gudang'){
            return view('surat-jalan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-operational'){
            return view('surat-jalan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function plan_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('planning-mingguan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'marketing'){
            return view('planning-mingguan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('planning-mingguan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('planning-mingguan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } {
            return view ('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function laporan_penjualan()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('laporan-penjualan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('laporan-penjualan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('laporan-penjualan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('laporan-penjualan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('laporan-penjualan')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function stock_gudang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-operasional'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'purchasing'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'staff-gudang'){
            return view('stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function kartu_stock_gudang()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'admin'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-operasional'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'staff-gudang'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'marketing'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('kartu-stock-gudang')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }

    public function kas_masuk()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('kas-masuk')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('kas-masuk')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('kas-masuk')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function kas_keluar()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('kas-keluar')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('kas-keluar')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('kas-keluar')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function jurnal_kas()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('jurnal-kas')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('jurnal-kas')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('jurnal-kas')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function laporan_bukubesar()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('laporan-bukubesar')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('laporan-bukubesar')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('laporan-bukubesar')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function search_jurnal()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('search-jurnal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('search-jurnal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'accounting'){
            return view('search-jurnal')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function database_marketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('database-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('database-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'marketing'){
            return view('database-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('database-marketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    public function aksi_DBmarketing()
    {
        $login = Auth::user();
        $karyawan = karyawan::where('kode',$login->kode_karyawan)->first();
        if($login->level == 'superadmin'){
            return view('aksi-dbmarketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'ceo'){
            return view('aksi-dbmarketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'marketing'){
            return view('aksi-dbmarketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        } elseif($login->level == 'manager-marketing'){
            return view('aksi-dbmarketing')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }  else {
            return view('main')->with([
                'user'=>Auth::user(),
                'detail'=>$karyawan,
            ]);
        }
    }
    
}
