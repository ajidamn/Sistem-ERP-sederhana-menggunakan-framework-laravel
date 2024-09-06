<?php

namespace App\Http\Controllers;


use App\Models\transaksi;
use App\Models\detail_transaksi;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = transaksi::all();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('item',function($data){
            $item = detail_transaksi::where('transaction_id',$data->id)->distinct()->count('item');
            return $item;
        })
        ->addColumn('qty',function($data){
            $qty = detail_transaksi::select(DB::raw("SUM(qty) AS QTY"))->where('transaction_id',$data->id)->first();
            return $qty->QTY;
        })
        ->addColumn('action', function($data){
            return "
                    <button type='button' class='btn btn-default'>Action</button>
                    <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->id'  data-target='#modal-detail' ><b>Detail</b></a>
                        <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->id' data-target='#modal-edit' data-backdrop='static' ><b>Edit</b></a>
                        <a class='dropdown-item hapus' style='color:red' data-toggle='modal' data-kode='$data->id' data-target='#modal-hapus'><b>Hapus</b></a>
                    </div>
                    ";
                     
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function dropdownpo()
    {
        
    }
    // public function query_B()
    // {
    //     $data = activity::select('activity.id','activity.title','detail_activity.type');
    //     return DataTables::of($data)
    //     ->addIndexColumn()
    //     ->addColumn('detail',function($data){
    //         $item = detail_activity::where('activity_id',$data->id)->distinct()->count('type');
    //         return $item;
    //     })
    //     ->addColumn('qty',function($data){
    //         $qty = detail_transaksi::select(DB::raw("SUM(qty) AS QTY"))->where('transaction_id',$data->id)->first();
    //         return $qty->QTY;
    //     })->make(true);
    // }
    public function structuretest()
    {
        try{
            $data = [
                [
                'no_transaction' =>'001',
                'items'=>[
                        ['name'=>'Milk','total'=>4],
                        ['name'=>'Coffee','total'=>2],
                     ]
                ],
                [
                'no_transaction' =>'002',
                'items'=>[
                        ['name'=>'Tea','total'=>7],
                        ['name'=>'Sugar','total'=>1],
                        ['name'=>'Coffee','total'=>5],
                     ]
                ]
            ];
            foreach($data AS $d){

            }


        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function last(){
        
        
        $data = transaksi::orderBy('id','DESC')->first();
        if($data == null){
            $kode = '001';
        } else {
            $Lkode = $data->id;
            // $angka = Str::substr($Lkode,11,4);
            $a = intval($Lkode);
            $b = $a+1;
            $next = sprintf('%03s', $b);
            return $next;
        }

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
            $data = new transaksi();
            $data->no_transaction = $request->no;
            $data->transaction_date = $request->tgl;
            // return $PO;
            $data->save();

            // $data = new author();
            // $data->transaksi = $request->kode;
            // $data->kode_pembuat = $request->author;
            // // "created_at" =>  date('Y-m-d H:i:s'),
            // $data->save();

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
            $po = transaksi::where('id',$kode)->first();
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
            $data = transaksi::where('id',$kode)->first();
            $detail = detail_transaksi::where('transaction_id',$kode)->get();
            return response()->json(['success'=>true,'data'=> $data,'detail'=> $detail]);
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
            $data = transaksi::where('id',$kode)->first();
            DB::table('transaksi')
                ->where('id',$kode)
                ->update(['transaction_date'=>$request->date]);
                
            
            
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
    public function destroy($kode)
    {
        //
        try{
            transaksi::where('id',$kode)->delete();
            detail_transaksi::where('transaction_id',$kode)->delete();
            return response()->json(['success'=>true,'pesan'=>'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
