<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\purchaseorder;
use App\Models\detail_po;
use App\Models\jurnal;
use App\Models\log_sistem;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;
class POController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = purchaseorder::all();
        return DataTables::of($data)
        ->addIndexColumn()
        
        ->addColumn('action', function($data){
            if($data->status == 'Belum Diperiksa'){
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-po' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus-po'><b>Hapus</b></a>
                    </div>
                    ";   
            } elseif ($data->status == 'Sudah Diperiksa') {
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-po' data-backdrop='static'><b>Edit</b></a>
                    </div>
                    "; 
            } else {
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        
                    </div>
                    "; 
            }
                     
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selesai(Request $request,$kode)
    {
        try{
            DB:: table('purchaseorder')
            ->where('kode',$kode)
            ->update(['status'=>'Selesai']);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data PO Selesai";
            $log->save();
           
            return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function dropdownpo()
    {
        
    }
    public function lastkode(Request $request, $jns){
        
        $kode = 'PO.'.$request->jenis.'.'.$request->tanggal.'.';
        $data = purchaseorder::where('kode','LIKE',"$kode%")->orderBy('kode','DESC')->first();
        if($data == null){
            $kode = $kode.'0001';
        } else {
            $Lkode = $data->kode;
            $angka = Str::substr($Lkode,11,4);
            $a = intval($angka);
            $b = $a+1;
            $next = $kode.sprintf('%04s', $b);
            return $next;
        }

    }
    public function dropdownbarangpo(){
        $data = barang::select('kode','nama','satuan')->get();
        return $data;
    }
    public function cetakpo($kode){
        $data = purchaseorder::where('kode',$kode)->first();
        $supplier = rekanan:: where('kode',$data->supplier)->first();
        $detail = detail_po::select('detail_po.*','barang.nama as nama','barang.satuan')
                    ->join('barang','detail_po.kode_brg','barang.kode')
                    ->where('detail_po.kode_po',$kode)->get();
        return response()->json(['po'=> $data,'detail'=> $detail,'supplier'=> $supplier]);
        
    }
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
            $PO = new purchaseorder();
            $PO->kode = $request->kode;
            $PO->tanggal = $request->tanggal;
            $PO->jenis = $request->jenis;
            $PO->supplier = $request->supplier;
            $PO->pembayaran = $request->pembayaran;
            $PO->spk = $request->spk;
            $PO->term_payment = $request->term;
            $PO->vat = $request->vat;
            $PO->time_delivery = $request->delivery;
            $PO->status = "Belum Diperiksa";
            // return $PO;
            $PO->save();

            // $data = new author();
            // $data->transaksi = $request->kode;
            // $data->kode_pembuat = $request->author;
            // // "created_at" =>  date('Y-m-d H:i:s'),
            // $data->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data PO";
            $log->save();
            return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Ditambahkan']);
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
    public function show($kode)
    {
        //
        try{
            $po = purchaseorder::where('kode',$kode)->first();
            return response()->json(['success'=>true,'data'=> $po]);
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
            $data = purchaseorder::
                select('purchaseorder.*', 'rekanan.nama')
                ->join('rekanan', 'purchaseorder.supplier','=','rekanan.kode')
                ->where('purchaseorder.kode',$kode)->first();
            $author = author::
                select('author.*')
                ->where('author.transaksi',$kode)->first();
            $author['creator'] = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
            return response()->json(['success'=>true,'po'=> $data,'author'=> $author]);
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
            $po = purchaseorder::where('kode',$kode)->first();
            if($request->vat == $po->vat) {
                DB::table('purchaseorder')
                ->where('kode',$kode)
                ->update(['supplier'=>$request->supplier,'pembayaran'=>$request->pembayaran,'spk'=>$request->spk,'time_delivery'=>$request->delivery,'term_payment'=>$request->term]);
                
            } else {
                DB::table('purchaseorder')
                ->where('kode',$kode)
                ->update(['supplier'=>$request->supplier,'pembayaran'=>$request->pembayaran,'spk'=>$request->spk,'time_delivery'=>$request->delivery,'term_payment'=>$request->term,'vat'=>$request->vat]);
  
            }
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data PO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$kode)
    {
        //
        try{
            purchaseorder::where('kode',$kode)->delete();
            detail_po::where('kode_po',$kode)->delete();
            author::where('transaksi',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data PO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
