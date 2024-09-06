<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lapmarketing;
use App\Models\karyawan;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Response;
use Throwable;

class LapMarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
        ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')->get();
        return DataTables::of($data)
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

    public function laporan($id)
    {
        
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
    public function lap_marketing($tanggal)
    {
        $awal = Str::substr($tanggal,0,10);
        $akhir = Str::substr($tanggal,10);
        $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
        ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
        ->whereBetween('lapmarketing.tanggal',[$awal,$akhir])->get();
        return DataTables::of($data)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $data = new lapmarketing();
            $data->marketing = $request->marketing;
            $data->tanggal = $request->tanggal;
            $data->laporan = $request->laporan;
            $data->status = 'Belum Diperiksa';
            $data->created_at = $request->time;
            $data->save();
            return response()->json(['success'=>'Data Berhasil Ditambahkan']);
        } catch (\Exception $e){
            return $e->getMessage();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($marketing)
    {
        //
        $user = Auth::user();
        if($user->level == 'marketing')
        {
            $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
            ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
            ->where('lapmarketing.marketing',$marketing)->get();
            return DataTables::of($data)
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
        else 
        {
            $data = lapmarketing::select('lapmarketing.*','karyawan.nama')
            ->join('karyawan','lapmarketing.marketing','=','karyawan.kode')
            ->where('lapmarketing.marketing',$marketing)->get();
            return DataTables::of($data)
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
            $data = lapmarketing::select('lapmarketing.*', 'karyawan.nama')
                    ->join ('karyawan','lapmarketing.marketing','=','karyawan.kode')
                    ->where('lapmarketing.kode',$kode)->first();
            return response()->json($data);
        } catch(\Exception $e){
            return $e->getMessage();
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
            DB::table('lapmarketing')
            ->where ('kode',$kode)
            ->update(['laporan'=>$request->laporan,'tanggal'=>$request->tanggal]);
            return response()->json(['success'=>'Data Berhasil Diubah']);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        //
        try{
            lapmarketing::where('kode',$kode)->delete();
            return response()->json(['success'=>'Data Berhasil Dihapus']);
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
