<?php

namespace App\Http\Controllers;

use App\Models\salesorder;
use App\Models\detail_so;
use App\Models\karyawan;
use App\Models\rekanan;
use App\Models\author;
use App\Models\jurnal;
use App\Models\log_sistem;
use App\Models\suratjalan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;

class SOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = salesorder::select('salesorder.*','rekanan.nama as rekanan','karyawan.nama as karyawan')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->join('rekanan','salesorder.konsumen','=','rekanan.kode')->get();
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
            } elseif ($data->status == 'Sudah Diperiksa' || $data->status == 'ON Progress') {
                return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item selesai' style='color:green;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-selesai'><b>Selesai</b></a>
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
    public function lastkode(Request $request){

        $kode = 'SO.'.$request->jenis.'.'.$request->tanggal.'.';
        $data = salesorder::select('kode')->where('kode', 'like', $kode.'%')->orderBy('kode','desc')->first();
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
            $SO = new salesorder();
            $SO->kode = $request->kode;
            $SO->jenis = $request->jenis;
            $SO->tanggal = $request->tanggal;
            $SO->konsumen = $request->konsumen;
            $SO->pembayaran = $request->pembayaran;
            $SO->marketing = $request->marketing;
            $SO->no_po = $request->po;
            $SO->tgl_diterima = $request->delivery;;
            $SO->term_payment = $request->term;
            $SO->vat = $request->vat;
            $SO->keterangan = $request->keterangan;
            $SO->status = 'Belum Diperiksa';
            $SO->save();


            $author = new author();
            $author->transaksi = $request->kode;
            $author->kode_pembuat = $request->author;
            $author->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data SO";
            $log->save();

            return response()->json(['success'=>true,'pesan'=> "Data Berhasil Ditembahkan"]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
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
    public function edit($id)
    {
        //
        try{
            $data = salesorder::
                select('salesorder.*', 'rekanan.nama as rekanan','rekanan.alamat','karyawan.nama as karyawan')
                ->join('karyawan', 'salesorder.marketing','=','karyawan.kode')
                ->join('rekanan', 'salesorder.konsumen','=','rekanan.kode')
                ->where('salesorder.kode',$id)->first();
            $author = author::
                select('author.*')
                ->where('author.transaksi',$id)->first();
            $author['creator']   = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
            return response()->json(['success'=>true,'so'=> $data,'author'=> $author]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }

    public function selesai(Request $request,$kode)
    {
        try{
            DB:: table('salesorder')
            ->where('kode',$kode)
            ->update(['status'=>'Selesai']);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data SO Selesai";
            $log->save();

            return response()->json(['success'=>true,'pesan'=>'Data Berhasil diupdate']);
        } catch(\Exception $e) {
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
            DB::table('salesorder')
            ->where('kode', $kode)
            ->update(['marketing' =>$request->marketing, 'konsumen' => $request->konsumen,'pembayaran' => $request->pembayaran,'no_po' => $request->po,'vat'=>$request->vat,'tgl_diterima'=> $request->delivery,'term_payment'=>$request->term,'keterangan' => $request->keterangan,'updated_at'=>$request->time]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data SO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
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
            salesorder::where('kode',$kode)->delete();
            detail_so::where('kode_so',$kode)->delete();
            author::where('transaksi',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data SO";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
