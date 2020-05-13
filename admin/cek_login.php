<?php
include "../system/koneksi.php";

$username = $_POST['username'];
$pass     = md5($_POST['password']);

$login = $pdo->query("SELECT * FROM admin WHERE username='$username' AND password='$pass' AND status='Aktif'");
$ketemu = $login->rowCount();

if ($ketemu > 0){
	$r = $login->fetch(PDO::FETCH_ASSOC);

	$statement = $pdo->prepare("UPDATE admin SET last_login = now() WHERE id = '$r[id]'");
	$count = $statement->execute();

	session_start();

	$_SESSION['KCFINDER']=array();
	$_SESSION['KCFINDER']['disabled'] = false;
	$_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/images";
	$_SESSION['KCFINDER']['uploadDir'] = "";
  
	$_SESSION['idadmin']     		= $r['id'];
	$_SESSION['gambaradmin']     	= $r['gambar'];
	$_SESSION['namaadmin']     		= $r['username'];
	$_SESSION['namalengkapadmin']  	= $r['nama_lengkap'];
	$_SESSION['passadmin']    		= $r['password'];
	$_SESSION['leveladmin']   		= $r['level'];
	$_SESSION['idsession']			= $r['id_session'];
	$_SESSION['halaman']			= 'Home';
	
	if($r['level'] !== 'admin'){
		header('location:cek-stok');
	}else{
		header('location:home');
	}
	
	
}else{
	echo "<link href='../style.css' rel='stylesheet' type='text/css' />";
	echo " <br />
		<br /> <br />
		<br /> <br />
		<br /> <br />
		<br /><div align='center'><div id='content'>
		<div align='center'><br /> 
	  

	   
		<table width='303' border='0' cellpadding='0' cellspacing='0' class='form5'>
		<tr>
			<td><div align='center'><a href='javascript:history.go(-1)'><b><img src='wrong.jpg' width='24' height='24' border='0'/></b></a><br />
			Username atau Password Anda tidak benar <br />
			<a href='javascript:history.go(-1)'><b>Ulangi Lagi</b></a> </div></td>
		</tr>
		</table>
		
		<br /><br />
	  </div> 
	</div>";
}
?>
