<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];
// Input user
if ($module=='set_app' AND $act=='proses'){
  $set_harga = $_POST['set_harga'];
  if(empty($set_harga) ){
    $_SESSION['pesan'] = "Gagal. Field harus terisi semua.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_app'>";
  }else{
    $cek_data = mysqli_query($konek,"SELECT * FROM tbl_setting_aplikasi ORDER BY id_setting DESC");
    if(mysqli_num_rows($cek_data) == 0){
      $input="INSERT INTO tbl_setting_aplikasi (set_harga) VALUES ('$set_harga');";
    }else{
      $input="UPDATE tbl_setting_aplikasi SET set_harga = '$set_harga' WHERE id_setting = 1;";
    }
    $query = mysqli_query($konek,$input);
    if($query){
      $_SESSION['pesan'] = "Berhasil. Proses berhasil.";
      echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_app'>";
    }else{
      $_SESSION['pesan'] = "Gagal. Proses gagal.";
      echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_app'>";
    }
  }
}
?>