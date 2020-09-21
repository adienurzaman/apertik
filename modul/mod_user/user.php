<?php
session_start();
$aksi="modul/mod_user/aksi_user.php";
$act =(isset($_GET['act']))?$_GET['act']:'';
switch($act){
  // Tampil User
  default:
?>
<?php if($_SESSION['leveluser'] == 'Pemilik'){ $page_header = 'Setting Data User';} else{ $page_header = 'Profil User';} ?>
<div class="pesan" data-flashdata="<?= $_SESSION['pesan']; ?>"></div>
<h2 class="page-header"><?php echo $page_header; ?></h2>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
            <?php if($_SESSION['leveluser'] == 'Pemilik'){ ?>
              <button type="button" class="btn btn-flat btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah">
                <span class="fa fa-plus"></span> Tambah Data
              </button>
            <?php } ?>
            </div>
            <!-- /.box-header -->
          <div class="table-responsive">
            <div class="box-body">
              <table id="datatable" class="table table-bordered table-striped nowrap">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Level User</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$no=1;
if($_SESSION['leveluser'] == 'Pemilik'){
  $tampil = "SELECT * FROM tbl_user ORDER BY id_user DESC";
}else{
  $tampil = "SELECT * FROM tbl_user WHERE id_user = '$_SESSION[id_user]' LIMIT 1";
}
$query = mysqli_query($konek, $tampil);
while($r=mysqli_fetch_array($query)){
?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $r['username']; ?></td>
                  <td><?php echo $r['nama']; ?></td>
                  <td><?php echo $r['level']; ?></td>
                  <td>
                    <!-- Button Ubah-->
                    <a href="javascript:;"
                      data-id="<?php echo $r['id_user'];?>"
                      data-username="<?php echo $r['username'];?>"
                      data-nama="<?php echo $r['nama'];?>"
                      data-level="<?php echo $r['level'];?>"
                      data-toggle="modal" data-target="#modal-edit">
                      <button  class="btn btn-sm btn flat btn-primary" id="btnEdit" title="Edit Data"><i class="fa fa-edit"></i> Edit Data</button>
                    </a>
                    <?php if($_SESSION['leveluser'] == 'Pemilik'){ ?>
                    <a class="btn btn-sm btn-danger btn-flat" onclick="hapus_user('<?= $r['id_user'];?>');" title='Hapus'><span class='fa fa-trash'></span> Hapus Data</a>
                    <?php } ?>
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
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Level User</th>
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
                  <form action="<?php echo $aksi."?module=user&act=tambah"; ?>" method="POST" id="form-tambah">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
                        <c id="cek_username" class="text-warning"></c>  
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Enter Nama" name="nama">
                        <c id="cek_nama" class="text-warning"></c>  
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                        <c id="cek_nama" class="text-warning"></c>  
                      </div>
                      <div class="form-group">
                        <label for="level">Level User</label>
                        <select name="level" id="level" class="form-control">
                          <option value="">-- Pilih Level User --</option>
                          <option value="Pemilik">Pemilik</option>
                          <option value="Petugas">Petugas</option>
                        </select>
                        <c id="cek_level" class="text-warning"></c>  
                      </div>
                    <!-- /.box-body -->
                  </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="button" id="btnSave" class="btn btn-primary"><span class="fa fa-check"></span> Save changes</button>
              </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!-- MODAL EDIT -->
<div class="modal modal-default fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Data</h4>
              </div>
              <div class="modal-body">
                <p>
                  <form action="<?php echo $aksi."?module=user&act=edit"; ?>" method="POST" id="form-edit">
                    <input type="hidden" name="id_user" id="id_user_edit" required>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username_edit" placeholder="Enter Username" name="username">
                        <c id="cek_username" class="text-warning"></c>  
                      </div>
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama_edit" placeholder="Enter Nama" name="nama">
                        <c id="cek_nama" class="text-warning"></c>  
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password_edit" placeholder="Isi password jika ada perubahan" name="password">
                        <c id="cek_nama" class="text-warning"></c>  
                      </div>
                      <?php if($_SESSION['leveluser'] == 'Pemilik'){ ?>
                      <div class="form-group">
                        <label for="level">Level User</label>
                        <select name="level" id="level_edit" class="form-control">
                          <option value="">-- Pilih Level User --</option>
                          <option value="Pemilik">Pemilik</option>
                          <option value="Petugas">Petugas</option>
                        </select>
                        <c id="cek_level" class="text-warning"></c>  
                      </div>
                  	<?php }else{ ?>
                  		<div class="form-group">
                        	<label for="level">Level User</label>
                  			<input name="level" id="level_edit" class="form-control" readonly>
                  		</div>
                  	<?php } ?>
                    <!-- /.box-body -->
                  </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Update Data</button>
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

    const pesan = $(".pesan").data('flashdata');
    if (pesan == "Berhasil. Tambah data berhasil.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'success'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Gagal. Tambah data gagal.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'error'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Berhasil. Ubah data berhasil.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'success'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Gagal. Ubah data gagal.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'error'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Berhasil. Hapus data berhasil.") {
      Swal.fire(
        'Konfirmasi',
        pesan,
        'success'
      )
      <?php unset ($_SESSION["pesan"]); ?>
    }

    if (pesan == "Gagal. Hapus data gagal.") {
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


    $("#modal-tambah").on("hidden.bs.modal", function() {
      $('#form-tambah')[0].reset();
      $("#cek_username").text("");
      $("#nama").removeAttr("disabled",false);
      $("#level").removeAttr("disabled",false);
      $("#password").removeAttr("disabled",false);
      $("#btnSave").removeAttr("disabled",false);
    });
 
      $("#username").on("keyup",function(){
        var username = $("#username").val();
        var jumKarakter = username.length;
        // alert(jumKarakter);

        if(username != ""){
          if(jumKarakter > 0){
            $.ajax({
              type:'POST',
              cache:false,
              url:"./ajax.php?request=cek_username",
              data:{username:username},
              success: function(data)
              { 
                // alert(data);
                if(data == 1){
                  $("#cek_username").text("");
                  $("#cek_username").text("Username Telah Terdaftar");
                  $("#nama").attr("disabled",true);
                  $("#level").attr("disabled",true);
                  $("#password").attr("disabled",true);
                  $("#btnSave").attr("disabled",true);
                }else{
                  $("#cek_username").text("");
                  $("#nama").removeAttr("disabled",false);
                  $("#level").removeAttr("disabled",false);
                  $("#password").removeAttr("disabled",false);
                  $("#btnSave").removeAttr("disabled",false);
                }
              }
            });
          }

          if(jumKarakter == 0){
            $("#cek_nik").text("");
            $("#cek_nik").text("Jumlah Karakter NIK tidak sesuai");
          }

        }

      });

      $("#btnSave").on("click",function(){
        $("#form-tambah").submit();
      });

    $("#modal-edit").on("show.bs.modal", function(event) {
      var div = $(event.relatedTarget);
      var id = div.data('id');
      var username = div.data('username');
      var nama = div.data('nama');
      var level = div.data('level');
      
      $('#id_user_edit').val(id);
      $('#username_edit').val(username);
      $('#nama_edit').val(nama);
      $('#level_edit').val(level);
    });

    $("#modal-edit").on("hidden.bs.modal", function() {
      $('#form-edit')[0].reset();
    });

  });

function hapus_user(id){
  let href = "<?= $aksi."?module=user&act=hapus&id="; ?>"+id;
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
        window.location.replace(href);
    }
  });
}
</script>