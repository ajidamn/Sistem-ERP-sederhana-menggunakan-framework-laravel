<?php

namespace App\Http\Controllers;

use App\Models\detail_po;
use App\Models\barang;
use App\Models\detail_kas;
use App\Models\detail_mr;
use App\Models\detail_so;
use App\Models\gudang;
use App\Models\hpp;
use App\Models\invoice;
use App\Models\jurnal;
use App\Models\kas;
use App\Models\kode_akuntansi;
use App\Models\purchaseorder;
use App\Models\rekanan;
use App\Models\salesorder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Response;
use Throwable;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail_po($kode)
    {
        try{
            $data=[];
            $jurnal = jurnal::where('kode_transaksi','LIKE',"$kode%")->get();
            foreach($jurnal as $jurnal){
                $sub = substr($jurnal->kode_transaksi,11,4);
                $sub  = intval($sub);
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_kredit)->first();
                $detail = detail_po::where('kode',$sub)->first();
                $jurnal->kode = $sub;
                $jurnal->hpp = $detail->harga;
                $jurnal->disc = $detail->diskon;
                $jurnal->nama_debit = $debit->nama_perkiraan;
                $jurnal->nama_kredit = $kredit->nama_perkiraan;
                $data[] = $jurnal;
            }
            return response()->json(['success'=> true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function detail_mr($kode)
    {
        try{
            $data=[];
            $jurnal = jurnal::where('kode_transaksi','LIKE',"$kode%")->get();
            foreach($jurnal as $jurnal){
                $sub = substr($jurnal->kode_transaksi,11,4);
                $sub = intval($sub);
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_kredit)->first();
                $detail = detail_mr::where('kode',$sub)->first();
                $jurnal->kode = $sub;
                $jurnal->hpp = $detail->harga;
                $jurnal->disc = $detail->diskon;
                $jurnal->nama_debit = $debit->nama_perkiraan;
                $jurnal->nama_kredit = $kredit->nama_perkiraan;
                $data[] = $jurnal;
            }
            return response()->json(['success'=> true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }

    public function detail_so($kode)
    {
        $data=[];
        $detail = jurnal::where('kode_transaksi','LIKE',"$kode%")->get();
        foreach($detail as $jurnal){
            $sub = substr($jurnal->kode_transaksi,11,4);
            $sub = intval($sub);
            $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_debit)->first();
            $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_kredit)->first();
            $detail = detail_so::where('kode',$sub)->first();
            $jurnal->kode = $sub;
            $jurnal->dpp = $detail->harga*$detail->qty;
            $jurnal->nama_debit = $debit->nama_perkiraan;
            $jurnal->nama_kredit = $kredit->nama_perkiraan;
            $data[] = $jurnal;
        }
        return response()->json(['success'=> true,'data'=>$data]);
    }
    
    public function detail_sj($kode)
    {
        try{
            $data=[];
            $jurnal = jurnal::where('kode_transaksi','LIKE',"$kode%")->get();
            foreach($jurnal as $jurnal){
                $sub = substr($jurnal->kode_transaksi,11,4);
                $sub = intval($sub);
                $debit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_debit)->first();
                $kredit = kode_akuntansi::select('nama_perkiraan')->where('kode',$jurnal->akun_kredit)->first();
                $jurnal->kode = $sub;
                $jurnal->nama_debit = $debit->nama_perkiraan;
                $jurnal->nama_kredit = $kredit->nama_perkiraan;
                $data[] = $jurnal;
            }
            return response()->json(['success'=> true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function data_bukubesar (Request $request)
    {
        try{
            $data = kode_akuntansi::select('kode','nama_perkiraan')->get();
            foreach($data AS $D){
                $D->perkiraan = $D->kode." - ".$D->nama_perkiraan;
                //AWAL
                $D_awal = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
                        ->where('akun_debit',$D->kode)
                        ->where('status','Selesai')
                        ->where('created_at','<',$request->awal)->first();
                if(!$D_awal){
                    
                    $D->debit_awal = "Rp.".number_format(0,2,',','.');
                    $Dawal = 0;
                }else {
                    $D->debit_awal = "Rp.".number_format($D_awal->jumlah,2,',','.');
                    $Dawal = $D_awal->jumlah;
                }
                $K_awal = jurnal::select(DB::raw('SUM(jumlah_kredit) AS jumlah'))
                        ->where('akun_debit',$D->kode)
                        ->where('status','Selesai')
                        ->where('created_at','<',$request->awal)->first();
                if(!$K_awal){
                    $D->kredit_awal = "Rp.".number_format(0,2,',','.');
                    $Kawal = 0;
                }else {
                    $D->kredit_awal = "Rp.".number_format($K_awal->jumlah,2,',','.');
                    $Kawal = $K_awal->jumlah;
                }
                //AWAL
                //MASUK
                $D_masuk = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
                        ->where('akun_debit',$D->kode)
                        ->where('status','Selesai')
                        ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                if(!$D_masuk){
                    $D->debit_masuk = "Rp.".number_format(0,2,',','.');
                    $Dasuk = 0;
                }else {
                    $D->debit_masuk = "Rp.".number_format($D_masuk->jumlah,2,',','.');
                    $Dasuk = $D_masuk->jumlah;
                }
                $K_masuk = jurnal::select(DB::raw('SUM(jumlah_kredit) AS jumlah'))
                        ->where('akun_debit',$D->kode)
                        ->where('status','Selesai')
                        ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                if(!$K_masuk){
                    $D->kredit_masuk = "Rp.".number_format(0,2,',','.');
                    $Kasuk = 0;
                }else {
                    $D->kredit_masuk = "Rp.".number_format($K_masuk->jumlah,2,',','.');
                    $Kasuk = $K_masuk->jumlah;
                }
                //MASUK
                //AKHIR
                    $D_akhir = $Dawal+$Dasuk;
                    $K_akhir = $Kawal+$Kasuk;
                    $D->debit_akhir = "Rp.".number_format($D_akhir,2,',','.');
                    $D->kredit_akhir = "Rp.".number_format($K_akhir,2,',','.');
                //AKHIR
            }
            return response()->json(['success'=>true,'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function laporan_penjualan(Request $request)
    {
        // $awal = substr($tanggal,0,10);
        // $akhir = substr($tanggal,11);

        try{
            $n = 0;
            $data = salesorder::select('salesorder.*','rekanan.nama AS rekanan','karyawan.nama AS karyawan')
                    ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                    ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                    ->where('salesorder.status','Selesai')
                    ->whereBetween('salesorder.created_at',[$request->awal,$request->akhir])->get();
            if(!$data){

            } else {
                foreach($data AS $D){
                    $kode = $D->kode;
                    $totalSO = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
                                ->where('kode_transaksi','LIKE',"$kode%D")
                                ->first();
                    $D->jumlahSO = $totalSO->jumlah;
                    $D->penjualan = "Rp.".number_format($totalSO->jumlah,2,',','.');
                    $D->action = "
                    <button type='button' class='btn btn-info detail' data-toggle='modal' data-kode='$D->kode' data-target='#modal-detail'>Detail</button>                    
                ";
                }
            }
                
                
            
            
            // foreach($data AS $D){
            //     $n++;
            //     $D->no = $n;
            //     $D->transaksi = $D->kode;
            //     $totalSO = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
            //                 ->where('kode_transaksi','LIKE',$D->kode."%")
            //                 ->first();
            //     $totalSO = $totalSO->jumlah;
            //     $D->penjualan = "Rp.".number_format($totalSO,2,',','.');
            //     //INVOICE
            //     $debit = 0;
            //         $inv = invoice::where('kode_so',$D->kode)
            //                 ->where('status','Selesai')->get();
            //         foreach($inv AS $I){
            //             $detail = jurnal::select('jumlah_debit')
            //                         ->where('kode_transaksi','LIKE',$I->kode."%")->first();
            //             $debit = $debit+$detail->jumlah_debit;
            //         }
            //         if($debit == $totalSO){
            //             $D->status = 'Lunas';
                        
            //         } else {
            //             $D->status = 'Belum Lunas';
            //         }
            //     //INVOICE
                

            // }

            // $data = salesorder::select('salesorder.*','rekanan.nama as nama_konsumen','karyawan.nama as nama_marketing')
            //         ->join('rekanan','salesorder.konsumen','rekanan.kode')
            //         ->join('karyawan','salesorder.marketing','karyawan.kode')
            //         ->whereBetween('salesorder.created_at',[$awal,$akhir])
            //         ->get();
            // return DataTables::of($data)
            // ->addIndexColumn()
            // ->addColumn('total',function($data){
            //     $detail = detail_so::select(DB::raw('SUM(total) as total'))
            //             ->where('kode_so',$data->kode)->first();
            //     $hasil = "Rp " . number_format($detail->total,2,',','.');
            //     return $hasil;
            // })
            // ->addColumn('action', function($data){
            //     return "
            //         <button type='button' class='btn btn-default'>Action</button>
            //         <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
            //             <span class='sr-only'>Toggle Dropdown</span>
            //         </button>
            //         <div class='dropdown-menu' role='menu'>
            //             <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode' data-target='#modal-detail' ><b>Detail</b></a>
            //         </div>
            //         ";
            // })->make(true);
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
        
    }
    public function detail_penjualan($kode)
    {
        try{
            $data = salesorder::select('salesorder.*','rekanan.nama AS rekanan','karyawan.nama AS karyawan')
                ->join('rekanan','salesorder.konsumen','=','rekanan.kode')
                ->join('karyawan','salesorder.marketing','=','karyawan.kode')
                ->where('salesorder.kode',$kode)->first();
            if(!$data){
                return response()->json(['success'=>false,'pesan'=>"Data Tidak Ditemukan"]);
            } else {
                $detail = detail_so::select('detail_so.*','barang.nama as barang','barang.satuan as satuan')
                        ->join('barang','detail_so.kode_brg','=','barang.kode')
                        ->where('detail_so.kode_so',$kode)
                        ->get();
                $totalSO = 0;
                foreach($detail AS $dtl){
                    $dtl->PPn = ($dtl->dpp*$dtl->vat) / 100;
                    $totalSO = $totalSO+$dtl->total;
                }
                $data->detail = $detail;
                $inv = invoice::select('invoice.*','bank.bank AS bank', 'bank.rekening as rekening')
                        ->join('bank','invoice.kode_bank','=','bank.kode')
                        ->where('invoice.kode_so',$kode)->get();
                $totalINV = 0;
                foreach($inv as $IN){
                    $kode = $IN->kode;
                    $kodekas = detail_kas::select('kode_kas')->where('kode_transaksi',$kode)->first();
                    $kas = detail_kas::select(DB::raw('SUM(total) AS jumlah'))
                            ->where('kode_transaksi',$kode)->first();    
                    $Dinv = jurnal::select(DB::raw('SUM(jumlah_debit) AS jumlah'))
                            ->where('kode_transaksi','LIKE',"$kode%D")->first();
                    $IN->kode_kas = $kodekas->kode_kas;
                    $IN->total = $kas->jumlah;    
                    $totalINV = $totalINV+$kas->jumlah;
                    if($kas->jumlah == $Dinv->jumlah){
                        $IN->status = "<strong style='color:green;'>LUNAS</strong>";
                    } else if(!$kas->jumlah) {
                        $IN->status = "<strong style='color:red;'>Belum Di Input ke Kas</strong>";
                    }
                    
                }
                return response()->json(['success'=>true,'data'=>$data,'inv'=>$inv]);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
        
    }
    public function dropdownbarangpo(Request $request,$po)
    {
        try{
            $barang = [];
            if($request->has('q')){
                $search = $request->q;
                $barang = jurnal::select('kode_brg','nama_brg')
                        ->where('kode_transaksi','LIKE','$po%')
                        ->where('nama_brg','LIKE',"%$search")
                        ->get();
                
            } else {
                $barang = jurnal::select('kode_brg','nama_brg')
                        ->where('kode_transaksi','LIKE',"$po%")
                        ->get();
            }
            return response()->json($barang);
        
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
    public function hpp_barang(Request $request,$barang)
    {
        try{
            $hpp  = hpp::where('barang',$barang)
                    ->where('created_at','<',$request->tanggal)
                    ->orderBy('created_at','desc')->first();
            
            $data = jurnal::select(DB::raw('SUM(jumlah_debit) as JUMLAH'), DB::raw('SUM(qty_debit) as QTY'))
                    ->where('kode_transaksi','LIKE',"MR%")
                    ->where('kode_brg',$barang)
                    ->where('status','Selesai')->first();
            if($data->JUMLAH == null || $data->QTY == null){
                if(!$hpp){
                    $HPP = 0;
                } else {
                    $HPP = $hpp->hpp;
                }
            } else {
                if(!$hpp){
                    $HPP = $data->JUMLAH/$data->QTY;
                } else {
                    $A = $data->JUMLAH/$data->QTY;
                    $HPP = ($hpp->hpp+$A)/2;
                }
                
            }

            return response()->json(['success'=>true,'data'=>$HPP]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
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
    public function edit(Request $request,$id)
    {
        //
        try{
            $data = jurnal::where('kode_transaksi','LIKE',"$request->transaksi%")
                    ->where('kode_brg',$id)->first();
            $debit = kode_akuntansi:: select('nama_perkiraan')->where('kode',$data->akun_debit)->first();
            $kredit = kode_akuntansi:: select('nama_perkiraan')->where('kode',$data->akun_kredit)->first();
            $data['nama_debit'] = $debit->nama_perkiraan;
            $data['nama_kredit'] = $kredit->nama_perkiraan;
            return response()->json(['success'=> true,'data'=>$data]);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=> $e->getMessage()]);
        }
    }
    public function test(Request $request)
    {
        $data = $request;
        return "MAsuk";
    }
    public function rekap_jurnal (Request $request)
    {
        try{
            $data = jurnal::where('kode_transaksi','LIKE',"$request->transaksi%")
                    ->whereBetween('created_at',[$request->awal,$request->akhir])->orderBy('created_at')->get();
            foreach($data AS $D){
                $debit = kode_akuntansi::where('kode',$D->akun_debit)->first();
                $D->transaksi = $D->akun_debit." - ".$debit->nama_perkiraan;
                $D->debit = number_format($D->jumlah_debit,2,',','.');
                $D->kredit = number_format($D->jumlah_kredit,2,',','.');
            }
            return response()->json(['success'=>true,'data'=>$data]);
        } catch (\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function total_so(Request $request)
    {
        try{
            if($request->marketing == null )
            {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SO"))
                    ->where('kode_transaksi','LIKE',"SO%D")
                    ->where('status',$request->status)
                    ->distinct()->first();
            } else {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SO"))
                    ->where('kode_transaksi','LIKE',"SO%D")
                    ->where('status',$request->status)
                    ->where('kode_marketing',$request->marketing)
                    ->distinct()->first();
            }
            return response()->json(['success'=>true, 'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getmessage() ]);
        }
    }

    public function total_sj(Request $request)
    {
        try{
            if($request->marketing == null){
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SJ"))
                    ->where('kode_transaksi','LIKE',"SJ%D")
                    ->where('status',$request->status)
                    ->distinct()->first();
            } else {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS SJ"))
                    ->where('kode_transaksi','LIKE',"SJ%D")
                    ->where('status',$request->status)
                    ->where('kode_marketing',$request->marketing)
                    ->distinct()->first();
            }
            
            return response()->json(['success'=>true, 'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getmessage() ]);
        }
    }

    public function total_invoice(Request $request)
    {
        try{
            if($request->marketing == null){
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS INV"))
                    ->where('kode_transaksi','LIKE',"INV%D")
                    ->where('status',$request->status)
                    ->distinct()->first();
            } else {
                $data = Jurnal::select(DB::raw("COUNT(kode_transaksi) AS INV"))
                    ->where('kode_transaksi','LIKE',"INV%D")
                    ->where('status',$request->status)
                    ->where('kode_marketing',$request->marketing)
                    ->distinct()->first();
            }
            return response()->json(['success'=>true, 'data'=>$data]);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getmessage() ]);
        }
    }

    public function stock_gudang(Request $request)
    {
        try{
            $data = barang::all();
           // belum selesai 
           foreach($data as $A) {
                if($request->gudang == "ALL"){
                    $gudang = gudang::select('nama')->first();
                    $A['gudang'] = $gudang->nama;
                    //Awal
                        $saldoA = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                                ->where('kode_transaksi','LIKE',"MR%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->first();
                        $saldoB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                                ->where('kode_transaksi','LIKE',"SJ%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->first();
                        if($saldoA == null ){
                            $saldoA = 0;
                        } else {
                            $saldoA = $saldoA->SA;
                        }
                        if($saldoB == null ){
                            $saldoB = 0;
                        } else {
                            $saldoB = $saldoB->SA;
                        }
                        $saldo_awal = $saldoA-$saldoB;
                        $A['awal_qty'] = $saldo_awal;
                        //NILAI AWAL
                        $nilaiA = jurnal ::where('kode_transaksi','LIKE',"MR%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->get();
                        $nilaiawal = 0;
                        foreach($nilaiA as $nilai){
                            $nilaiawal = $nilaiawal + $nilai->jumlah_debit;
                        }

                        $nilaiB = jurnal ::where('kode_transaksi','LIKE',"INV%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->get();
                        $nilaiakhir = 0;
                        foreach($nilaiB as $nilai){
                            $nilaiakhir = $nilaiakhir + $nilai->jumlah_debit;
                        }
                        $A['awal_nilai'] = "Rp.".number_format($nilaiawal-$nilaiakhir,2,',','.');
                        $Nawal = $nilaiawal-$nilaiakhir;
                    //Awal
                    //Masuk & Keluar
                        $dataA = jurnal::select(DB::raw("SUM(qty_debit) as SA"),DB::raw("SUM(jumlah_debit) as JUMLAH"))
                                ->where('kode_transaksi','LIKE',"MR%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                        $dataB = jurnal::select(DB::raw("SUM(qty_debit) as SA"),DB::raw("SUM(jumlah_debit) as JUMLAH"))
                                ->where('kode_transaksi','LIKE',"SJ%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                        $dataC = jurnal::select(DB::raw("SUM(jumlah_debit) as JUMLAH"))
                                ->where('kode_transaksi','LIKE',"INV%")
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                        if($dataA == null ){
                            $A['masuk_qty'] = $data->SA+0;
                            $A['masuk_nilai'] = "Rp.".number_format($dataA->JUMLAH+0,2,',','.');
                            $Nmasuk = $dataA->JUMLAH+0;
                        } else {
                            $A['masuk_qty'] = $dataA->SA+0;
                            $A['masuk_nilai'] = "Rp.".number_format($dataA->JUMLAH+0,2,',','.');
                            $Nmasuk = $dataA->JUMLAH+0;
                        }
                        if($dataB == null ){
                            $A['keluar_qty'] = 0;
                            $A['keluar_nilai'] = "Rp.".number_format($dataB->JUMLAH+0,2,',','.');
                            $Nkeluar = $dataA->JUMLAH+0;
                        } else {
                            $A['keluar_qty'] = $dataB->SA+0;
                            $A['keluar_nilai'] = "Rp.".number_format($dataB->JUMLAH+0,2,',','.');
                            $Nkeluar = $dataA->JUMLAH+0;
                        }
                        if($dataC == null){
                            
                        } else {
                            
                        }
                    //Masuk & Keluar
                    //Akhir
                        $A['akhir_qty'] = $A['awal_qty']+$A['masuk_qty']-$A['keluar_qty'];
                        $A['akhir_nilai'] = "Rp.".number_format($Nawal+$Nmasuk-$Nkeluar,2,',','.');
                    //Akhir
                } else {
                    $gudang = gudang::select('nama')
                            ->where('kode',$request->gudang)->first();
                    $A['gudang'] = $gudang->nama;
                    //Awal
                        $saldoA = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                                ->where('kode_transaksi','LIKE',"MR%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->first();
                        $saldoB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                                ->where('kode_transaksi','LIKE',"SJ%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->first();
                        if($saldoA == null ){
                            $saldoA = 0;
                        } else {
                            $saldoA = $saldoA->SA;
                        }
                        if($saldoB == null ){
                            $saldoB = 0;
                        } else {
                            $saldoB = $saldoB->SA;
                        }
                        $saldo_awal = $saldoA-$saldoB;
                        $A['awal_qty'] = $saldo_awal;
                        //NILAI AWAL
                        $nilaiA = jurnal ::where('kode_transaksi','LIKE',"MR%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->get();
                        $nilaiawal = 0;
                        foreach($nilaiA as $nilai){
                            $nilaiawal = $nilaiawal + $nilai->jumlah_debit;
                        }

                        $nilaiB = jurnal ::where('kode_transaksi','LIKE',"INV%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->where('created_at','<',$request->awal)->get();
                        $nilaiakhir = 0;
                        foreach($nilaiB as $nilai){
                            $nilaiakhir = $nilaiakhir + $nilai->jumlah_debit;
                        }
                        $A['awal_nilai'] = "Rp.".number_format($nilaiawal-$nilaiakhir,2,',','.');
                        $Nawal = $nilaiawal-$nilaiakhir;
                    //Awal
                    //Masuk & Keluar
                        $dataA = jurnal::select(DB::raw("SUM(qty_debit) as SA"),DB::raw("SUM(jumlah_debit) as JUMLAH"))
                                ->where('kode_transaksi','LIKE',"MR%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                        $dataB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
                                ->where('kode_transaksi','LIKE',"SJ%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                        $dataC = jurnal::select(DB::raw("SUM(jumlah_debit) as JUMLAH"))
                                ->where('kode_transaksi','LIKE',"INV%")
                                ->where('kode_gdg',$request->gudang)
                                ->where('kode_brg',$A->kode)
                                ->where('status','Selesai')
                                ->whereBetween('created_at',[$request->awal,$request->akhir])->first();
                        if($dataA == null ){
                            $A['masuk_qty'] = $data->SA+0;
                            $Nmasuk = $dataA->JUMLAH+0;
                            $A['masuk_nilai'] = $dataA->JUMLAH+0;
                        } else {
                            $A['masuk_qty'] = $dataA->SA+0;
                            $Nmasuk = $dataA->JUMLAH+0;
                            $A['masuk_nilai'] = "Rp.".number_format($dataA->JUMLAH+0,2,',','.');
                        }
                        if($dataB == null ){
                            $A['keluar_qty'] = 0;
                        } else {
                            $A['keluar_qty'] = $dataB->SA+0;
                        }
                        if($dataC == null){
                            $A['keluar_nilai'] = 0;
                            $Nkeluar = 0;
                        } else {
                            $Nkeluar = $dataC->JUMLAH;
                            $A['keluar_nilai'] = "Rp.".number_format($dataC->JUMLAH+0,2,',',);
                        }
                    //Masuk & Keluar
                    //Akhir
                        $A['akhir_qty'] = $A['awal_qty']+$A['masuk_qty']-$A['keluar_qty'];
                        $A['akhir_nilai'] = "Rp.".number_format($Nawal+$Nmasuk-$Nkeluar,2,',','.');
                    //AKhir
                }
           }
           return $data;
        } catch(\Exception $e) {
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
    }
    public function kartu_stock_gudang(Request $request)
    {
        try{
            $data = [];
            $totalmasuk = 0;
            $totalkeluar = 0;
            $totalsaldo = 0;
            $gudang = gudang::select('nama')->where('kode',$request->gudang)->first();
            $barang = barang::where('kode',$request->barang)->first();
            $title['barang'] = $barang->nama;
            $title['gudang']= $gudang->nama;
            $title['satuan'] = $barang->satuan;
            if($request->gudang == "ALL"){

            } else {
                
                //SEBLUMNYA
                    $data[0]['tanggal'] = null;
                    $data[0]['kode_transaksi'] = null;
                    $data[0]['keterangan'] = "Saldo periode Sebelumya";
                    
                    //MASUK
                    $A = jurnal::select(DB::raw("SUM(qty_debit) AS MASUK"))
                        ->where('kode_transaksi','LIKE',"MR%D")
                        ->where('kode_brg',$request->barang)
                        ->where('kode_gdg',$request->gudang)
                        ->where('status','Selesai')
                        ->where('created_at','<',$request->awal)->first();
                    
                    $data[0]['masuk'] = $A->MASUK+0;
                    //KELUAR
                    $B = jurnal::select(DB::raw("SUM(qty_debit) AS KELUAR"))
                        ->where('kode_transaksi','LIKE',"SJ%D")
                        ->where('kode_brg',$request->barang)
                        ->where('kode_gdg',$request->gudang)
                        ->where('status','Selesai')
                        ->where('created_at','<',$request->awal)->first();
                    
                    $data[0]['keluar'] = $B->KELUAR+0;
                    
                    $data[0]['saldo'] = $A->MASUK - $B->KELUAR;
                    $totalmasuk = $totalmasuk+$data[0]['masuk'];
                    $totalkeluar = $totalkeluar+$data[0]['keluar'];
                    $totalsaldo = $totalmasuk-$totalkeluar;
                //SEBELUMNYA
                //DATA
                    $n = 1;
                    $awal = strval($request->awal);
                    $akhir = strval($request->akhir);
                    
                    $dalam =jurnal::select('kode_transaksi','keterangan','qty_debit','qty_kredit')
                        ->where('kode_transaksi','LIKE',"MR%D")
                        ->where('kode_brg',$request->barang)
                        ->where('kode_gdg',$request->gudang)
                        ->where('akun_debit','LIKE','17%')
                        ->where('status','Selesai')
                        ->whereBetween('created_at',[$awal,$akhir])
                        ->orWhere('kode_transaksi','LIKE',"SJ%K")
                        ->where('kode_brg',$request->barang)
                        ->where('kode_gdg',$request->gudang)
                        ->where('akun_debit','LIKE','17%')
                        ->where('status','Selesai')
                        ->whereBetween('created_at',[$awal,$akhir])->get();
                        // foreach($dalam as $d){
                        //     $transaksi = substr($d->kode_transaksi,0,19);
                        //     $date = substr($d->kode_transaksi,6,6);
                        //     $thn = substr($date,0,2); $bln = substr($date,2,2); $tgl = substr($date,4,2);
                        //     $tahun = "20".$thn;
                        //     $date = $tgl."/".$bln."/".$tahun;
                        //     $data[$n]['tanggal']=$date;
                        //     $data[$n]['kode_transaksi']=$transaksi;
                        //     $data[$n]['keterangan']=$d->keterangan;
                        //     $data[$n]['kode_transaksi']= 
                        //     $n++;
                        // }
                    foreach($dalam AS $d){
                        $DK = substr(strrev($d->kode_transaksi),0,1);
                        $transaksi = substr($d->kode_transaksi,0,15);
                        $date = substr($d->kode_transaksi,6,4);
                        $thn = substr($date,0,2); $bln = substr($date,2,2);
                        $tahun = "20".$thn;
                        $date = $bln."/".$tahun;
                        
                        $data[$n]['tanggal']=$date;
                        $data[$n]['kode_transaksi']=$transaksi;
                        $data[$n]['keterangan']=$d->keterangan;
                        if(strpos($d->kode_transaksi,"MR") !== false){
                            //MASUK

                            $data[$n]['masuk'] = $d->qty_debit;
                            $data[$n]['keluar'] = 0;
                            $data[$n]['saldo'] = $d->qty_debit+0;
                            //MASUK
                        } else {
                            $data[$n]['keluar'] = $d->qty_kredit;
                            $data[$n]['masuk'] = 0;
                            $data[$n]['saldo'] = $d->qty_kredit+0;
                        }
                        $totalmasuk = $totalmasuk+$data[$n]['masuk'];
                        $totalkeluar = $totalkeluar+$data[$n]['keluar'];
                        $totalsaldo = $totalmasuk-$totalkeluar;
                        $n++;
                    }
                //DATA
                //TOTAL
                    $data[$n]['tanggal'] = "NA";
                    $data[$n]['kode_transaksi'] = "NA";
                    $data[$n]['keterangan'] = "TOTAL";
                    $data[$n]['masuk'] = $totalmasuk;
                    $data[$n]['keluar'] = $totalkeluar;
                    $data[$n]['saldo'] = $totalsaldo;
                //TOTAL
            }
            // if($request->barang == "ALL"){
            //     $data = jurnal::where('kode_gdg',$request->gudang)
            //         ->whereBetween('created_at',[$request->awal,$request->akhir])
            //         ->get();
            // } else {
            //     $data = jurnal::where('kode_gdg',$request->gudang)
            //         ->where('kode_brg',$request->barang)
            //         ->whereBetween('created_at',[$request->awal,$request->akhir])
            //         ->get();
            // }
            // foreach($data as $A){
            //     $saldoA = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
            //             ->where('kode_transaksi','LIKE','MR%')
            //             ->where('kode_gdg',$A->kode_gdg)
            //             ->where('kode_brg',$A->kode_brg)
            //             ->where('status','!=','Selesai')
            //             ->where('created_at','<',$A->created_at)->first();
            //     $saldoB = jurnal::select(DB::raw("SUM(qty_debit) as SA"))
            //             ->where('kode_transaksi','LIKE','SJ%')
            //             ->where('kode_gdg',$A->kode_gdg)
            //             ->where('kode_brg',$A->kode_brg)
            //             ->where('status','!=','Selesai')
            //             ->where('created_at','<',$A->created_at)->first();
            //     if($saldoA == null ){
            //         $saldoA = 0;
            //     } else {
            //         $saldoA = $saldoA->SA;
            //     }
            //     if($saldoB == null ){
            //         $saldoB = 0;
            //     } else {
            //         $saldoB = $saldoB->SA;
            //     }
            //     $saldo_awal = $saldoA-$saldoB;
            //     $A['saldo_awal'] = $saldo_awal;
            //     $saldo_akhir = $saldo_awal+$A->qty;
            //     $A['saldo_akhir'] = $saldo_akhir;
            // }
            return response()->json(['success'=>true,'title'=>$title,'data'=>$data]);
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

