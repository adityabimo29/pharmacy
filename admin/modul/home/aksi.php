<?php
session_start();
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../sys/koneksi.php";

	$module=$_GET["module"];
	$act=$_GET["act"];

	
	// Update modul
	if ($module=='home' AND $act=='update'){
		$deskripsi=mysql_real_escape_string($_POST["deskripsi"]);
		mysql_query("UPDATE content SET deskripsi = '$deskripsi', judul = '$_POST[judul]'
							  WHERE id_content   = '$_POST[id]'");
		header('location:../../media.php?module=home');
	}
}
?>
