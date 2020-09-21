<?php
session_start();
$aksi="modul/mod_set_app/aksi_set_app.php";
$act =(isset($_GET['act']))?$_GET['act']:'';
switch($act){
  // Tampil User
  default:
?>
<div class="pesan" data-flashdata="<?= $_SESSION['pesan']; ?>"></div>
<h2 class="page-header">Setting Aplikasi</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-info"></i> Informasi</p>
            </div>
            <!-- /.box-header -->
          <div class="table-responsive">
            <div class="box-body">
              <p>
                Pilih harga tiket yang akan dijadikan sebagai harga tiket default.
              </p>
              <p>
                <div class="col-lg-12 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-yellow" id="set_def">
                    <div class="inner">
                      <h3>HARGA DEFAULT</h3>
                      <hr>
                      <p>Klik untuk mensetting harga default</p>
                    </div>
                  </div>
                </div>
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>
              <h4 class="box-title">Data Setting Aplikasi</h4>
            </div>
            <!-- /.box-header -->
          <div class="table-responsive">
            <div class="box-body">
              <table id="datatable" class="table table-bordered table-striped nowrap">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Harga Tiket Dewasa</th>
                  <th>Harga Tiket Anak</th>
                </tr>
                </thead>
                <tbody>
<?php 
$no=1;
$tampil = "SELECT * FROM tbl_setting_aplikasi LEFT JOIN tbl_harga ON tbl_harga.id_harga = tbl_setting_aplikasi.set_harga ORDER BY tbl_setting_aplikasi.id_setting DESC";
$query = mysqli_query($konek, $tampil);
while($r=mysqli_fetch_array($query)){
?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $r['harga_D']; ?></td>
                  <td><?php echo $r['harga_A']; ?></td>
                </tr>
<?php 
  $no++;
  } 
?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th>Harga Tiket Dewasa</th>
                  <th>Harga Tiket Anak</th>
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
        <!-- /.col -->
<!-- Small boxes (Stat box) -->

<!-- MODAL TAMBAH -->
<div class="modal modal-default fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data</h4>
              </div>
              <div class="modal-body">
                <p>
                  <form action="<?php echo $aksi."?module=set_app&act=proses"; ?>" method="POST" id="form-tambah">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Data Setting Harga</label>
                        <select class="form-control" name="set_harga">
                          <option value="">-- Set Harga Default --</option>
                          <?php 
                            $tampil = "SELECT * FROM tbl_harga ORDER BY id_harga DESC";
                            $query = mysqli_query($konek, $tampil);
                            while($r=mysqli_fetch_array($query)){
                          ?>
                          <option value="<?php echo $r['id_harga']; ?>">Harga T-Dewasa : <?php echo $r['harga_D']." | Harga T-Anak : ".$r['harga_A']; ?></option>
                          <?php 
                           }
                          ?>
                        </select>
                      </div>                      
                    <!-- /.box-body -->
                  </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="submit" id="btnSave" class="btn btn-primary"><span class="fa fa-check"></span> Save changes</button>
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

    $("#set_def").click(function(){
      $("#modal-tambah").modal('show');
    });

    $("#modal-tambah").on("hidden.bs.modal", function() {
      $('#form-tambah')[0].reset();
    });

    const pesan = $(".pesan").data('flashdata');
    if (pesan == "Berhasil. Proses berhasil.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'success'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Gagal. Proses gagal.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'error'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Gagal. Field harus terisi semua.") {
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
</script>