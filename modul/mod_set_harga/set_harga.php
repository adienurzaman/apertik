<?php
session_start();
$aksi="modul/mod_set_harga/aksi_set_harga.php";
$act =(isset($_GET['act']))?$_GET['act']:'';
switch($act){
  // Tampil User
  default:
?>

<div class="pesan" data-flashdata="<?= $_SESSION['pesan']; ?>"></div>
<h2 class="page-header">Setting Harga Tiket</h2>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <button type="button" class="btn btn-flat btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah">
                <span class="fa fa-plus"></span> Tambah Data
              </button>
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
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$no=1;
$tampil = "SELECT * FROM tbl_harga ORDER BY id_harga DESC";
$query = mysqli_query($konek, $tampil);
while($r=mysqli_fetch_array($query)){
?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $r['harga_D']; ?></td>
                  <td><?php echo $r['harga_A']; ?></td>
                  <td>
                    <!-- Button Ubah-->
                    <a class="btn btn-sm btn-danger btn-flat" onclick="hapus_data('<?=$r['id_harga'];?>');" title='Hapus'><span class='fa fa-trash'></span> Hapus Data</a>
                  </td>
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
                  <th>Action</th>
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
                  <form action="<?php echo $aksi."?module=set_harga&act=tambah"; ?>" method="POST" id="form-tambah">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Harga Tiket Dewasa</label>
                        <input type="text" class="form-control" placeholder="Contoh : 12000" name="harga_D" required="">
                      </div>
                      <div class="form-group">
                        <label>Harga Tiket Anak</label>
                        <input type="text" class="form-control" placeholder="Contoh : 10000" name="harga_A" required="">
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

  $("#modal-tambah").on("hidden.bs.modal", function() {
    $('#form-tambah')[0].reset();
  });

  const pesan = $(".pesan").data('flashdata');
  if (pesan == "Berhasil. Data berhasil tersimpan.") {
    Swal.fire(
      'Konfirmasi',
      pesan,
      'success'
    )
    <?php unset ($_SESSION["pesan"]); ?>
  }

  if (pesan == "Gagal. Data gagal disimpan.") {
    Swal.fire(
      'Konfirmasi',
      pesan,
      'error'
    )
    <?php unset ($_SESSION["pesan"]); ?>
  }

  if (pesan == "Berhasil. Data berhasil dihapus.") {
    Swal.fire(
      'Konfirmasi',
      pesan,
      'success'
    )
    <?php unset ($_SESSION["pesan"]); ?>
  }

  if (pesan == "Gagal. Data gagal dihapus.") {
    Swal.fire(
      'Konfirmasi',
      pesan,
      'error'
    )
    <?php unset ($_SESSION["pesan"]); ?>
  }

  if (pesan == "Gagal. Field harus terisi semuanya.") {
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

//Akhir Jquery
});

function hapus_data(id){
  Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah Anda yakin data tersebut akan dihapus?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus Data!'
  }).then((result) => {
    if (result.value) {
      let href = "<?php echo $aksi."?module=set_harga&act=hapus&id=";?>"+id;
        window.location.replace(href);
    }
  });
}
</script>