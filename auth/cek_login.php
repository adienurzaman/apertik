<?php

include "../config/koneksi.php";

include "../config/library.php";

include "../config/fungsi_indotgl.php";

include "../config/class_paging.php";



function anti_injection($data){

  $filter  = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));

  return $filter;

}



$username = anti_injection($_POST['username']);

$pass     = anti_injection(md5($_POST['password']));



// pastikan username dan password adalah berupa huruf atau angka.

if(!ctype_alnum($username) OR !ctype_alnum($pass)){

  echo "<script>alert('GAGAL LOGIN, USERNAME DAN PASSWORD BELUM DIISI'); </script>";

  echo "<script>window.location ='../index.php'</script>";

}

else{

  $login=mysqli_query($konek,"SELECT * FROM tbl_user WHERE username='$username' LIMIT 1");

  $ketemu=mysqli_num_rows($login);

  $r=mysqli_fetch_array($login);



  // Apabila username dan password ditemukan

  if($ketemu>0){

  //cek lagi

    $login=mysqli_query($konek,"SELECT * FROM tbl_user WHERE username='$username' AND password='$pass' LIMIT 1");

    $ketemu=mysqli_num_rows($login);

    if($ketemu==0){

      echo "Please Wait. Redirect...";

      echo "<script>alert('Maaf, Password Salah!'); </script>";

      echo "<meta http-equiv='refresh' content='0; url=../index.php'>";

    }else{

      session_start();

      include "timeout.php";



      $_SESSION['id_user'] = $r['id_user'];

      $_SESSION['username'] = $r['username'];

      $_SESSION['password']  = $r['password'];

      $_SESSION['nama']  = $r['nama'];

      $_SESSION['leveluser'] = $r['level'];

      

      // session timeout

      $_SESSION['login'] = 1;

      timer();



      header('location:../media.php?module=home');

    }  

  }else{

    echo "Please Wait. Redirect...";

    echo "<script>alert('Maaf, Anda Belum Terdaftar'); </script>";

    echo "<meta http-equiv='refresh' content='0; url=../index.php'>";

    

  }

}

?>

