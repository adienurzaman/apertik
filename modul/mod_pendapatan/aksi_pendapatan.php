<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

// Input user

if ($module=='pendapatan' AND $act=='hapus'){
  $hapus="TRUNCATE tbl_pendapatan";
  $query = mysqli_query($konek,$hapus);
  if($query){
    $_SESSION['pesan'] = "Berhasil. Data berhasil terhapus.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=pendapatan'>";
  }else{
    $_SESSION['pesan'] = "Gagal. Data gagal terhapus.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=pendapatan'>";
  }
}

?>