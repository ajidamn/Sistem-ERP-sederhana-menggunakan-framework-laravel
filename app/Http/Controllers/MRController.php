<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\rekanan;
use App\Models\karyawan;
use App\Models\barang;
use App\Models\purchaseorder;
use App\Models\detail_mr;
use App\Models\jurnal;
use App\Models\log_sistem;
use App\Models\materialreceive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;

class MRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = materialreceive::select('materialreceive.*','purchaseorder.pembayaran','rekanan.nama')
                    ->leftjoin('purchaseorder','materialreceive.transaksi','=','purchaseorder.kode')
                    ->leftjoin('rekanan','purchaseorder.supplier','=','rekanan.kode')->get();
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
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";   
            } elseif ($data->status == 'Sudah Diperiksa') {
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-selesai'><b>Selesai</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit' data-backdrop='static'><b>Edit</b></a>
                    </div>
                    "; 
            } else {
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                       
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
    public function create()
    {
        //
    }
    public function lastkode(Request $request)
    {
        $kode = 'MR.'.$request->jenis.'.'.$request->tanggal.'.';

        $data = materialreceive::select('kode')->where('kode', 'like', $kode.'%')->orderBy('kode','desc')->first();
        if($data == null){
            $kode = $kode.'0001';
            return $kode;
        } else {
            $a = $data;
            $a = Str::substr($a,11);
            $a = intval($a);
            $b = $a+1;
            $next = $kode.sprintf('%04s', $b);
            return $next;
        }
    }
    public function selesai($kode)
    {
        try{
            DB:: table('materialreceive')
            ->where('kode',$kode)
            ->update(['status'=>'Selesai']);
            DB::table('jurnal')
            ->where('kode_transaksi','LIKE',"$kode%")
            ->update(['status'=>'Selesai']);
            return response()->json(['success'=>true, 'pesan'=>'Data Berhasil Diubah']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function dropdownpo(Request $request)
    {
        $po = [];
        if($request->has('q')){
            $search = $request->q;
            $po =purchaseorder::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->where('nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $po = purchaseorder::select("kode")->where('status','Sudah Diperiksa')
            		->get();
        }
        return response()->json($po);
    }
    public function cetakmr($kode)
    {
        $tipe = Str::substr($kode, 3, 2);
        if($tipe == 61){
            Try{
                $MR = materialreceive::select('materialreceive.*','rekanan.*')
                    ->join('purchaseorder','materialreceive.transaksi','=','purchaseorder.kode')
                    ->join('rekanan','purchaseorder.supplier','=','rekanan.kode')
                    ->where('materialreceive.kode',$kode)->first();
                $detail = detail_mr::select('detail_mr.*','barang.nama AS barang','barang.satuan AS satuan','barang.packing AS packing','gudang.nama as gudang','gudang.alamat as alamat')
                        ->join('barang','detail_mr.kode_brg','=','barang.kode')
                        ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                        ->where('detail_mr.kode_mr',$kode)->get();
                return response()->json(['success'=>true,'mr'=>$MR,'detail'=>$detail]);
            } catch(\Exception $e){
                return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
            }
        } else {
            Try{
                $MR = materialreceive::where('kode',$kode)->first();
                $detail = detail_mr::select('detail_mr.*','barang.nama AS barang','barang.satuan AS satuan','barang.packing AS packing','gudang.nama as gudang','gudang.alamat as alamat')
                        ->join('barang','detail_mr.kode_brg','=','barang.kode')
                        ->join('gudang','detail_mr.kode_gdg','=','gudang.kode')
                        ->where('detail_mr.kode_mr',$kode)->get();
                return response()->json(['success'=>true,'mr'=>$MR,'detail'=>$detail]);
            } catch(\Exception $e){
                return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
            }
        }
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
            if($request->jenis == 61){
                $data = new materialreceive();
                $data->kode = $request->kode;
                $data->transaksi = $request->transaksi;
                $data->tanggal = $request->tanggal;
                $data->surat_jalan = $request->sj;
                $data->keterangan = $request->keterangan;
                $data->status = "Belum Diperiksa";
                $data->save();


                $data = new author();
                $data->transaksi = $request->kode;
                $data->kode_pembuat = $request->author;
                // "created_at" =>  date('Y-m-d H:i:s'),
                $data->save();
            } else {
                $data = new materialreceive();
                $data->kode = $request->kode;
                $data->transaksi = $request->transaksi;
                $data->tanggal = $request->tanggal;
                $data->keterangan = $request->keterangan;
                $data->status = "Belum Diperiksa";
                $data->save();

                $data = new author();
                $data->transaksi = $request->kode;
                $data->kode_pembuat = $request->author;
                $data->created_at = $request->time;
                // "created_at" =>  date('Y-m-d H:i:s'),
                $data->save();
            }
            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data MR";
            $log->save();
            return response()->json(['success'=> true,'pesan'=>'Data Berhasil Ditambahkan']);
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
            $tipe = Str::substr($kode, 3, 2);
            if($tipe == 61){
                $data = materialreceive::
                    select('materialreceive.*', 'purchaseorder.tanggal as tanggalpo','purchaseorder.pembayaran','purchaseorder.vat')
                    ->join('purchaseorder', 'materialreceive.transaksi','=','purchaseorder.kode')
                    ->where('materialreceive.kode',$kode)->first();
                $author = author::
                    select('author.*')
                    ->where('author.transaksi',$kode)->first();
                $author['creator']   = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
                $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
                return response()->json(['success'=>true,'mr'=> $data,'author'=> $author]);
            } else {
                $data = materialreceive::where('kode',$kode)->first();
                $author = author::
                    select('author.*')
                    ->where('author.transaksi',$kode)->first();
                $author['creator']   = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
                $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
                return response()->json(['success'=>true,'mr'=> $data,'author'=> $author]);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'success'=>$e->getMessage()]);
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
            DB::table('materialreceive')
                ->where('kode',$kode)
                ->update(['surat_jalan'=> $request->sj]);
                $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data MR";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
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
        materialreceive::where('kode',$kode)->delete();
        detail_mr::where('kode_mr',$kode)->delete();
        author::where('transaksi',$kode)->delete();
        jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
        $log = new log_sistem();
        $log->transaksi = $kode;
        $log->user = $request->user;
        $log->keterangan = "Hapus Data MR";
        $log->save();
        return response()->json(['success'=> 'Data Berhasil Dihapus']);
    }
}
