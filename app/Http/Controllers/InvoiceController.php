<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoice;
use App\Models\author;
use App\Models\detail_invoice;
use App\Models\jurnal;
use App\Models\salesorder;
use App\Models\karyawan;
use App\Models\log_sistem;
use App\Models\suratjalan;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Response;
use Throwable;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = invoice::select('invoice.*','rekanan.nama as rekanan')
                ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')->get();
        return DataTables::of($data)
        ->addColumn('tempo',function($data){
            $fdate = $data->tanggal;
            $tdate = $data->tgl_tempo;
            $datetime1 = strtotime($fdate); // convert to timestamps
            $datetime2 = strtotime($tdate); // convert to timestamps
            $days = (int)(($datetime2 - $datetime1)/86400); // will give the difference in days , 86400 is the timestamp difference of a day
            return $days." Hari";
        })
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
    public function lastkode(Request $request)
    {
        $kode = 'INV.'.$request->tgl.'.';

        $data = invoice::select('kode')->where('kode', 'LIKE', $kode."%")->orderBy('kode','desc')->first();
        if($data == null){
            $kode = $kode.'0001';
            return $kode;
        } else {
            $a = $data->kode;
            $b = Str::substr($a,9,4);
            $a = intval($b);
            $b = $a+1;
            $next = $kode.sprintf('%04s', $b);
            return $next;
        }
    }

    public function dropdowninvsd(Request $request)
    {
        if($request->has('q')){
            $search = $request->q;
            $inv = invoice::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->where('kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $inv = invoice::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->get();
        }
        return response()->json($inv);
    }
    public function dropdowninvrekanan(Request $request, $kode)
    {
        if($request->has('q')){
            $search = $request->q;
            $inv = invoice::select("invoice.kode")
                    ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                    ->where('salesorder.konsumen',$kode)
                    ->where('invoice.status','Sudah Diperiksa')
            		->where('invoice.kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $inv = invoice::select("invoice.kode")
                    ->join('salesorder','invoice.kode_so','=','salesorder.kode')
                    ->where('salesorder.konsumen',$kode)
                    ->where('invoice.status','Sudah Diperiksa')
            		->get();
        }
        return response()->json($inv);
    }
    public function dropdowninv(Request $request)
    {
        if($request->has('q')){
            $search = $request->q;
            $inv = invoice::select("kode")
                    ->where('status','Selesai')
            		->where('kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $inv = invoice::select("kode")->where('status','Selesai')
            		->get();
        }
        return response()->json($inv);
    }

    public function dropdownso(Request $request)
    {
        $so = [];
        if($request->has('q')){
            $search = $request->q;
            $so =salesorder::select("kode")
                    ->where('status','Sudah Diperiksa')
            		->where('kode', 'LIKE', "%$search%")
            		->get();
        } else {
            $so = salesorder::select("kode")->where('status','Sudah Diperiksa')
            		->get();
        }
        return response()->json($so);
    }
    public function dropdownsj(Request $request,$kode)
    {
        if($request->has('q')){
            $search = $request->q;
            $sj =suratjalan::select('kode','status')
                ->where('status', 'Selesai')
                ->where('so',$kode)
                ->where('kode', 'LIKE', "%$search%")
                ->get();
        } else {
            $sj =suratjalan::select('kode','status')
                ->where('status', 'Selesai')
                ->where('so',$kode)
                ->get();
        }
        return response()->json($sj);
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
        $data = new invoice();

        try{
            $data->kode = $request->kode;
            $data->tanggal = $request->tanggal;
            $data->kode_so = $request->so;
            $data->kode_sj = $request->sj;
            $data->kode_bank = $request->bank;
            $data->po_req = $request->po;
            $data->vat = $request->vat;
            $data->tgl_tempo = $request->tempo;
            $data->DP = $request->dp;
            $data->keterangan = $request->keterangan;
            $data->status = "Belum Diperiksa";
            $data->created_at = $request->time;
            $data->save();

            
    
            $data = new author();
            $data->transaksi = $request->kode;
            $data->kode_pembuat = $request->author;
            // "created_at" =>  date('Y-m-d H:i:s'),
            $data->save();

            $log = new log_sistem();
            $log->transaksi = $request->kode;
            $log->user = $request->author;
            $log->keterangan = "Tambah Data Invoice";
            $log->save();



            return response()->json(['success'=> true,'author'=>$request->author, 'pesan'=> 'Data Berhasil Ditambahkan']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'pesan'=> $e->getMessage()]) ;
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
    public function selesai($kode)
    {
        try{
            DB:: table('invoice')
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
    public function cetakinv($kode)
    {
        $data = [];
        try{
            $inv = invoice::select('invoice.*','rekanan.nama as rekanan','rekanan.telp','bank.bank','bank.rekening','bank.atas_nama','karyawan.nama as marketing', 'salesorder.pembayaran', 'suratjalan.alamat' )
                ->join('salesorder', 'invoice.kode_so','=','salesorder.kode')
                ->join('bank','invoice.kode_bank','=','bank.kode')
                ->join('suratjalan', 'invoice.kode_sj','=','suratjalan.kode')
                ->join ('rekanan','salesorder.konsumen','=','rekanan.kode')
                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                ->where('invoice.kode',$kode)->first();
            $detail = detail_invoice::select('detail_invoice.*','gudang.nama as gudang','barang.nama as barang','barang.satuan')
                ->join('gudang', 'detail_invoice.kode_gdg','=','gudang.kode')
                ->join('barang','detail_invoice.kode_brg','=','barang.kode')
                ->where('detail_invoice.kode_inv',$kode)->get();
            $data['inv']= $inv;
            $data['detail']=$detail;
            return $data;
        } catch (\Exception $e){
            return $e->getMessage();
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
            $inv = invoice::select('invoice.*','rekanan.nama as rekanan','bank.bank','bank.rekening','bank.atas_nama','karyawan.nama as marketing', 'salesorder.pembayaran' )
                    ->join('salesorder', 'invoice.kode_so','=','salesorder.kode')
                    ->join('bank','invoice.kode_bank','=','bank.kode')
                    -> join ('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->where('invoice.kode',$kode)->first();
           
            $author = author::all()
                    ->where('transaksi',$kode)->first();
            $author['creator']   = karyawan::select('nama')->where('kode',$author['kode_pembuat'])->first();
            $author['pemeriksa'] = karyawan::select('nama')->where('kode',$author['kode_pemeriksa'])->first();
            $data['inv'] = $inv;
            $data['author']= $author;
            return response()->json(['success'=>true,'data'=>$data]);

        } catch (\Exception $e) {
            
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]) ;
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
            DB::table('invoice')
            ->where('kode',$kode)
            ->update(['kode_bank'=>$request->bank,'tgl_tempo'=>$request->tempo,'DP'=> $request->DP,'keterangan'=>$request->keterangan]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Invoice";
            $log->save();

            return response()->json(['success'=> true, 'pesan'=> 'Data Berhasil Diubah']);
        }catch (\Exception $e){
            return response()->json(['success'=>false, 'pesan' => $e->getMessage()]);
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
            $data = invoice::where('kode',$kode)->first();

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Invoice";
            $log->save();
            invoice::where('kode',$kode)->delete();
            detail_invoice::where('kode_inv',$kode)->delete();
            jurnal::where('kode_transaksi','LIKE',"$kode%")->delete();
            author::where('transaksi',$kode)->delete();

            return response()->json(['success'=>true, 'pesan'=>"Data Berhasil Ditambahkan"]);

        } catch (\Exception $e){
            return response()->json(['success'=>false ,'pesan'=>$e->getMessage()]);
        }
    }
}
