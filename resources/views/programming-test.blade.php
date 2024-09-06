<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Transcon</title>
  </head>
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
  
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Preloader -->
      <!-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
        
        <h4><b> Nusa Pratama Anugerah </b></h4>
      </div>  -->
      <!-- Navbar -->
      @include('layout/navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('layout/sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Programming Test</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Programming Test</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <button type="button" id="tambahdata" data-toggle="modal" data-backdrop="static" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Purchase Order</button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <table id="tabel" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Transaksi</th>
                          <th>Total Item</th>
                          <th>Total QTY</th>
                          <th>Action</th>
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
      <!-- /.content-wrapper -->
      @include('layout/footer')
    <!-- MODAL -->
      <!-- MODAL Tambah Purchase Order -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg ">
              <div class="modal-content">
                  
                      <div class="modal-header bg-primary">
                          <h4 class="modal-title">Tambah Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>Transaction No.</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" id="id_transaksi" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>Transaction Date.</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="date" id="tgl_transaksi" class="form-control">
                                        </div>
                                    </div>
                                </div>  
                            </div>
                  
                          <br>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-primary card-outline" >
                                <div class="card-header">
                                  <button type="button" id="add-detail" class=" btn btn-primary" >Tambah Barang</button>
                                  <div class="row" id="tambah-detail">
                                    <form id="form-tambah-detail">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label>Item Name</label>
                                            <input type="text" id="tambah-nama-item" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Quantity</label>
                                            <input id="tambah-qty-item" class="form-control" step="any" type="number" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <br>
                                          <button type="submit"  id="btn-tambah-item" class=" form-control btn btn-primary ">Tambah Barang</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="row" id="edit-detail">
                                    <form id="form-edit-detail">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label>Item Name</label>
                                            <input type="hidden" id="edit-id-item" class="form-control" hidden>
                                            <input type="text" id="edit-nama-item" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Quantity</label>
                                            <input id="edit-qty-item" class="form-control" step="any" type="number" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <br>
                                            <div class="row justify-content-between">
                                                <button type="button"  id="btn-cancel-edit" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                                <button type="submit"  id="btn-edit-item" class="col-sm-5 form-control btn btn-warning ">Edit Item</button>
                                            </div>
                                          
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="row" id="hapus-detail">
                                    <form id="form-hapus-detail">
                                      <input id="hapus-kode-item" class="form-control" type="text" hidden>
                                      <div class="row justify-content-center ">
                                        <label> Apakah Anda yakin akan menghapus Item ini ??</label>
                                      </div>
                                      <div class="row justify-content-center" > 
                                            <label class="col-lg-3">Nama Item </label>
                                            <label id ="hapus-nama-item" class="col-lg-9"></label>
                                      </div>
                                      <br>
                                      <div class="row justify-content-between ">
                                        <button type="button"  id="btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                        <button type="submit"  id="btn-hapus-item" class="col-lg-5 form-control btn btn-danger ">Hapus Item</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="card-body table-responsive">
                                  <table id="table-detail"class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th >No</th>
                                      <th >Action</th>
                                      <th >Item</th>
                                      <th >QTY</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body-tabel-tambah" >
                                      
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    <form id="form-tambah">
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="tambah-close" class=" ext col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-tambah-transaksi" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                      </div>
                    </form>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Purchase Order -->
      <!-- MODAL Edit Purchase Order -->
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>Transaction No.</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="text" id="edt-id_transaksi" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label>Transaction Date.</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <input type="date" id="edt-tgl_transaksi" class="form-control">
                                        </div>
                                    </div>
                                </div>  
                            </div>
                    
                            <br>
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-warning card-outline" >
                                <div class="card-header">
                                    <button type="button" id="edt-add-detail" class=" btn btn-primary" >Tambah Item</button>
                                    <div class="row" id="edt-tambah-detail">
                                    <form id="edt-form-tambah-detail">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <label>Item Name</label>
                                            <input type="text" id="edt-tambah-nama-item" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Quantity</label>
                                            <input id="edt-tambah-qty-item" class="form-control" step="any" type="number" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <br>
                                            <button type="submit"  id="edt-btn-tambah-item" class=" form-control btn btn-primary ">Tambah Barang</button>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="row" id="edt-edit-detail">
                                    <form id="edt-form-edit-detail">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <label>Item Name</label>
                                            <input type="text" id="edt-edit-nama-item" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Quantity</label>
                                            <input id="edt-edit-qty-item" class="form-control" step="any" type="number" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <br>
                                            <div class="row justify-content-between">
                                                <button type="button"  id="edt-btn-cancel-edit" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                                <button type="submit"  id="edt-btn-edit-item" class="col-sm-5 form-control btn btn-warning ">Edit Item</button>
                                            </div>
                                            
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="row" id="edt-hapus-detail">
                                    <form id="edt-form-hapus-detail">
                                        <input id="edt-hapus-kode-item" class="form-control" type="text" hidden>
                                        <div class="row justify-content-center ">
                                        <label> Apakah Anda yakin akan menghapus Item ini ??</label>
                                        </div>
                                        <div class="row justify-content-center" > 
                                            <label class="col-lg-3">Nama Item </label>
                                            <label id ="edt-hapus-nama-item" class="col-lg-9"></label>
                                        </div>
                                        <br>
                                        <div class="row justify-content-between ">
                                        <button type="button"  id="edt-btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                        <button type="submit"  id="edt-btn-hapus-item" class="col-lg-5 form-control btn btn-danger ">Hapus Item</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="edt-table-detail"class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th >Action</th>
                                        <th >No.</th>
                                        <th >Nama Barang</th>
                                        <th >QTY</th>
                                    </tr>
                                    </thead>
                                    <tbody id="body-tabel-edit" >
                                        
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    <form id="form-edit">
                        <div class="modal-footer justify-content-between ">
                            <button type="button" id="edt-tambah-close" class=" ext col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="edt-btn-tambah-transaksi" class="col-sm-2 form-control btn btn-warning">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      <!--/ Modal Edit Purchase Order -->
      
      <!-- MODAL Detail Purchase Order -->
      <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Detail Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="row">
                                      <div class="col-lg-2">
                                          <label>Transaction No.</label>
                                      </div>
                                      <div class="col-lg-10">
                                          <input type="text" id="detail-id_transaksi" class="form-control" readonly>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-lg-2">
                                          <label>Transaction Date.</label>
                                      </div>
                                      <div class="col-lg-10">
                                          <input type="date" id="detail-tgl_transaksi" class="form-control" readonly>
                                      </div>
                                  </div>
                              </div>   
                          </div>
                
                        <br>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card card-info card-outline" >
                              <div class="card-header">
                                
                              </div>
                              <div class="card-body table-responsive">
                                <table id="table-detail"class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th >No.</th>
                                    <th >Nama Barang</th>
                                    <th >QTY</th>
                                  </tr>
                                  </thead>
                                  <tbody id="body-tabel-detail" >
                                    
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button"  class=" ext col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
      </div>
      <!--/ Modal Detail Purchase Order -->
      <!-- MODAL Hapus PO -->
        <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data Transaksi</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus-id-transaksi" class="form-control" type="text" hidden >
                                      
                                      
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
      <!--/ Modal Hapus PO -->
      
    <!--/ MODAL -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('AdminLTE/plugins')}}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/jszip/jszip.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
    <script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    
    <script src="{{asset('AdminLTE/dist')}}/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- Page specific script -->
    <script>
      function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };
      
      $(document).ready(function() {   
        $('#tabel').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-transaksi") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'no_transaction', name: 'no_transaction',orderable:true},
                { data: 'item', name: 'item',orderable:true},
                { data: 'qty', name: 'qty',orderable:true},
                { data: 'action', name: 'action',orderable:false, searchable:false},
            ]
        });
        
      }); 
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
      }
      // TAMBAH DATA
        $(document).on('click','#tambahdata', function(){
          document.getElementById("form-tambah").reset();
          
          $('#body-tabel-tambah').empty();
          $('#add-barang').hide();
          $.ajax({
            url :'{!! url("last-transaksi") !!}',
            type : 'get',
            success:function(response){
                console.log(response);
                $('#id_transaksi').val(response);
            }
          })
          var token = "{!! csrf_token() !!}";
          $('#tambah-detail').hide();
          $('#edit-detail').hide();
          $('#hapus-detail').hide();
          $('#tgl_transaksi').val("");
          $('#tgl_transaksi').focus();
        });
        
        function tabelitem(kode){
          $.ajax({
            url :'{!! url("data-detail/'+kode+'") !!}',
            type : 'get',
            success : function(response){
              console.log(response);
              if (response.success == true){
                $('#body-tabel-tambah').empty();
                var datahandler = $('#body-tabel-tambah');
                var n= 0;
                $.each(response.data, function(key,val){
                    var Nrow = $("<tr>");
                      var nomor = n+1;
                    Nrow.html("<td>"+nomor+"</td><td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['id']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red'  data-kode='"+response.data[n]['id']+"' ><b>Hapus</b></a></div></td><td>"+response.data[n]['item']+"</td><td>"+response.data[n]['qty']+"</td></tr>");
                    datahandler.append(Nrow);
                    n = n+1;
                });
              } else {
                Toast.fire({
                  icon: 'error',
                  title: response.pesan
                })
              }
              
            }
          });
        }
        //Tambah Barang
          $('#add-detail').on('click',function (){
            $('#tambah-detail').show();
            document.getElementById("form-tambah-detail").reset();
            $('#add-detail').hide();
          });
          
          $('#form-tambah-detail').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-detail');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var transaksi = $('#id_transaksi').val();
            $.ajax({
              type: 'post',
              url: '{!! url("data-detail") !!}',
              data : {
                item       : $('#tambah-nama-item').val(),
                _token     : token,
                qty        : $('#tambah-qty-item').val(),
                transaksi  : transaksi,
                
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelitem(transaksi);
                  document.getElementById("form-tambah-detail").reset();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
                
              }
            });
          });
        //Tambah Barang
        //Edit Barang
          $('body').on('click', '.editbarang', function () {
              $('#edit-detail').show();
              $('#add-detail').hide();
              $('#tambah-detail').hide();
              $('#hapus-detail').hide();
              var id = $(this).data('kode');
              console.log(id);
              $.ajax({
                url :'{!! url("data-detail/'+id+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response.data);
                  $('#edit-id-item').val(id);
                  $('#edit-nama-item').val(response.data.item);
                  $('#edit-qty-item').val(response.data.qty);
                }
              });
          });
          $('#btn-cancel-edit').on('click',function (){
            $('#edit-barang').hide();
            $('#add-barang').show();
          });
          $('#form-edit-detail').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-item');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var transaksi = $('#id_transaksi').val();
            var id = $('#edit-id-item').val();
            $.ajax({
              type: 'PUT',
              url: '{!! url("data-detail/'+id+'") !!}',
              data : {
                _token     : token,
                qty        : $('#edit-qty-item').val(),
                item       : $('#edit-nama-item').val(),
                
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true ){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelitem(transaksi);
                  $('#edit-barang').hide();
                  $('#add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })  
                }
              }
            });
          });
        //Edit Barang
        //Hapus Barang
          $('body').on('click', '.hapusbarang', function () {
              $('#hapus-detail').show();
              $('#add-detail').hide();
              $('#tambah-detail').hide();
              $('#edit-detail').hide();
              var id = $(this).data('kode');
              console.log(id);
              $.ajax({
                url :'{!! url("data-detail/'+id+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response.id);
                  $('#hapus-kode-item').val(id);
                  $('#hapus-nama-item').html(response.data.item);
                }
              });
          });
          $('#btn-cancel-hapus').on('click',function (){
            $('#hapus-detail').hide();
            $('#add-detail').show();
          });
          $('#form-hapus-detail').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var token = "{!! csrf_token() !!}";
            var transaksi = $('#id_transaksi').val();
            var id =  $('#hapus-kode-item').val();
            $.ajax({
              type    : 'delete',
              url     : '{!! url("data-detail/'+id+'") !!}',
              data    : {
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
                  tabelitem(transaksi);
                  $('#hapus-detail').hide();
                  $('#add-detail').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })  
                }
              }
            });
          });
        //Hapus Barang
        $('#form-tambah').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var no = $('#id_transaksi').val();
          var tgl = $('#tgl_transaksi').val();
          $.ajax({
            type: 'post',
            url: '{!! url("data-transaksi") !!}',
            data : {
              no : no,
              tgl   : tgl,
              _token    : token
            }, // serializes form input
            success:function(response) {
              console.log(response);
              var hasil = response.pesan;
              if(response.success){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
              } else {
                Toast.fire({
                  icon: 'error',
                  title: hasil
                })
              }
            }
          });
          $('#modal-tambah').modal('hide');
          var table = $('#tabel').DataTable(); 
          table.ajax.reload( null, false );
        });  
      // END TAMBAH DATA

      // DETAIL PO
        $('body').on('click','.detail', function(){
          var id = $(this).data('kode');
        //   console.log(kode);
          $.ajax({
            url :'{!! url("data-transaksi/'+id+'/edit") !!}',
            type : 'get',
            success : function(response){
               var kode = response.data.no_transaction;
              $('#detail-id_transaksi').val(response.data.no_transaction);
              $('#detail-tgl_transaksi').val(response.data.transaction_date);
              

              tabeldetail(kode);
            }
          });
        });
        // $('#cetak-po').on('click',function(){
        //   var kode = $('#detail-kode-po').val();
        //   $.ajax({
        //     url :'{!! url("cetakpodetail/'+kode+'") !!}',
        //     type : 'get'
        //   });

        // });
        function tabeldetail(kode){
          $.ajax({
            url :'{!! url("data-detail/'+kode+'") !!}',
            type : 'get',
            success : function(response){
              console.log(response);
              if (response.success == true){
                $('#body-tabel-detail').empty();
                var datahandler = $('#body-tabel-detail');
                var n= 0;
                $.each(response.data, function(key,val){
                    var Nrow = $("<tr>");
                      var nomor = n+1;
                    Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['item']+"</td><td>"+response.data[n]['qty']+"</td></tr>");
                    datahandler.append(Nrow);
                    n = n+1;
                });
              } else {
                Toast.fire({
                  icon: 'error',
                  title: response.pesan
                })
              }
              
            }
          });
        }
        $('#form-konfirmasi').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var transaksi = $('#konfirmasi-po-author').val();
          var konfirmator = $('#konfirmasi-pemeriksa-author').val();
          $.ajax({
                type: 'put',
                url: '{!! url("data-author/'+transaksi+'") !!}',
                data : {
                  konfirmator   : konfirmator,
                  type        : "po",
                  
                  _token    : token
                }, // serializes form input
                success:function(response) {
                  console.log(response);
                  var hasil = response.pesan;
                  if(response.success == true){
                    Toast.fire({
                      icon: 'success',
                      title: hasil
                    })
                    $('#modal-detail').modal('hide');
                    var table = $('#tabel-po').DataTable(); 
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
      // END DETAIL PO
      
      // EDIT PO
        $('body').on('click','.edit', function(){
          const newdetail = [];
          var id = $(this).data('kode');
          console.log(id);
          $('#edt-add-detail').show();
          $('#edt-tambah-detail').hide();
          $('#edt-edit-detail').hide();
          $('#edt-hapus-detail').hide();
          $.ajax({
            url :'{!! url("data-transaksi/'+id+'/edit") !!}',
            type : 'get',
            success : function(response){
               var kode = response.data.no_transaction;
              $('#edt-id_transaksi').val(response.data.no_transaction);
              $('#edt-tgl_transaksi').val(response.data.transaction_date);
              $('#edit-id_transaksi').val(id);

              tabelitemedit(kode);
            }
          });
        });

        // $('#edit-close').on('click',function(e){
        //   e.preventDefault(); // prevent actual form submit
        //   var el = $(this);
        //   el.prop('disabled', true);
        //   setTimeout(function(){el.prop('disabled', false); }, 4000);
        //   var token = "{!! csrf_token() !!}";
        //   var po = $('#edit-kode-po').val();
        //   var today = new Date();
        //   var tgl = today.getDate();
        //   if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
        //     tgl = '0'+tgl;
        //   }
        //   var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
        //   var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        //   var end = date+' '+time;
        //   $.ajax({
        //     type    : 'delete',
        //     url     : '{!! url("hapus-detailpo/'+po+'") !!}',
        //     data    : {
        //       _token    : token,
        //       start     : $('#edit-start').val(),
        //       end       : end,
        //     },
        //     success : function(response){
        //       var hasil = response.pesan;
        //       console.log(response);
        //       if(response.success == true){
        //         Toast.fire({
        //           icon: 'success',
        //           title: hasil
        //         })
        //         $('#modal-edit-po').modal('hide');
        //         var table = $('#tabel-po').DataTable(); 
        //         table.ajax.reload( null, false );
        //       } else {
        //         Toast.fire({
        //           icon: 'error',
        //           title: hasil
        //         })
        //       }
        //     }
        //   });
        // });

        $('#btn-edit-po').on('click',function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $(this);
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var po = $('#edit-kode-po').val();
          $.ajax({
            type: 'put',
            url: '{!! url("data-po/'+po+'") !!}',
            data : {
              _token    : token,
              supplier  : $('#edit-supplier-po').val(),
              pembayaran : $('#edit-pembayaran-po').val(),
              spk       : $('#edit-spk-po').val(),
              delivery  : $('#edit-delivery-po').val(),
              term      : $('#edit-term-po').val(),
              vat       : $('#edit-vat-po').val(),
              
            }, // serializes form input
            success:function(response) {
              console.log(response);
              var hasil = response.pesan;
              if(response.success == true){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-edit-po').modal('hide');
                var table = $('#tabel-po').DataTable(); 
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
        //Tambah Barang
          $('#edit-add-barang').on('click',function(){
            $('#edit-tambah-barang').show();
            $('#edit-tambah-nama-barang').empty();
            $('#edit-tambah-nama-barang').select2({
                placeholder: 'Pilih Barang',
                ajax: {
                    url: '{!! url("dropdown-barang") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.nama,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
              });
            $('#edit-add-barang').hide();
          });
          $('#edit-tambah-nama-barang').on('change',function(){
            var barang = $(this).val();
            $.ajax({
              type  : 'get',
              url   : '{!! url("data-barang/'+barang+'/edit") !!}',
              success: function(response){
                if(response.success == true)  {
                  $('#edit-tambah-satuan-barang').val(response.result.satuan);
                  $('#edit-tambah-keterangan-barang').val(response.result.keterangan);
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : response.pesan,
                  });
                }
              }
            });
          });
          $('#form-edit-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edit-btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var po = $('#edit-kode-po').val();
            var today = new Date();
            var tgl = today.getDate();
            if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
              tgl = '0'+tgl;
            }
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = date+' '+time;
            $.ajax({
              type: 'post',
              url: '{!! url("data-detailpo") !!}',
              data : {
                kode       : $('#edit-tambah-nama-barang').val(),
                _token     : token,
                qty        : $('#edit-tambah-qty-barang').val(),
                po         : po,
                vat        : $('#edit-tambah-vat-po').val(),
                harga      : $('#edit-tambah-harga-barang').val(),
                keterangan : $('#edit-tambah-keterangan-barang').val(),
                
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelbarangedit(po);
                  document.getElementById("form-edit-tambah-barang").reset();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
                
              }
            });
          });
        //Tambah Barang
        //Edit Barang
          $('body').on('click','.edit-editbarang',function(){
            $('#edit-tambah-barang').hide();
            $('#edit-edit-barang').show();
            $('#edit-add-barang').hide();
            $('#edit-hapus-barang').hide();
            var kode = $(this).data('kode');
              console.log(kode);
              $.ajax({
                url :'{!! url("data-detailpo/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response.result);
                  $('#edit-edit-kode-barang').val(kode);
                  $('#edit-edit-nama-barang').val(response.result.nama);
                  $('#edit-edit-harga-barang').val(response.result.harga);
                  $('#edit-edit-qty-barang').val(response.result.qty);
                  $('#edit-edit-satuan-barang').val(response.result.satuan);
                  $('#edit-edit-keterangan-barang').val(response.result.keterangan);
                }
              });
          });
          $('#edit-btn-cancel-edit').on('click',function(){
            $('#edit-tambah-barang').hide();
            $('#edit-edit-barang').hide();
            $('#edit-add-barang').show();
            $('#edit-hapus-barang').hide();
          });
          $('#form-edit-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edit-btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var po = $('#edit-kode-po').val();
            var kode = $('#edit-edit-kode-barang').val();
            $.ajax({
              type: 'PUT',
              url: '{!! url("data-detailpo/'+kode+'") !!}',
              data : {
                kode       : $('#edit-edit-kode-barang').val(),
                _token     : token,
                qty        : $('#edit-edit-qty-barang').val(),
                po         : po,
                harga      : $('#edit-edit-harga-barang').val(),
                keterangan : $('#edit-edit-keterangan-barang').val(),
                
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true) {
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelbarangedit(po);
                  $('#edit-edit-barang').hide();
                  $('#edit-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
              }
            });
          });
        //Edit Barang
        //Hapus Barang
          $('body').on('click','.edit-hapusbarang',function(){
            $('#edit-tambah-barang').hide();
            $('#edit-edit-barang').hide();
            $('#edit-add-barang').hide();
            $('#edit-hapus-barang').show();
            var kode = $(this).data('kode');
              console.log(kode);
              $.ajax({
                url :'{!! url("data-detailpo/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response.result);
                  $('#edit-hapus-kode-barang').val(kode);
                  $('#edit-hapus-nama-barang').html(response.result.nama);
                }
              });
          });
          $('#edit-btn-cancel-hapus').on('click',function(){
            $('#edit-tambah-barang').hide();
            $('#edit-edit-barang').hide();
            $('#edit-add-barang').show();
            $('#edit-hapus-barang').hide();
          });
          $('#edit-form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var token = "{!! csrf_token() !!}";
            var po = $('#edit-kode-po').val();
            var kode =  $('#edit-hapus-kode-barang').val();
            $.ajax({
              type    : 'delete',
              url     : '{!! url("data-detailpo/'+kode+'") !!}',
              data    : {
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
                  tabelbarangedit(po);
                  $('#edit-hapus-barang').hide();
                  $('#edit-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                } 
              }
            });
          });
        //Hapus Barang
        
        
        
        function tabelitemedit(kode){
          $.ajax({
            url :'{!! url("data-detail/'+kode+'") !!}',
            type : 'get',
            success : function(response){
              console.log(response);
              if (response.success == true){
                $('#body-tabel-edit').empty();
                var datahandler = $('#body-tabel-edit');
                var n= 0;
                $.each(response.data, function(key,val){
                    var Nrow = $("<tr>");
                      var nomor = n+1;
                    Nrow.html("<td>"+nomor+"</td><td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['id']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red'  data-kode='"+response.data[n]['id']+"' ><b>Hapus</b></a></div></td><td>"+response.data[n]['item']+"</td><td>"+response.data[n]['qty']+"</td></tr>");
                    datahandler.append(Nrow);
                    n = n+1;
                });
              } else {
                Toast.fire({
                  icon: 'error',
                  title: response.pesan
                })
              }
              
            }
          });
        }
      // END EDIT PO

      // SELESAI PO
        $('body').on('click','.selesai',function(){
          document.getElementById("form-selesai").reset();
          var kode = $(this).data('kode');
          document.getElementById("kode-selesai").innerHTML = kode;
          $('#selesai-kode').val(kode);
        });
        $('#form-selesai').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-selesai');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#selesai-kode').val();
          $.ajax({
            type    : 'get',
            url     : '{!! url("data-po-selesai/'+kode+'") !!}',
            data    : {
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
                $('#modal-selesai').modal('hide');
                var table = $('#tabel-po').DataTable(); 
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
      // SELESAI PO

      // HAPUS PO
        $('body').on('click', '.hapus', function () {
            document.getElementById("form-hapus").reset();
            var kode = $(this).data('kode');
            $('#hapus-id-transaksi').val(kode);
        });
        $('#form-hapus').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var kode =  $('#hapus-id-transaksi').val();
          $.ajax({
            type    : 'delete',
            url     : '{!! url("data-transaksi/'+kode+'") !!}',
            data    : {
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
                $('#modal-hapus').modal('hide');
                var table = $('#tabel').DataTable(); 
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
      // END HAPUS PO

      $('.select2').select2();

      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
    </script>
  </body>
</html>
