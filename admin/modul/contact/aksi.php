<?php
session_start();
//error_reporting(0);

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";

	$module=$_GET["module"];
	$module2="contact";
	$act=$_GET["act"];
	
	// remove modul
	if ($module==$module2 AND $act=='remove'){
		$del = $pdo->query("DELETE FROM contact WHERE id_contact='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../contact'</script>";
	}
}
?>
