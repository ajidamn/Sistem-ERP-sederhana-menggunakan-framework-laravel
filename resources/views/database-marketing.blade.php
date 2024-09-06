<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Database Marketing</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

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
            <h1 class="m-0">Database Marketing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item "><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Database Marketing</li>
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
                  <div class="row justify-content-between">
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Database</button>
                    <button type="button" id="btn-import" data-toggle="modal" data-target="#modal-import"class="btn bg-gradient-info">Import Data</button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                  <table id="tabel-database" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Action</th>
                      <th>Kategori</th>
                      <th>Nama Perusahaan</th>
                      <th>Alamat Kantor</th>
                      <th>Alamat Pabrik</th>
                      <th>Nomor Telp/WA</th>
                      <th>Email</th>
                      <th>Link</th>
                      <th>Medsos</th>
                      <th>Kebutuhan</th>
                      <th>PIC</th>
                      <th>Keterangan</th>
                      <th>Status</th>
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
  <!-- MODAL Tambah  -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-tambah">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Database Marketing</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kategori</label>
                                <input id="tambah_kategori"  class="form-control" type="text" required>
                                <label>Nama Perusahaan </label>
                                <input id="tambah_nama"  class="form-control" type="text" required>
                                <label>Alamat Kantor</label>
                                <input id="tambah_alamat_kantor"  class="form-control" type="text">
                                <label>Alamat Pabrik</label>
                                <input id="tambah_alamat_pabrik" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Rekanan</label>
                                <textarea id="tambah_rekanan" class="form-control" style="resize:none" width="3" placeholder="Tuliskan Nama&Telp"></textarea>
                                <label>Telfon/WA</label>
                                <input id="tambah_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                <label>Email</label>
                                <input id="tambah_email" class="form-control" type="email">
                                <label>Media Sosial</label>
                                <textarea id="tambah-medsos" class="form-control" style="resize:none;" width="3"></textarea>
                                
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>PIC Marketing</label>
                                <select id="tambah_pic"  class="form-control select2 " ></select> 
                                <label>Kebutuhan</label>
                                <textarea id="tambah-kebutuhan" class="form-control" style="resize:none;" width="3"></textarea>
                                <label>Keterangan</label>
                                <textarea id="tambah-keterangan" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-tambah" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
  </div>
<!--/ Modal Tambah -->
<!-- Modal Detail-->
  <div class="modal fade" id="modal-detail">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h4 class="modal-title">Detail Data</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                  <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kode Database</label>
                                <input id="detail_kode"  class="form-control" type="text" readonly>
                                <label>Kategori</label>
                                <input id="detail_kategori"  class="form-control" type="text" readonly>
                                <label>Nama Perusahaan </label>
                                <input id="detail_nama"  class="form-control" type="text" readonly>
                                <label>Alamat Kantor</label>
                                <input id="detail_alamat_kantor"  class="form-control" type="text" readonly>
                                <label>Alamat Pabrik</label>
                                <input id="detail_alamat_pabrik" class="form-control" type="text" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Rekanan</label>
                                <textarea id="detail_rekanan" class="form-control" style="resize:none" width="3" placeholder="Tuliskan Nama&Telp" readonly></textarea>
                                <label>Telfon/WA</label>
                                <input id="detail_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12" readonly>
                                <label>Email</label>
                                <input id="detail_email" class="form-control" type="email" readonly>
                                <label>Media Sosial</label>
                                <textarea id="detail-medsos" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>PIC Marketing</label>
                                <input id="detail_pic" class="form-control" readonly>
                                <label>Kebutuhan</label>
                                <textarea id="detail-kebutuhan" class="form-control" style="resize:none;" width="3" readonly></textarea>
                                <label>Keterangan</label>
                                <textarea id="detail-keterangan" class="form-control" style="resize:none;" width="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between ">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
