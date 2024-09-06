<!DOCTYPE html>
<html lang="en">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist')}}/css/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  
    @include('layout/head')
    <head>
        <title>Cetak Invoice</title>
    </head>

    <style>
    @page { size: A4 };
</style>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    
    
    <!-- <table cellpadding="5" style="border:1px  solid;">
        <tr class="justify-content-left">
            <td>
              <p>
                <b style="font-size: 150%;">CV. Nusa Pratama Anugrah</b><br>
                Chemical Cleaning, Industry, Argo <br>
                <b>Taman Pondok Jati AR-2, Geluran , Taman, Sidoarjo, Email : nusapratama.anugrah@gmail.com</b>
              </p>
                   
            </td>
            <td  width="10%">
                <img src="{{asset('img')}}/logo.png"  class="brand-image" width="60%">
            </td>
            <td width="20%">
              
            </td>
            
        </tr>
    </table> -->
    <table cellpadding="5" style="border:1px solid;" width ="100% " >
        <thead>
            <tr class="justify-content-left">
                <td colspan="5" >
                    <p>
                        <b style="font-size: 150%;">CV. Nusa Pratama Anugrah</b><br>
                        Chemical Cleaning, Industry, Argo <br>
                        <b>Taman Pondok Jati AR-2, Geluran , Taman, Sidoarjo, Email : nusapratama.anugrah@gmail.com</b>
                    </p>
                </td>
                <td colspan="2"><img src="{{asset('img')}}/logo.png" class="application-logo" width="70" height="70"></td>
            </tr>
            <tr>
                <td align="center" style="border:1px solid black;" colspan="2">
                    <h3><b>NOTA PENJUALAN</b></h3>
                </td>
                <td style="border:1px solid black;" colspan="3">
                    <b>Nomor Invoice</b>
                    <br>
                    <b id="no-nota"><?php echo $_GET['kode'];?></b>
                </td>
                <td style="border:1px solid black;" colspan="2">
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
            <tr style="vertical-align: top;">
                <td rowspan="3" colspan="2" style="border:1px solid black;">
                    <b>Costumer</b> <br>
                    <b id="nama-customer"></b> <br>
                    <b>Alamat</b> <br>
                    <b id="alamat-pengiriman"></b>
                </td>
                <td colspan="5" style="border:1px solid black;">
                    <b>No. Telp</b><br><b id="telp">-</b>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border:1px solid black;">
                    <b>Nomor Surat Pesan</b><br><b id="po_req">-</b>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="border:1px solid black;">
                    <b>Keterangan</b><br><b id="keterangan">Term of Payment</b>
                </td>
            </tr>
            <tr>
                <td colspan="7" style="border:1px solid black;"> <b>Barang/Jasa dan Spesifikasinya sebagai berikut :</b></td>
            </tr>
            <tr>
                <td align="center" style="border:1px solid black;"><b>NO.</b></td>
                <td align="center" style="border:1px solid black;"><b>BARANG/JASA DAN SPESIFIKASI</b></td>
                <td align="center" style="border:1px solid black;"><b>QTY</b></td>
                <td align="center" style="border:1px solid black;"><b>UNIT </b></td>
                <td align="center" style="border:1px solid black;"><b>HARGA</b></td>
                <td align="center" colspan="2" style="border:1px solid black;"><b>SUBTOTAL</b></td>
            </tr>
        </thead>
        <tbody id="detail-barang">
            <tr >
                <td width="5%" style="border-right:1px solid black ;" align="center">no</td>
                <td width="45%" style="border-right:1px solid black ;">nama</td>
                <td width="8%" style="border-right:1px solid black ;" align="center">QTY</td>
                <td width="5%" style="border-right:1px solid black ;" align="center">unit</td>
                <td width="17%"style="border-right:1px solid black ;" align="right">harga</td>
                <td colspan="2" align="right">subtotal</td>
            </tr>
            <tr >
                <td width="5%" style="border-right:1px solid black ;" align="center">no</td>
                <td width="45%" style="border-right:1px solid black ;">nama</td>
                <td width="8%" style="border-right:1px solid black ;" align="center">QTY</td>
                <td width="5%" style="border-right:1px solid black ;" align="center">unit</td>
                <td width="17%"style="border-right:1px solid black ;" align="right">harga</td>
                <td colspan="2" align="right">subtotal</td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="vertical-align:top ;">
                <td rowspan="3" colspan="2" style="border:1px solid black;">
                    <b>Terbilang</b><br><b id="terbilang"></b>
                </td>
                <td colspan="3" style="border:1px solid black;"><b>Total</b></td>
                <td colspan="2" style="border:1px solid black;" align="right"><b id="total">00</b></td>
            </tr>
            <tr>
                <td colspan="3" style="border:1px solid black;"><b id="ppn">PPN</b></td>
                <td colspan="2" style="border:1px solid black;" align="right"><b id="PPN">00</b></td>
            </tr>
            <tr>
                <td colspan="3" style="border:1px solid black;"><b>TOTAL + PPN</b></td>
                <td colspan="2" style="border:1px solid black;" align="right"><b id="TOTAL">00</b></td>
            </tr>
            <tr style="vertical-align:top;">
                <td colspan="2" style="border:1px solid black;">
                    <b id="bank"></b> <br>
                    <b id="nama"></b> <br>
                    <b id="rekening"></b>
                </td>
                <td colspan="5" style="border:1px solid black;">
                    <div class="row justify-content-around">
                        <b>Penerima</b>
                        <b>Marketing</b>
                        <b>Admin</b>
                    </div>
                    <br>
                    <div class="row justify-content-around">
                        <b>_________</b>
                        <b id="marketing">Manshur</b>
                        <b id="admin">Vania</b>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
    <!-- <table cellpadding="5" style="border:1px solid black;" width="100%" >
      <tr>
        <td colspan="2" align="center" width="50%" height style="border:1px solid black;">
          <h3><b>NOTA PENJUALAN</b></h3>
        </td>
        <td width="25%" style="border:1px solid black;">
          <b>Nomor Invoice</b>
          <br>
          <b id="no-nota">-</b>
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
        <td rowspan="3" colspan="2" style="border:1px solid black;" id="data-customer">
            <b>Customer</b>
            <br>
            <b id="customer"></b>
            <br>
            <b>Alamat :</b>
            <b id="alamat"></b>
        </td>
        <td style="border:1px solid black;">
          <b>No. Telp</b>
          <br>
          <b id="telp-customer">-</b>
        </td>
        <td style="border:1px solid black;">
          <b> Tgl Pengiriman</b>
          <br>
          <b id="tgl-pengiriman"> 14 November 2022</b>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="border:1px solid black;">
          <b>Kode Surat Jalan</b>
          <br>
          <b id="kode"><?php echo $_GET['kode'];?></b>
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
        <td style="border:1px solid black;"><b>QTY</b></td>
        <td style="border:1px solid black;"><b>SATUAN</b></td>
      </thead>
      <tbody id="detail-sj">
        
      </tbody>
      <tr>
        <td colspan="4" width="40" style="border:1px solid black;">
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
    </table> -->
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
        url     :'{!! url("cetak-invoice/'+kode+'") !!}',
        type    : 'get',
        success : function(data){
            console.log(data);
            $('#nama-customer').html(data.inv.rekanan);
            $('#alamat-pengiriman').html(data.inv.alamat);
            $('#telp').html(data.inv.telp);
            if(data.inv.po_req == null){
                $('#po_req').html("-");    
            } else {
                $('#po_req').html(data.inv.po_req);
            }
            $('#keterangan').html(data.inv.keterangan);
            $('#marketing').html(data.inv.marketing);
            $('#bank').html(data.inv.bank);
            $('#nama').html(data.inv.atas_nama);
            $('#rekening').html(data.inv.rekening);
            var datahandler = $('#detail-barang');
            datahandler.empty();
            var vat = data.inv.vat;
            $('#ppn').html('PPN '+vat+'%');
            var n = 0;
            var sum = 0;
            var detail = data.detail;
            var total = 0;
            $.each(detail, function(key,val){
                var Nrow = $("<tr>");
                var nomor = n+1;
                sum = sum+detail[n]['dpp'];
                total = total+detail[n]['jumlah'];
                if (detail[n]['nama_request'] == null) {
                    Nrow.html("<td width='5%'' style='border-right:1px solid black ;' align='center'>"+nomor+"</td> <td width='45%' style='border-right:1px solid black ;'>"+detail[n]['barang']+" <br> Spesifikasi :<br>"+detail[n]['keterangan']+"</td><td width='8%' style='border-right:1px solid black ;' align='center'>"+detail[n]['diakui']+"</td><td width='5%' style='border-right:1px solid black ;' align='center'>"+detail[n]['satuan']+"</td><td width='17%'style='border-right:1px solid black ;' align='right'>"+formatRupiah(detail[n]['harga_jual'])+"</td><td colspan='2' align='right'>"+formatRupiah(detail[n]['dpp'])+"</td></tr>");  
                } else {
                    Nrow.html("<td width='5%'' style='border-right:1px solid black ;' align='center'>"+nomor+"</td> <td width='45%' style='border-right:1px solid black ;'>"+detail[n]['nama_request']+" <br> Spesifikasi :<br>"+detail[n]['keterangan']+"</td><td width='8%' style='border-right:1px solid black ;' align='center'>"+detail[n]['diakui']+"</td><td width='5%' style='border-right:1px solid black ;' align='center'>"+detail[n]['satuan']+"</td><td width='17%'style='border-right:1px solid black ;' align='right'>"+formatRupiah(detail[n]['harga_jual'])+"</td><td colspan='2' align='right'>"+formatRupiah(detail[n]['dpp'])+"</td></tr>");  
                }
                datahandler.append(Nrow);
                n = n+1;
            });
            var VAT = total-sum;
            $('#total').html(formatRupiah(sum));
            $('#PPN').html(formatRupiah(VAT));
            $('#TOTAL').html(formatRupiah(total));
            $('#terbilang').html('" '+terbilang(total)+' Rupiah "');

        }
    })
        
    });
    function formatRupiah(money) {
        return new Intl.NumberFormat('id-ID',
            { style: 'currency', currency: 'IDR' }
        ).format(money);
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