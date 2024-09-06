<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Models\detail_invoice;
use App\Models\detail_sj;
use App\Models\detail_so;
use App\Models\gudang;
use App\Models\suratjalan;
use App\Models\invoice;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\salesorder;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;
use Throwable;

class DetailInvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $kode = detail_sj::orderBy('kode','desc')->first();
            if($kode == null){
                $nkode_sj = 1;
            } else {
                $nkode_sj = $kode->kode + 1 ;
            }
            $kode = detail_invoice::orderBy('kode','desc')->first();
            if($kode == null){
                $nkode = 1;
            } else {
                $nkode = $kode->kode + 1 ;
            }
            $barang = barang::where('kode',$request->barang)->first();
            $SO = salesorder::select('salesorder.*','rekanan.nama','karyawan.nama as mrkting')
                    ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->where('salesorder.kode',$request->so)->first();
            $gudang = gudang::where('kode',$request->gudang)->first();
            //Detail Invoice
            $detail = new detail_invoice();
            $detail->kode = $nkode;
            $detail->kode_inv = $request->inv;
            $detail->tgl_kirim = $request->tanggal;
            $detail->tgl_terima = $request->tanggal;
            $detail->kode_gdg = $request->gudang;
            $detail->kode_brg = $request->barang;
            $detail->diakui     = $request->diakui;
            $detail->dikirim    = $request->dikirim;
            $detail->diterima    = $request->diterima;
            $detail->nama_request = $request->nama_req;
            $detail->harga_jual = $request->harga;
            $total = $request->harga*$request->diakui;
            $detail->dpp        = $total;
            $VAT = ($detail->dpp*$request->vat)/100;
            $detail->jumlah     = $detail->dpp + $VAT;
            $detail->keterangan = $request->keterangan;
            $detail->debit      = $request->debit;
            $detail->kredit     = $request->kredit;

            $log = new log_sistem();
            $log->transaksi = $nkode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Detail INV";
            $log->save();
            
            
            $detail->save();
            
            
            //Jurnal DEBIT
            $jurnalD = new jurnal();
            $jurnalD->kode_transaksi = $request->inv.".".$nkode."D";
            $jurnalD->akun_debit         = $request->debit;
            $jurnalD->akun_kredit        = $request->kredit;
            $jurnalD->kode_brg           = $request->barang;
            $jurnalD->nama_brg           = $barang->nama;
            $jurnalD->nama_request       = $request->nama_req;
            $jurnalD->kode_gdg           = $request->gudang;
            $jurnalD->nama_gdg           = $gudang->nama;
            $jurnalD->kode_marketing     = $SO->marketing;
            $jurnalD->nama_marketing     = $SO->mrkting;
            $jurnalD->kode_rekanan       = $SO->konsumen;
            $jurnalD->nama_rekanan       = $SO->nama;
            $jurnalD->qty_debit          = $request->diakui;
            $jurnalD->harga_debit        = $request->harga;
            $jurnalD->jumlah_debit       = $detail->dpp + $VAT;
            $jurnalD->satuan             = $barang->satuan;
            $jurnalD->vat                = $request->vat;
            $jurnalD->keterangan         = $request->keterangan;
            $jurnalD->status             = "Belum Diperiksa";

            $jurnalD->save();

            //Jurnal KREDIT
            $jurnalK = new jurnal();
            $jurnalK->kode_transaksi = $request->inv.".".$nkode."K";
            $jurnalK->akun_debit         = $request->kredit;
            $jurnalK->akun_kredit        = $request->debit;
            $jurnalK->kode_brg           = $request->barang;
            $jurnalK->nama_brg           = $barang->nama;
            $jurnalK->nama_request       = $request->nama_req;
            $jurnalK->kode_gdg           = $request->kode_gdg;
            $jurnalK->nama_gdg           = $gudang->nama;
            $jurnalK->kode_marketing     = $SO->marketing;
            $jurnalK->nama_marketing     = $SO->mrkting;
            $jurnalK->kode_rekanan       = $SO->konsumen;
            $jurnalK->nama_rekanan       = $SO->nama;
            $jurnalK->qty_kredit         = $request->diakui;
            $jurnalK->harga_kredit       = $request->harga;
            $jurnalK->jumlah_kredit      = $detail->dpp + $VAT;
            $jurnalK->satuan             = $barang->satuan;
            $jurnalK->vat                = $request->vat;
            $jurnalK->keterangan         = $request->keterangan;
            $jurnalK->status             = "Belum Diperiksa";

            $jurnalK->save();

            //DETAIL SJ

            $data = new detail_sj();
            $data->kode = $nkode_sj;
            $data->kode_sj = $request->sj;
            $data->kode_brg = $request->barang;
            $data->kode_gdg = $request->gudang;
            $data->nama_request = $request->nama;
            $data->qty = $request->diakui;
            $data->keterangan = $request->keterangan;
            $data->debit = '410';
            $data->kredit = $barang->kd_persediaan;
            $data->save();

            $log = new log_sistem();
            $log->transaksi = $nkode_sj;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Detail SJ";
            $log->save();

            

            $jurnalD = new jurnal();
            $jurnalD->kode_transaksi = $request->sj.".".$nkode."D";
            $jurnalD->akun_debit     = '410';
            $jurnalD->akun_kredit    = $barang->kd_persediaan;
            $jurnalD->kode_brg           = $request->barang;
            $jurnalD->nama_brg           = $barang->nama;
            $jurnalD->nama_request       = $request->nama_req;
            $jurnalD->kode_gdg           = $request->gudang;
            $jurnalD->nama_gdg           = $gudang->nama;
            $jurnalD->kode_marketing     = $SO->marketing;
            $jurnalD->nama_marketing     = $SO->mrkting;
            $jurnalD->kode_rekanan       = $SO->konsumen;
            $jurnalD->nama_rekanan       = $SO->nama;
            $jurnalD->qty_debit          = $request->diakui;
            $jurnalD->harga_debit        = $request->hpp;
            $jurnalD->jumlah_debit       = $request->hpp*$request->diakui;
            $jurnalD->satuan             = $barang->satuan;
            $jurnalD->vat                = $request->vat;
            $jurnalD->keterangan         = $request->keterangan;
            $jurnalD->status             = "Belum Diperiksa";
            $jurnalD->save();

            //KREDIT
            $jurnalK= new jurnal();
            $jurnalK->kode_transaksi = $request->sj.".".$nkode."K";
            $jurnalK->akun_debit         = $barang->kd_persediaan;
            $jurnalK->akun_kredit        = '410';
            $jurnalK->kode_brg           = $request->barang;
            $jurnalK->nama_brg           = $barang->nama;
            $jurnalK->nama_request       = $request->nama_req;
            $jurnalK->kode_gdg           = $request->gudang;
            $jurnalK->nama_gdg           = $gudang->nama;
            $jurnalK->kode_marketing     = $SO->marketing;
            $jurnalK->nama_marketing     = $SO->mrkting;
            $jurnalK->kode_rekanan       = $SO->konsumen;
            $jurnalK->nama_rekanan       = $SO->nama;
            $jurnalK->qty_kredit         = $request->diakui;
            $jurnalK->harga_kredit       = $request->hpp;
            $jurnalK->jumlah_kredit      = $request->hpp*$request->diakui;
            $jurnalK->satuan             = $barang->satuan;
            $jurnalK->vat                = $request->vat;
            $jurnalK->keterangan         = $request->keterangan;
            $jurnalK->status             = "Belum Diperiksa";
            $jurnalK->save();



            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']);

            
            
        }catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]) ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dropdownbaranginv (Request $request,$kode)
    {
            if($request->has('q')){
                $search = $request->q;
                $data = detail_invoice::select('detail_invoice.kode_brg','barang.nama as nama')
                        ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                        ->where('detail_invoice.kode_inv',$kode)
                        ->where('barang.nama','LIKE',"%$search")
                        ->get();
                
            } else {
                $data = detail_invoice::select('detail_invoice.kode_brg','barang.nama as nama')
                        ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                        ->where('detail_invoice.kode_inv',$kode)
                        ->get();
                
            }
            return response()->json($data);
    }
    public function databarang_detail(Request $request, $kode)
    {
        try{   
            $data = detail_invoice::select('detail_invoice.*','barang.satuan as satuan')
                    ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                    ->where('detail_invoice.kode_inv',$kode)
                    ->where('detail_invoice.kode_brg',$request->barang)
                    ->first();
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data->nama_debit = $debit->nama_perkiraan;
            $data->nama_kredit = $kredit->nama_perkiraan;
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function show($kode)
    {
        //
        try{
            $data = detail_invoice::select('detail_invoice.*','gudang.nama as gudang','barang.nama as barang','barang.satuan')
                ->join('gudang', 'detail_invoice.kode_gdg','=','gudang.kode')
                ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                ->where('detail_invoice.kode_inv',$kode)->get();
            foreach($data as $detail) {
                $debit = kode_akuntansi::where('kode',$detail->debit)->first();
                $kredit = kode_akuntansi::where('kode',$detail->kredit)->first();
                $detail->nama_debit = $debit->nama_perkiraan;
                $detail->nama_kredit = $kredit->nama_perkiraan;
            }
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $kode)
    {
        //
        try{
            $data = detail_invoice::select('detail_invoice.*','barang.nama', 'barang.satuan', 'gudang.nama as gudang')
                ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                ->join('gudang','detail_invoice.kode_gdg','=','gudang.kode')
                ->where('detail_invoice.kode',$kode)->first();
            
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data->nama_debit = $debit->nama_perkiraan;
            $data->nama_kredit = $kredit->nama_perkiraan;


            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        //
        try {
            // Validate the value...
            $data = detail_invoice::where('kode',$kode)->first();
            $dpp = $request->diakui*$data->harga_jual;
            $VAT = ($dpp*$request->vat)/100;
            $total = $dpp+$VAT;
    
            DB::table('detail_invoice')
            ->where('kode', $kode)
            ->update([
                'nama_request' => $request->nama_req,
                'diakui'=> $request->diakui,
                'dikirim' => $request->dikirim,
                'diterima' => $request->diterima,
                'dpp' => $dpp, 
                'jumlah' => $total, 
                'debit' => $request->debit, 
                'kredit' => $request->kredit,
                'keterangan' => $request->keterangan,
            ]);
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail INV";
            $log->save();
            //DEBIT
            DB::table('jurnal')
            ->where('kode_transaksi', $data->kode_inv.".".$kode."D")
            ->update([
                'nama_request' => $request->nama_req,
                'qty_debit' => $request->diakui,
                'jumlah_debit' => $total,
                'akun_debit'=> $request->debit, 
                'akun_kredit'=> $request->kredit,
                'keterangan' => $request->keterangan,
            ]);

            DB::table('jurnal')
            ->where('kode_transaksi', $data->kode_inv.".".$kode."K")
            ->update([
                'nama_request' => $request->nama_req,
                'qty_kredit' => $request->diakui,
                'jumlah_kredit' => $total,
                'akun_debit'=> $request->kredit, 
                'akun_kredit'=> $request->debit,
                'keterangan' => $request->keterangan,
            ]);

            // DETAIL SJ

            $SJ = detail_sj::where('kode',$request->kodesj)->first();
            DB::table('detail_sj')
            ->where('kode',$request->kodesj)
            ->update([
                'nama_request' => $request->nama_req,
                'qty'          => $request->dikirim,
                'keterangan' => $request->keterangan,
            ]);
            //log
            $log = new log_sistem();
            $log->transaksi = $request->kodesj;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail SJ";
            $log->save();

            $total = $request->hpp*$request->dikirim;
            //JURNAL SJ
            DB::table('jurnal')
            ->where('kode_transaksi', $SJ->kode_sj.".".$request->kodesj."D")
            ->update([
                'nama_request' => $request->nama_req,
                'qty_debit' => $request->dikirim,
                'jumlah_debit' => $total,
                'keterangan' => $request->keterangan,
            ]);

            DB::table('jurnal')
            ->where('kode_transaksi', $SJ->kode_sj.".".$request->kodesj."K")
            ->update([
                'nama_request' => $request->nama_req,
                'qty_kredit' => $request->dikirim,
                'jumlah_kredit' => $total,
                'keterangan' => $request->keterangan,
            ]);

            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch (Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hpsdetailinv(Request $request,$kode)
    {
        try {
            // Validate the value...
            
            DB::table('detail_invoice')
            ->where('kode_inv',$kode)
            ->delete();
            DB::table('jurnal')
            ->where('kode_transaksi','LIKE',"$kode%")
            ->delete();

            DB::table('detail_sj')
            ->where('kode_sj',$request->sj)
            ->delete();
            DB::table('jurnal')
            ->where('kode_transaksi','LIKE',"$request->sj%")
            ->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy(Request $request,$kode)
    {
        //
        try {
            $data = detail_invoice::where('kode',$kode)->first();
            detail_invoice::where('kode',$kode)->delete();
            $jurnal = $data->kode_inv.".".$kode;
            jurnal::where('kode_transaksi','LIKE',"$jurnal%")->delete();

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail INV";
            $log->save();

            $data = detail_sj::where('kode',$request->kodesj)->first();
            detail_sj::where('kode',$request->kodesj)->delete();
            $jurnal = $data->kode_sj.".".$kode;
            jurnal ::where('kode_transaksi','LIKE',"$jurnal%")->delete();
            
            $log = new log_sistem();
            $log->transaksi = $request->kodesj;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail SJ";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
