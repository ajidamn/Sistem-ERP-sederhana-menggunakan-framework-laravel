<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Purchase Order</title>
  </head>
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins')}}/select2/css/select2.min.css">
  
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img')}}/logo.png" alt="AdminLTELogo" height="60" width="60">
        
        <h4><b> Nusa Pratama Anugerah </b></h4>
      </div> 
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
                <h1>Purchase Order</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Purchase Order</li>
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
                    <button type="button" id="tambahdata" data-toggle="modal" data-backdrop="static" data-target="#modal-tambah-po"class="btn bg-gradient-primary">Tambah Purchase Order</button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <table id="tabel-po" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Action</th>
                          <th>Kode</th>
                          <th>Jenis</th>
                          <th>Supplier</th>
                          <th>Pembayaran</th>
                          <th>VAT</th>
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
      @include('layout/footer')
    <!-- MODAL -->
      <!-- MODAL Tambah Purchase Order -->
        <div class="modal fade" id="modal-tambah-po">
          <div class="modal-dialog modal-xl ">
              <div class="modal-content">
                  <form id="form-tambah-po">
                      <div class="modal-header bg-primary">
                          <h4 class="modal-title">Tambah Purchase Order</h4>
                          <button type="button" id="tambah-x"class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                          <div class="row">
                            <div class="col-lg-10">
                              <div class="row">
                                <div class="col-lg-4">
                                  <label>Tanggal</label>
                                  <input id="tambah-tanggal-po" class="form-control" type="date" required>
                                  <label>Kode PO</label>
                                  <input id="tambah-kode-po" class="form-control" type="text" value=""readonly required>
                                  <label> Jenis</label>
                                  <select id="tambah-jenis-po"  class="form-control " required>
                                    <option value="">Pilih Pembelian</option>
                                    <option value="51">Asset</option>
                                    <option value="31">Bahan Baku</option>
                                    <option value="21">Jasa</option>
                                    <option value="61">Barang Jadi</option>
                                  </select>
                                </div>
                                <div class="col-lg-3">
                                  <label> Supplier</label>
                                  <br>
                                  <select id="tambah-supplier-po"  class="form-control select2 " style="width: 100%" required>
                                    <option value="">Pilih Supplier</option>
                                    <option value="toya">PT. Toya</option>
                                    <option value="kharisma">PT. Kharisma</option>
                                    <option value="hendry">Hendry Kimia</option>
                                    <option value="lainlain">lainlain</option>
                                  </select>
                                  <br>
                                  <label>Pembayaran</label>
                                  <select id="tambah-pembayaran-po"  class="form-control " required>
                                    <option value="">Pilih Pembayaran</option>
                                    <option value="TUNAI">TUNAI</option>
                                    <option value="TEMPO">TEMPO</option>
                                  </select>
                                  <label>SPK No</label>
                                  <input id="tambah-spk-po" class="form-control" type="text" required >
                                </div>
                                <div class="col-lg-3">
                                  <label>Time Delivery</label>
                                  <input id="tambah-delivery-po" class="form-control" type="date" >
                                  <label>Term Payment</label>
                                  <input id="tambah-term-po" class="form-control" type="text" required>
                                  <label>VAT (%)</label>
                                  <input id="tambah-vat-po" class="form-control" type="number"  max="100" required>
                                </div>
                                <div class="col-lg-2">
                                  <br>
                                  <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input form-control" id="kunci-po">
                                    <label class="custom-control-label" for="kunci-po" >Kunci PO</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                  </form>
                            <div class="col-lg-2">
                              <label>AUTHOR</label>
                              <br>
                              <label >Dibuat Oleh :</label>
                              <br>
                              {{$detail->nama}}
                              <label>Dikonfirmasi Oleh :</label>
                              
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-primary card-outline" >
                                <div class="card-header">
                                  <button type="button" id="add-barang" class=" btn btn-danger" >Tambah Barang</button>
                                  <div class="row" id="tambah-barang">
                                    <form id="form-tambah-barang">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <select id="tambah-nama-barang"  class="form-control select2 "  style="width: 100%" required>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> Harga</label>
                                          <input id="tambah-harga-barang" class="form-control" step="any" type="number" min="1"  required>
                                          <label>Satuan</label>
                                          <input type="text" id="tambah-satuan-barang" class="form-control" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> QTY</label>
                                          <input id="tambah-qty-barang" class="form-control" step="any" type="number" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Keterangan</label>
                                            <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk"></textarea>
                                            
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                          <br>
                                          <button type="submit"  id="btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
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
                                            <input id="edit-nama-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> Harga</label>
                                          <input id="edit-harga-barang" class="form-control" type="number" step="any" min="1"  required>
                                          <label>Satuan</label>
                                          <input id="edit-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> QTY</label>
                                          <input id="edit-qty-barang" class="form-control" type="number" step="any" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Keterangan</label>
                                            <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk"></textarea>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                          <br>
                                          <div class="row justify-content-between">
                                            <button type="button"  id="btn-cancel-edit" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                            <button type="submit"  id="btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
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
                                <div class="card-body table-responsive">
                                  <table id="table-detail-po"class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th >Action</th>
                                      <th >No.</th>
                                      <th >Kode barang</th>
                                      <th >Nama Barang</th>
                                      <th >QTY</th>
                                      <th >Satuan</th>
                                      <th >@Harga Beli</th>
                                      <th >Jumlah</th>
                                      <th >Rate(Rp.)</th>
                                      <th >Keterangan</th>
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
                    <form id="form-tambah-author">
                      <input type="text" class="form-control" id="tambah-transaksi-author" hidden>
                      <input type="text" class="form-control" id="tambah-pembuat-author" value="{{$user->kode_karyawan}}" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="tambah-close" class=" ext col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-tambah-po" class="col-sm-2 form-control btn btn-primary">Tambah</button>
                      </div>
                    </form>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Purchase Order -->
      <!-- MODAL Edit Purchase Order -->
        <div class="modal fade" id="modal-edit-po">
          <div class="modal-dialog modal-xl ">
              <div class="modal-content">
                  <form id="form-edit-po">
                      <div class="modal-header bg-warning">
                          <h4 class="modal-title">Edit Purchase Order</h4>
                          <button type="button" id="edit-x"class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                          <div class="row">
                            <div class="col-lg-9">
                              <div class="row">
                                <div class="col-lg-4">
                                  <label>Tanggal</label>
                                  <input id="edit-tanggal-po" class="form-control" type="date" required>
                                  <label>Kode PO</label>
                                  <input id="edit-kode-po" class="form-control" type="text" value=""readonly required>
                                  <label> Jenis</label>
                                  <select id="edit-jenis-po"  class="form-control " required>
                                    <option value="">Pilih Pembelian</option>
                                    <option value="51">Asset</option>
                                    <option value="31">Bahan Baku</option>
                                    <option value="21">Jasa</option>
                                    <option value="61">Barang Jadi</option>
                                  </select>
                                </div>
                                <div class="col-lg-4">
                                  <label> Supplier</label>
                                  <br>
                                  <select id="edit-supplier-po"  class="form-control select2 " style="width: 100%" required>
                                    <option value="">Pilih Supplier</option>
                                    
                                  </select>
                                  <br>
                                  <label>Pembayaran</label>
                                  <select id="edit-pembayaran-po"  class="form-control " required>
                                    <option value="">Pilih Pembayaran</option>
                                    <option value="TUNAI">TUNAI</option>
                                    <option value="TEMPO">TEMPO</option>
                                  </select>
                                  <label>SPK No</label>
                                  <input id="edit-spk-po" class="form-control" type="text" required >
                                </div>
                                <div class="col-lg-4">
                                  <label>Time Delivery</label>
                                  <input id="edit-delivery-po" class="form-control" type="date" >
                                  <label>Term Payment</label>
                                  <input id="edit-term-po" class="form-control" type="text" required>
                                  <label>VAT (%)</label>
                                  <input id="edit-vat-po" class="form-control" type="number"  max="100" required>
                                </div>
                                
                              </div>
                            </div>
                  </form>
                            <div class="col-lg-3">
                              <label>AUTHORISASI </label>
                              <br>
                              <label >Dibuat Oleh :</label>
                              <h6 id="edit-nama-pembuat"></h6>
                              <h6 id="edit-tanggal-dibuat"></h6>
                              <label> Diperiksa Oleh :</label>
                              <h6 id="edit-nama-pemeriksa"></h6>
                              <h6 id="edit-tanggal-diperiksa"></h6>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-warning card-outline" >
                                <div class="card-header">
                                  <button type="button" id="edit-add-barang" class=" btn btn-primary" >Tambah Barang</button>
                                  <div class="row" id="edit-tambah-barang">
                                    <form id="form-edit-tambah-barang">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <select id="edit-tambah-nama-barang"  class="form-control select2 "  style="width: 100%" required>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> Harga</label>
                                          <input id="edit-tambah-harga-barang" class="form-control" type="number" step="any" min="1"  required>
                                          <label >Satuan</label>
                                          <input id="edit-tambah-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> QTY</label>
                                          <input id="edit-tambah-qty-barang" class="form-control" type="number" step="any" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Keterangan</label>
                                            <textarea id="edit-tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk"></textarea>
                                            
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                          <br>
                                          <button type="submit"  id="edit-btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="row" id="edit-edit-barang">
                                    <form id="form-edit-edit-barang">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <input id="edit-edit-kode-barang" class="form-control" type="text" hidden>
                                            <input id="edit-edit-nama-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> Harga</label>
                                          <input id="edit-edit-harga-barang" class="form-control" type="number" step="any" min="1"  required>
                                          <label>Satuan</label>
                                          <input id="edit-edit-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label> QTY</label>
                                          <input id="edit-edit-qty-barang" class="form-control" type="number" step="any" min="1" required >  
                                        </div>
                                        <div class="col-lg-4">
                                            <label> Keterangan</label>
                                            <textarea id="edit-edit-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk"></textarea>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                        <div class="col-lg-4">
                                          <br>
                                          <div class="row justify-content-between">
                                            <button type="button"  id="edit-btn-cancel-edit" class="col-sm-5 form-control btn btn-default">Cancel</button>
                                            <button type="submit"  id="edit-btn-edit-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="row" id="edit-hapus-barang">
                                    <form id="edit-form-hapus-barang">
                                      <input id="edit-hapus-kode-barang" class="form-control" type="text" hidden>
                                      <div class="row justify-content-center ">
                                        <label> Apakah Anda yakin akan menghapus barang ini ??</label>
                                      </div>
                                      <div class="row justify-content-center" > 
                                            <label class="col-lg-3">Nama Barang </label>
                                            <label id ="edit-hapus-nama-barang" class="col-lg-9"></label>
                                      </div>
                                      <br>
                                      <div class="row justify-content-between ">
                                        <button type="button"  id="edit-btn-cancel-hapus" class="col-lg-5 form-control btn btn-default">Cancel</button>
                                        <button type="submit"  id="edit-btn-hapus-barang" class="col-lg-5 form-control btn btn-danger ">Hapus Barang</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="card-body table-responsive">
                                  <table id="table-edit-po"class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th >Action</th>
                                      <th >No.</th>
                                      <th >Kode barang</th>
                                      <th >Nama Barang</th>
                                      <th >QTY</th>
                                      <th >Satuan</th>
                                      <th >@Harga Beli</th>
                                      <th >Jumlah</th>
                                      <th >Rate(Rp.)</th>
                                      <th >Keterangan</th>
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
                      <input type="text" class="form-control" id="edit-start" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="edit-close" class=" ext col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="btn-edit-po" class="col-sm-2 form-control btn btn-warning">Edit</button>
                      </div>
              </div>
          </div>
        </div>
      <!--/ Modal Edit Purchase Order -->
      
      <!-- MODAL Detail Purchase Order -->
        <div class="modal fade" id="modal-detail">
          <div class="modal-dialog modal-xl ">
              <div class="modal-content">
                      <div class="modal-header bg-info">
                          <h4 class="modal-title">Detail Purchase Order</h4>
                          <button type="button" id="tambah-x"class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                          <div class="row">
                            <div class="col-lg-9">
                              <div class="row">
                                <div class="col-lg-4">
                                  <label>Tanggal</label>
                                  <input id="detail-tanggal-po" class="form-control" type="date" readonly>
                                  <label>Kode PO</label>
                                  <input id="detail-kode-po" class="form-control" type="text" readonly >
                                  <label> Jenis</label>
                                  <input id="detail-jenis-po" class="form-control" type="text" readonly >
                                </div>
                                <div class="col-lg-4">
                                  <label> Supplier</label>
                                  <input id="detail-supplier-po" class="form-control" type="text" readonly >
                                  <label>Pembayaran</label>
                                  <input id="detail-pembayaran-po" class="form-control" type="text" readonly >
                                  <label>SPK No</label>
                                  <input id="detail-spk-po" class="form-control" type="text" readonly>
                                </div>
                                <div class="col-lg-4">
                                  <label>Time Delivery</label>
                                  <input id="detail-delivery-po" class="form-control" type="date"  readonly>
                                  <label>Term Payment</label>
                                  <input id="detail-term-po" class="form-control" type="text" readonly>
                                  <label>VAT (%)</label>
                                  <input id="detail-vat-po" class="form-control" type="number"  readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <label>AUTHORISASI </label>
                              <br>
                              <label >Dibuat Oleh :</label>
                              <h6 id="detail-nama-pembuat"></h6>
                              <h6 id="detail-create-pembuat"></h6>
                              <label> Diperiksa Oleh :</label>
                              <h6 id="detail-nama-pemeriksa"></h6>
                              <h6 id="detail-create-pemeriksa"></h6>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-info card-outline" >
                                <div class="card-header ">
                                  <div class="row justify-content-between col-lg-12">
                                    <label> Detail Barang Purchase Order </label>
                                    <a id="cetak-po" rel="noopener" target="_blank" class="col-sm-2 form-control btn btn-danger""><i class="fas fa-print"></i> Print</a>
                                  </div>
                                </div>
                                <div class="card-body table-responsive">
                                  <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th >No.</th>
                                      <th >Kode barang</th>
                                      <th >Nama Barang</th>
                                      <th >QTY</th>
                                      <th >Satuan</th>
                                      <th >@Harga Beli</th>
                                      <th >Jumlah</th>
                                      <th >Rate(Rp.)</th>
                                      <th >Keterangan</th>
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
                    <form id="form-konfirmasi">
                      <input type="text" id="konfirmasi-po-author" class="form-control" hidden>
                      <input type="text" id="konfirmasi-pemeriksa-author" class="form-control" value="{{$detail->kode}}" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button"  class=" ext col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit"  id="btn-konfirm" class=" col-sm-2 btn btn-success">Konfirmasi</button>
                      </div>
                    </form>
              </div>
          </div>
        </div>
      <!--/ Modal Detail Purchase Order -->
      <!-- MODAL Hapus PO -->
        <div class="modal fade" id="modal-hapus-po">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus-po">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data PO</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus-kode-po" class="form-control" type="text" hidden >
                                      <div class="row">
                                          <label class="col-md-3">Kode </label> 
                                          <h6 class="col-md-6" id="hapus-kode"></h6>
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
      <!--/ Modal Hapus PO -->
      <!-- MODAL Selesai -->
        <div class="modal fade" id="modal-selesai">
          <div class="modal-dialog modal-sm">
              <form id="form-selesai">
                  <div class="modal-content">
                      <div class="modal-header bg-success">
                          <h4 class="modal-title">Data PO</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Mengupdate Status Data ini ?
                                      <input id="selesai-kode" class="form-control" type="text" hidden >
                                      <div class="row">
                                          <label class="col-md-3">Kode </label> 
                                          <h6 class="col-md-6" id="kode-selesai"></h6>
                                      </div>
                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-selesai" class=" col-sm-4 form-control btn btn-success">Selesai</button>
                      </div>
                  </div>
              </form>
          </div>
        </div>
      <!--/ Modal Selesai -->
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
        $('#tabel-po').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-po") !!}',
            columns: [         
                { data: 'DT_RowIndex', name: 'DT_RowIndex',orderable:false, searchable:false},
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'jenis', name: 'jenis',orderable:true},
                { data: 'supplier', name: 'supplier',orderable:true},
                { data: 'pembayaran', name: 'pembayaran',orderable:true},
                { data: 'vat', name: 'vat',orderable:false},
                { data: 'status', name: 'status',orderable:true},
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
          document.getElementById("form-tambah-po").reset();
          
          $('#body-tabel-tambah').empty();
          $('#edit-barang').hide();
          $('#add-barang').hide();
          var A1 = $('#tambah-tanggal-po').prop('readonly',false);var A2 = $('#tambah-jenis-po').prop('disabled',false);
          var A3 = $('#tambah-supplier-po').prop('disabled',false);var A4 = $('#tambah-pembayaran-po').prop('disabled',false);
          var A5 = $('#tambah-spk-po').prop('readonly',false);var A6 = $('#tambah-delivery-po').prop('readonly',false);
          var A7 = $('#tambah-term-po').prop('readonly',false);var A8 = $('#tambah-vat-po').prop('readonly',false);
          var token = "{!! csrf_token() !!}";
          $('#tambah-barang').hide();
          $('#hapus-barang').hide();
          $('#tambah-supplier-po').select2({
            placeholder: 'Pilih Supplier',
            ajax: {
                url: '{!! url("dropdown-supplier") !!}',
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
          $('#tambah-tanggal-po').focus();
        });
        $(document).on('change','#tambah-jenis-po',function(){
          var jns = $(this).val();
          var tgl = $("#tambah-tanggal-po").val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $('#tambah-kode-po').val('');
          if (jns != "" ){
            $.ajax({
              url     :'{!! url("lastkode-po/'+jns+'") !!}',
              type    : 'get',
              data    : {
                jenis   : jns,
                tanggal : n
              },
              success : function(data){
                console.log(data);
                $('#tambah-kode-po').val(data);
              }
            });
          } else {
            $('#tambah-kode-po').val('');
          }
        });
        $(document).on('change','#tambah-tanggal-po',function(){
          var jns = $('tambah-jenis-po').val();
          var tgl = $(this).val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $('#tambah-kode-po').val('');
          
          if (tgl != "" ){
            $.ajax({
              url     :'{!! url("lastkode-po/'+tgl+'") !!}',
              type    : 'get',
              data    : {
                jenis   : jns,
                tanggal : n
              },
              success : function(data){
                console.log(data);
                $('#tambah-kode-po').val(data);
              }
            });
          } else {
            $('#tambah-kode-po').val('');
          }
        });
        $(document).on('change','#kunci-po', function(){
          var checkBox = document.getElementById("kunci-po");
          var id  = $('#tambah-kode-po').val();
          var length = id.length;
          var A1 = $('#tambah-tanggal-po');var A2 = $('#tambah-jenis-po');var A3 = $('#tambah-supplier-po');
          var A4 = $('#tambah-pembayaran-po');var A5 = $('#tambah-spk-po');var A6 = $('#tambah-delivery-po');
          var A7 = $('#tambah-term-po');var A8 = $('#tambah-vat-po');
          
          if( A1.val() === "" || A2.val() === "" || A3.val() === "" || A4.val() === "" || A5.val() === "" ||  A7.val() === "" || A8.val() === ""){
            alert('Semua Field wajib diisi');
          } else {
            if (checkBox.checked == true && length == 15){
              $('#tambah-transaksi-author').val(id);
              A1.prop('readonly', true);A2.prop('disabled', true);
              A3.prop('disabled', true);A4.prop('disabled', true);
              A5.prop('readonly', true);A6.prop('readonly', true);
              A7.prop('readonly', true);A8.prop('readonly', true);
              $('#tambah-x').prop('disabled',true);$('#tambah-close').prop('disabled',true);
              var token = "{!! csrf_token() !!}";
              $.ajax({
                type: 'post',
                url: '{!! url("data-po") !!}',
                data : {
                  kode      : id,
                  tanggal   : A1.val(),
                  _token    : token,
                  jenis     : A2.val(),
                  supplier  : A3.val(),
                  pembayaran : A4.val(),
                  spk       : A5.val(),
                  delivery  : A6.val(),
                  term      : A7.val(),
                  vat       : A8.val(),
                  author : "{{$user->kode_karyawan}}",
                }, // serializes form input
                success:function(response) {
                  console.log(response);
                }
              });
              $('#add-barang').show();
              
              //Hapus body tabel
              $('#body-tabel-tambah').empty();
              //remove event listener before submitting the form 
              $(document).on("keydown", disableF5);
            } else {
              $('#body-tabel-tambah').empty();
              $('#tambah-barang').hide();
              A1.prop('readonly', false);A2.prop('disabled', false);
              A3.prop('disabled', false);A4.prop('disabled', false);
              A5.prop('readonly', false);A6.prop('readonly', false);
              A7.prop('readonly', false);A8.prop('readonly', false);
              var token = "{!! csrf_token() !!}";
              //Hapus Data PO
              $.ajax({
                type    : 'delete',
                url     : '{!! url("data-po/'+id+'") !!}',
                data    : {
                  _token  : token,
                  user : "{{$user->kode_karyawan}}",
                },
                success:function(response) {
                  console.log(response);
                }
              });
              $('#tambah-x').prop('disabled',false);$('#tambah-close').prop('disabled',false);
              $('#edit-barang').hide();
              $('#hapus-barang').hide();
              $('#add-barang').hide();
            }
          }
        });
        function tabelbarang(kode){
          $.ajax({
            url :'{!! url("data-detailpo/'+kode+'") !!}',
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
                    Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red'  data-kode='"+response.data[n]['kode']+"' ><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['qty']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+formatRupiah(response.data[n]['jumlah'])+"</td><td>null</td><td>"+response.data[n]['keterangan']+"</td></tr>");
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
          $('#add-barang').on('click',function (){
            $('#tambah-barang').show();
            document.getElementById("form-tambah-barang").reset();
            $('#tambah-nama-barang').select2({
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
            $('#add-barang').hide();
          });
          $('#tambah-nama-barang').on('change',function(){
            var barang = $(this).val();
            $.ajax({
              url   : '{!! url("data-barang/'+barang+'/edit")!!}',
              type  : 'get',
              success: function(response){
                if(response.success == true){
                  $('#tambah-satuan-barang').val(response.result.satuan);
                  $('#tambah-keterangan-barang').val(response.result.keterangan);
                } else {
                  Toast.fire({
                    icon  : 'error',
                    title : response.pesan
                  });
                }
              }
            });
          });
          $('#form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var po = $('#tambah-kode-po').val();
            $.ajax({
              type: 'post',
              url: '{!! url("data-detailpo") !!}',
              data : {
                kode       : $('#tambah-nama-barang').val(),
                _token     : token,
                qty        : $('#tambah-qty-barang').val(),
                po         : po,
                vat        : $('#tambah-vat-po').val(),
                harga      : $('#tambah-harga-barang').val(),
                keterangan : $('#tambah-keterangan-barang').val(),
                user : "{{$user->kode_karyawan}}",
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelbarang(po);
                  document.getElementById("form-tambah-barang").reset();
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
              $('#edit-barang').show();
              $('#add-barang').hide();
              $('#tambah-barang').hide();
              $('#hapus-barang').hide();
              var kode = $(this).data('kode');
              console.log(kode);
              $.ajax({
                url :'{!! url("data-detailpo/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response.result);
                  $('#edit-kode-barang').val(kode);
                  $('#edit-nama-barang').val(response.result.nama);
                  $('#edit-harga-barang').val(response.result.harga);
                  $('#edit-qty-barang').val(response.result.qty);
                  $('#edit-satuan-barang').val(response.result.satuan);
                  $('#edit-keterangan-barang').val(response.result.keterangan);
                }
              });
          });
          $('#btn-cancel-edit').on('click',function (){
            $('#edit-barang').hide();
            $('#add-barang').show();
          });
          $('#form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var po = $('#tambah-kode-po').val();
            var kode = $('#edit-kode-barang').val();
            $.ajax({
              type: 'PUT',
              url: '{!! url("data-detailpo/'+kode+'") !!}',
              data : {
                kode       : $('#edit-kode-barang').val(),
                _token     : token,
                qty        : $('#edit-qty-barang').val(),
                po         : po,
                harga      : $('#edit-harga-barang').val(),
                keterangan : $('#edit-keterangan-barang').val(),
                user : "{{$user->kode_karyawan}}",
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true ){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelbarang(po);
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
              $('#hapus-barang').show();
              $('#add-barang').hide();
              $('#tambah-barang').hide();
              $('#edit-barang').hide();
              var kode = $(this).data('kode');
              console.log(kode);
              $.ajax({
                url :'{!! url("data-detailpo/'+kode+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response.result);
                  $('#hapus-kode-barang').val(kode);
                  $('#hapus-nama-barang').html(response.result.nama);
                }
              });
          });
          $('#btn-cancel-hapus').on('click',function (){
            $('#hapus-barang').hide();
            $('#add-barang').show();
          });
          $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var token = "{!! csrf_token() !!}";
            var po = $('#tambah-kode-po').val();
            var kode =  $('#hapus-kode-barang').val();
            $.ajax({
              type    : 'delete',
              url     : '{!! url("data-detailpo/'+kode+'") !!}',
              data    : {
                _token  : token,
                user : "{{$user->kode_karyawan}}",
              },
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelbarang(po);
                  $('#hapus-barang').hide();
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
        //Hapus Barang
        $('#form-tambah-author').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var transaksi = $('#tambah-transaksi-author').val();
          var pembuat = $('#tambah-pembuat-author').val();
          console.log(transaksi);
          $.ajax({
            type: 'post',
            url: '{!! url("data-author") !!}',
            data : {
              transaksi : transaksi,
              pembuat   : pembuat,
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
          $('#modal-tambah-po').modal('hide');
          var table = $('#tabel-po').DataTable(); 
          table.ajax.reload( null, false );
        });  
      // END TAMBAH DATA

      // DETAIL PO
        $('body').on('click','.detail', function(){
          var kode = $(this).data('kode');
          console.log(kode);
          $('#cetak-po').prop('href','cetak-po?kode='+kode);
          $.ajax({
            url :'{!! url("data-po/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              console.log(response.po);
              $('#detail-tanggal-po').val(response.po.tanggal);
              $('#detail-kode-po').val(kode);
              $('#detail-jenis-po').val(response.po.jenis);
              $('#detail-supplier-po').val(response.po.nama);
              $('#detail-pembayaran-po').val(response.po.pembayaran);
              $('#detail-spk-po').val(response.po.spk);
              $('#detail-delivery-po').val(response.po.time_delivery);
              $('#detail-term-po').val(response.po.term_payment);
              $('#detail-vat-po').val(response.po.vat);
              console.log(response.author);
              if(response.po.status == 'Belum Diperiksa'){
                $('#detail-nama-pembuat').html(response.author.creator.nama);
                $('#detail-create-pembuat').html(response.author.created_at);
                $('#konfirmasi-po-author').val(response.author.transaksi);
                $('#detail-nama-pemeriksa').html("-");
                $('#detail-create-pemeriksa').html("-");
              } else if(response.po.status =='Sudah Diperiksa'){
                $('#detail-nama-pembuat').html(response.author.creator.nama);
                $('#detail-create-pembuat').html(response.author.created_at);
                $('#detail-nama-pemeriksa').html(response.author.pemeriksa.nama);
                $('#detail-create-pemeriksa').html(response.author.diperiksa);
                $('#btn-konfirm').hide();
              } else {
                $('#detail-nama-pembuat').html(response.author.creator.nama);
                $('#detail-create-pembuat').html(response.author.created_at);
                $('#detail-nama-pemeriksa').html(response.author.pemeriksa.nama);
                $('#detail-create-pemeriksa').html(response.author.diperiksa);
                $('#btn-konfirm').hide();
              }
              tabelbarangdetail(kode);
            }
          });
        });
        $('#cetak-po').on('click',function(){
          var kode = $('#detail-kode-po').val();
          $.ajax({
            url :'{!! url("cetakpodetail/'+kode+'") !!}',
            type : 'get'
          });

        });
        function tabelbarangdetail(kode){
          $.ajax({
            url :'{!! url("data-detailpo/'+kode+'") !!}',
            type : 'get',
            success : function(response){
              console.log(response);
              if(response.success == true){
                $('#body-tabel-detail').empty();
                var datahandler = $('#body-tabel-detail');
                var n= 0;
                $.each(response.data, function(key,val){
                    var Nrow = $("<tr>");
                      var nomor = n+1;
                      Nrow.html("<td>"+nomor+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['qty']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+formatRupiah(response.data[n]['jumlah'])+"</td><td>null</td><td>"+response.data[n]['keterangan']+"</td></tr>");
                    datahandler.append(Nrow);
                    n = n+1;
                });
              } else {

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
                  user : "{{$user->kode_karyawan}}",
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
          var kode = $(this).data('kode');
          console.log(kode);
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var start = date+' '+time;
          console.log(start);
          $('#edit-start').val(start);
          $('#edit-add-barang').show();
          $('#edit-tambah-barang').hide();
          $('#edit-edit-barang').hide();
          $('#edit-hapus-barang').hide();
          $.ajax({
            url :'{!! url("data-po/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              console.log(response.po);
              $('#edit-tanggal-po').val(response.po.tanggal);
              $('#edit-tanggal-po').prop('disabled',true);
              $('#edit-kode-po').val(kode);
              $('#edit-jenis-po').val(response.po.jenis);
              $('#edit-jenis-po').prop('disabled',true);
              $('#edit-pembayaran-po').val(response.po.pembayaran);
              $('#edit-spk-po').val(response.po.spk);
              $('#edit-delivery-po').val(response.po.time_delivery);
              $('#edit-term-po').val(response.po.term_payment);
              $('#edit-vat-po').val(response.po.vat);
              $('#edit-supplier-po')
                  .empty() //empty select
                  .append($("<option/>") //add option tag in select
                      .val(response.po.supplier) //set value for option to post it
                      .text(response.po.nama)) //set a text for show in select
                  .val(response.po.supplier) //select option of select2
                  .trigger("change"); //apply to select2
              $('#edit-supplier-po').select2({
                ajax: {
                    url: '{!! url("dropdown-supplier") !!}',
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
              console.log(response.po.status);
              if(response.po.status == "Belum Diperiksa"){
                $('#edit-nama-pembuat').html(response.author.creator.nama);
                $('#edit-tanggal-dibuat').html(response.author.created_at);
                $('#edit-nama-pemeriksa').html('-');
                $('#edit-tanggal-diperiksa').html('-');
              } else if (response.po.status == "Sudah Diperiksa"){
                $('#edit-nama-pembuat').html(response.author.creator.nama);
                $('#edit-tanggal-dibuat').html(response.author.created_at);
                $('#edit-nama-pemeriksa').html(response.author.pemeriksa.nama);
                $('#edit-tanggal-diperiksa').html(response.author.diperiksa);
              } 
              
              tabelbarangedit(kode);
            }
          });
        });

        $('#edit-close').on('click',function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $(this);
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
          var end = date+' '+time;
          $.ajax({
            type    : 'delete',
            url     : '{!! url("hapus-detailpo/'+po+'") !!}',
            data    : {
              _token    : token,
              start     : $('#edit-start').val(),
              end       : end,
            },
            success : function(response){
              var hasil = response.pesan;
              console.log(response);
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
              user : "{{$user->kode_karyawan}}",
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
                user : "{{$user->kode_karyawan}}",
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
                user : "{{$user->kode_karyawan}}",
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
                user : "{{$user->kode_karyawan}}",
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
        
        
        
        function tabelbarangedit(kode){
          $.ajax({
            url :'{!! url("data-detailpo/'+kode+'") !!}',
            type : 'get',
            success : function(response){
              console.log(response);
              if(response.success == true){
                $('#body-tabel-edit').empty();
                var datahandler = $('#body-tabel-edit');
                var n= 0;
                $.each(response.data, function(key,val){
                    var Nrow = $("<tr>");
                      var nomor = n+1;
                      Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edit-editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item edit-hapusbarang' style='color:red'  data-kode='"+response.data[n]['kode']+"' ><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+response.data[n]['kode_brg']+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['qty']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+formatRupiah(response.data[n]['jumlah'])+"</td><td>null</td><td>"+response.data[n]['keterangan']+"</td></tr>");
                    datahandler.append(Nrow);
                    n = n+1;
                });
              } else {

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
              user : "{{$user->kode_karyawan}}",
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
            document.getElementById("form-hapus-po").reset();
            var kode = $(this).data('kode');
            document.getElementById("hapus-kode").innerHTML = kode;
            $('#hapus-kode-po').val(kode);
        });
        $('#form-hapus-po').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var kode =  $('#hapus-kode-po').val();
          $.ajax({
            type    : 'delete',
            url     : '{!! url("data-po/'+kode+'") !!}',
            data    : {
              _token  : token,
              user : "{{$user->kode_karyawan}}",
            },
            success:function(response) {
              console.log(response);
              var hasil = response.pesan;
              if(response.success == true){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-hapus-po').modal('hide');
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
