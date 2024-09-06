<!DOCTYPE html>
<html lang="en">
    @include('layout/head')
    <head>
      <title>Cetak Purchase Order</title>
    </head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    {{-- <!-- title row -->
    <div class="row">
      <div class="col-2">
        <h2 class="page-header">
            <img src="{{asset('img')}}/logo.png"  class="brand-image"  width="30%">
        </h2>
      </div>
      <div class="col-lg-9">
        <label> CV Nusa Pratama Anugerah
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>John Doe</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #007612</b><br>
        <br>
        <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Serial #</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>Call of Duty</td>
            <td>455-981-221</td>
            <td>El snort testosterone trophy driving gloves handsome</td>
            <td>$64.50</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Need for Speed IV</td>
            <td>247-925-726</td>
            <td>Wes Anderson umami biodiesel</td>
            <td>$50.00</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Monsters DVD</td>
            <td>735-845-642</td>
            <td>Terry Richardson helvetica tousled street art master</td>
            <td>$10.70</td>
          </tr>
          <tr>
            <td>1</td>
            <td>Grown Ups Blue Ray</td>
            <td>422-568-642</td>
            <td>Tousled lomo letterpress</td>
            <td>$25.99</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row --> --}}
    <table cellpadding="10">
        <tr class="justify-content-left">
            <td  width="10%">
                <img src="{{asset('img')}}/logo.png"  class="brand-image"  width="100%">
            </td>
            <td >
                <p>
                    <b style="font-size: 150%">CV. Nusa Pratama Anugerah</b>
                    <br>
                    Taman Pondok Jati Blok AR-2
                    <br>
                    RT.025 RW.005 Geluran-Taman
                    <br>
                    Sidoarjo - Jawa 61257
                </p>
            </td>
        </tr>
    </table>
    <table  cellpadding="10" style="border-color:black;"class="table table-bordered table-stripted">
        <thead>
            
        </thead>
        <tr>
            
            <td colspan="3" align="center">
                <h3><b>PURCHASE ORDER</b></h3>
            </td>
            <td colspan="3">
                PO No.
                <br>
                <label id="po"><?php echo $_GET['kode'];?></label>
            </td>
            <td colspan="3">
                Date
                <br>
                <label > 22 Juni 2022</label>
            </td>
        </tr>
        <tr>
            <td colspan="3" rowspan="4" id="data-supplier"></td>
            <td colspan="6" id="seller-reff" style="font-size:15px"> Seller Ref. No.</td>
        </tr>
        <tr>
            <td colspan="6" id="term-delivery" style="font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6"id="time-delivery" style="font-size:15px"></td>
        </tr>
        <tr>
            <td colspan="6" id="pembayaran" style="font-size:14px"></td>
        </tr>
        <tr align="center" >
            <td width="5%">No.</td>
            <td colspan="2">Item & Specification</td>
            <td width="5">QTY</td>
            <td width="5">Satuan</td>
            <td>Harga</td>
            <td width="5%">Disc(%)</td>
            <td>Amount</td>
        </tr>
        
    <tbody id="detail-po">
    </tbody>
        <tr>
            <td rowspan="3 "colspan="3" width="50%" id="total-terbilang">Amount in Words</td>
            <td colspan="4">Total</td>
            <td id="total">Rp.</td>
        </tr>
        <tr>
            <td colspan="4" id="vat-po">VAT </td>
            <td id="vat">Rp.</td>
        </tr>
        <tr>
            <td colspan="4">TOTAL + VAT</td>
            <td id="total-po">Rp.</td>
        </tr>
        <tr>
            <td colspan="8">REMARK 
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3">Accept and confirmed by Seller
                <br><br><br><br>By
            </td>
            <td colspan="5" align="">Approved
                <br><br><br><br><p class="text-center"><b>Daris Rafid Hirmanda Putra</b></p>
               
            </td>
        </tr>
        <tr>
            <td colspan="3" >
                <p style="font-size:12px">
                    Pada saat penagihan PENJUAL wajib menyerahkan :
                    <br>
                    1. Surat Jalan Asli / Berita Acara yang ditandatangai dan distempel 
                    <br>
                    2. 1(satu) lembar kwitansi lengkap dengan materai yang cukup
                    <br>
                    3. 1(satu) lembar PO yang telah ditandatangani dan distempel
                    <br>
                    PENJUAL
                    <br>
                    4. 1(satu) lembar Asli dan 1(satu) lembar copy Faktur Pajak tanpa cacat (tidak ada tipe-x)
                </p>
            </td>
            <td colspan="5"></td>
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
        url     :'{!! url("cetakpodetail/'+kode+'") !!}',
        type    : 'get',
        success : function(data){
            console.log(data);
            detail = data.detail;
            var vat = data.po.vat;
            $('#vat-po').html('VAT '+vat+'%');
            $('#data-supplier').html('<p style="font-size:17px">Seller Name & Address :<br><b>'+data.supplier.nama_perusahaan+'</b><br><b>'+data.supplier.nama+'</b><br>'+data.supplier.alamat+'<br>Email : '+data.supplier.email+'<br>NPWP :</p>');
            $('#term-delivery').html('Term Of Delivery : ');
            $('#time-delivery').html('Time Of Delivery :<b> '+data.po.time_delivery+'</b>');
            $('#pembayaran').html('Term Of Payment :<b> '+data.po.pembayaran+'</b>');
            var datahandler = $('#detail-po');
            var n= 0;
            var total = 0;
            $.each(detail, function(key,val){
                var Nrow = $("<tr>");
                var nomor = n+1;
                if(detail[n]['diskon']==null){
                  
                }
                Nrow.html("<td width='5%''>"+nomor+"</td><td colspan='2'>"+detail[n]['nama']+"</td><td width='5%'>"+detail[n]['qty']+"</td><td>"+detail[n]['satuan']+"</td><td>"+formatRupiah(detail[n]['harga'])+"</td><td width='5%'>"+detail[n]['diskon']+"</td><td>"+formatRupiah(detail[n]['jumlah'])+"</td></tr>");
                datahandler.append(Nrow);
                total = total+detail[n]['jumlah'];
                n = n+1;
            });
            vat = (vat/100)*total;
            $('#vat').html(formatRupiah(vat));
            $('#total').html('<b>'+formatRupiah(total)+'</b>');
            $('#total-po').html('<b>'+formatRupiah(total+vat)+'</b>');
            $('#total-terbilang').html('Amount in Words <br><br><b>"'+terbilang(total+vat)+' Rupiah</b>"');
            window.print();
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
