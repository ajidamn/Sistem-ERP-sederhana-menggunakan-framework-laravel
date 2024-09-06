<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\log_sistem;
use App\Models\db_marketing;
use App\Models\karyawan;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Response;

class DB_marketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $login = Auth::user();
        switch($login->level){
            case('marketing'):
                $data = db_marketing::all();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";            
                })->make(true);
                break;
            case('superadmin'):
                $data = db_marketing::all();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";            
                })->make(true);
                break;
            case('ceo'):
                $data = db_marketing::all();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";            
                })->make(true);
                break;
            case('manager-marketing'):
                $data = db_marketing::all();
                return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail'><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit'><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->kode' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";            
                })->make(true);
                break;
        }
            
            
         
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
            $last = db_marketing::max('kode')->first();;
            $newkode  = $last->kode+1;

            $data = new db_marketing();
            $data->kode = $newkode;
            $data->kategori = $request->kategori;
            $data->nama_perusahaan = $request->nama;
            $data->alamat_kantor = $request->kantor;
            $data->alamat_pabrik = $request->pabrik;
            $data->telp_wa = $request->telp;
            $data->email = $request->email;
            $data->orang_dalam = $request->rekanan;
            $data->medsos = $request->medsos;
            $data->kebutuhan = $request->kebutuhan;
            $data->PIC = $request->pic;
            $data->keterangan = $request->keterangan;
            $data->status = "Belum Diperiksa";
            $data->save();

            $log = new log_sistem();
            $log->transaksi = "DB Marketing ".$newkode;
            $log->user      = $request->user;
            $log->keterangan = "Tambah Data DB Marketing";
            $log->save();
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch(Exception $e){
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
            $data = db_marketing::select('database_marketing.*','karyawan.nama AS marketing')
                    ->join('karyawan','db_marketing.PIC','=','karyawan.kode')
                    ->where('database_marketing.kode',$kode)->first();
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
    public function update(Request $request, $kode)
    {
        //
        try{
            $data = db_marketing::where('kode',$kode)->first();
            DB::table('database_marketing')->where('kode',$kode)
            ->update(['kategori' =>$request->kategori, 'nama_perusahaan' => $request->nama,'alamat_kantor' => $request->kantor,'alamat_pabrik' => $request->pabrik,
            'telp_wa' => $request->telp,'email'=>$request->email,'orang_dalam'=>$request->rekanan,'medsos'=>$request->medsos,'kebutuhan'=>$request->kebutuhan,
            'PIC'=>$request->pic,'keterangan' => $request->keterangan,'status'=>$request->status
            ]);
            
            $log = new log_sistem();
            $log->transaksi = "DB Marketing ".$kode;
            $log->user      = $request->user;
            $log->keterangan = "Edit Data DB Marketing";
            $log->save();
            return response()->json(['success'=>true,'pesan'=>"Data Berhasil Diubah"]);
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
            DB::table('database_marketing')
            ->where('kode', $kode)
            ->delete();
            
            $log = new log_sistem();
            $log->transaksi = "DB Marketing ".$kode;
            $log->user      = $request->user;
            $log->keterangan = "Hapus Data DB Marketing";
            $log->save();
            return response()->json(['success'=> true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
