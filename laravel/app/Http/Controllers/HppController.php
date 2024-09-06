<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\hpp;
use App\Models\jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HppController extends Controller
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
            $barang = barang::all();
            
            foreach($barang AS $brg){
                $hpp = hpp::where('barang',$brg->kode)->orderBy('id','DESC')->first();
                if(!$hpp){
                    $jurnal = jurnal::select(DB::raw('SUM(qty_debit) AS QTY'), DB::raw('SUM(jumlah_debit) AS JUMLAH'))
                        ->where('kode_transaksi','LIKE',"MR%D")
                        ->where('kode_brg',$brg->kode)
                        ->where('created_at','<',$request->created)
                        ->where('status','Selesai')->first();
                    if(!$jurnal){
                        $jumlah = 0;
                        $qty = 0;
                        $HPP = 0;
                    } else {
                        $jumlah = $jurnal->JUMLAH;
                        $qty = $jurnal->QTY;
                        $HPP = $jurnal->JUMLAH/$jurnal->QTY;
                    }
                } else {
                    $jurnal = jurnal::select(DB::raw('SUM(qty_debit) AS QTY'), DB::raw('SUM(jumlah_debit) AS JUMLAH'))
                        ->where('kode_transaksi','LIKE',"MR%D")
                        ->where('kode_brg',$brg->kode)
                        ->whereBetween('created_at',[$hpp->tanggal,$request->created])
                        ->where('status','Selesai')->first();
                    if(!$jurnal){
                        $qty = $hpp->qty;
                        $jumlah = $hpp->total;
                        $HPP = $hpp->hpp;
                    } else {
                        $qty = $hpp->qty + $jurnal->QTY;
                        $jumlah = $hpp->total + $jurnal->JUMLAH;
                        $HPP = $jumlah/$qty;
                    }
                    
                }
                
                $data = new hpp();
                $data->tanggal = $request->tanggal;
                $data->barang = $brg->kode;
                $data->qty = $qty;
                $data->total = $jumlah;
                $data->hpp  = $HPP;
                $data->save();
            }
            return response()->json(['success'=>true,'pesan'=>"Data berhasil Ditambahkan"]);
        }catch(\Exception $e){
            return response()->json($e->getMessage());
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
