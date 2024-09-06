<!DOCTYPE html>
<html lang="en">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  
    @include('layout/head')

    <style>
    @page { size: A4};
</style>
<head>
  <title>Cetak Material Receive</title>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="">
    
    
    <table cellpadding="5" style="border:1px  solid;">
        <tr class="justify-content-left">
            <td>
              <p>
                <b style="font-size: 150%;">CV. Nusa Pratama Anugrah</b><br>
                Chemical Cleaning, Industry, Argo <br>
                <b>Taman Pondok Jati AR-2, Geluran , Taman, Sidoarjo, Email : nusapratama.anugrah@gmail.com</b>
              </p>
                    <!-- <label><b style="font-size: 150%">CV. Nusa Pratama Anugrah</b></label>
                    <br>Chemical Cleaning, Industry, Argo <br> <b>Taman Pondok Jati AR-2, Geluran , Taman, Sidoarjo, Email : nusapratama.anugrah@gmail.com</b> -->
            </td>
            <td  width="10%">
                <img src="{{asset('img')}}/logo.png"  class="brand-image" width="60%">
            </td>
            <td width="30%">
              
            </td>
            
        </tr>
    </table>
    </style>
    <table cellpadding="5" style="border:1px solid black;" width="100%" >
      <tr>
        <td colspan="2" align="center" width="50%" height style="border:1px solid black;">
          <h3><b>MATERIAL RECEIVE</b></h3>
        </td>
        <td width="25%" style="border:1px solid black;">
          <b>Nomor Material Receive</b>
          <br>
          <b id="no-nota"></b>
        </td>
        <td width="25%" style="border:1px solid black;">
          <b>Tanggal</b>
          <br>
          <b id="tgl"> 
            <script type='text/javascript'>

              var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              
              var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
              
              var date = new Date();
              
              var day = date.getDate();
              
              var month = date.getMonth();
              
              var thisDay = date.getDay(),
              
                  thisDay = myDays[thisDay];
              
              var yy = date.getYear();
              
              var year = (yy < 1000) ? yy + 1900 : yy;
              
              document.write(day + ' ' + months[month] + ' ' + year);
            </script>
          </b>
        </td>
      </tr>
      <tr>
        <td rowspan="3" colspan="2" style="border:1px solid black;" id="data-supplier">
            <b>Supplier</b>
            <br>
            <b id="supplier"></b>
            <br>
            <b>Alamat :</b>
            <br>
            <b id="alamat"></b>
        </td>
        <td style="border:1px solid black;">
          <b>No. Telp</b>
          <br>
          <b id="telp-supplier">-</b>
        </td>
        <td style="border:1px solid black;">
          <b> Tgl Penerimaan</b>
          <br>
          <b id="tgl-penerimaan">
            
          </b>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="border:1px solid black;">
          <b>Kode Surat Jalan</b>
          <br>
          <b id="surat-jalan"></b>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="border:1px solid black;">
          <b>KETERANGAN</b>
          <br>
          <b id="keterangan"></b>
        </td>
      </tr>
      <tr>
        <td colspan="4" style="border:1px solid black;">
          <b>Barang/jasa dan spesifikasinya adalah sebagai berikut :</b>
        </td>
      </tr>
    </table>
    <table cellpadding="5" style="border:1px solid black;" width="100%" >
      <thead align="center" >
        <td width="5%" style="border:1px solid black;"><b>No.</b></td>
        <td width="45%" style="border:1px solid black;"><b>Barang/Jasa dan Spesifikasi</b></td>
        <td style="border:1px solid black;"><b>Dikirim</b></td>
        <td style="border:1px solid black;"><b>Diterima</b></td>
        <td style="border:1px solid black;"><b>Diakui</b></td>
        <td style="border:1px solid black;"><b>Packing</b></td>
        <td style="border:1px solid black;"><b>SATUAN</b></td>
      </thead>
      <tbody id="detail-mr">
        
      </tbody>
      <tr>
        <td colspan="7" width="40" style="border:1px solid black;">
          <div class="row justify-content-around">
            <b>Penerima</b>
            <b>Admin</b>
          </div>
          <br><br>
          <div class="row justify-content-around">
            <b>_________</b>
            <b>_________</b>
          </div>
          
        </td>
        
      </tr>
    </table>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins')}}/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<script>


    $(document).ready(function() {   
    var kode = "<?php echo $_GET['kode'];?>";

    $.ajax({
        url     :'{!! url("cetakmr/'+kode+'") !!}',
        type    : 'get',
        success : function(data) {
            console.log(data);
            var tipe = kode.substr(3,2);
            if(tipe == 61){
              $('#no-nota').html(kode);
              $('#supplier').html(data.mr.nama+" "+data.mr.nama_perusahaan);
              $('#alamat').html(data.mr.alamat);
              $('#telp-supplier').html(data.mr.telp);
              $('#tgl-penerimaan').html(Tanggal(data.mr.tanggal));
              $('#surat-jalan').html(data.mr.surat_jalan);
            } else {
              $('#no-nota').html(kode);
              $('#supplier').html("-");
              $('#alamat').html("-");
              $('#tgl-penerimaan').html(Tanggal(data.mr.tanggal));  
              $('#surat-jalan').html("-");
            }
            
            // $('#keterangan').html(data.detail.0.gudang+"<br>"+data.detail.0.alamat);
            // if(tipe == 41){
            //   $('#customer').html(data.konsumen.nama_perusahaan+"<br>"+data.konsumen.nama);
            //   if(data.konsumen.alamat == null ){
            //     $('#alamat').html("<br>"+data.sj.alamat);
            //   } else {
            //     $('#alamat').html("<br>"+data.konsumen.alamat);
            //   }
            //   $('#telp-customer').html(data.konsumen.telp);
            //   $('#no-nota').html(data.invoice.kode);
            // } else {
            //   $('#data-customer').html("-");
            // }
            // $('#keterangan').html(data.sj.keterangan);
            // detail = data.detail;
            var detail = data.detail;
            var datahandler = $('#detail-mr');
            var n= 0;
            $('#keterangan').html("Gudang : "+detail[n]['gudang']+"<br> Alamat   : "+detail[n]['alamat']);
            $.each(detail, function(key,val){
                var Nrow = $("<tr>");
                var nomor = n+1;
                Nrow.html("<td align='center'>"+nomor+".</td><td>"+detail[n]['barang']+"<br>"+detail[n]['keterangan']+"</td><td align='center'>"+detail[n]['dikirim']+"</td><td align='center'>"+detail[n]['diterima']+"</td><td align='center'>"+detail[n]['diakui']+"</td><td align='center'>"+detail[n]['packing']+"</td><td align='center'>"+detail[n]['satuan']+"</td></tr>");  
               
                datahandler.append(Nrow);
                n = n+1;
            });
            // window.print();
        }
    })
        
    });
    function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
            { style: 'currency', currency: 'IDR' }
        ).format(money);
    }
    function Tanggal(tanggal){
        var date = tanggal;
        var tahun = date.substr(0,4);
        var bulan = parseInt(date.substr(5,2));
        bulan = bulan-1;
        var tanggal = parseInt(date.substr(8,2));
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        
        
        
        return tanggal + ' ' + months[bulan] + ' ' + tahun;
    }
    function terbilang(angka){
        var bilne=["","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas"];
        if(angka < 12){

            return bilne[angka];

        }else if(angka < 20){

            return terbilang(angka-10)+" belas";

        }else if(angka < 100){

            return terbilang(Math.floor(parseInt(angka)/10))+" Puluh "+terbilang(parseInt(angka)%10);

        }else if(angka < 200){

            return "Seratus "+terbilang(parseInt(angka)-100);

        }else if(angka < 1000){

            return terbilang(Math.floor(parseInt(angka)/100))+" Ratus "+terbilang(parseInt(angka)%100);

        }else if(angka < 2000){

            return "Seribu "+terbilang(parseInt(angka)-1000);

        }else if(angka < 1000000){

            return terbilang(Math.floor(parseInt(angka)/1000))+" Ribu "+terbilang(parseInt(angka)%1000);

        }else if(angka < 1000000000){

            return terbilang(Math.floor(parseInt(angka)/1000000))+" Juta "+terbilang(parseInt(angka)%1000000);

        }else if(angka < 1000000000000){

            return terbilang(Math.floor(parseInt(angka)/1000000000))+" Milyar "+terbilang(parseInt(angka)%1000000000);

        }else if(angka < 1000000000000000){

            return terbilang(Math.floor(parseInt(angka)/1000000000000))+" Trilyun "+terbilang(parseInt(angka)%1000000000000);

        }

    }
</script>
</body>
</html>
