<?php

namespace App\Http\Controllers;
use App\Models\karyawan;
use App\Models\gudang;
use App\Models\log_sistem;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Response;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = karyawan::select('karyawan.*','users.level')
                ->Leftjoin('users','karyawan.kode','=','users.kode_karyawan')->orderBy('kode');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
            return "
            <button type='button' class='btn btn-default'>Action</button>
            <button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                <span class='sr-only'>Toggle Dropdown</span>
            </button>
            <div class='dropdown-menu' role='menu'>
                <a class='dropdown-item detail' style='color:lightblue;' data-toggle='modal' data-kode='$data->kode'  data-target='#modal-detail-karyawan'><b>Detail</b></a>
                <a class='dropdown-item edit' style='color:orange' data-toggle='modal' data-kode='$data->kode' data-target='#modal-edit-karyawan'><b>Edit</b></a>
                <a class='dropdown-item hapus' style='color:red' data-toggle='modal'  data-nama='$data->nama' data-kode='$data->kode' data-divisi='$data->divisi' data-target='#modal-hapus-karyawan'><b>Hapus</b></a>
            </div>
            ";            
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dropdownmarketing(Request $request)
    {
        
        $marketing = [];
        if($request->has('q')){
            $search = $request->q;
            $marketing =karyawan::select("karyawan.kode", "karyawan.nama")
                    ->join('users','karyawan.kode','=','users.kode_karyawan')
                    ->where('users.level','marketing')
            		->where('karyawan.nama', 'LIKE', "%$search%")
            		->get();
        } else {
            $marketing =karyawan::select("karyawan.kode", "karyawan.nama")
                    ->join('users','karyawan.kode','=','users.kode_karyawan')
                    ->where('users.level','marketing')
            		->get();
        }
        return response()->json($marketing);
    }
    public function create($data)
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

        try{
            $username = User::select('username')->where('username',$request->username)->first();
            if($username == null){
                $lastkode = karyawan::max('kode');
                if($lastkode == null){
                    $new ="NPA.0001";
                } else {
                    $ls = substr($lastkode,4,4);
                    $nwls = $ls+1;
                    $new = "NPA.".sprintf('%04s',$nwls);
                }
                
                $pwd = bcrypt($request->pwd);

                $karyawan = new Karyawan;
                $karyawan->kode = $new;
                $karyawan->nama = $request->nama;
                $karyawan->ttl = $request->ttl;
                $karyawan->telp = $request->telp;
                $karyawan->alamat = $request->alamat;
                $karyawan->divisi = $request->divisi;
                $karyawan->lokasi = $request->lokasi;
                $karyawan->save();

                $users = new User;
                $users->username = $request->username;
                $users->level = $request->role;
                $users->kode_karyawan = $new;
                $users->password = $pwd;
                $users->save();

                $log = new log_sistem();
                $log->transaksi = $new;
                $log->user = $request->user;
                $log->keterangan = "Tambah Data Karyawan";
                $log->save();

                return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Ditambahkan']);
            } else {
                return response()->json(['success'=>false,'pesan'=> 'Username Sudah dipakai']);
            }
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }

        // 
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ubahpassword(Request $request)
    {
        try{
            # Validation
            $request->validate([
                'pwdlama' => 'required',
                'pwd' => 'required|confirmed',
            ]);


            #Match The Old Password
            if(!Hash::check($request->pwdlama, auth()->user()->password)){
                return response()->json(['success'=>false,'pesan'=>'Password yang diinputkan salah']);
            }


            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->pwd)
            ]);

            

            return response()->json(['success'=>true,'pesan'=>'Password berhasil di update']);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        

    }
    public function show($id)
    {
        //
    }
    public function cekusername($request)
    {
        try{
            $username = User::select('username')->where('username',$request->username)->first();
            if($username == null){

            } else {
                return response()->json(['success'=>false,'pesan'=>'Username Sudah Ada']);
            }
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
            $data = karyawan::select('karyawan.*','users.*')->join('users','karyawan.kode','=','users.kode_karyawan')->where('karyawan.kode',$kode)->first();
            $gudang = gudang::select('nama')->where('kode',$data->lokasi)->first();
            $data->namalokasi = $gudang->nama;
            return response()->json(['success'=>true,'result'=> $data]);
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
        try{
            $pwd = bcrypt($request->pwd);
            // $newpwd = md5($pwd);
            // $kode = $request->kode;
            // $queries = DB::table('karyawan')
            // ->select('password')
            // ->where('id',$id)
            // ->get();
            // $pass = $queries[0]['password'];
            // return $pass;
        
            $karyawan = karyawan::where('kode',$kode)->first();
           
            $karyawan->kode = $request->kode;
            $karyawan->nama = $request->nama;
            $karyawan->ttl = $request->ttl;
            $karyawan->telp = $request->telp;
            $karyawan->alamat = $request->alamat;
            $karyawan->divisi = $request->divisi;
            $karyawan->lokasi = $request->lokasi;
            $karyawan->gaji = $request->gaji;
            // $karyawan->save();

            DB::table('karyawan')
            ->where('kode', $kode)
            ->update(['nama' =>$karyawan->nama, 'alamat' => $karyawan->alamat,'role'=> $request->role ,'ttl' => $karyawan->ttl
            , 'telp' => $karyawan->telp, 'divisi' => $karyawan->divisi, 'lokasi' => $karyawan->lokasi, 'gaji' => $karyawan->gaji]);

            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Edit Data Karyawan";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Diubah']);
        } catch(\Exception $e) {
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
        try{
            karyawan::where('kode',$kode)->delete();
            $log = new log_sistem();
            $log->transaksi = $kode;
            $log->user = $request->user;
            $log->keterangan = "Hapus Data Karyawan";
            $log->save();
            return response()->json(['success'=>true,'pesan'=> 'Data Berhasil Dihapus']);
        } catch(\Exception $e){
            return response()->json(['success'=>false,'pesan'=>$e->getMessage()]);
        }
        
    }
}
