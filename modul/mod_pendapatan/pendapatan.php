<?php
session_start();
$aksi="modul/mod_pendapatan/aksi_pendapatan.php";
$act =(isset($_GET['act']))?$_GET['act']:'';
switch($act){
  // Tampil User
  default:
?>
<div class="pesan" data-flashdata="<?= $_SESSION['pesan']; ?>"></div>
<h2 class="page-header">Data Pendapatan</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>
              <h4 class="box-title">Informasi</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <p align=center>

                Silahkan klik button pilihan yang berada di bagian bawah untuk mengelola proses ini.
              
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      <?php if($_SESSION['leveluser'] == 'Pemilik'){ ?>
<!-- Small boxes (Stat box) -->
      <div class="row">
        <a href="#" id="resi">
        <div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>VIEW</h3>
              <hr>
              <p>Klik untuk lihat pendapatan</p>
            </div>
          </div>
        </div>
        </a>
        <!-- ./col -->
      </div>
      <!-- /.row -->
<?php
if(isset($_POST['tgl_awal'])){
  $tgl_awal = $_POST['tgl_awal'];
  $tgl_akhir = $_POST['tgl_akhir'];
}else{
  $tgl_awal = "";
  $tgl_akhir = "";
}
?>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
                <?php
                if(!empty($tgl_awal) || !empty($tgl_akhir)){
                ?>
                    <a class="btn btn-sm btn-info btn-flat" onclick="cetak_pendapatan('<?= $tgl_awal.",".$tgl_akhir; ?>');" title='Cetak Data'><span class='fa fa-print'></span> Cetak Data</a>
                <?php }else{ ?>
                    <a href="#" class="btn btn-sm btn-info btn-flat" title='Cetak Data' disabled><span class='fa fa-print'></span> Cetak Data</a>
                <?php } ?>
                <a class="btn btn-sm btn-danger btn-flat" onclick="hapus_semua();" title='Hapus Semua Data'><span class='fa fa-trash'></span> Hapus Semua Data</a>
    
            </div>
            <!-- /.box-header -->
          <div class="table-responsive">
            <div class="box-body">
              <table id="datatable" class="table table-bordered table-striped nowrap">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal Awal</th>
                  <th>Tanggal Akhir</th>
                  <th>Jml Pengunjung Dewasa</th>
                  <th>Jml Pengunjung Anak</th>
                  <th>Total Pendapatan</th>
                </tr>
                </thead>
                <tbody>
<?php 
$no=1;
if(!empty($tgl_awal) && !empty($tgl_akhir)){
  $tampil = "SELECT SUM(jumlah_D) as jml_dewasa, SUM(jumlah_A) as jml_anak, SUM(total_bayar) as jumlah_total FROM tbl_pendapatan WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'";
}

$query = mysqli_query($konek, $tampil);
$jml = mysqli_num_rows($query);
if($jml>0){
  while($r=mysqli_fetch_array($query)){
  ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $tgl_awal; ?></td>
                    <td><?php echo $tgl_akhir; ?></td>
                    
                    <?php if(!empty($r['jml_dewasa']) || !empty($r['jml_anak'])){ ?>
                    
                    <td><?php echo $r['jml_dewasa']." orang"; ?></td>
                    <td><?php echo $r['jml_anak']." orang"; ?></td>
                    <td><?php echo "Rp ".$r['jumlah_total']; ?></td>
                    
                    <?php }else{ ?>
                    
                    <td>- orang</td>
                    <td>- orang</td>
                    <td>Rp -</td>
                    
                    <?php } ?>
                  </tr>
  <?php 
    $no++;
  } 
}
?>

                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Tanggal Awal</th>
                  <th>Tanggal Akhir</th>
                  <th>Jml Pengunjung Dewasa</th>
                  <th>Jml Pengunjung Anak</th>
                  <th>Total Pendapatan</th>
                </tr>
                </tfoot>
              </table>
              
              </div>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

    <?php }?>
<!-- Small boxes (Stat box) -->

<!-- MODAL EDIT -->
<div class="modal modal-default fade" id="modal-resi">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Tanggal Acuan</h4>
              </div>
              <div class="modal-body">
                <p>
                  <form action="./media.php?module=pendapatan" method="POST" id="form-edit">
                    <div class="box-body">
                      
                      <div class="form-group">
                        <label>Tanggal Awal</label>
                        <input type="date" class="form-control" id="tgl_awal" placeholder="Pilih Tanggal Awal" name="tgl_awal" value="<?php echo $tgl_awal;?>">
                      </div>

                     <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tgl_akhir" placeholder="Pilih Tanggal Akhir" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>" >
                      </div>


                    <!-- /.box-body -->
                  </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="submit" id="cari_data" class="btn btn-primary"><span class="fa fa-search"></span> Cari Data</button>
              </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<?php
}
?>

<script type="text/javascript">
  $(function(){
    $('#datatable').DataTable({
      responsive: true
    });

     $("#resi").click(function(){
      $("#modal-resi").modal("show");
    });

    $("#modal-resi").on("hidden.bs.modal", function() {
      $('#form-edit')[0].reset();
    });

    const pesan = $(".pesan").data('flashdata');
    if (pesan == "Berhasil. Data berhasil terhapus.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'success'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Gagal. Data gagal terhapus.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'error'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "") {
      console.log('No Respon');
      <?php unset ($_SESSION["pesan"]); ?>
    }

  });

  function cetak_pendapatan(keterangan){
    let str = keterangan.split(",");
    let tgl_awal = str[0];
    let tgl_akhir = str[1];
    let href ="cetak.php?c=pendapatan&tgl_awal="+tgl_awal+"&tgl_akhir="+tgl_akhir;
    Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah Anda yakin akan mencetak data dari tanggal "+tgl_awal+" s/d "+tgl_akhir+" ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Cetak Data!'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    });
  }

  function hapus_semua(){
    let href ="<?php echo $aksi."?module=pendapatan&act=hapus";?>";
    Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah Anda yakin akan menghapus semua data?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus semua data!'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    });
  }
</script>