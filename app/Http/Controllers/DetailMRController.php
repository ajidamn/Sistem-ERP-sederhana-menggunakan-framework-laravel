<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\purchaseorder;
use App\Models\detail_po;
use App\Models\detail_mr;
use App\Models\detail_sj;
use App\Models\gudang;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\materialreceive;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;
use Exception;

class DetailMRController extends Controller
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
            $tipe = Str::substr($request->mr, 3, 2);
            if($request->type == 'po'){
                $po = $request->transaksi;
                $PO = purchaseorder::where('kode',$po)->first();
                $po = detail_po::where('kode_po',$request->transaksi)->get();
                foreach ($po as $po) {
                    $kode = detail_mr::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                    $barang = barang::where('kode',$po->kode_brg)->first();
                    $data = new detail_mr();
                    $data->kode = $nkode;
                    $data->kode_mr = $request->mr;
                    $data->kode_brg = $po->kode_brg;
                    $data->kode_gdg = "BB";
                    $data->harga = $po->harga;
                    $data->dikirim = $po->qty;
                    $data->diakui = $po->qty;
                    $data->diterima = $po->qty;
                    $data->dpp = $po->harga*$po->qty;
                    $data->vat = $PO->vat;
                    $data->keterangan = $po->keterangan;
                    $data->created_at = $request->time;
                    $data->total = $po->jumlah;
                    $data->kode_debit = $barang->kd_persediaan;
                    $data->kode_kredit = "300";
                    $data->save();

                    //DEBIT
                    
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->mr.".".$nkode."D";
                    $jurnalD->akun_debit = $barang->kd_persediaan;
                    $jurnalD->akun_kredit = "300";
                    $jurnalD->kode_brg = $po->kode_brg;
                    $jurnalD->nama_brg = $barang->nama;
                    $jurnalD->satuan = $barang->satuan;
                    $jurnalD->kode_gdg = "BB";
                    $jurnalD->nama_gdg = "Balung Bendo";
                    $jurnalD->kode_rekanan = $po->kode_rekanan;
                    $jurnalD->nama_rekanan = $po->nama_rekanan;
                    $jurnalD->keterangan = $po->keterangan;
                    $jurnalD->qty_debit = $po->qty;
                    $jurnalD->harga_debit = $po->harga;
                    $jurnalD->jumlah_debit = $po->jumlah;
                    $jurnalD->vat = $PO->vat;
                    $jurnalD->status = "Belum Diperiksa";
                    $jurnalD->created_at = $request->time;
                    $jurnalD->save();

                    //KREDIT
                    $jurnalK = new jurnal();
                    $jurnalK->kode_transaksi = $request->mr.".".$nkode."K";
                    $jurnalK->akun_debit = "300";
                    $jurnalK->akun_kredit = $barang->kd_persediaan;
                    $jurnalK->kode_brg = $po->kode_brg;
                    $jurnalK->nama_brg = $barang->nama;
                    $jurnalK->satuan = $barang->satuan;
                    $jurnalK->kode_gdg = "BB";
                    $jurnalK->nama_gdg = "Balung Bendo";
                    $jurnalK->kode_rekanan = $po->kode_rekanan;
                    $jurnalK->nama_rekanan = $po->nama_rekanan;
                    $jurnalK->keterangan = $po->keterangan;
                    $jurnalK->qty_kredit = $po->qty;
                    $jurnalK->harga_kredit = $po->harga;
                    $jurnalK->jumlah_kredit = $po->jumlah;
                    $jurnalK->vat = $PO->vat;
                    $jurnalK->status = "Belum Diperiksa";
                    $jurnalK->created_at = $request->time;
                    $jurnalK->save();

                    $log = new log_sistem();
                    $log->transaksi = $request->mr.".".$nkode;
                    $log->user = $request->user;
                    $log->keterangan = "Tambah Data Detail MR";
                    $log->save();
                }
                return response()->json(['success'=>true, 'pesan'=> 'Ubah Gudang Penerima dan Jumlah Barang yang diterima sesuai dengan kondisi di lapangan']);
            } elseif($request->type == 'sj'){
                if($tipe == 43){
                    $kode = detail_mr::orderBy('kode','desc')->first();
                    if($kode == null){
                        $nkode = 1;
                    } else {
                        $nkode = $kode->kode + 1 ;
                    }
                    $data = new detail_mr();
                    $data->kode = $nkode;
                    $data->kode_mr = $request->mr;
                    $data->kode_brg = $request->barang;
                    $data->kode_gdg = $request->gudang;
                    $data->harga = $request->harga;
                    $data->dikirim = $request->qty;
                    $data->diakui = $request->diakui;
                    $data->diterima = $request->diterima;
                    $data->dpp = $request->dpp;
                    $data->vat = 0;
                    $data->total = $request->dpp;
                    $data->keterangan = $request->keterangan;
                    $data->kode_debit = $request->debit;
                    $data->kode_kredit = $request->kredit;
                    $data->save();

                    $gudang = gudang::where('kode',$request->gudang)->first();
                    $barang = barang::where('kode',$request->barang)->first();
                    //DEBIT
                    $jurnalD = new jurnal();
                    $jurnalD->kode_transaksi = $request->mr.".".$nkode."D";
                    $jurnalD->akun_debit = $request->debit;
                    $jurnalD->akun_kredit = $request->kredit;
                    $jurnalD->kode_brg = $request->barang;
                    $jurnalD->nama_brg = $barang->nama;
                    $jurnalD->satuan = $barang->satuan;
                    $jurnalD->kode_gdg = $request->gudang;
                    $jurnalD->nama_gdg = $gudang->nama;
                    $jurnalD->keterangan = $request->keterangan;
                    $jurnalD->qty_debit = $request->qty;
                    $jurnalD->harga_debit = $request->harga;
                    $jurnalD->jumlah_debit = $request->dpp;
                    $jurnalD->vat = 0;
                    $jurnalD->status = "Belum Diperiksa";
                    $jurnalD->save();

                    //KREDIT
                    $jurnalK = new jurnal();
                    $jurnalK->kode_transaksi = $request->mr.".".$nkode."K";
                    $jurnalK->akun_debit = $request->kredit;
                    $jurnalK->akun_kredit = $request->debit;
                    $jurnalK->kode_brg = $request->barang;
                    $jurnalK->nama_brg = $barang->nama;
                    $jurnalK->satuan = $barang->satuan;
                    $jurnalK->kode_gdg = $request->gudang;
                    $jurnalK->nama_gdg = $gudang->nama;
                    $jurnalK->keterangan = $request->keterangan;
                    $jurnalK->qty_kredit = $request->qty;
                    $jurnalK->harga_kredit = $request->harga;
                    $jurnalK->jumlah_kredit = $request->dpp;
                    $jurnalK->vat = 0;
                    $jurnalK->status = "Belum Diperiksa";
                    $jurnalK->save();

                    $log = new log_sistem();
                    $log->transaksi = $request->mr.".".$nkode;
                    $log->user = $request->user;
                    $log->keterangan = "Tambah Data Detail MR";
                    $log->save();

                } elseif($tipe == 44){
                    $sj = detail_sj::where('kode_sj', $request->transaksi)->get();
                    foreach($sj as $sj){
                        $kode = detail_mr::orderBy('kode','desc')->first();
                        if($kode == null){
                            $nkode = 1;
                        } else {
                            $nkode = $kode->kode + 1 ;
                        }
                        $data = new detail_mr();
                        $data->kode = $nkode;
                        $data->kode_mr = $request->mr;
                        $data->kode_brg = $sj->kode_brg;
                        $data->kode_gdg = $sj->kode_gdg;
                        $data->harga = 0;
                        $data->dikirim = $sj->qty;
                        $data->diakui = $sj->qty;
                        $data->diterima = $sj->qty;
                        $data->dpp = 0;
                        $data->vat = 0;
                        $data->total = 0;
                        $data->keterangan = $sj->keterangan;
                        $data->kode_debit = $sj->debit;
                        $data->kode_kredit = $sj->kredit;
                        $data->save();

                        //log
                        $log = new log_sistem();
                        $log->transaksi = $request->mr.".".$nkode;
                        $log->user = $request->user;
                        $log->keterangan = "Tambah Data Detail MR";
                        $log->save();
                        //endlog

                        $gudang = gudang::where('kode',$sj->kode_gdg)->first();
                        $barang = barang::where('kode',$sj->kode_brg)->first();
                        //DEBIT
                        $jurnalD = new jurnal();
                        $jurnalD->kode_transaksi = $request->mr.".".$nkode."D";
                        $jurnalD->akun_debit = $sj->debit;
                        $jurnalD->akun_kredit = $sj->kredit;
                        $jurnalD->kode_brg = $sj->kode_brg;
                        $jurnalD->nama_brg = $barang->nama;
                        $jurnalD->satuan = $barang->satuan;
                        $jurnalD->kode_gdg = $sj->kode_gdg;
                        $jurnalD->nama_gdg = $gudang->nama;
                        $jurnalD->keterangan = $sj->keterangan;
                        $jurnalD->qty_debit = $sj->qty;
                        $jurnalD->harga_debit = 0;
                        $jurnalD->jumlah_debit = 0;
                        $jurnalD->vat = 0;
                        $jurnalD->status = "Belum Diperiksa";
                        $jurnalD->save();

                        //KREDIT
                        $jurnalK = new jurnal();
                        $jurnalK->kode_transaksi = $request->mr.".".$nkode."K";
                        $jurnalK->akun_debit = $sj->kredit;
                        $jurnalK->akun_kredit = $sj->debit;
                        $jurnalK->kode_brg = $sj->kode_brg;
                        $jurnalK->nama_brg = $barang->nama;
                        $jurnalK->satuan = $barang->satuan;
                        $jurnalK->kode_gdg = $sj->kode_gdg;
                        $jurnalK->nama_gdg = $gudang->nama;
                        $jurnalK->keterangan = $sj->keterangan;
                        $jurnalK->qty_kredit = $sj->qty;
                        $jurnalK->harga_kredit = 0;
                        $jurnalK->jumlah_kredit = 0;
                        $jurnalK->vat = 0;
                        $jurnalK->status = "Belum Diperiksa";
                        $jurnalK->save();
                    }
                }
                
                return response()->json(['success'=> true, 'pesan'=> 'Data berhasil Ditambahkan']);
            }
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]) ;
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mr)
    {
        //
        try{
            $detail = detail_mr::
                select('detail_mr.*', 'barang.nama as barang','barang.satuan','gudang.nama as gudang' )
                ->join('barang','detail_mr.kode_brg','=','barang.kode')
                ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                ->where('detail_mr.kode_mr', $mr )->get();
            foreach($detail as $A){
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$A->kode_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$A->kode_kredit)->first();
                $A->nama_debit = $debit->nama_perkiraan;
                $A->nama_kredit = $kredit->nama_perkiraan;
            }
            // foreach ($detail as $detail) {
            //     $dpp = $detail['dpp'];
            //     $vat = $detail['vat'];
            //     $detail['VAT'] = ($dpp*$vat)/100;
            // }
        return response()->json(['success'=>true ,'data' => $detail]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        

    }
    public function dropdownbarang(Request $request,$gudang)
    {
        $barang = [];
        if($request->has('q')){
            $search = $request->q;
            $barang = DB::table('detail_mr')
                    -> select ('detail_mr.kode_brg','barang.nama')
                    -> join ('barang','detail_mr.kode_brg','=','barang.kode')
                    -> join ('materialreceive','detail_mr.kode_mr','=','materialreceive.kode')
                    -> where('materialreceive.status','Selesai')
                    -> where('detail_mr.kode_gdg',$gudang)
                    -> where ('barang.nama','LIKE',"%$search")
                    -> distinct()->get();
            
        } else {
            $barang = DB::table('detail_mr')
                -> select ('detail_mr.kode_brg as kode','barang.nama')
                -> join ('barang','detail_mr.kode_brg','=','barang.kode')
                -> join ('materialreceive','detail_mr.kode_mr','=','materialreceive.kode')
                -> where('materialreceive.status','Selesai')
                -> where('detail_mr.kode_gdg',$gudang)
                -> distinct()->get();
        }
        return response()->json($barang);
    }
    public function gudangso(Request $request, $kode)
    {
        $gdg = [];
        if($request->has('q')){
            $search = $request->q;
            $gdg = $gdg = detail_mr::select('detail_mr.kode_gdg','gudang.nama')
                ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                ->where('detail_mr.kode_brg',$kode)
                ->where('gudang.nama', 'LIKE', "%$search%")
                ->distinct()->get();
        } else {
            $gdg = detail_mr::select('detail_mr.kode_gdg as kode','gudang.nama')
                ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                ->where('detail_mr.kode_brg',$kode)->distinct()->get();
           
            
        }
        return response()->json($gdg);
    }
    public function stockbarang(Request $request ,$kode)
    {

        try {
            // Validate the value...
            $masuk = jurnal::select(DB::raw('SUM(qty_debit) as qty'))
                    ->where('kode_transaksi','LIKE',"MR%")
                    ->where('kode_gdg',$kode)
                    ->where('kode_brg',$request->barang)
                    ->where('status','Selesai')->first();
            $keluar = jurnal::select(DB::raw('SUM(qty_debit)as qty'))
                    ->where('kode_transaksi','LIKE',"SJ%")
                    ->where('kode_gdg',$kode)
                    ->where('kode_brg',$request->barang)
                    ->where('status','Selesai')->first();
            
            if($masuk->qty == null){
                $qty= 0;
            } else {
                $qty = $masuk->qty - $keluar->qty;
            }
            return response()->json(['success'=>true,'data'=>$qty]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //
        try {
            $detail = detail_mr::
                    select('detail_mr.*', 'barang.nama as barang','barang.satuan','gudang.nama as gudang' )
                    ->join('barang','detail_mr.kode_brg','=','barang.kode')
                    ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                    ->where('detail_mr.kode', $kode )->first();
            $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$detail->kode_debit)->first();
            $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$detail->kode_kredit)->first();
            $detail['nama_debit'] = $debit->nama_perkiraan;
            $detail['nama_kredit'] = $kredit->nama_perkiraan;
            return response()->json(['success'=>true,'data'=>$detail]);
        } catch (\Exception $e){
            return response()->json(['success'=>false, 'pesan'=>$e->getMessage()]);
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

        try{
            $data = detail_mr::where('kode',$kode)->first();
            $data->kode_gdg = $request->gudang;
            $data->diakui = $request->diakui;
            $data->diterima = $request->diterima;
            $data->dpp = $request->dpp;
            $data->keterangan = $request->keterangan;
            $vat = $data['vat'];
            $dpp =  $request->dpp;
            $VAT = ($dpp*$vat)/100;
            $total = $dpp+$VAT;
            $data->total = $total;

            //log
            $log = new log_sistem();
            $log->transaksi = $data->kode_mr.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail MR";
            $log->save();

            DB::table('detail_mr')
            ->where('kode', $kode)
            ->update([
                'kode_gdg' =>$data->kode_gdg,
                'diakui' => $data->diakui,
                'diterima' => $data->diterima,
                'dpp' => $data->dpp,
                'total' => $data->total,
                'keterangan' => $data->keterangan,
                'kode_debit' => $request->debit,
                'kode_kredit' => $request->kredit,
            ]);
            $gudang  = gudang::where('kode',$request->gudang)->first();
            //DEBIT
            DB::table('jurnal')
            ->where('kode_transaksi',$data->kode_mr.".".$kode."D")
            ->update([
                'kode_gdg'=>$data->kode_gdg,
                'nama_gdg'=>$gudang->nama,
                'qty_debit'=>$data->diakui,
                'jumlah_debit'=>$data->total,
                'keterangan'=>$data->keterangan,
                'akun_debit' => $request->debit,
                'akun_kredit' => $request->kredit,
            ]);
            //KREDIT
            DB::table('jurnal')
            ->where('kode_transaksi',$data->kode_mr.".".$kode."K")
            ->update([
                'kode_gdg'=>$data->kode_gdg,
                'nama_gdg'=>$gudang->nama,
                'qty_kredit'=>$data->diakui,
                'jumlah_kredit'=>$data->total,
                'keterangan'=>$data->keterangan,
                'akun_debit' => $request->kredit,
                'akun_kredit' => $request->debit,
            ]);
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false , 'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hpsdetailmr(Request $request,$kode){
        
        
        try {
            // Validate the value...
            DB::table('detail_mr')
            ->where('kode_mr',$kode)
            ->delete();
            jurnal::where('kode_transaksi','LIKE',"$kode%")
            ->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail MR";
            $log->save();
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch (Exception $e) {
            return response()->json(['success'=> false ,'pesan'=> $e->getMessage()]);
        }
    }
    public function destroy(Request $request,$kode)
    {
        //
        try{
            $data = detail_mr::where('kode',$kode)->first();
            jurnal::where('kode_transaksi','LIKE',"$data->kode_mr.".".$kode%")->delete();
            detail_mr::where('kode',$kode)->delete();
            //log
            $log = new log_sistem();
            $log->transaksi = $data->kode_mr.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail MR";
            $log->save();
            return response()->json(['success'=> true, 'pesan' => 'Data Berhasil Dihapus']);
        } catch (Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
