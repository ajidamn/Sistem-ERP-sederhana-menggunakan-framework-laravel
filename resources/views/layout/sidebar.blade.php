<!-- MAIN content sidebar -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        {{-- <img src="{{asset('img')}}/logo.png"  class="brand-image" style="opacity: .8">
        <span class=""><h6> CV. Nusa Pratama Anugerah</h6></span> --}}
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
            {{-- <a href="#" class="d-block"><b>{{$detail->nama}} AS {{$user->level}}</b></a> --}}
        </div>
        </div>
    
        <!-- SidebarSearch Form -->
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            {{-- @if($user->level == 'admin')
            <div class="admin">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Penjualan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="sales-order" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="invoice" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="surat-jalan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="purchase-order" class="nav-link" id="help-it">
                        <i class="	fas fa-shopping-cart nav-icon"></i>
                        <p>Purchase Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Inventory
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="stock-gudang" class="nav-link">
                                <i class="far fa-circle nav-icon"> </i>
                                <p>Stock Barang Gudang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kartu-stock-gudang" class="nav-link">
                                <i class="far fa-circle nav-icon"> </i>
                                <p>Kartu Stock Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="kas-masuk" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kas-keluar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a href="laporan-penjualan" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                    <li class="nav-item">
                        <a href="master-karyawan" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Karyawan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-rekanan" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p> Data Rekanan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-barang" class="nav-link">
                            <i class="nav-icon fab fa-dropbox"></i>
                            <p>Data Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-akuntansi" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Data Perkiraan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-gudang" class="nav-link">
                            <i class="fas fa-warehouse nav-icon"></i>
                            <p>Data Gudang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-bank" class="nav-link">
                            <i class="fas fa-piggy-bank nav-icon"></i>
                            <p>Data Bank</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-asset" class="nav-link">
                            <i class="fas fa-landmark nav-icon"></i>
                            <p>Data Asset</p>
                        </a>
                    </li>
                </li>
               
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
            </div>
            @elseif($user->level == 'accounting')
            <div class="accounting">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Inventory
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="stock-gudang" class="nav-link">
                                <i class="far fa-circle nav-icon"> </i>
                                <p>Stock Barang Gudang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kartu-stock-gudang" class="nav-link">
                                <i class="far fa-circle nav-icon"> </i>
                                <p>Kartu Stock Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="kas-masuk" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kas-keluar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Laporan</li>
                <li class="nav-item">
                    <a href="laporan-penjualan" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="search-jurnal" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Rekap Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="laporan-bukubesar" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Buku Besar</p>
                    </a>
                </li>
                <li class="nav-header">DATA MASTER</li>
                    <li class="nav-item">
                        <a href="master-akuntansi" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Data Perkiraan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-bank" class="nav-link">
                            <i class="fas fa-piggy-bank nav-icon"></i>
                            <p>Data Bank</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="master-asset" class="nav-link">
                            <i class="fas fa-landmark nav-icon"></i>
                            <p>Data Asset</p>
                        </a>
                    </li>
                </li>
               
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
            </div>
            @elseif($user->level == 'superadmin')
            <div class="superadmin">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                        Marketing
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="marketing-lapor" class="nav-link">
                                <i class="nav-icon far fa-list-alt"></i>
                                <p>
                                    Laporan harian Marketing
                                </p>
                            </a>        
                        </li>
                        <li class="nav-item">
                            <a href="planning-mingguan" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Planning Mingguan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="database-marketing" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Database Marketing
                                </p>
                            </a>        
                        </li>
                        <li class="nav-item">
                            <a href="plan-marketing" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Aksi Database Marketing
                                </p>
                            </a>        
                        </li>
                        
                    </ul>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Penjualan
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="sales-order" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="invoice" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="surat-jalan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                        Pembelian
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="purchase-order" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchase Order</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="material-receive" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Material Receive</p>
                        </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="kas-masuk" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kas-keluar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                <a href="master-karyawan" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                    Data Karyawan
                    
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="master-rekanan" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                        Data Rekanan
                        
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="master-barang" class="nav-link">
                        <i class="nav-icon fab fa-dropbox"></i>
                        <p>
                        Data Barang
                        
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="master-akuntansi" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                    Data Perkiraan
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="master-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p>Data Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="master-bank" class="nav-link">
                        <i class="fas fa-piggy-bank nav-icon"></i>
                        <p>Data Bank</p>
                    </a>
                </li>
                <li class="nav-header">Inventory</li>
                <li class="nav-item">
                    <a href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-header">Laporan Keuangan</li>
                <li class="nav-item">
                    <a href="laporan-penjualan" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="search-jurnal" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Rekap Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="laporan-bukubesar" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Buku Besar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inbox</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="pages/mailbox/compose.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Compose</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Read</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                <li class="nav-item">
                <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Documentation</p>
                </a>
                </li>
            </div>
            @elseif($user->level == 'ceo')
            <div class="ceo">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="marketing" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                    Laporan Marketing
                    
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                        Penjualan
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="sales-order" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sales Order</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="invoice" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="surat-jalan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                        Pembelian
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="purchase-order" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Purchase Order</p>
                        </a>
                        </li>
                        <li class="nav-item">
                            <a href="material-receive" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Material Receive</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Kas Bank
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="kas-masuk" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Masuk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="kas-keluar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kas Keluar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan-kas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">DATA MASTER</li>
                <li class="nav-item">
                <a href="master-karyawan" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                    Data Karyawan
                    
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="master-rekanan" class="nav-link">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                        Data Rekanan
                        
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="master-barang" class="nav-link">
                        <i class="nav-icon fab fa-dropbox"></i>
                        <p>
                        Data Barang
                        
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                <a href="master-akuntansi" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                    Data Perkiraan
                    </p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="master-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"></i>
                        <p>Data Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="master-bank" class="nav-link">
                        <i class="fas fa-piggy-bank nav-icon"></i>
                        <p>Data Bank</p>
                    </a>
                </li>
                <li class="nav-header">Inventory</li>
                <li class="nav-item">
                    <a href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-header">Laporan Keuangan</li>
                <li class="nav-item">
                    <a href="laporan-penjualan" class="nav-link">
                        <i class="fas fa-file-invoice nav-icon"> </i>
                        <p>Laporan Penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="search-jurnal" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Rekap Jurnal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="laporan-bukubesar" class="nav-link">
                        <i class="fas fa-book nav-icon"> </i>
                        <p>Laporan Buku Besar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inbox</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="pages/mailbox/compose.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Compose</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Read</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                <li class="nav-item">
                <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Documentation</p>
                </a>
                </li>
            </div>
            @elseif($user->level == 'staff-gudang')
            <div class="staff-gudang">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="surat-jalan" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Surat Jalan</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="material-receive" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Material Receive</p>
                    </a>
                </li>
                <li class="nav-header">Inventory</li>
                <li class="nav-item">
                    <a href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="" class="nav-link" id="help-admin">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
            </div>
            @elseif($user->level == 'manager-operasional')
            <div class="manager-operational">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="surat-jalan" class="nav-link">
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Surat Jalan</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="material-receive" class="nav-link">
                        <i class="fas fa-box-open nav-icon"></i>
                        <p>Material Receive</p>
                    </a>
                </li>
                <li class="nav-header">Inventory</li>
                <li class="nav-item">
                    <a href="stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="kartu-stock-gudang" class="nav-link">
                        <i class="fas fa-warehouse nav-icon"> </i>
                        <p>Kartu Stock Barang Gudang</p>
                    </a>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="" class="nav-link" id="help-admin">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
            </div>
            @elseif($user->level == 'manager-marketing')
            <div class="manager-marketing">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sales-order" class="nav-link">
                        <i class="	fas fa-money-bill-wave nav-icon"></i>
                        <p> Sales Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="marketing-lapor" class="nav-link">
                        <i class="nav-icon 	far fa-file-alt"></i>
                        <p>
                            Laporan Harian 
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="planning-mingguan" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Planning Mingguan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="omset" class="nav-link">
                        <i class="nav-icon 	fas fa-dollar-sign"></i>
                        <p>
                        Omset Bulan ini
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="omset" class="nav-link">
                        <i class="nav-icon  fas fa-history"></i>
                        <p>
                        Riwayat Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="" class="nav-link" id="help-admin">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
            </div>
            @elseif($user->level == 'marketing')
            <div class="marketing">
                <li class="nav-item ">
                    <a href="home" class="nav-link " >
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sales-order" class="nav-link">
                        <i class="	fas fa-money-bill-wave nav-icon"></i>
                        <p> Sales Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="marketing-lapor" class="nav-link">
                        <i class="nav-icon 	far fa-file-alt"></i>
                        <p>
                            Laporan Harian 
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="planning-mingguan" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Planning Mingguan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="omset" class="nav-link">
                        <i class="nav-icon 	fas fa-dollar-sign"></i>
                        <p>
                        Omset Bulan ini
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="omset" class="nav-link">
                        <i class="nav-icon  fas fa-history"></i>
                        <p>
                        Riwayat Penjualan
                        </p>
                    </a>
                </li>
                <li class="nav-header">Bantuan</li>
                <li class="nav-item">
                    <a href="" class="nav-link" id="help-admin">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan Admin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="wa.me/+62856938533225" class="nav-link" id="help-it">
                        <i class="fab fa-hire-a-helper nav-icon"></i>
                        <p>Bantuan IT</p>
                    </a>
                </li>
            </div> 
            
            @endif --}}
            <li class="nav-item ">
                <a href="programming-test" class="nav-link " >
                    <p>Programming Test </p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="structure-test" class="nav-link " >
                    <p>Structure Test </p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="query-test" class="nav-link " >
                    <p>Query Test </p>
                </a>
            </li>
            <!-- <li class="nav-item ">
                <a href="main" class="nav-link " >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard </p>
                </a>
            </li>
            <li class="nav-item">
            <a href="marketing" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                Laporan Marketing
                
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                Penjualan
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="sales-order" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sales Order</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="invoice" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Invoice</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="surat-jalan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Surat Jalan</p>
                </a>
                </li>
                
            </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    <i class="nav-icon fa fa-shopping-cart"></i>
                    <p>
                    Pembelian
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="purchase-order" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Purchase Order</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="material-receive" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Material Receive</p>
                    </a>
                    </li>
                    
                    
                </ul>
            </li>
            <li class="nav-header">DATA MASTER</li>
            <li class="nav-item">
            <a href="data-karyawan" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Data Karyawan
                
                </p>
            </a>
            </li>
            <li class="nav-item">
                <a href="data-rekanan" class="nav-link">
                    <i class="nav-icon fas fa-user-plus"></i>
                    <p>
                    Data Rekanan
                    
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="data-barang" class="nav-link">
                    <i class="nav-icon fab fa-dropbox"></i>
                    <p>
                    Data Barang
                    
                    </p>
                </a>
            </li>
            <li class="nav-item">
            <a href="data-kode-akuntasi" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                Data Perkiraan
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a  class="nav-link">
                <i class="nav-icon fa fa-plus"></i>
                <p>
                Data Tambahan
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="data-gudang" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Gudang</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="data-bank" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Bank</p>
                </a>
                </li>
            </ul>
            </li>
            
            <li class="nav-header">Laporan Keuangan</li>
            <li class="nav-item">
            <a href="iframe.html" class="nav-link">
                <i class="nav-icon fas fa-ellipsis-h"></i>
                <p>Tabbed IFrame Plugin</p>
            </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                    Mailbox
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <a href="pages/mailbox/mailbox.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inbox</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="pages/mailbox/compose.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Compose</p>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Read</p>
                    </a>
                    </li>
                </ul>
                </li>
            <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Documentation</p>
            </a>
            </li> -->
            
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>