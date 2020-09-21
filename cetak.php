<?php 
include "config/fungsi_indotgl.php";
include "config/koneksi.php";

$tgl=tgl_indo(date("Y m d"));

#cetak Resi
if($_GET['c']=='resi')
{

$tanggal = $_GET['tanggal'];
$jml_D = $_GET['jml_d'];
$jml_A = $_GET['jml_a'];
$harga_D = $_GET['harga_d'];
$harga_A = $_GET['harga_a'];
$total_bayar = $_GET['total_bayar'];
?>


<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <style>
    .tengah{
      text-align:center;
    }
    .kiri{
      text-align:left;
    }
    .kanan{
      text-align:right;

    }
    .h1{
      font-size: 65%;
    }
    </style>
    </head><body>
      <?php $value = $tanggal;
            $tgl = date_create($value);
            $hasil = date_format($tgl,'Y m d');?>  
      <p style="text-align: center;"><strong>RESI PEMBAYARAN TIKET</strong></p>
	<p style="text-align: center;">Tanggal Terbit : <?php echo tgl_indo($hasil); ?></p>
    <hr style="height:4px;" />

    <br>
    <h4 class="tengah"><font face="arial"><b><u>INFORMASI PEMBAYARAN</u></b></font></h4>

    <br><br>
    <div class="x_content">
        <div class="table-responsive">
        <table>
          <tbody>
            <tr>
              <td>
                <strong>Jumlah Pengunjung Dewasa</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo $jml_D." orang";?>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Jumlah Pengunjung Anak</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo $jml_A." orang";?>
              </td>
            </tr>	            	            
          </tbody>

        </table>
        <br>

        <h4 class="tengah"><font face="arial"><b><u>Jumlah Bayar</u></b></font></h4>

    <br><br>
    <div class="x_content">
        <div class="table-responsive">
        <table>
          <tbody>
            <tr>
              <td>
                <strong>Sub Total Dewasa</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo "Rp ".$harga_D; ?>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Sub Total Anak</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo "Rp ".$harga_A;?>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Total Pembayaran</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo "Rp ".$total_bayar;?>
              </td>
            </tr>
             
          </tbody>

        </table>
        <br>
        <br>
              *Resi ini merupakan resi pembayaran resmi.
          
      </div>
    </div>
    </body></html>

    <?php
    $html = ob_get_contents();
    ob_end_clean();
    $nama_dokumen=date('Y-m-d')." RESI_PEMBAYARAN";
    require_once('./config/mpdf/mpdf.php');
    $mpdf=new mPDF();
    $mpdf->SetDisplayMode('fullwidth');
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'I');
}

#cetak Data Pendapatan
if($_GET['c']=='pendapatan')
{
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];

$tampil = "SELECT SUM(jumlah_D) as jml_dewasa, SUM(jumlah_A) as jml_anak, SUM(total_bayar) as jumlah_total FROM tbl_pendapatan WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'";
$query = mysqli_query($konek, $tampil);
$jml = mysqli_num_rows($query);
$row = mysqli_fetch_assoc($query);
?>


<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <style>
    .tengah{
      text-align:center;
    }
    .kiri{
      text-align:left;
    }
    .kanan{
      text-align:right;

    }
    .h1{
      font-size: 65%;
    }
    </style>
    </head><body>
      <?php $value = $tanggal;
            $tgl = date_create($value);
            $hasil = date_format($tgl,'Y m d');?>  
      <p style="text-align: center;"><strong>DATA PENDAPATAN</strong></p>
	<p style="text-align: center;">Tanggal Terbit : <?php echo tgl_indo($hasil); ?></p>
    <hr style="height:4px;" />

    <br>
    <h4 class="tengah"><font face="arial"><b><u>INFORMASI DATA PENDAPATAN (<?php echo $tgl_awal;?> s/d <?php echo $tgl_akhir;?>)</u></b></font></h4>

    <br><br>
    <div class="x_content">
        <div class="table-responsive">
        <?php  if($jml>0){ ?>
        <table>
          <tbody>
            <?php if(!empty($row['jml_dewasa']) || !empty($row['jml_anak'])){ ?>
            <tr>
              <td>
                <strong>Jumlah Pengunjung Dewasa</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo $row['jml_dewasa']." orang";?>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Jumlah Pengunjung Anak</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo $row['jml_anak']." orang";?>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Total Pendapatan</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;<?php echo "Rp ".$row['jumlah_total'];?>
              </td>
            </tr>
            <?php } else { ?>
            <tr>
              <td>
                <strong>Jumlah Pengunjung Dewasa</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;- orang
              </td>
            </tr>
            <tr>
              <td>
                <strong>Jumlah Pengunjung Anak</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;- orang
              </td>
            </tr>
            <tr>
              <td>
                <strong>Total Pendapatan</strong>
              </td>
              <td>
                 &nbsp;:&nbsp;
              </td>
              <td>
                &nbsp;Rp -
              </td>
            </tr>
            <?php } ?>
          </tbody>

        </table>
        <?php } ?>
        <br>
        <br>
        <br>
              *Gunakan lembar ini sebagai pelaporan data pendapatan
          
      </div>
    </div>
    </body></html>

    <?php
    $html = ob_get_contents();
    ob_end_clean();
    $nama_dokumen="DATA_PENDATAPAN (".$tgl_awal." s/d ".$tgl_akhir.")";
    require_once('./config/mpdf/mpdf.php');
    $mpdf=new mPDF();
    $mpdf->SetDisplayMode('fullwidth');
    $mpdf->WriteHTML(utf8_encode($html));
    $mpdf->Output($nama_dokumen.".pdf" ,'I');
}
    ?>