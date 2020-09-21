<?php
session_start();
include "../../config/koneksi.php";
$module=$_GET['module'];
$act=$_GET['act'];

// Input user
if ($module=='user' AND $act=='tambah'){
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $level = $_POST['level'];
  $password = $_POST['password'];
  if(empty($username) || empty($nama) || empty($level) || empty($password) ){
    $_SESSION['pesan'] = "Gagal. Field harus terisi semua.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
  }else{
    $password = md5($_POST['password']);
    $input="INSERT INTO tbl_user (username,password,nama,level) VALUES ('$username','$password','$nama','$level');";
    $query = mysqli_query($konek,$input);
    if($query){
      $_SESSION['pesan'] = "Berhasil. Tambah data berhasil.";
      echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
    }else{
      $_SESSION['pesan'] = "Gagal. Tambah data gagal.";
      echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
    }
  }
}

if ($module=='user' AND $act=='edit'){
  $id_user = $_POST['id_user'];
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $level = $_POST['level'];
  $password = $_POST['password'];
  if( empty($password) ){
    $edit="UPDATE tbl_user SET username = '$username', nama = '$nama', level = '$level' WHERE id_user = '$id_user';";
  }else{
    $password = md5($_POST['password']);
    $edit="UPDATE tbl_user SET username = '$username', password = '$password', nama = '$nama', level = '$level' WHERE id_user = '$id_user'; ";
  }
  $query = mysqli_query($konek,$edit);
  if($query){
    $_SESSION['pesan'] = "Berhasil. Ubah data berhasil.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
  }else{
    $_SESSION['pesan'] = "Gagal. Ubah data gagal.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
  }
}

if ($module=='user' AND $act=='hapus'){
  $id_user = $_GET['id'];
  $hapus="DELETE FROM tbl_user  WHERE id_user = '$id_user' ";
  $query = mysqli_query($konek,$hapus);
  if($query){
    $_SESSION['pesan'] = "Berhasil. Hapus data berhasil.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
  }else{
    $_SESSION['pesan'] = "Gagal. Hapus data gagal.";
    echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=user'>";
  }
}
?>