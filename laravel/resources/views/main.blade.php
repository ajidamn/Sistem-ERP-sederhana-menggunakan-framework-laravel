<!DOCTYPE html>
<html lang="en">
@include('layout/head')
<head>
  <title>Dashboard {{$user->level}}</title>
</head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            @if($user->level == 'marketing')
              <h1 class="m-0" id="omset"> Omset bulan ini Rp. 0</h1>
            @elseif($user->level == 'admin')
              <h1 class="m-0" > Hai {{$detail->nama}}</h1>
            @elseif($user->level == 'superadmin')
              <h1 class="m-0" > Hai Master {{$detail->nama}}</h1>
            @endif
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="home">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if($user->level == 'admin')
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="total-so">0</h3>

                  <p>SO menunggu Konfirmasi </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="sales-order" class="small-box-footer">Cek Sales Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="total-sj">0</h3>

                  <p>Dalam Pengiriman</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a href="surat-jalan" class="small-box-footer">Cek Surat Jalan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total-inv">0</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                
                <a href="invoice" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tv"></i>
                    Stock Barang 
                  </h3>
                </div>
                <div class="card-body table-responsive">
                  <table id="tabel-stock" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
        @elseif($user->level == 'superadmin')
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="total-so">150</h3>

                  <p>Sales Order</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a data-toggle="modal" data-target="#modal-so" id="cek-so" class="small-box-footer">Cek Sales Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="total-sj"></h3>

                  <p>Dalam Pengiriman</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a data-toggle="modal" data-target="#modal-sj" id="cek-sj" class="small-box-footer">Cek Surat Jalan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total-invoice">44</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                
                <a data-toggle="modal" data-target="#modal-invoice" id="cek-invoice" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tv"></i>
                    Stock Barang 
                  </h3>
                </div>
                <div class="card-body table-responsive">
                  <table id="tabel-stock" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
        @elseif($user->level == 'marketing')
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3 id="total-so">0</h3>

                  <p>Sales Order</p>
                </div>
                <div class="icon">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="sales-order" class="small-box-footer">Buat Sales Order<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 id="total-sj">0</h3>

                  <p>Kawal Pesanan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a class="small-box-footer">Cek Status Pesanan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3 id="total-inv">0</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                <a class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tv"></i>
                    Stock Barang 
                  </h3>
                </div>
                <div class="card-body table-responsive">
                  <table id="tabel-stock" class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama Barang</th>
                      <th>Satuan</th>
                      
                      <th>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        @endif
        <!-- Small boxes (Stat box) -->
          <!-- <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>Purchase Order</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a data-toggle="modal" data-target="#modal-po" class="small-box-footer">Cek Purchase Order <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53</h3>

                  <p>Dalam Pengiriman</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a data-toggle="modal" data-target="#modal-sj" class="small-box-footer">Cek Surat Jalan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>44</h3>

                  <p>Invoice Belum Lunas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-fax"></i>
                </div>
                
                <a data-toggle="modal" data-target="#modal-invoice" class="small-box-footer">Cek Invoice <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div> -->
          <!-- /.row -->
          <!-- Main row -->
          <!-- <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Penjualan 6 bulan kebelakang
                  </h3>
                  
                </div>
                <div class="card-body">
                  <div class="tab-content p-0">
                    
                    <div class="chart tab-pane active" id="revenue-chart"
                        style="position: relative; height: 300px;">
                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <section class="col-lg-6 connectedSortable">
              
              <div class="card bg-gradient-primary">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Visitors
                  </h3>
              
                  <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                      <i class="far fa-calendar-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
              
                </div>
                <div class="card-body">
                  <div id="world-map" style="height: 250px; width: 100%;"></div>
                </div>
              
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <div class="text-white">Visitors</div>
                    </div>
              
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">Online</div>
                    </div>
              
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="text-white">Sales</div>
                    </div>
              
                  </div>
              
                </div>
              </div>
              
            </section>
            
            <section class="col-lg-6 connectedSortable">
              
              <div class="card bg-gradient-info">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Sales Graph
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                            data-fgColor="#39CCCC">

                      <div class="text-white">Mail-Orders</div>
                    </div>
                    
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                            data-fgColor="#39CCCC">

                      <div class="text-white">Online</div>
                    </div>
                    
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                            data-fgColor="#39CCCC">

                      <div class="text-white">In-Store</div>
                    </div>
                    
                  </div>
                  
                </div>
                
              </div>
              
            </section>
            
          </div> -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- MODAL -->
  
  <!-- /.modal -->
  <!-- /.content-wrapper -->
  @include('layout/footer')
  
</div>
<!-- ./wrapper -->

