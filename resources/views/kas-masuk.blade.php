<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Kas Masuk</title>
    </head>
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- SweetAlert -->
<link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
    
    <h4><b> Nusa Pratama Anugerah </b></h4>
  </div> 
  <!-- /.navbar -->
  @include('layout/navbar')

  <!-- Main Sidebar Container -->
  @include('layout/sidebar')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kas Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Kas Masuk</li>
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
                <div class="row justify-content-between">
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah"class="btn bg-gradient-primary">Tambah Kas Masuk</button>
                    <a id="jurnal" href="jurnal-kas" rel="noopener" target="_blank" class="col-sm-2 form-control btn btn-danger"><i class="fas fa-file"></i> Jurnal</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="tabel-kas" class="table  table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Action</th>
                    <th>Tanggal</th>
                    <th>Kode</th>
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
  <!-- /.content-wrapper -->

<!-- MODAL -->
<!-- MODAL Tambah  -->
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Buat Kas Masuk</h4>
                        <button type="button" id="btn-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Tanggal</label>
                                <input id="tmb-tgl" class="form-control" type="date" required>
                                <label> Rekanan</label>
                                <select id="tmb-rekanan" class="form-control select2"></select>
                                <span class="text-muted well well-sm shadow-none">*note: Abaikan Field Rekanan apabila melakukan transaksi di luar penjualan</span>
                                
                            </div>
                            <div class="col-lg-4">
                                <label>Kode Transaksi</label>
                                <input id="tmb-kode" class="form-control" type="text" value=""readonly required>
                                
                            </div>
                            <div class="col-lg-4">
                                <label> Kas</label>
                                <select id="tmb-debit" class="form-control select2" required></select>
                                <label> Keterangan</label>
                                <textarea  id="tmb-keterangan" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Kas Masuk" ></textarea>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4 custom control custom-switch">
                                <br>
                                <input type="checkbox" class="custom-control-input form-control" id="kunci">
                                <label class="custom-control-label" for="kunci" >Kunci </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="row">
                                <button id="btn-add-barang" class="btn btn-primary">Tambah Barang</button>
                                </div>
                                <div class="row" id="tambah-barang">
                                    <form id="form-tambah-barang">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <div id="tambah-penjualan">
                                                <label >Kode Invoice</label>
                                                <select id="tambah-inv-barang" class="form-control select2"></select>
                                            </div>
                                            <label>Nama Barang</label>
                                            <select id="tambah-nama-barang" class="form-control select2" style="width:100% ;" required></select>
                                            <div id="tambah-lain">
                                                <label>Invoice Pembelian</label>
                                                <input id="tambah-invoice-barang" class="form-control" type="text" >
                                            </div>
                                            <label> Sumber Pemasukkan</label>
                                            <select id="tambah-kredit-barang" class="form-control select2"></select>
                                            
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Harga</label>
                                            <input id="tambah-harga-barang" class="form-control" type="number" min="1" required >
                                            <label>Satuan</label>
                                            <input id="tambah-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>QTY</label>
                                            <input id="tambah-qty-barang" class="form-control" type="number" min="1" required > 
                                            <label> VAT</label>
                                            <input id="tambah-vat-barang" type="number" min="0" max="20" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-4">
                                            
                                        </div>
                                        <div class="col-lg-4">
                                            <label for=""> Total</label>
                                            <input type="text" class="form-control" id="tambah-total-barang" readonly >
                                        </div>
                                        <div class="col-lg-4">
                                            <br>
                                            <div class="row justify-content-between">
                                            <button type="submit" id="btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row" id="edit-barang">
                                    <form id="form-edit-barang">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <input id="edit-kode-barang" class="form-control" type="text" hidden>
                                            <select id="edit-nama-barang" class="form-control select2"></select>
                                            <div id="edit-lain">
                                                <label>Invoice Pembelian</label>
                                                <input id="edit-invoice-barang" class="form-control" type="text" >
                                            </div>
                                            <div id="edit-penjualan">
                                                <label >Kode Invoice</label>
                                                <select id="edit-inv-barang" class="form-control select2"></select>
                                            </div>
                                            <label> Sumber Pemasukkan</label>
                                            <select id="edit-kredit-barang" class="form-control select2"></select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Harga</label>
                                            <input id="edit-harga-barang" class="form-control" type="number" min="1" required >
                                            <label> Satuan</label>
                                            <input id="edit-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>QTY</label>
                                            <input id="edit-qty-barang" class="form-control" type="number" min="1" required >  
                                            <label> VAT</label>
                                            <input id="edit-vat-barang" type="number" min="0" max="20" class="form-control" required>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <label>Keterangan</label>
                                            <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                            </div>
                                            <div class="col-lg-4">
                                                <label for=""> Total</label>
                                                <input type="text" class="form-control" id="edit-total-barang" readonly>
                                            </div>
                                            <div class="col-lg-4">
                                                <br>
                                                <div class="row justify-content-between">
                                                <button type="button" id="btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                                <button type="submit" id="btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row" id="hapus-barang">
                                    <form id="form-hapus-barang">
                                        <input id="hapus-kode-barang" class="form-control" type="text" hidden>
                                        <div class="row justify-content-center ">
                                        <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                        </div>
                                        <div class="row justify-content-center" > 
                                            <label class="col-lg-3">Nama Barang </label>
                                            <label id ="hapus-nama-barang" class="col-lg-9"></label>
                                        </div>
                                        <br>
                                        <div class="row justify-content-between ">
                                        <button type="button"  id="btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                        <button type="submit"  id="btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table  class="table table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Kode Transaksi</th>
                                    <th rowspan="2">Kode Barang</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th rowspan="2">Satuan</th>
                                    <th rowspan="2">Harga</th>
                                    <th rowspan="2">QTY</th>
                                    <th rowspan="2">VAT</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Keterangan</th>
                                    <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                    <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                </tr>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                </tr>
                                </thead>
                                <tbody id="tbl_kas_tambah">
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <form id="tmbkas">
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-kas"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--/ Modal Tambah -->
  
  <!-- Modal Detail  -->
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Detail Kas Masuk</h4>
                        <button type="button" id="btn-detail-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Tanggal</label>
                                <input id="dtl-tgl" class="form-control" type="date" readonly>
                                
                            </div>
                            <div class="col-lg-4">
                                <label>Kode Transaksi</label>
                                <input id="dtl-kode" class="form-control" type="text" value=""readonly>
                            </div>
                            <div class="col-lg-4">
                                <label> Keterangan</label>
                                <textarea  id="dtl-keterangan" class="form-control" row="2" style="resize: none;" readonly></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table  class="table table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Kode Transaksi</th>
                                    <th rowspan="2">Kode Barang</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th rowspan="2">Satuan</th>
                                    <th rowspan="2">Harga</th>
                                    <th rowspan="2">QTY</th>
                                    <th rowspan="2">VAT</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Keterangan</th>
                                    <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                    <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                </tr>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                </tr>
                                </thead>
                                <tbody id="tbl_kas_detail">
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <form id="dtlkas">
                    <div class="modal-footer justify-content-between ">
                        <input type="text" id="dtl-status" class="form-control" hidden>
                        <button type="button" id="btn-close-detail" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-submit-detail"class="col-sm-2 form-control btn btn-success">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <!-- /Modal Detail  -->
  <!-- MODAL Edit  -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Edit Kas Masuk</h4>
                        <button type="button" id="btn-edit-x-kas" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Tanggal</label>
                                <input id="edt-tgl" class="form-control" type="date" readonly>
                            </div>
                            <div class="col-lg-4">
                                <label>Kode Transaksi</label>
                                <input id="edt-kode" class="form-control" type="text" value=""readonly required>
                            </div>
                            <div class="col-lg-4">
                                <label> Keterangan</label>
                                <textarea  id="edt-keterangan" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Kas Masuk" ></textarea>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4 custom control custom-switch">
                                
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="row">
                                <button id="edt-btn-add-barang" class="btn btn-primary">Tambah Barang</button>
                                </div>
                                <div class="row" id="edt-tambah-barang">
                                    <form id="edt-form-tambah-barang">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <select id="edt-tambah-nama-barang" class="form-control select2" style="width:100% ;" required></select>
                                            <label>Invoice Pembelian</label>
                                            <input id="edt-tambah-invoice-barang" class="form-control" type="text" >
                                            <select class="form-control select2" style="width: 100%;" id="edt-tambah-invoice2-barang"></select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Harga</label>
                                            <input id="edt-tambah-harga-barang" class="form-control" type="number" min="1" required >
                                            <label>Satuan</label>
                                            <input id="edt-tambah-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>QTY</label>
                                            <input id="edt-tambah-qty-barang" class="form-control" type="number" min="1" required > 
                                            <label>VAT</label>
                                            <input type="number" min='0' max='100' class="form-control" id="edt-tambah-vat-barang" required>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>Keterangan</label>
                                            <textarea id="edt-tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Kas (Debit)</label>
                                                <select id="edt-tambah-debit-barang" class="form-control select2" required></select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Sumber Pemasukkan (Kredit)</label>
                                                <select id="edt-tambah-kredit-barang" class="form-control select2" required></select>
                                            </div>
                                            <div class="col-lg-2">
                                                <br>
                                                <button id="edt-btn-cancel-barang" class="form-control btn btn-default">Cancel</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <br>
                                                <button type="submit" id="edt-btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row" id="edt-edit-barang">
                                    <form id="edt-form-edit-barang">
                                        <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <input id="edt-edit-kode-barang" class="form-control" type="text" hidden>
                                            <select id="edt-edit-nama-barang" class="form-control select2"></select>
                                            <label>Invoice Pembelian</label>
                                            <input id="edt-edit-invoice-barang" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Harga</label>
                                            <input id="edt-edit-harga-barang" class="form-control" type="number" min="1" required >
                                            <label> Satuan</label>
                                            <input id="edt-edit-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>QTY</label>
                                            <input id="edt-edit-qty-barang" class="form-control" type="number" min="1" required >  
                                            <label>VAT</label>
                                            <input type="number" min='0' max='100' class="form-control" id="edt-edit-vat-barang" required>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <label>Keterangan</label>
                                            <textarea id="edt-edit-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label>Kas (Debit)</label>
                                                <select id="edt-edit-debit-barang" class="form-control select2" required></select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Sumber Pemasukkan (Kredit)</label>
                                                <select id="edt-edit-kredit-barang" class="form-control select2" required></select>
                                            </div>
                                            <div class="col-lg-4">
                                                <br>
                                                <div class="row justify-content-between">
                                                <button type="button" id="edt-btn-cancel-edit-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                                <button type="submit" id="edt-btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="row" id="edt-hapus-barang">
                                    <form id="edt-form-hapus-barang">
                                        <input id="edt-hapus-kode-barang" class="form-control" type="text" hidden>
                                        <div class="row justify-content-center ">
                                        <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                        </div>
                                        <div class="row justify-content-center" > 
                                            <label class="col-lg-3">Nama Barang </label>
                                            <label id ="edt-hapus-nama-barang" class="col-lg-9"></label>
                                        </div>
                                        <br>
                                        <div class="row justify-content-between ">
                                        <button type="button"  id="edt-btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                        <button type="submit"  id="edt-btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table  class="table table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th rowspan="2">Action</th>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Kode Transaksi</th>
                                    <th rowspan="2">Kode Barang</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th rowspan="2">Satuan</th>
                                    <th rowspan="2">Harga</th>
                                    <th rowspan="2">QTY</th>
                                    <th rowspan="2">VAT</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Keterangan</th>
                                    <td colspan="2" align="center"><b>Kode Akun DEBIT</b></td>
                                    <td colspan="2" align="center"><b>Kode Akun KREDIT</b></td>
                                </tr>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                    <th>Kode</th>
                                    <th>Nama Perkiraan</th>
                                </tr>
                                </thead>
                                <tbody id="tbl_kas_edit">
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <form id="edtkas">
                    <div class="modal-footer justify-content-between ">
                        <button type="button" id="edt-btn-close-kas" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-edit-kas"class="col-sm-2 form-control btn btn-warning">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  <!--/ Modal Edit  -->
  <!-- MODAL Hapus  -->
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog modal-sm">
            <form id="hapus">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Hapus Kas Masuk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          Apakah Anda Yakin Akan Menghapus Data ini ?
                          <div class="row">
                              <input id="hps-kode" class="form-control" type="text" required hidden>
                              <label class=" col-md-3">KODE </label> 
                              <label class="col-md-1">:</label>
                              <label class="col-md-8" id="hps_kode" > 	</label>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between ">
                        <button type="button" class="col-sm-4 btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-hapus" class=" col-sm-4 form-control btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  <!--/ Modal Hapus  -->