<!-- /Modal Detail Customer -->
<!-- MODAL Edit Customer -->
  <div class="modal fade" id="modal-edit">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <form id="form-edit">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Database</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kode Database</label>
                                <input id="edit_kode"  class="form-control" type="text" hidden>
                                <label>Kategori</label>
                                <input id="edit_kategori"  class="form-control" type="text" required>
                                <label>Nama Perusahaan </label>
                                <input id="edit_nama"  class="form-control" type="text" required>
                                <label>Alamat Kantor</label>
                                <input id="edit_alamat_kantor"  class="form-control" type="text">
                                <label>Alamat Pabrik</label>
                                <input id="edit_alamat_pabrik" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Rekanan</label>
                                <textarea id="edit_rekanan" class="form-control" style="resize:none" width="3" placeholder="Tuliskan Nama&Telp"></textarea>
                                <label>Telfon/WA</label>
                                <input id="edit_telp" class="form-control" type="text" onkeypress="return angka('evt')" maxlength="12">
                                <label>Email</label>
                                <input id="edit_email" class="form-control" type="email">
                                <label>Media Sosial</label>
                                <textarea id="edit-medsos" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>PIC Marketing</label>
                                <select id="edit_pic"  class="form-control select2 " ></select> 
                                <label>Kebutuhan</label>
                                <textarea id="edit-kebutuhan" class="form-control" style="resize:none;" width="3"></textarea>
                                <label>Keterangan</label>
                                <textarea id="edit-keterangan" class="form-control" style="resize:none;" width="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-edit" class="col-sm-2 form-control btn btn-warning">Edit</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<!--/ Modal Edit Customer -->
<!-- MODAL Hapus Customer -->
  <div class="modal fade" id="modal-hapus">
      <div class="modal-dialog modal-sm">
          <form id="form-hapus">
              <div class="modal-content">
                  <div class="modal-header bg-danger">
                      <h4 class="modal-title">Hapus Database</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="form-group">
                                  Apakah Anda Yakin Akan Menghapus Data ini ?
                                  <input id="hapus_kode" class="form-control" type="text" hidden >
                                  <div class="row">
                                      <label class=" col-md-3">ID </label> 
                                      <h6 class="col-md-6" id="kode"></h6>
                                  </div>
                                  <div class="row">
                                      <label class=" col-md-3">Nama </label> 
                                      <h6 class="col-md-6" id="nama"></h6>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between ">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
<!--/ Modal Hapus Customer -->
 <!-- Modal Import -->
  <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header bg-info">
              <h4 class="modal-title">Import Database</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="upload-data" enctype="multipart/form-data" >
              <div class="row">
                <div class="col-lg-6">
                  <label for="Pilih File">Pilih File Excel</label>
                  <input type="file" id="upload-file" name="upload-file" class="form-control" accept=".xls,.xlsx">
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                  <br>
                  <button type="submit" id="submit-file" class="btn btn-info">Input Data</button>
                </div>
              </div>
            </form>
            <hr>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table id="tabel-preview" class="table table-bordered ">
                      <thead>
                          <th>No.</th>
                          <th>Kategori</th>
                          <th>Nama Perusahaan</th>
                          <th>Alamat Kantor</th>
                          <th>Alamat Pabrik</th>
                          <th>Nomor Telp/WA</th>
                          <th>Email</th>
                          <th>Orang Dalam</th>
                          <th>Medsos</th>
                          <th>Kebutuhan</th>
                          <th>PIC</th>
                          <th>Keterangan</th>
                          <th>Status</th>
                      </thead>
                      <tbody id="body-tabel-preview"></tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between ">
            <input type="file" id="import-file" name="import-file" class="form-control" hidden>
            <button type="button"  id="edt-btn-cancel-edit-barang" data-dismiss="modal" class="col-sm-4 form-control btn btn-default">Cancel</button>
            <button type="button"  id="submit-import" class="col-sm-4 form-control btn btn-info ">Upload Barang</button>
          </div>
      </div>
    </div>
  </div>
<!--/ Modal Import -->
<!--/ MODAL -->

<!-- /MODAL -->
  <!-- /.content-wrapper -->
  @include('layout/footer')

</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
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
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<script>
    
    
    $(document).ready(function() {   
    $('#tabel-database').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-dbmarketing") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'kategori', name: 'kategori',orderable:false},
            { data: 'nama_perusahaan', name: 'nama_perusahaan',orderable:true},
            { data: 'alamat_kantor', name: 'alamat_kantor',orderable:false},
            { data: 'alamat_pabrik', name: 'alamat_pabrik',orderable:false},
            { data: 'telp_wa', name: 'telp_wa',orderable:false},
            { data: 'email', name: 'email',orderable:false},
            { data: 'orang_dalam', name: 'orang_dalam',orderable:false},
            { data: 'medsos', name: 'medsos',orderable:false},
            { data: 'kebutuhan', name: 'kebutuhan',orderable:false},
            { data: 'PIC', name: 'PIC',orderable:false},
            { data: 'keterangan', name: 'keterangan',orderable:false},
            { data: 'status', name: 'status',orderable:false},
        ]
    });
  }); 
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  function angka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    } 