@include('layout/script')
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
<script>
  $(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
  });
    var token = "{!! csrf_token() !!}";
    var today = new Date();
    var tgl = today.getDate();
    if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
      tgl = '0'+tgl;
    }
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var time = date+' '+time;
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });
</script>
@if($user->level == 'admin')
  <script>
    $(document).ready(function() {   
      var awal = "2000-01-01 "+time;
      var akhir = time;
      $.ajax({
        url   : '{!! url("data-stock-gudang") !!}',
        type  : 'get',
        data  :{
                _token : token,
                gudang  : "ALL",
                awal    : awal,
                akhir   : akhir ,
              },
        success   : function(response){
          console.log(response);
          $('#tabel-stock').DataTable().clear().destroy();
          $('#tabel-stock').DataTable({
            data : response,
            columns : [
              { data: 'nama', name: 'nama',orderable:true},
              { data: 'satuan', name: 'satuan',orderable:true},
              { data: 'akhir_qty', name: 'akhir_qty',orderable:false},
            ],
          });
        }
      })
      //SO
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-so") !!}',
          data  : {
            status : "Belum Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-so').html(response.data.SO);
            } else {
              alert(response.pesan);
            }
          }
        });
      //SO
      //SJ
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-sj") !!}',
          data  : {
            status : "Sudah Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-sj').html(response.data.SJ);
            } else {
              alert(response.pesan);
            }
          }
        });
      //SJ
      //Invoice
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-invoice") !!}',
          data  : {
            status : "Sudah Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-inv').html(response.data.INV);
            } else {
              alert(response.pesan);
            }
          }
        });
      //Invoice
    }); 
  </script>
@elseif($user->level == 'marketing')
  <script>
    $(document).ready(function() {   
      var awal = "2000-01-01 "+time;
      var akhir = time;
      var marketing = "{{$user->kode_karyawan}}";
      console.log(marketing);
      $.ajax({
        url   : '{!! url("data-stock-gudang") !!}',
        type  : 'get',
        data  :{
                _token : token,
                gudang  : "ALL",
                awal    : awal,
                akhir   : akhir ,
              },
        success   : function(response){
          console.log(response);
          $('#tabel-stock').DataTable().clear().destroy();
          $('#tabel-stock').DataTable({
            data : response,
            columns : [
              { data: 'nama', name: 'nama',orderable:true},
              { data: 'satuan', name: 'satuan',orderable:true},
              { data: 'akhir_qty', name: 'akhir_qty',orderable:false},
            ],
          });
        }
      })
      //SO
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-so") !!}',
          data  : {
            status : "Belum Diperiksa",
            marketing : marketing,
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-so').html(response.data.SO);
            } else {
              alert(response.pesan);
            }
          }
        });
      //SO
      //SJ
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-sj") !!}',
          data  : {
            status : "Sudah Diperiksa",
            marketing : marketing,
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-sj').html(response.data.SJ);
            } else {
              alert(response.pesan);
            }
          }
        });
      //SJ
      //Invoice
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-invoice") !!}',
          data  : {
            status : "Sudah Diperiksa",
            marketing : marketing,
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-inv').html(response.data.INV);
            } else {
              alert(response.pesan);
            }
          }
        });
      //Invoice
    }); 
  </script>
@elseif($user->level == 'superadmin')
  <script>
    var token = "{!! csrf_token() !!}";
    var today = new Date();
    var tgl = today.getDate();
    if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
      tgl = '0'+tgl;
    }
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var awal = "2000-01-01 "+time;
    var time = date+' '+time;
    $(document).ready(function(){
      
      var akhir = time;
      $.ajax({
        url   : '{!! url("data-stock-gudang") !!}',
        type  : 'get',
        data  :{
                _token : token,
                gudang  : "ALL",
                awal    : awal,
                akhir   : akhir ,
              },
        success   : function(response){
          console.log(response);
          $('#tabel-stock').DataTable().clear().destroy();
          $('#tabel-stock').DataTable({
            data : response,
            columns : [
              { data: 'nama', name: 'nama',orderable:true},
              { data: 'satuan', name: 'satuan',orderable:true},
              { data: 'akhir_qty', name: 'akhir_qty',orderable:false},
            ],
          });
        }
      })
      //HPPNEW
      if(tgl == 7){

        $.ajax({
          type    : 'post',
          url     : '{!! url("data-hpp")!!}',
          data    : {
            _token    : token,
            tanggal   : date,
            created   : time,

          },
          success : function(response){
            console.log(response);
            if(response.success == true){
              Toast.fire({
                icon  : 'success',
                title : response.pesan
              });
            } else {
              Toast.fire({
                icon  : 'error',
                title : response.pesan
              });
            }
          }
        });
      } else {

      }
      
      //SO
      $.ajax({
        type  : 'get',
        url   : '{!! url("total-so")!!}',
        data  : {
          _token : token,
          status : "Belum Diperiksa",
        },
        success : function(response){
          console.log(response);
          var hasil = response.pesan;
          if(response.success == true ){
            $('#total-so').html(response.data.SO);
          } else {
            $('#total-so').html("0");
          }
        }
      });
        
      //SJ
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-sj")!!}',
          data  : {
            _token : token,
            time   : time,
            status : "Sudah Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-sj').html(response.data.SJ);
            } else {
              $('#total-sj').html("0");
            }
          }
        });
      //INVOICE
        $.ajax({
          type  : 'get',
          url   : '{!! url("total-inv")!!}',
          data  : {
            _token : token,
            status : "Sudah Diperiksa",
          },
          success : function(response){
            console.log(response);
            var hasil = response.pesan;
            if(response.success == true ){
              $('#total-invoice').html(response.data.INV);
            } else {
              $('#total-invoice').html("0");
            }
          }
        });
    });
  </script>
@endif
<script>
  
</script>
</body>
</html>
