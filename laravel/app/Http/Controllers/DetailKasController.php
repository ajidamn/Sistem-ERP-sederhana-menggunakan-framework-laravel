<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_invoice;
use App\Models\detail_kas;
use App\Models\gudang;
use App\Models\invoice;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\rekanan;
use App\Models\salesorder;
use App\Models\suratjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailKasController extends Controller
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
        try{
            if($request->kredit == 12){
                //last kode
                    $kode = detail_kas::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                //Detail
                    $detail = new detail_kas();
                    $detail->kode = $nkode;
                    $detail->kode_kas = $request->kode_kas;
                    $detail->kode_transaksi = $request->transaksi;
                    $detail->kode_brg = $request->barang;
                    $detail->vat = $request->vat;
                    $detail->harga = $request->harga;
                    $detail->qty = $request->qty;
                    $total = $request->harga * $request->qty;
                    $VAT = ($total*$request->vat)/100;
                    $TOTAL = $total+$VAT;
                    $detail->total = $TOTAL;
                    $detail->keterangan = $request->keterangan;
                    $detail->debit = $request->debit;
                    $detail->kredit = $request->kredit;
                    $detail->save();

                //Log System
                    $log = new log_sistem();
                    $log->transaksi = $request->kode_kas.".".$nkode;
                    $log->user = $request->user;
                    $log->keterangan = "Tambah Data Detail Kas";
                    $log->save();

                //Jurnal Debit
                    $detailinv = detail_invoice::where('kode_inv',$request->transaksi)->first();
                    $inv = invoice::where('kode',$request->transaksi)->first();
                    $so = salesorder::where('kode',$inv->kode_so)->first();
                    $rekanan = rekanan::where('kode',$so->konsumen)->first();
                    $barang = barang::where('kode',$request->barang)->first();
                    $gudang = gudang::where('kode',$detailinv->kode_gdg)->first();
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->kode_kas.".".$nkode."D";
                    $jurnalD->akun_debit = $request->debit;
                    $jurnalD->akun_kredit = $request->kredit;
                    $jurnalD->kode_brg = $request->barang;
                    $jurnalD->nama_brg = $barang->nama;
                    $jurnalD->nama_request = $detailinv->nama_request;
                    $jurnalD->satuan = $barang->satuan;
                    $jurnalD->kode_gdg = $detailinv->kode_gdg;
                    $jurnalD->nama_gdg = $gudang->nama;
                    $jurnalD->kode_rekanan = $so->konsumen;
                    $jurnalD->nama_rekanan = $rekanan->nama;
                    $jurnalD->keterangan = $request->keterangan;
                    $jurnalD->qty_debit = $request->qty;
                    $jurnalD->harga_debit = $request->harga;
                    $jurnalD->jumlah_debit = $TOTAL;
                    $jurnalD->vat = $request->vat;
                    $jurnalD->status = "Belum Diperiksa";
                    $jurnalD->save();
                //Jurnal Kredit
                    $jurnalK = new jurnal();
                    $jurnalK->kode_transaksi = $request->kode_kas.".".$nkode."K";
                    $jurnalK->akun_debit = $request->kredit;
                    $jurnalK->akun_kredit = $request->debit;
                    $jurnalK->kode_brg = $request->barang;
                    $jurnalK->nama_brg = $barang->nama;
                    $jurnalD->nama_request = $detailinv->nama_request;
                    $jurnalK->satuan = $barang->satuan;
                    $jurnalK->kode_gdg = $detailinv->kode_gdg;
                    $jurnalK->nama_gdg = $gudang->nama;
                    $jurnalK->kode_rekanan = $so->konsumen;
                    $jurnalK->nama_rekanan = $rekanan->nama;
                    $jurnalK->keterangan = $request->keterangan;
                    $jurnalK->qty_kredit = $request->qty;
                    $jurnalK->harga_kredit = $request->harga;
                    $jurnalK->jumlah_kredit = $TOTAL;
                    $jurnalK->vat = $request->vat;
                    $jurnalK->status = "Belum Diperiksa";
                    $jurnalK->save();

                
            } else {
                //last kode
                    $kode = detail_kas::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                //Detail
                    $detail = new detail_kas();
                    $detail->kode = $nkode;
                    $detail->kode_kas = $request->kode_kas;
                    $detail->vat = $request->vat;
                    $detail->harga = $request->harga;
                    $detail->qty = $request->qty;
                    $total = $request->harga * $request->qty;
                    $VAT = ($total*$request->vat)/100;
                    $TOTAL = $total+$VAT;
                    $detail->total = $TOTAL;
                    $detail->keterangan = $request->keterangan;
                    $detail->debit = $request->debit;
                    $detail->kredit = $request->kredit;
                    $detail->save();
                //Log System
                    $log = new log_sistem();
                    $log->transaksi = $request->kode_kas.".".$nkode;
                    $log->user = $request->user;
                    $log->keterangan = "Tambah Data Detail Kas";
                    $log->save();

                //Jurnal Debit
                    
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->kode_kas.".".$nkode."D";
                    $jurnalD->akun_debit = $request->debit;
                    $jurnalD->akun_kredit = $request->kredit;
                    $jurnalD->keterangan = $request->keterangan;
                    $jurnalD->qty_debit = $request->qty;
                    $jurnalD->harga_debit = $request->harga;
                    $jurnalD->jumlah_debit = $TOTAL;
                    $jurnalD->vat = $request->vat;
                    $jurnalD->status = "Belum Diperiksa";
                    $jurnalD->save();
                //Jurnal Kredit
                    $jurnalK = new jurnal();
                    $jurnalK->kode_transaksi = $request->kode_kas.".".$nkode."K";
                    $jurnalK->akun_debit = $request->kredit;
                    $jurnalK->akun_kredit = $request->debit;
                    $jurnalK->keterangan = $request->keterangan;
                    $jurnalK->qty_kredit = $request->qty;
                    $jurnalK->harga_kredit = $request->harga;
                    $jurnalK->jumlah_kredit = $TOTAL;
                    $jurnalK->vat = $request->vat;
                    $jurnalK->status = "Belum Diperiksa";
                    $jurnalK->save();
            }
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Ditambahkan']);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $data = detail_kas::select('detail_kas.*','barang.nama','barang.satuan')
                    ->leftJoin('barang','detail_kas.kode_brg','barang.kode')
                    ->where('detail_kas.kode_kas',$id)->get();
            foreach($data AS $D){
                $debit = kode_akuntansi::where('kode',$D->debit)->first();
                $kredit = kode_akuntansi::where('kode',$D->kredit)->first();
                $D->nama_debit = $debit->nama_perkiraan;
                $D->nama_kredit = $kredit->nama_perkiraan;
                $D->VAT = (($D->harga*$D->qty)*$D->vat)/100;
            }
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try{
            $data = detail_kas::select('detail_kas.*','barang.nama','barang.satuan')
                    ->leftJoin('barang','detail_kas.kode_brg','=','barang.kode')
                    ->where('detail_kas.kode',$id)->first();
            $debit = kode_akuntansi::where('kode',$data->debit)->first();
            $kredit = kode_akuntansi::where('kode',$data->kredit)->first();
            $data->nama_debit= $debit->nama_perkiraan;
            $data->nama_kredit = $kredit->nama_perkiraan;
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $data = detail_kas::where('kode',$id)->first();
            $total = $request->harga*$request->qty;
            $VAT = ($total*$data->vat)/100;
            $TOTAL = $total+$VAT;
            $barang = barang::where('kode',$request->barang)->first();

            //DETAIL
            DB::table('detail_kas')->where('kode',$id)
            ->update([
                'kode_transaksi'=> $request->transaksi,
                'qty'           => $request->qty,
                'harga'         => $request->harga,
                'total'         => $TOTAL,
                'kode_brg'      => $request->barang,
                'keterangan'    => $request->keterangan,
            ]);
            //LOG
            $log = new log_sistem();
            $log->transaksi = $data->kode_kas.".".$id;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail Kas";
            $log->save();
            //Jurnal
            DB::table('jurnal')->where('kode_transaksi',$data->kode_kas.".".$id."D")
            ->update([
                'kode_brg'      => $request->barang,
                'nama_brg'      => $barang->nama,
                'keterangan'    => $request->keterangan,
                'qty_debit'     => $request->qty,
                'harga_debit'   => $request->harga,
                'jumlah_debit'  => $TOTAL,

            ]); 
            DB::table('jurnal')->where('kode_transaksi',$data->kode_kas.".".$id."K")
            ->update([
                'kode_brg'      => $request->barang,
                'nama_brg'      => $barang->nama,
                'keterangan'    => $request->keterangan,
                'qty_kredit'     => $request->qty,
                'harga_kredit'   => $request->harga,
                'jumlah_kredit'  => $TOTAL,

            ]); 

            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapuskas($kode)
    {
        try{
            jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
            detail_kas::where('kode_kas',$kode)->delete();

            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Dihapus"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function destroy(Request $request,$id)
    {
        //
        try{
            $data = detail_kas::where('kode',$id)->first();
            $kode = $data->kode_kas.".".$id;
            jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail Kas";
            $log->save();
            detail_kas::where('kode',$id)->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
