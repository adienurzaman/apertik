<?php
session_start();
error_reporting(0);
// error_reporting(E_ALL);
date_default_timezone_set('Asia/Jakarta');
include "auth/timeout.php";

if($_SESSION['login']==1){
  if(!cek_login()){
    $_SESSION['login'] = 0;
  }
}
if($_SESSION['login']==0){
  header('location:auth/logout.php');
}
else{
      if (empty($_SESSION['username']) AND $_SESSION['login']==0){
        echo "<link href='style.css' rel='stylesheet' type='text/css'>
      <center>Untuk mengakses modul, Anda harus login <br>";
        echo "<a href=index.php><b>LOGIN</b></a></center>";
      }
else{
?>
<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
    include "layout/head.php";
    ?>
  </head>
  <?php if($_SESSION['leveluser']=='Pemilik'){ $color = "skin-green";}else{ $color = "skin-red"; } ?>
  <body class="hold-transition <?= $color; ?> fixed sidebar-mini">
    <?php
    include "layout/header.php";
    include "layout/sidebar.php";
    include "layout/konten.php";
    include "layout/footer.php";
    include "layout/footerjs.php";
    ?>
 </body>
</html>

<?php
}
}
?>