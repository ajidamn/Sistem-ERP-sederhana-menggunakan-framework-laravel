<?php

namespace App\Http\Controllers;
use App\Models\detail_po;
use App\Models\barang;
use App\Models\jurnal;
use App\Models\kode_akuntansi;
use App\Models\log_sistem;
use App\Models\purchaseorder;
use App\Models\rekanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class DetailPOController extends Controller
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

            $kode = detail_po::orderBy('kode','desc')->first();
            if($kode == null){
                $nkode = 1;
            } else {
                $nkode = $kode->kode + 1 ;
            }
            $detail = new detail_po();
            $detail->kode = $nkode;
            $detail->kode_po = $request->po;
            $detail->kode_brg = $request->kode;
            $detail->harga = $request->harga;
            $detail->qty = $request->qty;
            
            $harga = $request->harga;
            $qty = $request->qty;
            $jumlah = $harga*$qty;

            $vat = ($jumlah*$request->vat)/100;
            $jumlah = $jumlah + $vat;
            
            $detail->jumlah = $jumlah;
            $detail->keterangan = $request->keterangan;
            $detail->save();

            $log = new log_sistem();
            $log->transaksi = $request->po.".".$nkode;
            $log->user = $request->user;
            $log->keterangan = "Tambah Data Detail PO";
            $log->save();
            

            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch(\Exception $e){
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
            // $jurnal = jurnal::where('kode_transaksi',$id)->get();
            // foreach($jurnal as $jurnal){
            //     $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_debit)->first();
            //     $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_kredit)->first();
            //     $jurnal->nama_debit = $debit->nama_perkiraan;
            //     $jurnal->nama_kredit = $kredit->nama_perkiraan;
            //     $dat[] = $jurnal;
            // }
            $data = detail_po::select('detail_po.*', 'barang.nama', 'barang.satuan')
            ->join('barang','detail_po.kode_brg','=','barang.kode')
            ->where('detail_po.kode_po',$id)->get();
           

            
            return response()->json(['success'=> true,'data'=>$data]);
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
    public function edit($kode)
    {
        //
        try{
            $data = detail_po::where('kode',$kode)->first();
            $barang = barang::select('nama','satuan')->where('kode',$data->kode_brg)->first();
            $data->nama = $barang->nama;
            $data->satuan = $barang->satuan;
            return response()->json(['success'=>true,'result'=> $data]);
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
    public function update(Request $request, $kode)
    {
        //
        try{
            $data = detail_po::where('kode',$kode)->first();
            $data->qty = $request->qty;
            $data->harga = $request->harga;
            $data->keterangan = $request->keterangan;

            $harga = $request->harga;
            $qty = $request->qty;            
            $jumlah = $harga*$qty;

            $data->jumlah = $jumlah;
            $transaksi = $data->kode_po.".".$kode;
            DB::table('detail_po')
            ->where('kode', $kode)
            ->update([
                'qty'       =>$data->qty, 
                'harga'     => $data->harga,
                'jumlah'    => $data->jumlah,
                'keterangan' => $data->keterangan,
            ]);
            $log = new log_sistem();
            $log->transaksi = $transaksi;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Detail PO";
            $log->save();

            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false ,'pesan'=>$e->getMessage()]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function hpsdetailpo(Request $request,$kode){


        try {
            // Validate the value...

            detail_po::where('kode_po',$kode)
            ->whereBetween('created_at',[$request->start,$request->end])->delete();
            jurnal::where('kode_transaksi','LIKE',"$kode%")
            ->whereBetween('created_at',[$request->start,$request->end])->delete();
            // detail_po::
            //     where('kode_po',$kode)
            //     ->whereBetween('created_at', [$request->start, $request->end])
            //     ->delete();
            return response()->json(['success'=>true ,'pesan'=>'Data Berhasil Dihapus']); 
        } catch (Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
      
    }
    public function destroy(Request $request,$kode)
    {
        //
        try{
            $data = detail_po::where('kode',$kode)->first();
            detail_po::where('kode',$kode)->delete();
            jurnal::where('kode_transaksi','LIKE',"$data->kode_po.".".$kode%")->delete();
            $log = new log_sistem();
            $log->transaksi = $data->kode_po.".".$kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Detail PO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
        
    }
}
