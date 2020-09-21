<?php

$aksi="modul/mod_proses/aksi_proses.php";
$act =(isset($_GET['act']))?$_GET['act']:'';
switch($act){
  // Tampil User
  default:
?>
<h2 class="page-header">Proses Perhitungan</h2>
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
      <?php if($_SESSION['leveluser'] == 'Petugas'){ ?>
<!-- Small boxes (Stat box) -->
      <div class="row">
        <a href="#" id="proses">
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>PROSES</h3>
              <hr>
              <p>Klik untuk memproses antrean</p>
            </div>
          </div>
        </div>
        </a>
        <!-- ./col -->
        <a href="#" id="resi">
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>RESI</h3>
              <hr>
              <p>Klik untuk lihat & simpan resi pembayaran</p>
            </div>
          </div>
        </div>
        </a>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-info"></i>
              <h4 class="box-title">Riwayat Proses Perhitungan</h4>
            </div>
            <!-- /.box-header -->
          <div class="table-responsive">
            <div class="box-body">
              <table id="datatable" class="table table-bordered table-striped nowrap">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal</th>
                  <th>Jumlah Pengunjung Dewasa</th>
                  <th>Jumlah Pengunjung Anak</th>
                  <th>Sub Total Dewasa</th>
                  <th>Sub Total Anak</th>
                  <th>Total Pembayaran</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php 
$no=1;
$tampil = "SELECT * FROM tbl_pendapatan ORDER BY tanggal DESC";
$query = mysqli_query($konek, $tampil);
while($r=mysqli_fetch_array($query)){
?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $r['tanggal']; ?></td>
                  <td><?php echo $r['jumlah_D']; ?></td>
                  <td><?php echo $r['jumlah_A']; ?></td>
                  <td><?php echo $r['sub_total_d']; ?></td>
                  <td><?php echo $r['sub_total_a']; ?></td>
                  <td><?php echo $r['total_bayar']; ?></td>
                  <td>
                    <a class="btn btn-sm btn-info btn-flat" onclick="cetak_data('<?= $r['tanggal'].",".$r['jumlah_D'].",".$r['jumlah_A'].",".$r['sub_total_d'].",".$r['sub_total_a'].",".$r['total_bayar'];?>');" title='Cetak'><span class='fa fa-print'></span> Cetak Resi</a>
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
                  <th>Tanggal</th>
                  <th>Jumlah Pengunjung Dewasa</th>
                  <th>Jumlah Pengunjung Anak</th>
                  <th>Sub Total Dewasa</th>
                  <th>Sub Total Anak</th>
                  <th>Total Pembayaran</th>
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

    <?php } ?>
<!-- Small boxes (Stat box) -->

<!-- MODAL EDIT -->
<div class="modal modal-default fade" id="modal-resi">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Resi Pembayaran</h4>
              </div>
              <div class="modal-body">
                <p>
                  <form action="" id="form-edit">
                    <div class="box-body">
                      
                      <div class="form-group">
                        <label for="cc">Tanggal : <?php echo date('d F Y'); ?></label>
                      </div>

                      <input type="hidden" class="form-control" id="tgl" name="tgl" value="<?php echo date('Y-m-d'); ?>">

                      <div class="form-group">
                        <label for="dewasa">Jumlah Pengunjung Dewasa</label>
                        <input type="text" class="form-control" id="dewasa" placeholder="Jumlah Pengunjung Dewasa" name="dewasa" required readonly>
                        <input type="text" class="form-control" id="sub_total_dewasa" placeholder="Sub Total (Rp)" readonly="">
                      </div>

                      <div class="form-group">
                        <label for="anak">Jumlah Pengunjung Anak-anak</label>
                        <input type="text" class="form-control" id="anak" placeholder="Jumlah Pengunjung Anak" name="anak" required readonly>
                        <input type="text" class="form-control" id="sub_total_anak" placeholder="Sub Total (Rp)" readonly="">
                      </div>

                      <div class="form-group">
                        <label for="anak">Total Pembayaran</label>
                        <input type="text" class="form-control" id="bayar" target="_blank" placeholder="Total Pembayaran (Rp)" name="bayar" readonly="">
                      </div>


                    <!-- /.box-body -->
                  </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
                <button type="button" id="cetak_data" class="btn btn-primary"><span class="fa fa-save"></span> Simpan Data</button>
              </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<!-- MODAL KONFIRMASI -->
<div class="modal modal-default fade" id="modal-konfirmasi">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-body">
                <p>
                  <form action="" id="form-edit">
                    <div class="box-body">
                      <h5 class="modal-title">Konfirmasi Proses</h5>
                      <h4>Berhasil memproses</h4>
                      <p>Klik button OK untuk konfirmasi.</p>
                    <!-- /.box-body -->
                  </div>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" id="reload" class="btn btn-primary"><span class="fa fa-refresh"></span> OK</button>
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

    $("#modal-resi").on("show.bs.modal", function() {
      get_antrean();
    });

    $("#cetak_data").click(function(){
      simpan_data();
      $("#modal-resi").modal('hide');
    });

    $("#proses").click(function(){
      var nilai = 1;
      var ket = 'Memproses';

      $.ajax({
        type:"POST",
        cache:false,
        url:"./ajax.php?request=save_button",
        dataType:"JSON",
        data:{nilai:nilai,ket:ket},
        success: function(data)
        {
          if(data.success == 1){
            setInterval(function(){
              cek_button();
            },500);
          }else{
            alert('Gagal Memproses');
          }
        } 
      });

    });


    function get_antrean()
    {
      $.ajax({
        cache:false,
        url:"./ajax.php?request=get_data_antrean",
        dataType:"JSON",
        success: function(data)
        {
          if(data.success == 1){
            var sub_biaya_dewasa = data.jml_dewasa * data.harga_D;
            var sub_biaya_anak = data.jml_anak * data.harga_A;
            var total_bayar = sub_biaya_dewasa + sub_biaya_anak;
            $("#dewasa").val(data.jml_dewasa);
            $("#anak").val(data.jml_anak);
            $("#sub_total_dewasa").val(sub_biaya_dewasa);
            $("#sub_total_anak").val(sub_biaya_anak);
            $("#bayar").val(total_bayar);

            var dewasa = $("#dewasa").val();
            var anak = $("#anak").val();
            var bayar = $("#bayar").val();

            var jml_D = $("#sub_total_dewasa").val();
            var jml_A = $("#sub_total_anak").val();

            if(dewasa == "" || anak == ""){
              $("#cetak_data").attr('disabled',true);
            }else{
              $("#cetak_data").removeAttr('disabled',false);
            }

          }else{
            alert('Gagal Memproses');
          }
        } 
      });
    }

    function simpan_data()
    {
      var tanggal = $("#tgl").val();

      var dewasa = $("#dewasa").val();
      var anak = $("#anak").val();
      var bayar = $("#bayar").val();

      var jml_D = $("#sub_total_dewasa").val();
      var jml_A = $("#sub_total_anak").val();

      if(dewasa == "" || anak == ""){
        $("#cetak_data").attr('disabled',true);
        $("#modal-resi").modal('hide');
      }else{
        $("#cetak_data").removeAttr('disabled',false);
        $.ajax({
          type:"POST",
          cache:false,
          url:"./ajax.php?request=save_pendapatan",
          data:{jumlah_D:dewasa,jumlah_A:anak,total_bayar:bayar,jml_D:jml_D,jml_A:jml_A,tanggal:tanggal},
          dataType:"JSON",
          success: function(data)
          {
            if(data.success == 1){
               Swal.fire({
                  title: 'Konfirmasi',
                  text: data.pesan,
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.value) {
                    window.location.reload(true);
                  }else{
                    window.location.reload(true);
                  }
                });
            }else{
              Swal.fire(
                'Konfirmasi',
                'Gagal Memproses',
                'error'
              )
              $("#modal-resi").modal('hide');
            }
          }, error: function(jqXHR, textError){
            Swal.fire(
              'Konfirmasi',
              'Gagal Memproses',
              'error'
            )
            $("#modal-resi").modal('hide');
          }
        });
      }
    }

    function cek_button()
    {
      $.ajax({
        cache:false,
        url:"./ajax.php?request=cek_nilai_button",
        dataType:"JSON",
        success: function(data)
        {
          if(data.success == 1){
            // alert('Berhasil Memproses');
            $("#modal-konfirmasi").modal({
              backdrop: 'static',
              keyboard: false, 
              show: true
            });
          }else{
            // alert('Gagal Memproses');
          }
        } 
      });
    }

    $("#reload").click(function() {
      window.location.reload(true);      
    })

    //Jquery Akhir
  });

function cetak_data(keterangan){
  let str = keterangan.split(",");
  let tanggal = str[0];
  let jml_d = str[1];
  let jml_a = str[2];
  let harga_d = str[3];
  let harga_a = str[4];
  let total_bayar = str[5];
  let href = "cetak.php?c=resi&tanggal="+tanggal+"&jml_d="+jml_d+"&jml_a="+jml_a+"&harga_d="+harga_d+"&harga_a="+harga_a+"&total_bayar="+total_bayar;
  Swal.fire({
    title: 'Konfirmasi',
    text: "Apakah Anda yakin akan mencetak data ini?",
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

</script>