<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input user
if ($module=='set_harga' AND $act=='tambah'){
  $harga_D = $_POST['harga_D'];
  $harga_A = $_POST['harga_A'];
  if(empty($harga_D) || empty($harga_A) ){
    $_SESSION['pesan'] = "Gagal. Field harus terisi semuanya.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
  }else{
    $input="INSERT INTO tbl_harga (harga_D,harga_A) VALUES ('$harga_D','$harga_A');";
    $query = mysqli_query($konek,$input);
    if($query){
      $_SESSION['pesan'] = "Berhasil. Data berhasil tersimpan.";
      echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
    }else{
      $_SESSION['pesan'] = "Gagal. Data gagal disimpan.";
      echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
    }
  }
}

if ($module=='set_harga' AND $act=='edit'){
  $id_harga = $_POST['id_harga'];
  $harga_D = $_POST['harga_D'];
  $harga_A = $_POST['harga_A'];

  $edit="UPDATE tbl_harga SET harga_D = '$harga_D', harga_A = '$harga_A' WHERE id_harga = '$id_harga'; ";

  $query = mysqli_query($konek,$edit);
  if($query){
    $_SESSION['pesan'] = "Berhasil. Data berhasil diubah";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
  }else{
    $_SESSION['pesan'] = "Gagal. Data gagal diubah";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
  }
}

if ($module=='set_harga' AND $act=='hapus'){
  $id_harga = $_GET['id'];
  $hapus="DELETE FROM tbl_harga  WHERE id_harga = '$id_harga' ";
  $query = mysqli_query($konek,$hapus);
  if($query){
    $_SESSION['pesan'] = "Berhasil. Data berhasil dihapus.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
  }else{
    $_SESSION['pesan'] = "Gagal. Data gagal dihapus.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=set_harga'>";
  }
}

?>