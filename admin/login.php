<?php
	session_start();
	
	include "../system/koneksi.php";
	include "../system/z_setting.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin <?php echo $namaweb; ?> | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
	<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script language="javascript">
	function validasi(form){
	  if (form.username.value == ""){
		alert("Anda belum mengisikan Username.");
		form.username.focus();
		return (false);
	  }
		 
	  if (form.password.value == ""){
		alert("Anda belum mengisikan Password.");
		form.password.focus();
		return (false);
	  }
	  return (true);
	}
	</script>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
		<!--
		<div class="login-logo">
			<a href="index2.html"><b>Admin <br>Hasanah Property</b></a>
		</div>
		-->
		<div class="login-box-body">
			<div class="login-logo">
				<a href="index2.html"><b>Admin <br/><?php echo $namaweb; ?></b></a>
			</div><!-- /.login-logo -->
			<form name="login" action="cek_login.php" method="post" onSubmit="return validasi(this)">
			  <div class="form-group has-feedback">
				<input type="text" name="username" class="form-control" placeholder="Username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			  <div class="row">
				<div class="col-xs-4">
				  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div><!-- /.col -->
			  </div>
			</form><br>

			<!-- <a href="#">I forgot my password</a><br> -->

		</div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  </body>
</html>
