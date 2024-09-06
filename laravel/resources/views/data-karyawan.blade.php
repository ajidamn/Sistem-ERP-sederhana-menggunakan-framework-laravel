<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Data Karyawan</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
    
    <h4><b> Nusa Pratama Anugerah </b></h4>
  </div> 
  @include('layout/navbar')

  <!-- Main Sidebar Container -->
  @include('layout/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah-karyawan"class="btn  bg-gradient-primary">Tambah Karyawan</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="tabel-karyawan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Action</th>
                      <th>Kode Karyawan</th>
                      <th>Nama Karyawan</th>
                      <th>Role</th>
                      <th>Nomor Telp</th>
                      <th>Divisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- MODAL -->
    <!-- MODAL Tambah Karyawan -->
      <div class="modal fade" id="modal-tambah-karyawan">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-primary">
              <h4 class="modal-title">Tambah Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <form id="tambahkaryawan" >
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Nama Karyawan </label>
                      <input id="tambah_nama_karyawan"  class="form-control" type="text" required>
                      <label>Username</label>
                      <input type="text" id="tambah_username_karyawan" class="form-control" required placeholder="menggunakan hurug kecil semua">
                      <label>Tanggal Lahir </label>
                      <input id="tambah_tgl_karyawan"  class="form-control" type="date" required>
                      <label>Nomor Telepon</label>
                      <input id="tambah_telp_karyawan"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required>
                      <label>Alamat</label>
                      <textarea id="tambah_alamat_karyawan" class="form-control"  rows="3" placeholder="Alamat Lengkap" required></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label>Password</label>
                    <input id="tambah_pwd_karyawan" class="form-control" type="password" maxlength="12" minlength="6" required>
                    
                    <label> Divisi</label>
                    <select id="tambah_divisi_karyawan"  class="form-control select2" required>
                      <option value="">Pilih Divisi</option>
                      <option value="Accounting">Accounting</option>
                      <option value="Administrasi">Administasi</option>
                      <option value="Administrasi Internal">Administasi Internal </option>
                      <option value="Desain Grafis">Desain Grafis</option>
                      <option value="IT/jaringan">IT/Jaringan</option>
                      <option value="Manager Operasional">Manager Operasional</option>
                      <option value="Manager Marketing">Manager Marketing</option>
                      <option value="Marketing Agro-Chemidal">Marketing Agro-Chemical</option>
                      <option value="Marketing Chemical-Industri">Marketing Chemical-Industri</option>
                      <option value="Marketing Chemical Cleaning">Marketing Chemical Cleaning</option>
                      <option value="RnD">Research and Development</option>
                    </select>
                    <label >Role</label>
                    <select id="tambah_role_karyawan" class="form-control" required>
                      <option value="">Pilih Role</option>
                      <option value="super-admin">Super Admin</option>
                      <option value="admin">Admin Penjualan</option>
                      <option value="purchasing">Purchasing</option>
                      <option value="accounting">Accounting</option>
                      <option value="manager-operasional">Operasional Manager</option>
                      <option value="marketing">Marketing</option>
                      <option value="manager-marketing">Marketing Manager</option>
                    </select>
                    <label>Penempatan</label>
                    <select id="tambah_penempatan_karyawan"  class="form-control select2" required>
                    </select>
                    
                    
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between ">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="btn-tambah" class="btn btn-save btn-primary">Simpan</button>
              </div>
          </form>
          </div>
          </div>
      </div>
    <!--/ Modal Tambah Karyawan -->
    <!-- Modal Detail Karyawan -->
      <div class="modal fade" id="modal-detail-karyawan">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
            <h4 class="modal-title">Detail Data Karyawan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Kode Karyawan</label>
                    <input id="detail_kode_karyawan" class="form-control" type="text" required readonly>
                    <label>Nama Karyawan </label>
                    <input id="detail_nama_karyawan" class="form-control" type="text" required>
                    <label >Usename</label>
                    <input type="text" id="detail_username_karyawan" class="form-control" readonly>
                    <label>Tanggal Lahir </label>
                    <input id="detail_tgl_karyawan"  class="form-control" type="date">
                    <label>Nomor Telepon</label>
                    <input id="detail_telp_karyawan"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required>
                    <label>Alamat</label>
                    <textarea id="detail_alamat_karyawan"  class="form-control"  rows="3" placeholder="Alamat Lengkap""></textarea>
                  </div>
                </div>
                <div class="col-lg-6">
                  <label> Divisi</label>
                  <input type="text" id="detail_divisi_karyawan" class="form-control" disabled>
                  <label> Role</label>
                  <input type="text" class="form-control" id="detail_role_karyawan" readonly>
                  <label>Penempatan</label>
                  <input id="detail_penempatan_karyawan"  class="form-control" type="text" readonly>
                  
                  
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between ">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
        </div>
      </div>
    <!--/ Modal Detail Karyawan -->
    <!-- MODAL Edit Karyawan -->
      <div class="modal fade" id="modal-edit-karyawan">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header bg-warning">
              <h4 class="modal-title">Edit Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <form id="editkaryawan">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label>Kode Karyawan</label>
                      <input id="edt_kode" class="form-control" type="text" required readonly>
                      
                      <label>Nama Karyawan </label>
                      <input id="edit_nama_karyawan" class="form-control" type="text" required>
                      <label>Username</label>
                      <input type="text" id="edit_username" hidden>
                      <input type="text" id="edit_username_karyawan" class="form-control" required>
                      <label>Tanggal Lahir </label>
                      <input id="edit_tgl_karyawan"  class="form-control" type="date">
                      
                      <label>Nomor Telepon</label>
                      <input id="edit_telp_karyawan"  class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" required>
                      
                      <label>Alamat</label>
                      <textarea id="edit_alamat_karyawan" class="form-control"  rows="3" placeholder="Alamat Lengkap""></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label>Password</label>
                    <input type="text" id="edit_pasword" hidden>
                    <input id="edit_pwd_karyawan"  class="form-control" type="password" maxlength="12" minlength="6" >
                    
                    <label>Ketik Ulang Password</label>
                    <input id="edit_newpwd_karyawan"  class="form-control" type="password" maxlength="12" minlength="6" >
                    
                    <label> Divisi</label>
                    <select id="edit_divisi_karyawan"  class="form-control select2" >
                      <option value="">Pilih Divisi</option>
                      <option value="Accounting">Accounting</option>
                      <option value="Administrasi">Administasi</option>
                      <option value="Administrasi Internal">Administasi Internal </option>
                      <option value="Desain Grafis">Desain Grafis</option>
                      <option value="IT/jaringan">IT/Jaringan</option>
                      <option value="Manager Operasional">Manager Operasional</option>
                      <option value="Manager Marketing">Manager Marketing</option>
                      <option value="Marketing Agro-Chemidal">Marketing Agro-Chemical</option>
                      <option value="Marketing Chemical-Industri">Marketing Chemical-Industri</option>
                      <option value="Marketing Chemical Cleaning">Marketing Chemical Cleaning</option>
                      <option value="RnD">Research and Development</option>
                    </select>
                    <label>Role</label>
                    <select id="edit_role_karyawan" class="form-control">
                      <option value="super-admin">Super Admin</option>
                      <option value="admin">Admin Penjualan</option>
                      <option value="purchasing">Purchasing</option>
                      <option value="accounting">Accounting</option>
                      <option value="manajemen-operasional">Manajemen Operasional</option>
                      <option value="marketing">Marketing</option>
                      <option value="manager-marketing">Marketing Manager</option>
                    </select>
                    <label>Penempatan</label>
                    <select id="edit_penempatan_karyawan"  class="form-control select2" >
                    </select>
                    
                    <label>Gaji</label>
                    <input id="edit_gaji_karyawan"  class="form-control" type="number" min="1500000" max="15000000" >
                    
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between ">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="btn-edit" class=" col-sm-2 form-control btn btn-warning">Edit</button>
              </div>
          </form>
          </div>
          </div>
      </div>
    <!--/ Modal Edit Karyawan -->
    <!-- MODAL Hapus Karyawan -->
      <div class="modal fade" id="modal-hapus-karyawan">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="hapuskaryawan">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    Apakah Anda Yakin Akan Menghapus Data ini ?
                    <input id="hapus_kode_karyawan"  class="form-control" type="text" hidden >
                    <div class="row">
                      <label class=" col-md-3">Kode </label> 
                      <h6 class="col-md-6" id="hapus_kode"></h6>
                    </div>
                    <div class="row">
                      <label class=" col-md-3">Nama </label> 
                      <h6 class="col-md-6" id="hapus_nama"></h6>
                    </div>
                    <div class="row">
                      <label class=" col-md-3">Divisi </label> 
                      <h6 class="col-md-6"id="hapus_divisi"></h6>
                    </div>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between ">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
            </div>
        </form>
          </div>
        </div>
      </div>
    <!--/ Modal Hapus Karyawan -->

<!-- /MODAL -->
  <!-- /.content-wrapper -->
  @include('layout/footer')

</div>
<!-- ./wrapper -->

!-- jQuery -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('AdminLTE/plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script>
    
  $(document).ready(function() {   
    $('#tabel-karyawan').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-karyawan") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kode', name: 'kode',orderable:true},
            { data: 'nama', name: 'nama',orderable:true},
            { data: 'level', name: 'level',orderable:true},
            { data: 'telp', name: 'telp',orderable:true},           
            { data: 'divisi', name: 'divisi',orderable:true},
            
        ]
    });
  });  
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });
  $('#tambahkaryawan').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-karyawan") !!}',
      data : {
        nama : $('#tambah_nama_karyawan').val(),
        _token : token,
        ttl : $('#tambah_tgl_karyawan').val(),
        telp : $('#tambah_telp_karyawan').val(),
        username:$('#tambah_username_karyawan').val(),
        alamat : $('#tambah_alamat_karyawan').val(),
        divisi : $('#tambah_divisi_karyawan').val(),
        role    : $('#tambah_role_karyawan').val(),
        lokasi : $('#tambah_penempatan_karyawan').val(),
        pwd : $('#tambah_pwd_karyawan').val(),
        user  : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        console.log(response);
        var hasil = response.pesan;
        if(hasil == 'Data Berhasil Ditambahkan'){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-tambah-karyawan').modal('hide');
          var table = $('#tabel-karyawan').DataTable(); 
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: hasil
          })
        }
        
      }
    });
  });

  $('#editkaryawan').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edt_kode').val();
    var username = $('#edit_username').val();
    if(username == $('#edit_username_karyawan').val()){

    } else {
      $.ajax({
        type: 'get',
        url : '{!!url("cek-username")!!}',
        data: {username:$('#edit_username_karyawan').val(),},
        success:function(response){
          console.log(response);
          if(response.success == true ){

          } else {
            Toast.fire({
              icon: 'error',
              title: response.pesan
            })
            return false;
          }
        }
      });
    }
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-karyawan/'+kode+'") !!}',
      data : {
        nama    : $('#edit_nama_karyawan').val(),
        kode    : $('#edt_kode').val(),
        _token  : token,
        username : $('#edit_username_karyawan').val(),
        ttl     : $('#edit_tgl_karyawan').val(),
        telp    : $('#edit_telp_karyawan').val(),
        alamat  : $('#edit_alamat_karyawan').val(),
        role    : $('#edit_role_karyawan').val(),
        divisi  : $('#edit_divisi_karyawan').val(),
        lokasi  : $('#edit_penempatan_karyawan').val(),
        pwd     : $('#edit_pwd_karyawan').val(),
        pwd2    : $('#edit_newpwd_karyawan').val(),
        user  : "{{$user->kode_karyawan}}",
      }, // serializes form input
      success:function(response) {
        console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit-karyawan').modal('hide');
          var table = $('#tabel-karyawan').DataTable(); 
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: hasil
          })
        }
        
      }
    });
  });
  $('#hapuskaryawan').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#hapus_kode_karyawan').val();
    
    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-karyawan/'+kode+'") !!}',
      data    : {
        user  : "{{$user->kode_karyawan}}",
        _token  : token,
      },
      success:function(response) {
        console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-hapus-karyawan').modal('hide');
          var table = $('#tabel-karyawan').DataTable(); 
          table.ajax.reload( null, false );
        } else {
          Toast.fire({
            icon: 'error',
            title: hasil
          })  
        }
      }
    });
  });

  function angka(evt){
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

          return false;
      return true;
  } 

  $(document).on('click','#tambahdata',function(){
    document.getElementById("tambahkaryawan").reset();
    $('#tambah_penempatan_karyawan').empty();
    $.ajax({
      url :'{!! url("dropdown-gudang") !!}',
      type : 'get',
      success : function(response){
        console.log(response);
        var datahandler = $('#tambah_penempatan_karyawan');
        var Nrow = $("<option value=''>Pilih Penempatan</option>");
        datahandler.append(Nrow);
        $.each(response, function(key,val){
          var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
          datahandler.append(Nrow);
        });
      }
    });
    
  });
  $('body').on('click', '.edit', function () {
    var kode = $(this).data('kode');
    document.getElementById("editkaryawan").reset();
    $.ajax({
      url :'{!! url("data-karyawan/'+kode+'/edit") !!}',
      type : 'get',
      success : function(response){
        Toast.fire({
          icon: 'info',
          title: 'Password tidak perlu di isi jika tidak dirubah'
        })
        $('#edit_penempatan_karyawan').empty();
        $.ajax({
          url :'{!! url("dropdown-gudang") !!}',
          type : 'get',
          success : function(data){
            var datahandler = $('#edit_penempatan_karyawan');
            $.each(data, function(key,val){
              var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
              datahandler.append(Nrow);
            });
            
          }
        });
        console.log(response.result);
        var kode = response.result.kode;
        $('#edt_kode').val(kode);
        $('#edit_nama_karyawan').val(response.result.nama);
        $('#edit_tgl_karyawan').val(response.result.ttl);
        $('#edit_alamat_karyawan').val(response.result.alamat);
        $('#edit_username_karyawan').val(response.result.username);
        $('#edit_username').val(response.result.username);
        $('#edit_telp_karyawan').val(response.result.telp);
        $('#edit_role_karyawan').val(response.result.role);
        $('#edit_penempatan_karyawan').append('<option value="'+response.result.lokasi+'" selected>'+response.result.namalokasi+'</option>');
        $('#edit_divisi_karyawan').append('<option value="'+response.result.divisi+'" selected>'+response.result.divisi+'</option>');
        var gaji = response.result.gaji;
        $('#edit_gaji_karyawan').val(response.result.gaji);
      }
    });
  });
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-karyawan/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          console.log(response.result);
          $('#detail_kode_karyawan').val(kode);
          $('#detail_nama_karyawan').val(response.result.nama);
          $('#detail_tgl_karyawan').val(response.result.ttl);
          $('#detail_alamat_karyawan').val(response.result.alamat);
          $('#detail_telp_karyawan').val(response.result.telp);
          $('#detail_username_karyawan').val(response.result.username);
          $('#detail_role_karyawan').val(response.result.role);
          $('#detail_penempatan_karyawan').val(response.result.namalokasi);
          $('#detail_divisi_karyawan').val(response.result.divisi);
          var gaji = response.result.gaji;
          $('#detail_gaji_karyawan').val(formatRupiah(response.result.gaji));
        }
      });
  });
  $('body').on('click', '.hapus', function () {
      document.getElementById("hapuskaryawan").reset();
      
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      var divisi = $(this).data('divisi');
      document.getElementById("hapus_kode").innerHTML = kode;
      document.getElementById("hapus_nama").innerHTML = nama;
      document.getElementById("hapus_divisi").innerHTML = divisi;
      $('#hapus_kode_karyawan').val(kode);
  });
  function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
      { style: 'currency', currency: 'IDR' }
    ).format(money);
  }
  
  
</script>
</body>
</html>
