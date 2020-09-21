<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Area | Aplikasi Perhitungan Tiket</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="manifest" href="manifest.json">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/vendor/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/vendor/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">

<?php 
for ($i=0; $i<7; $i++){
    echo "<br>";
} 
?>

  <div class="login-box-body">
    <p class="login-box-msg"><strong>Silahkan Login Terlebih Dahulu</strong></p>

    <form action="auth/cek_login.php" method="post">
      <div class="form-group has-feedback">
        <input type="username" class="form-control" placeholder="Masukkan Username Anda" name="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Masukkan Password Anda" name="password"> 
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
        </div>
        <div class="col-xs-12">
          <button type="reset" class="btn btn-warning btn-block btn-flat">Batal</button>
        </div>
        
        <div class="col-xs-12">
          <hr/>
          <p class="login-box-msg">APERTIK (Aplikasi Perhitungan Tiket) &copy<?php echo date('Y'); ?></p>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/vendor/iCheck/icheck.min.js"></script>
<script src="./pwa/main.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