//Tambah Data
  $(document).on('click','#tambahdata',function(){
    document.getElementById("form-tambah").reset();
    
    $('#tambah_pic').empty();
    $.ajax({
      url :'{!! url("dropdown-marketing") !!}',
      type : 'get',
      success : function(data){
        var datahandler = $('#tambah_pic');
        var Nrow = $("<option value=''>Pilih Marketing</option>");
        datahandler.append(Nrow);
        var Nrow = $("<option value='-'>-</option>");
        datahandler.append(Nrow);
        $.each(data, function(key,val){
          var Nrow = $("<option value='"+val.kode+"'>"+val.nama+"</option>");
          datahandler.append(Nrow);
        });
        
      }
    });
  });
  $('#form-tambah').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-tambah');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    $.ajax({
      type: 'post',
      url: '{!! url("data-dbmarketing") !!}',
      data : {
        user        : "{{$user->kode_karyawan}}",
        kategori    : $('#tambah-kategori').val(),
        nama        : $('#tambah_nama').val(),
        _token      : token,
        kantor      : $('#tambah_alamat_kantor').val(),
        pabrik      : $('#tambah_alamat_pabrik').val(),
        rekanan     : $('#tambah_rekanan').val(),
        telp        : $('#tambah_telp').val(),
        email       : $('#tambah_email').val(),
        medsos      : $('#tambah-medsos').val(),
        pic         : $('#tambah_pic').val(),
        kebutuhan   : $('#tambah-kebutuhan').val(),
        keterangan  : $('#tambah-keterangan').val(),
      }, // serializes form input
      success:function(response) {
        console.log(response);
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-tambah').modal('hide');
          var table = $('#tabel-database').DataTable(); 
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
//Tambah Data
//Detail Data
  $('body').on('click', '.detail', function () {
      var kode = $(this).data('kode');
      $.ajax({
        url :'{!! url("data-dbmarketing/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
          $('#detail_kategori').val(response.data.kategori);
          $('#detail_nama').val(response.data.nama_perusahaan);
          $('#detail_alamat_kantor').val(response.data.alamat_kantor);
          $('#detail_alamat_pabrik').val(response.data.alamat_pabrik);
          $('#detail_rekanan').val(response.data.orang_dalam);
          $('#detail_telp').val(response.data.telp_wa);
          $('#detail_email').val(response.data.email);
          $('#detail-medsos').val(response.data.medsos);
          $('#detail_pic').val(response.data.marketing);
          $('#detail-kebutuhan').val(response.data.kebutuhan);
          $('#detail-keterangan').val(response.data.keterangan);
        }
      });
  });
