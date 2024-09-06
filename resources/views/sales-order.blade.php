<!DOCTYPE html>
<html lang="en">
  @include('layout/head')
  <head>
    <title>Sales Order</title>
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
                <h1>Sales Order</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Sales Order</li>
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
                    <button type="button" id="tambahdata" data-toggle="modal" data-target="#modal-tambah" data-backdrop="static" class="btn bg-gradient-primary">Tambah Sales Order</button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <table id="tabel-so" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Action</th>
                        <th>No SO</th>
                        <th>Konsumen</th>
                        <th>Tanggal</th>
                        <th>Marketing</th>
                        <th>Pembayaran</th>
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
      <!-- MODAL Tambah Sales Order -->
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                      <div class="modal-header bg-primary">
                          <h4 class="modal-title">Buat Sales Order</h4>
                          <button type="button" id="btn-x-so" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                          <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="tmb-tgl-so" class="form-control" type="date" required>
                                    <label>Kode SO</label>
                                    <input id="tmb-kode-so" class="form-control" type="text" value=""readonly required>
                                    <label> Jenis </label>
                                    @if($user->level != 'marketing')
                                      <select id="tmb-jenis-so"  class="form-control "  required>
                                        <option value="">Pilih Jenis SO</option>
                                        <option value="51">Asset</option>
                                        <option value="31">Bahan Baku</option>
                                        <option value="21">Jasa</option>
                                        <option value="61">Barang Jadi</option>
                                      </select>
                                    @else
                                      <select id="tmb-jenis-so"  class="form-control "  required>
                                        <option value="">Pilih Jenis SO</option>
                                        <option value="61">Barang Jadi</option>
                                      </select>
                                    @endif
                                    
                                    <label> Marketing </label>
                                    @if($user->level == 'marketing')
                                      <select id="tmb-marketing-so"  class="form-control " style="width:100%;" required >
                                        <option value="">Pilih Nama Marketing</option>
                                        <option value="{{$user->kode_karyawan}}">{{$detail->nama}}</option>
                                      </select>
                                    @else
                                      <select id="tmb-marketing-so"  class="form-control select2 " style="width:100%;" required>
                                      </select>
                                    @endif
                                    
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Konsumen</label>
                                    <select id="tmb-konsumen-so" class="form-control " style="width:100%;" required>
                                    </select>
                                    <label>Pembayaran</label>
                                    <select id="tmb-bayar-so"  class="form-control " style="width:100%;" required>
                                        <option value="">Pilih Jenis Pembayaran</option>
                                        <option value="TUNAI">TUNAI</option>
                                        <option value="TEMPO">TEMPO</option>
                                    </select>
                                    <label> Term Payment</label>
                                    <input id="tmb-term-so" class="form-control" type="text" >
                                    <label>VAT (%)</label>
                                    <input id="tmb-vat-so" class="form-control" type="number" min="0" max="100" required>
                                  </div>
                                  <div class="col-lg-4">
                                    <label> No. PO </label>
                                    <input id="tmb-po-so" class="form-control" type="text" value="" >
                                    <label> Tanggal Diterima </label>
                                    <input id="tmb-date-so" class="form-control" type="date"  >
                                    <label> Keterangan</label>
                                    <textarea  id="tmb-keterangan-so" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Sales Order" ></textarea>
                                    <div class="custom-control custom-switch">
                                      <br>
                                      <input type="checkbox" class="custom-control-input form-control" id="kunci">
                                      <label class="custom-control-label" for="kunci" >Kunci </label>
                                    </div>
                                  </div>
                                </div>
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
                                            <label>Nama Barang</label>
                                            <select id="tambah-nama-barang" class="form-control select2" style="width:100% ;" required></select>
                                            <label>Nama Request</label>
                                            <input id="tambah-namareq-barang" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-2">
                                          <label>Harga</label>
                                          <input id="tambah-harga-barang" step="any" class="form-control" type="number" min="1" required >
                                          <label>Satuan</label>
                                          <input id="tambah-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label>QTY</label>
                                          <input id="tambah-qty-barang" step="any" class="form-control" type="number" min="1" required >
                                          @if($user->level == 'superadmin' || $user->level == 'ceo' )
                                            <label>HPP</label>
                                            <input type="text" class="form-control" id="tambah-hpp-barang" readonly>
                                          @else
                                            
                                          @endif
                                        </div>
                                        <div class="col-lg-4">
                                          <label>Keterangan</label>
                                          <textarea id="tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                          <label>Kode Akun Debit</label>
                                          <select id="tambah-debit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
                                        </div>
                                        <div class="col-lg-4">
                                          <label>Kode Akun Kredit</label>
                                          <select id="tambah-kredit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
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
                                            <input id="edit-nama-barang" class="form-control" type="text" readonly>
                                            <label>Nama Request</label>
                                            <input id="edit-namareq-barang" class="form-control" type="text">
                                        </div>
                                        <div class="col-lg-2">
                                          <label>Harga</label>
                                          <input id="edit-harga-barang" step="any" class="form-control" type="number" min="1" required >
                                          <label> Satuan</label>
                                          <input id="edit-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label>QTY</label>
                                          <input id="edit-qty-barang" step="any" class="form-control" type="number" min="1" required >  
                                          <label>HPP</label>
                                          <input type="text" class="form-control" id="edit-hpp-barang" readonly>
                                        </div>
                                        <div class="col-lg-4 ">
                                          <label>Keterangan</label>
                                          <textarea id="edit-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                          <label>Kode Akun Debit</label>
                                          <select id="edit-debit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
                                        </div>
                                        <div class="col-lg-4">
                                          <label>Kode Akun Kredit</label>
                                          <select id="edit-kredit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
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
                                      <th rowspan="2">Kode Barang</th>
                                      <th rowspan="2">Nama Barang</th>
                                      <th rowspan="2">Nama Request</th>
                                      <th rowspan="2">Satuan</th>
                                      <th rowspan="2">Harga Jual</th>
                                      <th rowspan="2">QTY</th>
                                      <th rowspan="2">DPP</th>
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
                                    <tbody id="tbl_so_tambah">
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  <form id="tmbso">
                      <input type="text" id="tmb-time-so" class="form-control" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="btn-close-so" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-submit-so"class="col-sm-2 form-control btn btn-primary">Tambah</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Tambah Sales Order -->
      <!-- MODAL Edit Sales Order -->
        <div class="modal fade" id="modal-edit">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                      <div class="modal-header bg-warning">
                          <h4 class="modal-title">Edit Sales Order</h4>
                          <button type="button" id="btn-edit-x-so" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                          <div class="row">
                            <div class="col-lg-9">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="edt-tgl-so" class="form-control" type="date" required readonly>
                                    <label>Kode SO</label>
                                    <input id="edt-kode-so" class="form-control" type="text" value="" readonly required>
                                    <label> Jenis </label>
                                    <input id="edt-jenis-so" class="form-control" type="text" readonly >
                                    @if($user->level == 'marketing')
                                      <label> Marketing </label>
                                      <select id="edt-marketing-so"  class="form-control " style="width:100%;" required >
                                        <option value="">Pilih Nama Marketing</option>
                                        <option value="{{$user->kode_karyawan}}">{{$detail->nama}}</option>
                                      </select>
                                    @else
                                      <label> Marketing </label>
                                      <select id="edt-marketing-so"  class="form-control " style="width:100%;" required>
                                      </select>
                                    @endif
                                    
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Konsumen</label>
                                    <select id="edt-konsumen-so" class="form-control " style="width:100%;" required>
                                    </select>
                                    <label>Pembayaran</label>
                                    <select id="edt-bayar-so"  class="form-control " style="width:100%;" required>
                                        <option value="">Pilih Jenis Pembayaran</option>
                                        <option value="TUNAI">TUNAI</option>
                                        <option value="TEMPO">TEMPO</option>
                                    </select>
                                    <label> Term Payment</label>
                                    <input id="edt-term-so" class="form-control" type="text" >
                                    <label>VAT (%)</label>
                                    <input id="edt-vat-so" class="form-control" type="number" min="0" max="100" required>
                                  </div>
                                  <div class="col-lg-4">
                                    <label> No. PO </label>
                                    <input id="edt-po-so" class="form-control" type="text" value="" >
                                    <label> Tanggal Diterima </label>
                                    <input id="edt-date-so" class="form-control" type="date"  >
                                    <label> Keterangan</label>
                                    <textarea  id="edt-keterangan-so" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Sales Order" ></textarea>
                                    
                                  </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                              <label>AUTHORISASI </label>
                              <br>
                              <label >Dibuat Oleh :</label>
                              <h6 id="edt-nama-pembuat"></h6>
                              <h6 id="edt-create-pembuat"></h6>
                              <label> Diperiksa Oleh :</label>
                              <h6 id="edt-nama-pemeriksa"></h6>
                              <h6 id="edt-create-pemeriksa"></h6>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-outline card-warning">
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
                                            <label>Nama Request</label>
                                            <input id="edt-tambah-namareq-barang" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-2">
                                          <label>Harga</label>
                                          <input id="edt-tambah-harga-barang" step="any" class="form-control" type="number" min="1" required >
                                          <label> Satuan</label>
                                          <input id="edt-tambah-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label>QTY</label>
                                          <input id="edt-tambah-qty-barang" step="any" class="form-control" type="number" min="1" required >
                                          @if($user->level == 'superadmin' || $user->level == 'ceo')
                                            <label>HPP</label>
                                            <input type="text" id="edt-tambah-hpp-barang" class="form-control" readonly>
                                          @else
                                          @endif
                                        </div>
                                        <div class="col-lg-4">
                                          <label>Keterangan</label>
                                          <textarea id="edt-tambah-keterangan-barang" class="form-control" row="3" style="resize: none;" placeholder="Keterangan Produk" ></textarea>
                                          <br>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                          <label>Kode Akun Debit</label>
                                          <select id="edt-tambah-debit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
                                        </div>
                                        <div class="col-lg-4">
                                          <label>Kode Akun Kredit</label>
                                          <select id="edt-tambah-kredit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
                                        </div>
                                        <div class="col-lg-4">
                                          <br>
                                          <div class="row justify-content-between">
                                            <button type="submit" id="edt-btn-tambah-barang" class=" form-control btn btn-primary ">Tambah Barang</button>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                  <div class="row" id="edt-barang">
                                    <form id="form-edt-barang">
                                      <div class="row">
                                        <div class="col-lg-4">
                                            <label>Nama Barang</label>
                                            <input id="edt-kode-barang" class="form-control" type="text" hidden>
                                            <input id="edt-nama-barang" class="form-control" type="text" readonly>
                                            <label>Nama Request</label>
                                            <input id="edt-namareq-barang" type="text" class="form-control">
                                        </div>
                                        <div class="col-lg-2">
                                          <label>Harga</label>
                                          <input id="edt-harga-barang" step="any" class="form-control" type="number" min="1" required >
                                          <label> Satuan</label>
                                          <input id="edt-satuan-barang" class="form-control" type="text" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                          <label>QTY</label>
                                          <input id="edt-qty-barang" step="any" class="form-control" type="number" min="1" required >  
                                          @if($user->level == 'superadmin' || $user->level == 'ceo')
                                          <label>HPP</label>
                                          <input id="edt-hpp-barang" type="text" class="form-control" readonly>
                                        @else
                                        @endif
                                        </div>
                                        <div class="col-lg-4 ">
                                          <label>Keterangan</label>
                                          <textarea id="edt-keterangan-barang" class="form-control" row="3" style="resize: none;"  ></textarea>
                                         
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-4">
                                          <label>Kode Akun Debit</label>
                                          <select id="edt-debit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
                                        </div>
                                        <div class="col-lg-4">
                                          <label>Kode Akun Kredit</label>
                                          <select id="edt-kredit-barang"  class="form-control select2 "  style="width: 100%" >
                                          </select>
                                        </div>
                                        <div class="col-lg-4">
                                          <br>
                                          <div class="row justify-content-between">
                                            <button type="button" id="edt-btn-cancel-barang" class="col-sm-5 form-control btn btn-default ">Cancel</button>
                                            <button type="submit" id="edt-btn-barang" class="col-sm-5 form-control btn btn-warning ">Edit Barang</button>
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
                                        <th rowspan="2">Kode Barang</th>
                                        <th rowspan="2">Nama Barang</th>
                                        <th rowspan="2">Nama Request</th>
                                        <th rowspan="2">Satuan</th>
                                        <th rowspan="2">Harga Jual</th>
                                        <th rowspan="2">QTY</th>
                                        <th rowspan="2">DPP</th>
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
                                    <tbody id="tbl_so_edit">
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  <form id="edtso">
                      <input type="text" id="edt-time-so" class="form-control" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="edt-btn-close-so" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="edt-btn-submit-so"class="col-sm-2 form-control btn btn-warning">Edit</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Edit Sales Order -->
      <!-- MODAL Detail Sales Order -->
        <div class="modal fade" id="modal-detail">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                      <div class="modal-header bg-info">
                          <h4 class="modal-title">Detail Sales Order</h4>
                          <button type="button" id="btn-detail-x-so" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body form-group">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <label>Tanggal</label>
                                    <input id="detail-tgl-so" class="form-control" type="date" required readonly>
                                    <label>Kode SO</label>
                                    <input id="detail-kode-so" class="form-control" type="text" value=""readonly required>
                                    <label> Jenis </label>
                                    <input id="detail-jenis-so" type="text" class="form-control" readonly>
                                    <label> Marketing </label>
                                    <input id="detail-marketing-so" type="text" class="form-control" readonly>
                                  </div>
                                  <div class="col-lg-4">
                                    <label>Konsumen</label>
                                    <input id="detail-konsumen-so" type="text" class="form-control" readonly>
                                    <label>Pembayaran</label>
                                    <input id="detail-bayar-so" type="text" class="form-control" readonly>
                                    <label>Term Payment</label>
                                    <input id="detail-term-so" class="form-control" type="text" readonly >
                                    <label>VAT (%)</label>
                                    <input id="detail-vat-so" class="form-control" type="number" min="0" max="100" readonly required>
                                  </div>
                                  <div class="col-lg-4">
                                    <label> No. PO </label>
                                    <input id="detail-po-so" class="form-control" type="text" value=""  readonly>
                                    <label> Tanggal Diterima </label>
                                    <input id="detail-date-so" class="form-control" type="date"  readonly>
                                    <label> Keterangan</label>
                                    <textarea id="detail-keterangan-so" class="form-control" row="2" style="resize: none;" placeholder="Keterangan Sales Order"  readonly></textarea>                                  </div>
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
                              <div class="card card-outline card-info">
                                <div class="card-header">
                                  <div class="row justify-content-between col-lg-12">
                                    <label> Detail Barang Sales Order </label>
                                    <a id="cetak-so" rel="noopener" target="_blank" class="col-sm-2 form-control btn btn-danger"><i class="fas fa-print"></i> Print</a>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <table  class="table table-responsive table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Kode Barang</th>
                                        <th rowspan="2">Nama Barang</th>
                                        <th rowspan="2">Nama Request</th>
                                        <th rowspan="2">Satuan</th>
                                        <th rowspan="2">Harga Jual</th>
                                        <th rowspan="2">QTY</th>
                                        <th rowspan="2">DPP</th>
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
                                    <tbody id="tbl_so_detail">
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  <form id="dtlso">
                      <input type="text" id="dtl-time-so" hidden>
                      <input type="text" id="dtl-diperiksa-so" hidden>
                      <div class="modal-footer justify-content-between ">
                          <button type="button" id="btn-detail-close-so" class=" col-sm-2 btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="btn-detail-submit-so"class="col-sm-2 form-control btn btn-success">Konfirmasi</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      <!--/ Modal Detail Sales Order -->

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

      <!-- MODAL Hapus Sales Order -->
        <div class="modal fade" id="modal-hapus">
          <div class="modal-dialog modal-sm">
              <form id="form-hapus-so">
                  <div class="modal-content">
                      <div class="modal-header bg-danger">
                          <h4 class="modal-title">Hapus Data SO</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="form-group">
                                      Apakah Anda Yakin Akan Menghapus Data ini ?
                                      <input id="hapus-kode-so" class="form-control" type="text" hidden >
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
      <!--/ Modal Hapus Sales Order -->
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
      $(document).ready(function() {   
        $('#tabel-so').DataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            processing: true,
            serverSide: true,
            ajax: '{!! url("data-so") !!}',
            columns: [   
                { data: 'action', name: 'action',orderable:false, searchable:false},
                { data: 'kode', name: 'kode',orderable:true},
                { data: 'rekanan', name: 'rekanan',orderable:true},
                { data: 'tanggal', name: 'tanggal',orderable:true},
                { data: 'karyawan', name: 'karyawan',orderable:true},
                { data: 'pembayaran', name: 'pembayaran',orderable:true},
                { data: 'status', name: 'status',orderable:true},
            ]
        });
        
      }); 
      $('.select2').select2();
      var today = new Date();
      var tgl = today.getDate();
      if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
        tgl = '0'+tgl;
      }
      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
      var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var time = date+' '+time;
      var token = "{!! csrf_token() !!}";
      // Tambah SO
        $(document).on('click','#tambahdata',function(){
          $('#tmb-tgl-so').val(''); $('#tmb-jenis-so').val(''); $('#tmb-konsumen-so').val(''); $('#tmb-vat-so').val(''); $('#tmb-po-so').val(''); $('#tmb-keterangan-so').val('');
          $('#tmb-kode-so').val(''); $('#tmb-marketing-so').val(''); $('#tmb-bayar-so').val(''); $('#tmb-term-so').val(''); $('#tmb-date-so').val('');
          $('#tmb-tgl-so').prop('disabled',false); $('#tmb-marketing-so').prop('disabled',false); $('#tmb-konsumen-so').prop('disabled',false); $('#tmb-bayar-so').prop('disabled',false); $('#tmb-po-so').prop('disabled',false);
          $('#tmb-jenis-so').prop('disabled',false); $('#tmb-term-so').prop('disabled',false); $('#tmb-vat-so').prop('disabled',false); $('#tmb-date-so').prop('disabled',false); $('#tmb-keterangan-so').prop('disabled',false);
          $('#kunci').prop('checkedBox',false);
          $('#btn-x-so').prop('disabled',false);
          $('#btn-close-so').prop('disabled',false);
          $('#btn-submit-so').prop('disabled',true);
          $("#tambah-barang").hide();
          $("#edit-barang").hide();
          $("#hapus-barang").hide();
          $("#btn-add-barang").hide();
          $('#tbl_so_tambah').empty();
          @if($user->level == 'marketing')
            var nama = "aaa";
          @else
            $('#tmb-marketing-so').select2({
              placeholder: 'Pilih Marketing',
              ajax: {
                  url: '{!! url("dropdown-marketing") !!}',
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
          @endif
            
          
          $('#tmb-konsumen-so').select2({
            placeholder: 'Pilih Konsumen',
            ajax: {
                url: '{!! url("dropdown-konsumen") !!}',
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
          $('#btn-submit-so').prop('disabled',true);
        });
        $(document).on('change','#tmb-tgl-so', function(){
          
          var jns = $('#tmb-jenis-so').val();
          var tgl = $('#tmb-tgl-so').val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $.ajax({
            url     :'{!! url("lastkode-so") !!}',
            type    : 'get',
            data    : {
              jenis   : jns,
              tanggal : n
            },
            success : function(data){
              $('#tmb-kode-so').val(data);
            }
          });
        });
        $(document).on('change','#tmb-jenis-so', function(){
          
          var jns = $('#tmb-jenis-so').val();
          var tgl = $('#tmb-tgl-so').val();
          var th = tgl.substr(2,2);
          var bln = tgl.substr(5,2);
          var n = th+bln;
          $.ajax({
            url     :'{!! url("lastkode-so") !!}',
            type    : 'get',
            data    : {
              jenis   : jns,
              tanggal : n
            },
            success : function(data){
              $('#tmb-kode-so').val(data);
            }
          });
        });

        $(document).on('change','#kunci', function(){
          var checkBox = document.getElementById("kunci");
          var token = "{!! csrf_token() !!}";
          var kode  = $('#tmb-kode-so').val();
          var length = kode.length;
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          console.log(time);
          var tgl = $('#tmb-tgl-so').val(); var marketing = $('#tmb-marketing-so').val(); var konsumen =$('#tmb-konsumen-so').val(); var diterima = $('#tmb-date-so').val();
          var bayar = $('#tmb-bayar-so').val(); var term = $('#tmb-term-so').val(); var vat = $('#tmb-vat-so').val(); var po = $('#tmb-po-so').val(); var ket = $('#tmb-keterangan-so').val();
          if(kode == ''||marketing == ''||konsumen == ''|| bayar ==''||vat ==''|| length != 15 || tgl == ''||ket =='') {
            alert('Semua Field wajib diisi');
            checkBox.check = false;
          } else {
            if (checkBox.checked == true){
              $('#tmb-tgl-so').prop('disabled',true); $('#tmb-marketing-so').prop('disabled',true); $('#tmb-konsumen-so').prop('disabled',true); $('#tmb-bayar-so').prop('disabled',true); $('#tmb-po-so').prop('disabled',true);
              $('#tmb-jenis-so').prop('disabled',true); $('#tmb-term-so').prop('disabled',true); $('#tmb-vat-so').prop('disabled',true); $('#tmb-date-so').prop('disabled',true); $('#tmb-keterangan-so').prop('disabled',true);
              $('#btn-x-so').prop('disabled',true);
              $('#btn-close-so').prop('disabled',true);
              $('#btn-submit-so').prop('disabled',false);
              $('#tmb-time-so').val(time);
              $('#tbl_so_tambah').empty();
              $('#btn-add-barang').show();
            } else {
              var today = new Date();
              var tgl = today.getDate();
              if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
                tgl = '0'+tgl;
              }
              var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
              var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
              var endtime = date+' '+time;

              $('#tmb-tgl-so').prop('disabled',false); $('#tmb-marketing-so').prop('disabled',false); $('#tmb-konsumen-so').prop('disabled',false); $('#tmb-bayar-so').prop('disabled',false); $('#tmb-po-so').prop('disabled',false);
              $('#tmb-jenis-so').prop('disabled',false); $('#tmb-term-so').prop('disabled',false); $('#tmb-vat-so').prop('disabled',false); $('#tmb-date-so').prop('disabled',false); $('#tmb-keterangan-so').prop('disabled',false);
              $('#btn-x-so').prop('disabled',false);
              $('#btn-close-so').prop('disabled',false);
              $('#btn-submit-so').prop('disabled',true);
              $('#edit-barang').hide();
              $('#tambah-barang').hide();
              $('#hapus-barang').hide();
              $('#btn-add-barang').hide();
              $('#tbl_so_tambah').empty();
              $.ajax({
                type: 'delete',
                url: '{!! url("hps-detail-so/'+kode+'") !!}',
                data : {
                  _token      : token,
                  start          : time,
                  end         : endtime,
                }, // serializes form input
                success:function(response) {
                  console.log(response);
                  var hasil = response.success;
                }
              });
              
            }
          }
        });
        //Tambah Barang
          $(document).on('click','#btn-add-barang', function(){
            @if($user->level == 'superadmin'||$user->level == 'ceo')
              $('#tambah-hpp-barang').show();
            @else
              $('#tambah-hpp-barang').hide();
            @endif
            $('#tambah-barang').show();
            $('#btn-add-barang').hide();
            document.getElementById("form-tambah-barang").reset();
            $('#tambah-nama-barang').empty();
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
            console.log($('#tmb-time-so').val());
            $('#tambah-debit-barang').select2({
              placeholder:"Pilih Kode Debit",
              ajax: {
                  url: '{!! url("dropdown-akuntansi") !!}',
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
            $('#tambah-kredit-barang').select2({
              placeholder:"Pilih Kode Kredit",
              ajax: {
                  url: '{!! url("dropdown-akuntansi") !!}',
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
          $('#tambah-nama-barang').on('change', function (){
            var barang = $(this).val();
            if(barang == 'all'){
              Toast.fire({
                icon  : 'error',
                title : "Pilih Salah Satu Barang",
              });
            } else {
              $.ajax({
                url :'{!! url("data-barang/'+barang+'/edit") !!}',
                type : 'get',
                success : function(response){
                  console.log(response);
                  $('#tambah-satuan-barang').val(response.result.satuan);
                  $('#tambah-keterangan-barang').val(response.result.keterangan);
                }
              });
              $.ajax({
                type  : 'get',
                url   : '{!! url("hpp-barang/'+barang+'")!!}',
                data  : {
                  _token : token,
                  tanggal : time,
                },
                success:function(response){
                  console.log(response)
                  if(response.success == true) {
                    
                      $('#tambah-hpp-barang').val(formatRupiah(response.data));
                      $('#tambah-harga-barang').prop('min',response.data);
                  } else {
                    Toast.fire({
                      icon  :'error',
                      title : response.pesan,
                    });
                  }
                }
              });
            }
            
          });
          
          $('#form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#tambah-nama-barang').val();
            var so = $('#tmb-kode-so').val();
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
              url: '{!! url("data-detailso") !!}',
              data : {
                kode        : kode,
                satuan      : $('#tambah-satuan-barang').val(),
                konsumen    : $('#tmb-konsumen-so').val(),
                marketing    : $('#tmb-marketing-so').val(),
                _token      : token,
                so          : so,
                nama        : $('#tambah-namareq-barang').val(),
                vat         : $('#tmb-vat-so').val(),
                harga       : $('#tambah-harga-barang').val(),
                qty         : $('#tambah-qty-barang').val(),
                keterangan  : $('#tambah-keterangan-barang').val(),
                debit       : $('#tambah-debit-barang').val(),
                kredit      : $('#tambah-kredit-barang').val(),
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
                  tabelSOtambah(so);
                  document.getElementById("form-tambah-barang").reset();
                  $('#tambah-barang').hide();
                  $('#btn-add-barang').show();
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
            @if($user->level == 'superadmin'||$user->level == 'ceo')
              $('#edit-hpp-barang').show();
            @else
              $('#edit-hpp-barang').hide();
            @endif
            $('#edit-barang').show();
            $('#tambah-barang').hide();
            $('#btn-add-barang').hide();
            $('#hapus-barang').hide();
            var kode = $(this).data('kode');
            console.log(kode);
            $.ajax({
              url :'{!! url("data-detailso/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                console.log(response);
                $('#edit-kode-barang').val(kode);
                $('#edit-nama-barang').val(response.data.nama);
                $('#edit-namareq-barang').val(response.data.nama_request),
                $('#edit-qty-barang').val(response.data.qty);
                $('#edit-harga-barang').val(response.data.harga);
                $('#edit-satuan-barang').val(response.data.satuan);
                $('#edit-keterangan-barang').val(response.data.keterangan);
                $('#edit-debit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.debit) //set value for option to post it
                          .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                      .val(response.data.debit) //select option of select2
                      .trigger("change"); //apply to select2
                $('#edit-debit-barang').select2({
                  placeholder:"Pilih Kode Debit",
                  ajax: {
                      url: '{!! url("dropdown-akuntansi") !!}',
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
                $('#edit-kredit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kredit) //set value for option to post it
                          .text(response.data.kredit+" "+response.data.nama_kredit )) //set a text for show in select
                      .val(response.data.kredit) //select option of select2
                      .trigger("change"); //apply to select2
                $('#edit-kredit-barang').select2({
                  placeholder:"Pilih Kode Kredit",
                  ajax: {
                      url: '{!! url("dropdown-akuntansi") !!}',
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
                $.ajax({
                  type  : 'get',
                  url   : '{!! url("hpp-barang/'+response.data.kode_brg+'")!!}',
                  data  : {
                    _token : token,
                    tanggal : time,
                  },
                  success:function(response){
                    console.log(response)
                    if(response.success == true) {
                      $('#edit-hpp-barang').val(response.data);
                      $('#edit-harga-barang').prop('min',response.data);
                    } else {
                      Toast.fire({
                        icon  :'error',
                        title : response.pesan,
                      });
                    }
                  }
                });
              }
            });
            
          });
          $('#btn-cancel-edit-barang').on('click',function(){
            $('#edit-barang').hide();
            $('#btn-add-barang').show();
          });
          $('#form-edit-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-edit-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edit-kode-barang').val();
            var so = $('#tmb-kode-so').val();
            $.ajax({
              type: 'put',
              url: '{!! url("data-detailso/'+kode+'") !!}',
              data : {
                kode        : kode,
                _token      : token,
                konsumen    : $('#tmb-konsumen-so').val(),
                marketing   : $('#tmb-marketing-so').val(),
                vat         : $('#tmb-vat-so').val(),
                nama        : $('#edit-namareq_barang').val(),
                harga       : $('#edit-harga-barang').val(),
                qty         : $('#edit-qty-barang').val(),
                keterangan  : $('#edit-keterangan-barang').val(),
                debit       : $('#edit-debit-barang').val(),
                kredit      : $('#edit-kredit-barang').val(),
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
                  tabelSOtambah(so);
                  document.getElementById("form-edit-barang").reset();
                  $('#edit-barang').hide();
                  $('#btn-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
                
              }
            });
          });
        // /Edit Barang
        // Hapus Barang
          $('body').on('click','.hapusbarang',function(){
            $('#edit-barang').hide();
            $('#tambah-barang').hide();
            $('#btn-add-barang').hide();
            $('#hapus-barang').show();
            var kode = $(this).data('kode');
            $.ajax({
              url :'{!! url("data-detailso/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                console.log(response);
                if(response.success == true){
                  $('#hapus-kode-barang').val(kode);
                  $('#hapus-nama-barang').html(response.data.nama);
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
                
              }
            });
          });
          $('#btn-cancel-hapus').on('click', function(){
            $('#hapus-barang').hide();
            $('#btn-add-barang').show();
          });
          $('#form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#hapus-kode-barang').val();
            var so = $('#tmb-kode-so').val();
            $.ajax({
              type: 'delete',
              url: '{!! url("data-detailso/'+kode+'") !!}',
              data : {
                user : "{{$user->kode_karyawan}}",
                _token      : token,
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelSOtambah(so);
                  $('#hapus-barang').hide();
                  $('#btn-add-barang').show();
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: hasil
                  })
                }
                
              }
            });
          });
        // /Hapus Barang
        $('#tmbso').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-submit-so');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#tmb-kode-so').val();
          var time = $('#tmb-time-so').val();
          $.ajax({
            type: 'post',
            url: '{!! url("data-so") !!}',
            data : {
              kode        : kode,
              tanggal     : $('#tmb-tgl-so').val(),
              _token      : token,
              jenis       : $('#tmb-jenis-so').val(),
              marketing   : $('#tmb-marketing-so').val(),
              konsumen    : $('#tmb-konsumen-so').val(), 
              pembayaran  : $('#tmb-bayar-so').val(),
              term        : $('#tmb-term-so').val(),
              po          : $('#tmb-po-so').val(),
              vat         : $('#tmb-vat-so').val(),
              delivery    : $('#tmb-date-so').val(),
              keterangan  : $('#tmb-keterangan-so').val(),
              time        : $('#tmb-time-so').val(),
              author      : "{{$detail->kode}}",
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
                var table = $('#tabel-so').DataTable(); 
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
      // Tambah SO
      // Edit SO
        $(document).on('click','.edit',function(){
          var kode = $(this).data('kode');
          $('#edt-tambah-barang').hide();
          $('#edt-barang').hide();
          $('#edt-hapus-barang').hide();
          $.ajax({
            url :'{!! url("data-so/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              console.log(response.so);
              
              $('#edt-tgl-so').val(response.so.tanggal);
              $('#edt-kode-so').val(kode);
              if(response.so.jenis == 51 ){
                $('#edt-jenis-so').val('Asset');
              } else if(response.so.jenis == 31){
                $('#edt-jenis-so').val('Bahan Baku');
              } else if(response.so.jenis == 21){
                $('#edt-jenis-so').val('Jasa');
              } else if(response.so.jenis == 61){
                $('#edt-jenis-so').val('Bahan Jadi');
              } else {
                $('#edt-jenis-so').val('');
              }
              $('#edt-marketing-so')
                  .empty() //empty select
                  .append($("<option/>") //add option tag in select
                      .val(response.so.marketing) //set value for option to post it
                      .text(response.so.karyawan )) //set a text for show in select
                  .val(response.so.marketing) //select option of select2
                  .trigger("change"); //apply to select2
              $('#edt-marketing-so').select2({
                ajax: {
                    url: '{!! url("dropdown-marketing") !!}',
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
              $('#edt-konsumen-so').empty() //empty select
                .append($("<option/>") //add option tag in select
                    .val(response.so.konsumen) //set value for option to post it
                    .text(response.so.rekanan)) //set a text for show in select
                .val(response.so.konsumen) //select option of select2
              $('#edt-konsumen-so').select2({
                ajax: {
                    url: '{!! url("dropdown-konsumen") !!}',
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
              $('#edt-bayar-so').val(response.so.pembayaran);
              $('#edt-date-so').val(response.so.tanggal);
              $('#edt-bayar-so').val(response.so.pembayaran);
              $('#edt-vat-so').val(response.so.vat);
              $('#edt-po-so').val(response.so.no_po);
              $('#edt-date-so').val(response.so.tgl_diterima);
              $('#edt-term-so').val(response.so.term_payment);
              $('#edt-keterangan-so').val(response.so.keterangan);
              console.log(response.author);
              if(response.so.status == 'Belum Diperiksa'){
                $('#edt-nama-pembuat').html(response.author.creator.nama);
                $('#edt-create-pembuat').html(response.author.created_at);
                $('#edt-nama-pemeriksa').html("-");
                $('#edt-create-pemeriksa').html("-");
              } else if(response.so.status =='Sudah Diperiksa'){
                @if($user->level == 'marketing')
                  Toast.fire({
                    icon  : 'error',
                    title  : 'Anda Tidak Memiliki Akses di Menu ini',
                  });
                  $('#modal-edit').modal('hide');
                @else

                @endif
                $('#edt-nama-pembuat').html(response.author.creator.nama);
                $('#edt-create-pembuat').html(response.author.created_at);
                $('#edt-nama-pemeriksa').html(response.author.pemeriksa.nama);
                $('#edt-create-pemeriksa').html(response.author.diperiksa);
              } 
              tabelSOedit(kode);
            }
          });
        });
        //Tambah Barang
          $(document).on('click','#edt-btn-add-barang', function(){
            @if($user->level == 'superadmin'||$user->level == 'ceo')
              $('#edt-tambah-hpp-barang').show();
            @else
              $('#edt-tambah-hpp-barang').hide();
            @endif

            $('#edt-tambah-barang').show();
            $('#edt-btn-add-barang').hide();
            document.getElementById("edt-form-tambah-barang").reset();
            $('#edt-tambah-nama-barang').empty();
            $('#edt-tambah-nama-barang').select2({
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
            $('#edt-tambah-debit-barang').select2({
              placeholder:"Pilih Kode Debit",
              ajax: {
                  url: '{!! url("dropdown-akuntansi") !!}',
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
              placeholder:"Pilih Kode Kredit",
              ajax: {
                  url: '{!! url("dropdown-akuntansi") !!}',
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
          $('#edt-tambah-nama-barang').on('change', function (){
            var barang = $(this).val();
            $.ajax({
              url :'{!! url("data-barang/'+barang+'/edit") !!}',
              type : 'get',
              success : function(response){
                console.log(response);
                $('#edt-tambah-satuan-barang').val(response.result.satuan);
              }
            });
            $.ajax({
              type  : 'get',
              url   : '{!! url("hpp-barang/'+barang+'")!!}',
              data  : {
                _token : token,
                tanggal : time,
              },
              success:function(response){
                console.log(response)
                if(response.success == true) {
                  $('#edt-tambah-hpp-barang').val(response.data);
                  $('#edt-tambah-harga-barang').prop('min',response.data);
                } else {
                  Toast.fire({
                    icon  :'error',
                    title : response.pesan,
                  });
                }
              }
            });
          });
          $('#edt-form-tambah-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-tambah-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-tambah-nama-barang').val();
            var so = $('#edt-kode-so').val();
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
              url: '{!! url("data-detailso") !!}',
              data : {
                kode        : kode,
                satuan      : $('#edt-tambah-satuan-barang').val(),
                _token      : token,
                so          : so,
                nama        : $('#edt-tambah-namareq-barang').val(),
                konsumen    : $('#edt-konsumen-so').val(),
                marketing   : $('#edt-marketing-so').val(),
                vat         : $('#edt-vat-so').val(),
                harga       : $('#edt-tambah-harga-barang').val(),
                qty         : $('#edt-tambah-qty-barang').val(),
                keterangan  : $('#edt-tambah-keterangan-barang').val(),
                user : "{{$user->kode_karyawan}}",
                debit       : $('#edt-tambah-debit-barang').val(),
                kredit      : $('#edt-tambah-kredit-barang').val(),
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelSOedit(so);
                  document.getElementById("edt-form-tambah-barang").reset();
                  $('#edt-tambah-barang').hide();
                  $('#edt-btn-add-barang').show();
                  $('#btn-edit-x-so').prop('disabled',true);
                  $('#edt-btn-close-so').prop('disabled',true);
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
          $(document).on('click','.edtbarang',function(){
            @if($user->level == 'superadmin'||$user->level == 'ceo')
              $('#edt-hpp-barang').show();
            @else
              $('#edt-hpp-barang').hide();
            @endif
            $('#edt-barang').show();
            $('#edt-tambah-barang').hide();
            $('#edt-hapus-barang').hide();
            $('#edt-btn-add-barang').hide();
            var kode = $(this).data('kode');
            console.log(kode);
            $.ajax({
              url :'{!! url("data-detailso/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                console.log(response);
                if(response.success == true){
                  $('#edt-kode-barang').val(kode);
                  $('#edt-nama-barang').val(response.data.nama);
                  $('#edt-namareq-barang').val(response.data.nama_request);
                  $('#edt-qty-barang').val(response.data.qty);
                  $('#edt-harga-barang').val(response.data.harga);
                  $('#edt-satuan-barang').val(response.data.satuan);
                  $('#edt-keterangan-barang').val(response.data.keterangan);
                  $('#edt-debit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.debit) //set value for option to post it
                          .text(response.data.debit+" "+response.data.nama_debit )) //set a text for show in select
                      .val(response.data.debit) //select option of select2
                      .trigger("change"); //apply to select2
                  $('#edt-debit-barang').select2({
                    placeholder:"Pilih Kode Kredit",
                    ajax: {
                        url: '{!! url("dropdown-akuntansi") !!}',
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
                  $('#edt-kredit-barang')
                      .empty() //empty select
                      .append($("<option/>") //add option tag in select
                          .val(response.data.kredit) //set value for option to post it
                          .text(response.data.kredit+" "+response.data.nama_kredit )) //set a text for show in select
                      .val(response.data.kredit) //select option of select2
                      .trigger("change"); //apply to select2
                  $('#edt-kredit-barang').select2({
                    placeholder:"Pilih Kode Kredit",
                    ajax: {
                        url: '{!! url("dropdown-akuntansi") !!}',
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
                  $.ajax({
                    type  : 'get',
                    url   : '{!! url("hpp-barang/'+response.data.kode_brg+'")!!}',
                    data  : {
                      _token : token,
                      tanggal : time,
                    },
                    success:function(response){
                      console.log(response)
                      if(response.success == true) {
                        $('#edt-hpp-barang').val(response.data);
                        $('#edt-harga-barang').prop('min',response.data);
                      } else {
                        Toast.fire({
                          icon  :'error',
                          title : response.pesan,
                        });
                      }
                    }
                  });
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
                
              }
            });
            $('#edt-debit-barang').select2({
              placeholder:"Pilih Kode Debit",
              ajax: {
                  url: '{!! url("dropdown-akuntansi") !!}',
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
            $('#edt-kredit-barang').select2({
              placeholder:"Pilih Kode Kredit",
              ajax: {
                  url: '{!! url("dropdown-akuntansi") !!}',
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
          $('#edt-btn-cancel-barang').on('click',function(){
            $('#edt-barang').hide();
            $('#edt-btn-add-barang').show();
          });
          $('#form-edt-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-kode-barang').val();
            var so = $('#edt-kode-so').val();
            $.ajax({
              type: 'put',
              url: '{!! url("data-detailso/'+kode+'") !!}',
              data : {
                kode        : kode,
                so          : so,
                _token      : token,
                nama        : $('#edt-namareq-barang').val(),
                harga       : $('#edt-harga-barang').val(),
                qty         : $('#edt-qty-barang').val(),
                keterangan  : $('#edt-keterangan-barang').val(),
                debit       : $('#edt-debit-barang').val(),
                kredit       : $('#edt-kredit-barang').val(),
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
                  tabelSOedit(so);
                  document.getElementById("form-edt-barang").reset();
                  $('#edt-barang').hide();
                  $('#btn-edit-x-so').prop('disabled',true);
                  $('#edt-btn-close-so').prop('disabled',true);
                  $('#edt-btn-add-barang').show();
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
          $(document).on('click','.hpsbarang', function(){
            $('#edt-hapus-barang').show();
            $('#edt-barang').hide();
            $('#edt-tambah-barang').hide();
            $('#edt-btn-add-barang').hide();
            var kode = $(this).data('kode');
            $.ajax({
              url :'{!! url("data-detailso/'+kode+'/edit") !!}',
              type : 'get',
              success : function(response){
                console.log(response);
                if(response.success == true){
                  $('#edt-hapus-kode-barang').val(kode);
                  $('#edt-hapus-nama-barang').html(response.data.nama);
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: response.pesan
                  })
                }
                
              }
            });
          });
          $(document).on('click','#edt-btn-cancel-hapus',function(){
            $('#edt-hapus-barang').hide();
            $('#edt-btn-add-barang').show();
          });
          $('#edt-form-hapus-barang').submit(function(e){
            e.preventDefault(); // prevent actual form submit
            var el = $('#edt-btn-hapus-barang');
            el.prop('disabled', true);
            setTimeout(function(){el.prop('disabled', false); }, 4000);
            var token = "{!! csrf_token() !!}";
            var kode = $('#edt-hapus-kode-barang').val();
            var so = $('#edt-kode-so').val();
            $.ajax({
              type: 'delete',
              url: '{!! url("data-detailso/'+kode+'") !!}',
              data : {
                kode        : kode,
                user : "{{$user->kode_karyawan}}",
                _token      : token,
              }, // serializes form input
              success:function(response) {
                console.log(response);
                var hasil = response.pesan;
                if(response.success == true){
                  Toast.fire({
                    icon: 'success',
                    title: hasil
                  })
                  tabelSOedit(so);
                  $('#edt-hapus-barang').hide();
                  $('#edt-btn-add-barang').show();
                  $('#btn-edit-x-so').prop('disabled',true);
                  $('#edt-btn-close-so').prop('disabled',true);
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
        $('#edt-vat-so').keyup(function(){
          var vat = $(this).val();
          if( vat == null ){
            return false;
          } else{
            var so = $('#edt-kode-so').val();
            $.ajax({
              url :'{!! url("vat-detailso") !!}',
              type : 'get',
              data  :{
                vat  : vat,
                so   : so
              },
              success : function(response){
                tabelSOedit(so);
              }
            });
          }
          
        });
        $('#edtso').submit(function(e){
          var marketing = $('#edt-marketing-so').val();
          var konsumen = $('#edt-konsumen-so').val();
          var bayar = $('#edt-bayar-so').val();
          var vat = $('#edt-vat-so').val();
          var ket = $('#edt-keterangan-so').val();
          if(marketing == null){
            alert('Marketing Tidak Boleh Kosong');
            return false;
          } else if(konsumen == null){
            alert('Konsumen Tidak Boleh Kosong');
            return false;
          } else if(bayar == null){
            alert('Pembayaran Tidak Boleh Kosong');
            return false;
          } else if(vat == null || vat < 0 ){
            alert('VAT Tidak Boleh Kosong');
            return false;
          } else if(ket == null){
            alert('Keterangan Tidak Boleh Kosong');
            return false;
          }
          e.preventDefault(); // prevent actual form submit
          var el = $('#edt-btn-submit-so');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#edt-kode-so').val();
          var today = new Date();
          var tgl = today.getDate();
          if(tgl == 1 || tgl == 2 || tgl == 3 || tgl == 4 || tgl == 5 || tgl == 6 || tgl == 7 || tgl == 8 || tgl == 9){
            tgl = '0'+tgl;
          }
          var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+tgl;
          var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
          var time = date+' '+time;
          $.ajax({
            type: 'put',
            url: '{!! url("data-so/'+kode+'") !!}',
            data : {
              kode        : kode,
              tanggal     : $('#edt-tgl-so').val(),
              _token      : token,
              jenis       : $('#edt-jenis-so').val(),
              marketing   : $('#edt-marketing-so').val(),
              konsumen    : $('#edt-konsumen-so').val(), 
              pembayaran  : $('#edt-bayar-so').val(),
              term        : $('#edt-term-so').val(),
              po          : $('#edt-po-so').val(),
              vat         : $('#edt-vat-so').val(),
              delivery    : $('#edt-date-so').val(),
              keterangan  : $('#edt-keterangan-so').val(),
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
                $('#modal-edit').modal('hide');
                var table = $('#tabel-so').DataTable(); 
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
      // Edit SO
      // Detail SO
        $(document).on('click','.detail',function(){
          var kode = $(this).data('kode');
          $.ajax({
            url :'{!! url("data-so/'+kode+'/edit") !!}',
            type : 'get',
            success : function(response){
              console.log(response.so);
              $('#detail-tgl-so').val(response.so.tanggal);
              $('#detail-kode-so').val(kode);
              if(response.so.jenis == 51 ){
                $('#detail-jenis-so').val('Asset');
              } else if(response.so.jenis == 31){
                $('#detail-jenis-so').val('Bahan Baku');
              } else if(response.so.jenis == 21){
                $('#detail-jenis-so').val('Jasa');
              } else if(response.so.jenis == 61){
                $('#detail-jenis-so').val('Bahan Jadi');
              } else {
                $('#detail-jenis-so').val('');
              }
              $('#detail-marketing-so').val(response.so.karyawan);
              $('#detail-konsumen-so').val(response.so.rekanan);
              $('#detail-bayar-so').val(response.so.pembayaran);
              $('#detail-vat-so').val(response.so.vat);
              $('#detail-term-so').val(response.so.term_payment);
              $('#detail-po-so').val(response.so.no_po);
              $('#detail-date-so').val(response.so.tgl_diterima);
              $('#detail-keterangan-so').val(response.so.keterangan);
              $('#cetak-so').on('click',function(e){
                var kode  = $('#detail-kode-so').val();
                location.href = 'cetak-so?kode='+kode;
              });
              console.log(response.author);
              if(response.so.status == 'Belum Diperiksa'){
                $('#detail-nama-pembuat').html(response.author.creator.nama);
                $('#detail-create-pembuat').html(response.author.created_at);
                $('#detail-nama-pemeriksa').html("-");
                $('#detail-create-pemeriksa').html("-");
              } else if(response.so.status =='Sudah Diperiksa'){
                $('#detail-nama-pembuat').html(response.author.creator.nama);
                $('#detail-create-pembuat').html(response.author.created_at);
                $('#detail-nama-pemeriksa').html(response.author.pemeriksa.nama);
                $('#detail-create-pemeriksa').html(response.author.diperiksa);
                $('#btn-detail-submit-so').hide();
              } 
              tabelSOdetail(kode);
            }
          });
        });
        @if($user->level == 'marketing')
          $('#btn-detail-submit-so').prop('disabled',true);
          $('#btn-detail-submit-so').hide();
        @else
        $('#btn-detail-submit-so').prop('disabled',false);
        $('#btn-detail-submit-so').show();
        @endif
        $('#dtlso').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-detail-submit-so');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#detail-kode-so').val();
          $.ajax({
            type: 'put',
            url: '{!! url("data-author/'+kode+'") !!}',
            data : {
              kode        : kode,
              _token      : token,
              konfirmator : "{{$user->kode_karyawan}}",
              time        : $('#tmb-time-so').val(),
              type        : "so",
              user : "{{$user->kode_karyawan}}",
            }, // serializes form input
            success:function(response) {
              console.log(response);
              var hasil = response.pesan;
              if( response.success == true){
                Toast.fire({
                  icon: 'success',
                  title: hasil
                })
                $('#modal-detail').modal('hide');
                var table = $('#tabel-so').DataTable(); 
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
      // Detail SO
      // SELESAI PO
        $('body').on('click','.selesai',function(){
            
            document.getElementById("form-selesai").reset();
            var kode = $(this).data('kode');
            document.getElementById("kode-selesai").innerHTML = kode;
            $('#selesai-kode').val(kode);
            @if($user->level == 'marketing')
              Toast.fire({
                icon  : 'error',
                title  : 'Anda Tidak Memiliki Akses di Menu ini',
              });
              $('#modal-selesai').modal('hide');
              $('#btn-selesai').prop('disabled',true);
            @else
            $('#btn-selesai').prop('disabled',false);
            @endif
          });
        $('#form-selesai').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var el = $('#btn-selesai');
          el.prop('disabled', true);
          setTimeout(function(){el.prop('disabled', false); }, 4000);
          var token = "{!! csrf_token() !!}";
          var kode = $('#selesai-kode').val();
          $.ajax({
            type    : 'put',
            url     : '{!! url("data-so-selesai/'+kode+'") !!}',
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
                var table = $('#tabel-so').DataTable(); 
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
      // Hapus SO
        $(document).on('click','.hapus',function(){
          var kode = $(this).data('kode');
          $('#hapus-kode-so').val(kode);
          $('#hapus-kode').html(kode);
        });
        $('#form-hapus-so').submit(function(e){
          e.preventDefault(); // prevent actual form submit
          var token = "{!! csrf_token() !!}";
          var kode =  $('#hapus-kode-so').val();
          $.ajax({
            type    : 'delete',
            url     : '{!! url("data-so/'+kode+'") !!}',
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
                $('#modal-hapus').modal('hide');
                var table = $('#tabel-so').DataTable(); 
                table.ajax.reload( null, false );
              } else {
                Toast.fire({
                  icon: 'error',
                  title: hasil
                })
              }
              
            },
            error:function(response){

            }
          });
        });
      // Hapus SO

      function tabelSOtambah(kode){
        $.ajax({
          url :'{!! url("data-detailso/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            console.log(response);
            $('#tbl_so_tambah').empty();
            var datahandler = $('#tbl_so_tambah');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  var dpp = response.data[n]['dpp'];
                  var vat = $('#tmb-vat-so').val();
                  var VAT = (dpp*vat)/100;
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item editbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hapusbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+kode+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                sum = sum+response.data[n]['total'];
                n = n+1;
            });
            var Nrow = $("<tr>");
            Nrow.html("<td colspan='10' style='text-align: center;color:red;'><b>Total</b></td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
            datahandler.append(Nrow);
          }
        });
      }
      function tabelSOedit(kode){
        $.ajax({
          url :'{!! url("data-detailso/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            console.log(response);
            $('#tbl_so_edit').empty();
            var datahandler = $('#tbl_so_edit');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  var dpp = response.data[n]['dpp'];
                  var vat = $('#edt-vat-so').val();
                  var VAT = (dpp*vat)/100;
                Nrow.html("<td><button type='button' class='btn btn-default'>Action</button><button type='button' class='btn btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown'><span class='sr-only'>Toggle Dropdown</span></button><div class='dropdown-menu' role='menu'><a class='dropdown-item edtbarang' style='color:orange' data-kode='"+response.data[n]['kode']+"'><b>Edit</b></a><a class='dropdown-item hpsbarang' style='color:red' data-kode='"+response.data[n]['kode']+"'><b>Hapus</b></a></div></td><td>"+nomor+"</td><td>"+kode+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                sum = sum+response.data[n]['total'];
                n = n+1;
            });
            var Nrow = $("<tr>");
            Nrow.html("<td colspan='10' style='text-align: center;color:red;'><b>Total</b></td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
            datahandler.append(Nrow);
          }
        });
      }
      function tabelSOdetail(kode){
        $.ajax({
          url :'{!! url("data-detailso/'+kode+'") !!}',
          type : 'get',
          success : function(response){
            console.log(response);
            $('#tbl_so_detail').empty();
            var datahandler = $('#tbl_so_detail');
            var n= 0;
            var sum = 0;
            $.each(response.data, function(key,val){
                var Nrow = $("<tr>");
                  var nomor = n+1;
                  var dpp = response.data[n]['dpp'];
                  var vat = $('#detail-vat-so').val();
                  var VAT = (dpp*vat)/100;
                Nrow.html("<td>"+nomor+"</td><td>"+kode+"</td><td>"+response.data[n]['nama']+"</td><td>"+response.data[n]['nama_request']+"</td><td>"+response.data[n]['satuan']+"</td><td>"+formatRupiah(response.data[n]['harga'])+"</td><td>"+response.data[n]['qty']+"</td><td>"+formatRupiah(response.data[n]['dpp'])+"</td><td>"+formatRupiah(VAT)+"</td><td>"+formatRupiah(response.data[n]['total'])+"</td><td>"+response.data[n]['keterangan']+"</td><td>"+response.data[n]['debit']+"</td><td>"+response.data[n]['nama_debit']+"</td><td>"+response.data[n]['kredit']+"</td><td>"+response.data[n]['nama_kredit']+"</td></tr>");
                datahandler.append(Nrow);
                sum = sum+response.data[n]['total'];
                n = n+1;
            });
            var Nrow = $("<tr>");
            Nrow.html("<td colspan='9' style='text-align: center;color:red;'><b>Total</b></td><td><b>"+formatRupiah(sum)+"</b></td></tr>");
            datahandler.append(Nrow);
          }
        });
      }

      


      function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(money);
      }
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });

    

    </script>
  </body>
</html>