<!--/ MODAL -->

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
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="{{asset('AdminLTE/plugins')}}/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist')}}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(document).ready(function() {   
    $('#tabel-kas').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        processing: true,
        serverSide: true,
        ajax: '{!! url("DATA-kas/D") !!}',
        columns: [         
            { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
            { data: 'action', name: 'action',orderable:false, searchable:false},
            { data: 'tanggal', name: 'tanggal',orderable:true},
            { data: 'kode', name: 'kode',orderable:true},
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
    timer: 5000
  });

  var token = "{!! csrf_token() !!}";
  //TAMBAH DATA
    $(document).on('click','#tambahdata',function(){
        $('#tmb-tgl').val('');$('#tmb-kode').val('');$('#tmb-debit').val('');$('#tmb-rekanan').val('');$('#tmb-keterangan').val('');$('#kunci').prop('checked',false);
        $('#tmb-tgl').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);
        $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
        $('#tmb-debit').select2({
          placeholder : 'Pilih Kas Terima',
          ajax  :{
            url : '{!! url("dropdown-kas") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode+" - "+item.nama_perkiraan,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
        $('#tmb-rekanan').select2({
          placeholder : 'Pilih Rekanan',
          ajax  :{
            url : '{!! url("dropdown-konsumen") !!}',
            dataType: 'json',
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.kode+" - "+item.nama+" - "+item.nama_perusahaan,
                              id: item.kode
                          }
                      })
                  };
              },
              cache: true
          }
        });
    });
    
    $('#tmb-tgl').on('change',function(){
        var tgl = $(this).val();
        var th = tgl.substr(2,2);
        var bln = tgl.substr(5,2);
        var n = th+bln;
        $.ajax({
            url     :'{!! url("lastkode-kas") !!}',
            type    : 'get',
            data    : {
                tanggal : n,
            },
            success : function(data){
                $('#tmb-kode').val(data);
            }
        });
    });
    $('#tmb-inv').on('change',function(){
        var inv  = $(this).val();
        $.ajax({
            type    : 'get',
            url     : '{!! url("data-inv/'+inv+'/edit")!!}',
            success : function(response){
                console.log(response);
                if(response.success == true){
                    $('#tmb-vat').val(response.data.inv.vat);
                } else {
                    // Toast.fire({
                    //     icon    : 'error',
                    //     title   : response.pesan,
                    // });
                }
            }
        });
    });
    $('#kunci').on('change',function(){
        var kode =  $('#tmb-kode').val();
        var tanggal = $('#tmb-tgl').val();
        var kas = $('#tmb-debit').val();
        var checkBox = document.getElementById("kunci");
        if( kode == null){
            Toast.fire({icon: 'error',title: 'Semua Field Wajib Diisi !!'}) 
            return false;
        } else if( tanggal == null){
            Toast.fire({icon: 'error',title: 'Tanggal Wajib Diisi !!'}) 
            return false;
        } else if (kas == null){
            Toast.fire({icon: 'error',title: 'Kas Wajib Diisi !!'}) 
            return false;
        }  else {

        }
        if(checkBox.checked == true){
            $('#btn-add-barang').show();
            $('#tmb-tgl').prop('disabled',true);$('#tmb-rekanan').prop('disabled',true);$('#tmb-keterangan').prop('disabled',true);$('#tmb-debit').prop('disabled',true);
        } else {
            $('#tmb-tgl').prop('disabled',false);$('#tmb-rekanan').prop('disabled',false);$('#tmb-keterangan').prop('disabled',false);$('#tmb-debit').prop('disabled',false);
            $('#btn-add-barang').hide();$('#tambah-barang').hide();$('#edit-barang').hide();$('#hapus-barang').hide();
           $.ajax({
            type    : 'delete',
            url     : '{!! url ("hapus-kas/'+kode+'")!!}',
            data    : {_token : token,user : "{{$user->kode_karyawan}}"},
            success : function(response){
                console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon    : 'success',
                        title   : response.pesan,
                    });
                    $('#tbl_kas_tambah').empty();
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
           });
        }
    });
    //Tambah Barang
        $('#btn-add-barang').on('click',function(){
            document.getElementById("form-tambah-barang").reset();
            $('#tambah-invoice-barang').val('');$('#tambah-inv-barang').val('');
            $('#tambah-nama-barang').prop('disabled',true);$('#tambah-harga-barang').prop('disabled',true);$('#tambah-keterangan-barang').prop('disabled',true);$('#tambah-qty-barang').prop('disabled',true);$('#tambah-vat-barang').prop('disabled',true);
            $('#tambah-nama-barang').val(null).trigger('change');
            $('#tambah-lain').hide();$('#tambah-penjualan').hide();
            $('#tambah-barang').show();$('#btn-add-barang').hide();
            $('#tambah-kredit-barang').select2({
                placeholder:"Pilih Jenis Pemasukkan",
                    ajax: {
                        url: '{!! url("dropdown-uangmasuk") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode+" - "+item.nama_perkiraan,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
            });
            var rekanan = $('#tmb-rekanan').val();
            if(rekanan == null){
                $('#tambah-lain').show();$('#tambah-penjualan').hide();
                $('#tambah-nama-barang').prop('disabled',false);$('#tambah-harga-barang').prop('disabled',false);$('#tambah-keterangan-barang').prop('disabled',false);$('#tambah-qty-barang').prop('disabled',false);$('#tambah-vat-barang').prop('disabled',false);
                
                $('#tambah-nama-barang').select2({
                    placeholder:"Pilih Barang",
                    
                });
            } else {
                $('#tambah-inv-barang').select2({
                    placeholder: "Pilih Invoice",
                    ajax :{
                        url: '{!! url("dropdown-inv/'+rekanan+'") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#tambah-lain').hide();$('#tambah-penjualan').show();
                $('#tambah-nama-barang').prop('disabled',true);$('#tambah-harga-barang').prop('disabled',true);$('#tambah-keterangan-barang').prop('disabled',true);$('#tambah-qty-barang').prop('disabled',true);$('#tambah-vat-barang').prop('disabled',true);
                
            }
            $('#tambah-inv-barang').on('change',function(){
                var data = $(this).val();
                $('#tambah-nama-barang').prop('disabled',false);
                $('#tambah-nama-barang').val(''); $('#tambah-harga-barang').val(''); $('#tambah-satuan-barang').val('');
                $('#tambah-qty-barang').val(''); $('#tambah-keterangan-barang').val('');
                $('#tambah-nama-barang').select2({
                    placeholder:"Pilih Barang",
                    ajax: {
                        url: '{!! url("dropdown-baranginv/'+data+'") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode_brg+" - "+item.nama,
                                        id: item.kode_brg
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $.ajax({
                    type : 'get',
                    url  : '{!! url("data-inv/'+data+'/edit") !!}',
                    success: function(response){
                        console.log(response);
                        if(response.success == true){
                            $('#tambah-vat-barang').val(response.data.inv.vat);
                        } else {
                            Toast.fire({
                                icon : 'error',
                                title : response.pesan,
                            });
                        }
                    }
                });
            });
            $('#tambah-nama-barang').on('change',function(){
                var barang = $(this).val();
                var rekanan = $('#tmb-rekanan').val();
                if(rekanan == null){
                    if(barang == 'all'){
                        Toast.fire({
                            icon    : 'error',
                            title   : 'Pilih Salah Satu Barang',
                        });
                        return false;
                    } else {
                        $.ajax({
                            type    : 'get',
                            url     : '{!! url("data-barang/'+barang+'/edit") !!}',
                            success : function(response){
                                if(response.success == true){
                                    $('#tambah-satuan-barang').val(response.result.satuan);
                                } else {
                                    Toast.fire({
                                        icon    : 'error',
                                        title   : response.pesan
                                    });
                                }
                            }
                        });
                    }
                    
                } else {
                    var inv = $('#tambah-inv-barang').val();
                    $.ajax({
                        type   : 'get',
                        url    : '{!! url("databarang-detailinv/'+inv+'")!!}',
                        data   : {barang : barang,},
                        success:function(response){
                            console.log(response);
                            if(response.success == true){
                                $('#tambah-harga-barang').val(response.data.harga_jual);
                                $('#tambah-satuan-barang').val(response.data.satuan);
                                $('#tambah-qty-barang').val(response.data.diakui);
                                $('#tambah-keterangan-barang').val(response.data.keterangan);
                                $('#tambah-total-barang').val(formatRupiah(response.data.jumlah));
                                $('#tambah-kredit-barang')
                                    .empty() //empty select
                                    .append($("<option/>") //add option tag in select
                                        .val(response.data.debit) //set value for option to post it
                                        .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                                    .val(response.data.debit) //select option of select2
                                    .trigger("change"); //apply to select2
                            } else {
                                Toast.fire({
                                    icon   : 'error',
                                    title  : response.pesan,
                                });
                            }
                        },
                    });
                }
            });
            
        });
        $('#tambah-kredit-barang').on('change',function(){
            var kredit = $(this).val();
            var rekanan = $('#tmb-rekanan').val();
            console.log(rekanan);
            if(rekanan == null){
                if(kredit == 12 ||kredit == 12.1 ){
                    Toast.fire({
                        icon    : 'error',
                        title   : 'Pilih Rekanan Terlebih Dahulu',
                    });
                    $(this).val('');
                    return false;
                } else {
                    $('#tambah-nama-barang').prop('disabled',true);$('#tambah-invoice-barang').prop('disabled',true);
                }
            } else {
                $(this).prop('disabled',true);
                if(kredit != 12 || kredit != 12.1){
                    Toast.fire({
                        icon    : 'error',
                        title   : "ILLEGAL FUNCTION"
                    });
                } else {
                }
            }
            
        });
      
        $('#form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kas = $('#tmb-kode').val();
            var invoice = $('#tambah-invoice-barang').val();
            if(invoice == ''){
                invoice = $('#tambah-inv-barang').val();
            } else {
                
            }
            $.ajax({
                type : 'post',
                url  : '{!! url("data-detailkas") !!}',
                data : {
                    _token      :token,
                    kode_kas    : kas,
                    transaksi   : invoice,
                    barang      : $('#tambah-nama-barang').val(),
                    vat         : $('#tambah-vat-barang').val(),
                    harga       : $('#tambah-harga-barang').val(),
                    qty         : $('#tambah-qty-barang').val(),
                    keterangan  : $('#tambah-keterangan-barang').val(),
                    debit       : $('#tmb-debit').val(),
                    kredit      : $('#tambah-kredit-barang').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#tambah-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
            
            
        });
    //Tambah Barang
    //Edit Barang
        $(document).on('click','.editbarang',function(){
            var kode = $(this).data('kode');
            $('#btn-add-barang').hide(); $('#tambah-barang').hide(); $('#hapus-barang').hide();
            $('#edit-barang').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    console.log(response);
                    if(response.success == true) {
                        $('#edit-kode-barang').val(response.data.kode);
                        $('#edit-harga-barang').val(response.data.harga);
                        $('#edit-satuan-barang').val(response.data.satuan);
                        $('#edit-qty-barang').val(response.data.qty);
                        $('#edit-invoice-barang').val(response.data.kode_transaksi);
                        $('#edit-keterangan-barang').val(response.data.keterangan);
                        
                        if(response.data.kredit == 40){
                            var inv = $('#tmb-inv').val()
                            $('#edit-nama-barang').select2({
                                ajax: {
                                    url: '{!! url("dropdown-baranginv/'+inv+'") !!}',
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.kode_brg+" - "+item.nama,
                                                    id: item.kode_brg
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        } else {
                            $('#edit-nama-barang').select2({
                                ajax: {
                                    url: '{!! url("dropdown-barang") !!}',
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.kode+" - "+item.nama_perkiraan,
                                                    id: item.kode
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        }
                        $('#edit-nama-barang')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.kode_brg) //set value for option to post it
                                .text(response.data.kode_brg+" "+response.data.nama )) //set a text for show in select
                            .val(response.data.kode_brg) //select option of select2
                            .trigger("change"); //apply to select2
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
            
        });
        $('#btn-cancel-edit-barang').on('click',function(){
            $('#edit-barang').hide();
            document.getElementById("form-edit-barang").reset();
            $('#btn-add-barang').show();
        });
        $('#form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edit-kode-barang').val();
            var kas  = $('#tmb-kode').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detailkas/'+kode+'")!!}',
                data    : {
                    _token  : token,
                    barang  : $('#edit-nama-barang').val(),
                    transaksi : $('#edit-invoice-barang').val(),
                    harga   : $('#edit-harga-barang').val(),
                    qty     : $('#edit-qty-barang').val(),
                    keterangan : $('#edit-keterangan-barang').val(),
                    user : "{{$user->kode_karyawan}}",

                },
                success : function(response){
                    console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        document.getElementById("form-edit-barang").reset();
                        $('#edit-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Edit Barang
    //Hapus Barang
        $('body').on('click','.hapusbarang',function(){
            var kode = $(this).data('kode');
            $('#btn-add-barang').hide(); $('#tambah-barang').hide(); $('#edit-barang').hide();
            $('#hapus-barang').show();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    console.log(response);
                    if(response.success == true) {
                        $('#hapus-kode-barang').val(kode);
                        $('#hapus-nama-barang').html(response.data.nama);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
        $('#btn-cancel-hapus').on('click',function(){
            $('#hapus-barang').hide();
            $('#btn-add-barang').show();
        });
        $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#hapus-kode-barang').val();
            var kas = $('#tmb-kode').val();
            $.ajax({
                type : 'delete',
                url     : '{!! url("data-detailkas/'+kode+'") !!}',
                data    : {_token : token,user : "{{$user->kode_karyawan}}"},
                success : function(response){
                    console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#hapus-barang').hide();
                        $('#btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
    //Hapus Barang

    $('#tmbkas').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-tambah');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var tanggal = $('#tmb-tgl').val();
        var kas =  $('#tmb-debit').val();
        var ket     = $('#tmb-keterangan').val();
        var kode = $('#tmb-kode').val();
        //Validasi
            if(tanggal == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Tanggal Wajib Diisi',
                });
                return false ;
            } else {}
            if(kode == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kode Wajib Diisi',
                });
                return false ;
            } else {}
            if(kas == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Kas Wajib Diisi',
                });
                return false  ;
            } else {}
            if(ket == ""){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Error',
                    text    : 'Keterangan Wajib Diisi',
                });
                return false ;
            } else {}
        //Validasi
        $.ajax({
            type    : 'post',
            url     : "{!! url('data-kas')!!}",
            data    : {
                _token :token,
                kode    : $('#tmb-kode').val(),
                keterangan  : $('#tmb-keterangan').val(),
                tanggal : $('#tmb-tgl').val(),
                dk      : "D",
                user : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon :'success',
                        title: response.pesan,
                    });
                    $('#modal-tambah').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon :'error',
                        title: response.pesan,
                    });
                }
            }
        });
    });
  //TAMBAH DATA

  //DETAIL DATA
    $('body').on('click', '.detail', function () {
        var kode = $(this).data('kode');
        $('#btn-submit-detail').hide();
        $.ajax({
            url :'{!! url("data-kas/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
            console.log(response);
            if(response.success == true){
                $('#dtl-kode').val(response.data.kode);
                $('#dtl-tgl').val(response.data.tanggal);
                $('#dtl-keterangan').val(response.data.keterangan);
                if(response.data.status == 'Belum Diperiksa'){
                  $('#btn-submit-detail').show();
                  $('#dtl-status').val('Sudah Diperiksa');
                } else if( response.data.status == 'Sudah Diperiksa'){
                  $('#btn-submit-detail').show();
                  $('#dtl-status').val('Selesai');
                } else {
                  $('#btn-submit-detail').hide();
                }
                tabeldetail(kode);
            } else {
                Toast.fire({
                    icon    : 'error',
                    title   : response.pesan,
                });
            }
            
            }
        });
    });
    $('#dtlkas').submit(function(e){
      e.preventDefault(); // prevent actual form submit
        var el = $('#btn-detail');
        var kode = $('#dtl-kode').val();
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        $.ajax({
            type    : 'put',
            url     : "{!! url('status-kas/"+kode+"')!!}",
            data    : {
                _token :token,
                status : $('#dtl-status').val(),
                user : "{{$user->kode_karyawan}}",

            },
            success : function(response){
                console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon :'success',
                        title: response.pesan,
                    });
                    $('#modal-detail').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon :'error',
                        title: response.pesan,
                    });
                }
            }
        });
    });
  //DETAIL DATA

  //EDIT DATA
    $('body').on('click', '.edit', function () {
        var kode = $(this).data('kode');
        $.ajax({
            url :'{!! url("data-kas/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
                console.log(response);
                if(response.success == true){
                    $('#edt-kode').val(response.data.kode);
                    $('#edt-tgl').val(response.data.tanggal);
                    $('#edt-keterangan').val(response.data.keterangan);
                    tabeledit(kode);
                    $('#edt-btn-add-barang').show();$('#edt-tambah-barang').hide();$('#edt-edit-barang').hide();$('#edt-hapus-barang').hide();
                } else {
                    Toast.fire({
                        icon    : 'error',
                        title   : response.pesan,
                    });
                }
            }
        });
    });
    $('#edtkas').on('submit',function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-edit-kas');
        el.prop('disabled', true);
        setTimeout(function(){el.prop('disabled', false); }, 4000);
        var kode = $('#edt-kode').val();
        $.ajax({
            type    : 'put',
            url     : "{!! url('data-kas/"+kode+"')!!}",
            data    : {
                _token :token,
                keterangan  : $('#edt-keterangan').val(),
                user : "{{$user->kode_karyawan}}",
            },
            success : function(response){
                console.log(response);
                if(response.success == true){
                    Toast.fire({
                        icon  : 'success',
                        title : response.pesan,
                    });
                    $('#modal-edit').modal('hide');
                    var table = $('#tabel-kas').DataTable(); 
                    table.ajax.reload( null, false );
                } else {
                    Toast.fire({
                        icon  : 'error',
                        title : response.pesan,
                    });
                }
            }
        });
    });
    //Tambah Barang
        $('#edt-btn-add-barang').on('click',function(){
            $('#edt-tambah-barang').show();
            $('#edt-tambah-invoice-barang').hide();
            $('#edt-tambah-invoice2-barang').hide();
            $('#edt-btn-add-barang').hide();$('#edt-edit-barang').hide();$('#edt-hapus-barang').hide();
            $('#edt-tambah-kredit-barang').focus();
            $('#edt-tambah-debit-barang').select2({
                placeholder : 'Pilih Kas Terima',
                ajax  :{
                    url : '{!! url("dropdown-kas") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama_perkiraan,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            $('#edt-tambah-kredit-barang').select2({
                placeholder : 'Pilih Sumber Dana Masuk',
                ajax  :{
                    url : '{!! url("dropdown-uangmasuk") !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.kode+" - "+item.nama_perkiraan,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: true
                }
                });
        });
        $('#edt-tambah-kredit-barang').on('change',function(){
            var kredit = $(this).val();
            if(kredit == 12){
                $('#edt-tambah-invoice2-barang').prop('disabled',false);
                $('#edt-tambah-invoice-barang').hide(); $('#edt-tambah-invoice2-barang').show();
                $('#edt-tambah-invoice2-barang').select2({
                    placeholder : 'Pilih Invoice',
                    ajax  :{
                        url : '{!! url("dropdown-invsd") !!}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.kode,
                                        id: item.kode
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#edt-tambah-invoice2-barang').on('change',function(){
                    var data = $(this).val();
                    $('#edt-tambah-nama-barang').prop('disabled',false);
                    $('#edt-tambah-nama-barang').select2({
                        placeholder:"Pilih Barang",
                        ajax: {
                            url: '{!! url("dropdown-baranginv/'+data+'") !!}',
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: $.map(data, function (item) {
                                        return {
                                            text: item.kode_brg+" - "+item.nama,
                                            id: item.kode_brg
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                    });
                    $.ajax({
                        type : 'get',
                        url  : '{!! url("data-inv/'+data+'/edit") !!}',
                        success: function(response){
                            console.log(response);
                            if(response.success == true){
                                $('#edt-tambah-vat-barang').val(response.data.inv.vat);
                                $('#edt-tambah-vat-barang').prop('disabled',true);
                            } else {
                                Toast.fire({
                                    icon : 'error',
                                    title : response.pesan,
                                });
                            }
                        }
                    });
                });
                $('#edt-tambah-nama-barang').on('change',function(){
                    var barang = $(this).val();
                    var inv = $('#edt-tambah-invoice2-barang').val();
                    $.ajax({
                        type   : 'get',
                        url    : '{!! url("databarang-detailinv/'+inv+'")!!}',
                        data   : {barang : barang,},
                        success:function(response){
                            console.log(response);
                            if(response.success == true){
                                $('#edt-tambah-harga-barang').val(response.data.harga_jual);
                                $('#edt-tambah-satuan-barang').val(response.data.satuan);
                                $('#edt-tambah-qty-barang').val(response.data.diakui);
                                $('#edt-tambah-keterangan-barang').val(response.data.keterangan);
                                // $('#tambah-total-barang').val(formatRupiah(response.data.jumlah));
                                $('#edt-tambah-debit-barang')
                                    .empty() //empty select
                                    .append($("<option/>") //add option tag in select
                                        .val(response.data.debit) //set value for option to post it
                                        .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                                    .val(response.data.debit) //select option of select2
                                    .trigger("change"); //apply to select2
                            } else {
                                Toast.fire({
                                    icon   : 'error',
                                    title  : response.pesan,
                                });
                            }
                        },
                    });
                });
            } else {
                $('#edt-tambah-nama-barang').prop('disabled',true);
                $('#edt-tambah-invoice2-barang').prop('disabled',true);
                $('#edt-tambah-invoice-barang').show(); $('#edt-tambah-invoice2-barang').hide();
            }
        });
        $('#edt-tambah-nama-barang').on('change',function(){
            var barang = $(this).val();
            if(barang == 'all'){
                Toast.fire({
                    icon    : 'error',
                    title   : 'Pilih Salah Satu Barang',
                });
                return false;
            } else {
            }
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-barang/'+barang+'/edit") !!}',
                success : function(response){
                    if(response.success == true){
                        $('#edt-tambah-satuan-barang').val(response.result.satuan);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $('#edt-btn-cancel-barang').on('click',function(){
            $('#edt-btn-add-barang').show();$('#edt-tambah-barang').hide();
        });
        $('#edt-form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-kode').val();
            $.ajax({
                type    : 'post',
                url     : '{!! url("data-detailkas") !!}',
                data    : {
                    _token  : token,
                    barang  : $('#edt-tambah-nama-barang').val(),
                    kode_kas: $('#edt-kode').val(),
                    transaksi   : $('#edt-tambah-invoice-barang').val(),
                    vat         : $('#edt-tambah-vat-barang').val(),
                    harga       : $('#edt-tambah-harga-barang').val(),
                    qty         : $('#edt-tambah-qty-barang').val(),
                    keterangan  : $('#edt-tambah-keterangan-barang').val(),
                    debit       : $('#edt-tambah-debit-barang').val(),
                    kredit      : $('#edt-tambah-kredit-barang').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success:function(response){
                    console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                        tabeledit(kode);
                        $('#edt-tambah-barang').hide();
                        $('#edt-btn-add-barang').show();
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
    //Tambah Barang
    //Edit Barang
        $('body').on('click','.edtbarang',function(){
            var kode = $(this).data('kode');
            $('#edt-btn-add-barang').hide();$('#edt-edit-barang').show();$('#edt-tambah-barang').hide();$('#edt-hapus-barang').hide();$('#edt-btn-tambah-barang').hide();
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    console.log(response);
                    if(response.success == true) {
                        $('#edt-edit-kode-barang').val(response.data.kode);
                        $('#edt-edit-harga-barang').val(response.data.harga);
                        $('#edt-edit-satuan-barang').val(response.data.satuan);
                        $('#edt-edit-qty-barang').val(response.data.qty);
                        $('#edt-edit-invoice-barang').val(response.data.kode_transaksi);
                        $('#edt-edit-keterangan-barang').val(response.data.keterangan);
                        $('#edt-edit-vat-barang').val(response.data.vat);
                        if(response.data.kredit == 12){
                            $('#edt-edit-nama-barang').select2({
                                ajax: {
                                    url: '{!! url("dropdown-baranginv/'+response.data.kode_transaksi+'") !!}',
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.kode_brg+" - "+item.nama,
                                                    id: item.kode_brg
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        } else {
                            $('#edt-edit-nama-barang').select2({
                                ajax: {
                                    url: '{!! url("dropdown-barang") !!}',
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                return {
                                                    text: item.kode+" - "+item.nama_perkiraan,
                                                    id: item.kode
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        }
                        $('#edt-edit-debit-barang').select2({
                            placeholder : 'Pilih Kas Terima',
                            ajax  :{
                                url : '{!! url("dropdown-kas") !!}',
                                dataType: 'json',
                                processResults: function (data) {
                                    return {
                                        results: $.map(data, function (item) {
                                            return {
                                                text: item.kode+" - "+item.nama_perkiraan,
                                                id: item.kode
                                            }
                                        })
                                    };
                                },
                                cache: true
                            }
                        });
                        $('#edt-edit-kredit-barang').select2({
                            placeholder : 'Pilih Sumber Dana Masuk',
                            ajax  :{
                                url : '{!! url("dropdown-uangmasuk") !!}',
                                dataType: 'json',
                                processResults: function (data) {
                                    return {
                                        results: $.map(data, function (item) {
                                            return {
                                                text: item.kode+" - "+item.nama_perkiraan,
                                                id: item.kode
                                            }
                                        })
                                    };
                                },
                                cache: true
                            }
                        });
                        $('#edt-edit-debit-barang')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.debit) //set value for option to post it
                                .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                            .val(response.data.debit) //select option of select2
                            .trigger("change"); //apply to select2
                        $('#edt-edit-kredit-barang')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.kredit) //set value for option to post it
                                .text(response.data.kredit+" "+response.data.nama_kredit )) //set a text for show in select
                            .val(response.data.kredit) //select option of select2
                            .trigger("change"); //apply to select2
                        $('#edt-edit-nama-barang')
                            .empty() //empty select
                            .append($("<option/>") //add option tag in select
                                .val(response.data.kode_brg) //set value for option to post it
                                .text(response.data.kode_brg+" "+response.data.nama )) //set a text for show in select
                            .val(response.data.kode_brg) //select option of select2
                            .trigger("change"); //apply to select2
                        $('#edt-edit-debit-barang').prop('disabled',true);
                        $('#edt-edit-kredit-barang').prop('disabled',true);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan,
                        });
                    }
                }
            });
        });
        $('#edt-btn-cancel-edit-barang').on('click',function(){
            $('#edt-btn-add-barang').show();
            $('#edt-edit-barang').hide();
        });
        $('#edt-form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-kode').val();
            $.ajax({
                type    : 'put',
                url     : '{!! url("data-detailkas/'+kode+'")!!}',
                data    : {
                    _token  : token,
                    barang  : $('#edt-edit-nama-barang').val(),
                    transaksi : $('#edt-edit-invoice-barang').val(),
                    harga   : $('#edt-edit-harga-barang').val(),
                    qty     : $('#edt-edit-qty-barang').val(),
                    keterangan : $('#edt-edit-keterangan-barang').val(),
                    user : "{{$user->kode_karyawan}}",
                },
                success : function(response){
                    console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        document.getElementById("edt-form-edit-barang").reset();
                        $('#edt-edit-barang').hide();
                        $('#edt-btn-add-barang').show();
                        tabeltambah(kas);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
    //Edit Barang
    //Hapus Barang
        $('body').on('click','.hpsbarang',function(){
            $('#edt-btn-add-barang').hide();$('#edt-tambah-barang').hide();$('#edt-edit-barang').hide();
            $('#edt-hapus-barang').show();
            var kode = $(this).data('kode');
            $.ajax({
                type    : 'get',
                url     : '{!! url("data-detailkas/'+kode+'/edit") !!}',
                success : function(response){
                    console.log(response);
                    if(response.success == true) {
                        $('#edt-hapus-kode-barang').val(kode);
                        $('#edt-hapus-nama-barang').html(response.data.nama);
                    } else {
                        Toast.fire({
                            icon    : 'error',
                            title   : response.pesan
                        });
                    }
                }
            });
        });
        $('#edt-btn-cancel-hapus').on('click',function(){
            $('#edt-hapus-barang').hide();$('#edt-btn-add-barang').show();
        });
        $('#edt-form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var kode = $('#edt-hapus-kode-barang').val();
            var kas = $('#edt-kode').val();
            $.ajax({
                type    : 'delete',
                url     : '{!! url("data-detailkas/'+kode+'") !!}',
                data    : {user : "{{$user->kode_karyawan}}",_token :token,},
                success : function(response){
                    console.log(response);
                    if(response.success == true){
                        Toast.fire({
                            icon    : 'success',
                            title   : response.pesan,
                        });
                        $('#edt-hapus-barang').hide(); $('#edt-btn-add-barang').show();
                        tabeledit(kas);
                    } else {
                        Toast.fire({
                            icon    :'error',
                            title   : response.pesan 
                        });
                    }
                },
            });
        });
    //Hapus Barang
  //EDIT DATA
  //HAPUS DATA
    $('body').on('click','.hapus',function(){
        var kode  = $(this).data('kode');
        $('#hps-kode').val(kode);
        $('#hps_kode').html(kode);
    });
    $('#hapus').submit(function(e){
        e.preventDefault(); // prevent actual form submit
        var el = $('#btn-hapus');
        el.prop('readonly', true);
        setTimeout(function(){el.prop('readonly', false); }, 3000);
        var kode = $('#hps-kode').val();
        $.ajax({
        type    : 'delete',
        url     : '{!! url("data-kas/'+kode+'") !!}',
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
            var table = $('#tabel-kas').DataTable(); 
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
  //HAPUS DATA
  
function tabeltambah(kode){
    $.ajax({
        url :'{!! url("data-detailkas/'+kode+'") !!}',
        type : 'get',
        success : function(response){
        console.log(response);
        $('#tbl_kas_tambah').empty();
        var datahandler = $('#tbl_kas_tambah');
        var n= 0;
        var sum = 0;
        $.each(response.data, function(key,val){
            var Nrow = $("<tr>");
            sum = sum+response.data[n]['total']
                var nomor = n+1;
            Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_transaksi']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['VAT'])+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
            datahandler.append(Nrow);
            n = n+1;
        });
        var row = $("<tr><td colspan='9' align='center'>Total</td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
        datahandler.append(row);
        
        }
    });
}
function tabeldetail(kode){
    $.ajax({
        url :'{!! url("data-detailkas/'+kode+'") !!}',
        type : 'get',
        success : function(response){
        console.log(response);
        $('#tbl_kas_detail').empty();
        var datahandler = $('#tbl_kas_detail');
        var n= 0;
        var sum = 0;
        $.each(response.data, function(key,val){
            var Nrow = $("<tr>");
            sum = sum+response.data[n]['total']
                var nomor = n+1;
            Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode_transaksi']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['VAT'])+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
            datahandler.append(Nrow);
            n = n+1;
        });
        var row = $("<tr><td colspan='8' align='center'>Total</td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
        datahandler.append(row);
        
        }
    });
}
function tabeledit(kode){
    $.ajax({
        url :'{!! url("data-detailkas/'+kode+'") !!}',
        type : 'get',
        success : function(response){
        console.log(response);
        $('#tbl_kas_edit').empty();
        var datahandler = $('#tbl_kas_edit');
        var n= 0;
        var sum = 0;
        $.each(response.data, function(key,val){
            var Nrow = $("<tr>");
            sum = sum+response.data[n]['total']
                var nomor = n+1;
            Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edtbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hpsbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_transaksi']+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['VAT'])+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
            datahandler.append(Nrow);
            n = n+1;
        });
        var row = $("<tr><td colspan='9' align='center'>Total</td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
        datahandler.append(row);
        
        }
    });
}
function formatRupiah(money) {
    return new Intl.NumberFormat('id-ID',
        { style: 'currency', currency: 'IDR' }
    ).format(money);
}
 
</script>
</body>
</html>