//Detail Data
//Edit Data
  $('body').on('click', '.edit', function () {
      var kode = $(this).data('kode');
      $('#edit_pic').empty();
      
      $.ajax({
        url :'{!! url("data-dbmarketing/'+kode+'/edit") !!}',
        type : 'get',
        success : function(response){
            console.log(response);
          $('#edit-kode').val(kode);
          $('#edit_kategori').val(response.data.kategori);
          $('#edit_nama').val(response.data.nama_perusahaan);
          $('#edit_alamat_kantor').val(response.data.alamat_kantor);
          $('#edit_alamat_pabrik').val(response.data.alamat_pabrik);
          $('#edit_rekanan').val(response.data.orang_dalam);
          $('#edit_telp').val(response.data.telp_wa);
          $('#edit_email').val(response.data.email);
          $('#edit-medsos').val(response.data.medsos);
          $('#edit-kebutuhan').val(response.data.kebutuhan);
          $('#edit-keterangan').val(response.data.keterangan);
          $('#detail_pic')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(response.data.PIC) //set value for option to post it
                .text(response.data.PIC+" - "+response.data.marketing )) //set a text for show in select
            .val(response.data.PIC) //select option of select2
            .trigger("change"); //apply to select2
          
        }
      });
  });
  
  $('#form-edit').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-edit');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode = $('#edit_kode').val();
    $.ajax({
      type: 'PUT',
      url: '{!! url("data-dbmarketing/'+kode+'") !!}',
      data : {
        user        : "{{$user->kode_karyawan}}",
        kategori    : $('#edit-kategori').val(),
        nama        : $('#edit_nama').val(),
        _token      : token,
        kantor      : $('#edit_alamat_kantor').val(),
        pabrik      : $('#edit_alamat_pabrik').val(),
        rekanan     : $('#edit_rekanan').val(),
        telp        : $('#edit_telp').val(),
        email       : $('#edit_email').val(),
        medsos      : $('#edit-medsos').val(),
        pic         : $('#edit_pic').val(),
        kebutuhan   : $('#edit-kebutuhan').val(),
        keterangan  : $('#edit-keterangan').val(),
      }, // serializes form input
      success:function(response) {
        var hasil = response.pesan;
        if(response.success == true){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-edit').modal('hide');
          var table = $('#tabel-database').DataTable(); 
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
  
//Edit Data
//Hapus Data
  $('body').on('click', '.hapus', function () {
      document.getElementById("form-hapus").reset();
      var nama = $(this).data('nama');
      var kode = $(this).data('kode');
      document.getElementById("kode").innerHTML = kode;
      document.getElementById("nama").innerHTML = nama;
      $('#hapus_kode').val(kode);

  });
 
  $('#form-hapus').submit(function(e){
    e.preventDefault(); // prevent actual form submit
    var el = $('#btn-hapus');
    el.prop('readonly', true);
    setTimeout(function(){el.prop('readonly', false); }, 3000);
    var token = "{!! csrf_token() !!}";
    var kode =  $('#hapus_kode').val();
    $.ajax({
      type    : 'delete',
      url     : '{!! url("data-rekanan/'+kode+'") !!}',
      data    : {
        _token  : token,
        user : "{{$user->kode_karyawan}}",
      },
      success:function(response) {
        console.log(response);
        var hasil = response.pesan;
        if(response.success){
          Toast.fire({
            icon: 'success',
            title: hasil
          })
          $('#modal-hapus').modal('hide');
          var table = $('#tabel-rekanan').DataTable(); 
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
//Hapus Data
//Import Data
   $('#btn-import').on('click',function(){
      document.getElementById("upload-data").reset();
      $('#upload-file').prop('disabled',false);
      $('#body-table-preview').empty();
    });
    $('#upload-data').submit(function(e){
      e.preventDefault(); // prevent actual form submit
      var el = $('#submit-file');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: '{!! url("upload-rekanan") !!}',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          if(data.success == true){
            Toast.fire({
              icon  : 'success',
              title : data.pesan,
            });
            $('#upload-file').prop('disabled',true);
            $('#body-tabel-preview').empty();
            var datahandler = $('#body-tabel-preview');
            console.log(data.data);
            var n= 0;
            $.each(data.data[0], function(key,val){
                var nomor = n+1;
                var Nrow = $("<tr>");
                Nrow.html("<td>"+nomor+"</td><td>"+data.data[0][n][0]+"</td><td>"+data.data[0][n][1]+"</td><td>"+data.data[0][n][2]+"</td><td>"+data.data[0][n][3]+"</td><td>"+data.data[0][n][4]+"</td><td>"+data.data[0][n][5]+"</td><td>"+data.data[0][n][6]+"</td><td>"+data.data[0][n][7]+"</td></tr>");
                datahandler.append(Nrow);
                n = n+1;
            });
          } else {
            Toast.fire({
              icon  : 'error',
              title  : data.pesan
            });
          }
          console.log(data);
        }
      });
    });
    $('#submit-import').on('click',function(e){
      var el = $('#submit-import');
      el.prop('disabled', true);
      setTimeout(function(){el.prop('disabled', false); }, 4000);
      var formData = new FormData('#upload-data');
      console.log(formData);
    });
    // $('#import-data').submit(function(e){
    //   var el = $('#submit-import');
    //   el.prop('disabled', true);
    //   setTimeout(function(){el.prop('disabled', false); }, 4000);
    //   var formData = new FormData('#upload-data');
    //   console.log(formData);
    //   $.ajax({
    //     type: 'POST',
    //     url: '{!! url("import-barang") !!}',
    //     data: formData,
    //     processData: false,
    //     contentType: false,
    //     success: function(response) {
    //       console.log(response);
    //       if(response.success == true){
    //         Toast.fire({
    //           icon  : "success",
    //           title : response.pesan
    //         });
            
    //       } else {
    //         Toast.fire({
    //           icon  : 'error',
    //           title  : response.pesan
    //         });
    //       }
          
    //     }
    //   });
    // });
//Import Data
</script>
</body>
</html>
