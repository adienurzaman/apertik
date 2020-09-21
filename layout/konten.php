<?php
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/class_paging.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
<?php
// Bagian Home
if ($_GET['module']=='home'){
$jam=date("H:i:s");
$tgl=tgl_indo(date("Y m d"));
?>

<h2 class="page-header">Dashboard</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>
              <h4 class="box-title">Selamat Datang</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <p align=center>Hai <b><?php echo ucfirst($_SESSION['nama']); ?></b>, selamat datang di halaman <?php echo ucfirst($_SESSION['leveluser']); ?>. 
                Silahkan klik menu pilihan yang berada di bagian Sidebar Menu untuk mengelola sistem Aplikasi Ini.<br /> <b><?php echo $hari_ini;?>, <?php echo $tgl;?>, <?php echo $jam; ?></b> WIB
              </p>
              
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      <?php if($_SESSION['leveluser'] == 'Petugas'){ ?>
<!-- Small boxes (Stat box) -->
      <div class="row">
        <a href="#">
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="jml_D"></h3>
              <hr>
              <p>Data Pengunjung Dewasa Tanggal : <i id="tgl_terakhir1"></i></p>
            </div>
          </div>
        </div>
        </a>
        <!-- ./col -->
        <a href="#">
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3 id="jml_A"></h3>
              <hr>
              <p>Data Pengunjung Anak-anak Tanggal : <i id="tgl_terakhir2"></i></p>
            </div>
          </div>
        </div>
        </a>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <script type="text/javascript">
        $(function(){
          setInterval(function(){
            get_data_terakhir();
          },2000);

          function get_data_terakhir()
          {
            $.ajax({
              cache:false,
              url:"./ajax.php?request=get_data_terakhir",
              success: function(data)
              {
                var str = data.split("/");
                if(str[0] == '1'){
                  $("#jml_D").html(str[1]);
                  $("#jml_A").html(str[2]);
                  $("#tgl_terakhir1").html("");
                  $("#tgl_terakhir2").html("");
                  $("#tgl_terakhir1").html(str[3]);
                  $("#tgl_terakhir2").html(str[3]);
                }
              } 
            });
          }
        });
      </script>
    <?php }?>
<?php
}


elseif ($_GET['module']=='user'){
    include "modul/mod_user/user.php";
}

elseif ($_GET['module']=='proses'){
    include "modul/mod_proses/proses.php";
}

elseif ($_GET['module']=='set_harga'){
    include "modul/mod_set_harga/set_harga.php";
}

elseif ($_GET['module']=='set_app'){
    include "modul/mod_set_app/set_app.php";
}

elseif ($_GET['module']=='pendapatan'){
    include "modul/mod_pendapatan/pendapatan.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}

?>
    </section>
    <!-- /.content -->
</div>
