<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = detail_transaksi::all();
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
                <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-bank='$data->bank' data-kode='$data->kode' data-rekening='$data->rekening' data-nama='$data->atas_nama' data-target='#modal-hapus'><b>Hapus</b></a>
            </div>
            ";            
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lastkode(Request $request)
    {

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
            $bank = new detail_transaksi();
            $bank->transaction_id = $request->transaksi;
            $bank->item = $request->item;
            $bank->qty = $request->qty;
            $bank->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            
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
        try{
            $data = detail_transaksi::where('transaction_id',$id)->get();
            return response()->json(['success'=>true,'data'=> $data]);
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
    public function edit($id)
    {
        //
        try{
            $data = detail_transaksi::where('id',$id)->first();
            return response()->json(['success'=>true,'data'=> $data]);
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
            
            DB::table('transaction_details')
            ->where('id', $kode)
            ->update(['item'=> $request->item,'qty'=> $request->qty]);
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
    public function destroy($id)
    {
        //
        try{
            detail_transaksi::where('id',$id)->delete();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
}
