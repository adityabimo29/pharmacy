<?php
session_start();
error_reporting(0);

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";
	include "../../../system/fungsi_thumb.php";
	include "../../../system/fungsi_seo.php";
	include "../../../system/fungsi_seo2.php";
	include "../../setting.php";

	$module=$_GET["module"];
	$module2="about";
	$hal = "About";
	$act=$_GET["act"];
	
	// Update modul
	if ($module==$module2 AND $act=='update'){
		$jdl2 = substr($_POST["judul"],0,100);
		$seojdul        = seo($jdl2);
		
		$tgl 	= explode("/", $_POST['tgl']);
		$tgl1=$tgl[0];
		$bln=$tgl[1];
		$thn=$tgl[2];
		$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";
		
		try {
			$sql = "UPDATE about SET
						judul 			= :judul,
						judul_seo 		= :judul_seo,
						deskripsi 		= :deskripsi,
						status	 		= :status,
						
						keyword 		= :keyword,
						description 	= :description,
						tgl 			= :tgl,
						tgl_update 		= now()
					WHERE id_about 	= :id_about
				  ";
				  
			$statement = $pdo->prepare($sql);
			$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
			$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
			$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
			$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
			
			$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
			$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
			$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
			$statement->bindParam(":id_about", $_POST["id_about"], PDO::PARAM_INT);
			$count = $statement->execute();
		
			echo "<script>window.location = '../../$module-edit-$_POST[id_about]'</script>";
		}catch(PDOException $e){
			echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_about]'</script>";
		}
	}
	  
	
	// add modul
	elseif ($module==$module2 AND $act=='add'){
		$jdl2 = substr($_POST["judul"],0,100);
		$seojdul        = seo($_POST["judul"]);
		
		$tgl 	= explode("/", $_POST['tgl']);
		$tgl1=$tgl[0];
		$bln=$tgl[1];
		$thn=$tgl[2];
		date_default_timezone_set('Asia/Jakarta');
		if($_POST['tgl']!=''){$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";}else{ $tgl_post = date('Y-m-d h:i:sa');}
		
		try{
			//$gbr = $imgname1."-".$nama_file_unik;
			
			$stmt = $pdo->prepare("INSERT INTO about
									(judul,judul_seo,deskripsi,status,keyword,description,tgl,tgl_update)
									VALUES(:judul,:judul_seo,:deskripsi,:status,:keyword,:description, :tgl,now())" );
			
			$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
			$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
			$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
			$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
			$stmt->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
			$stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
			$stmt->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
			$count = $stmt->execute();
			$insertId = $pdo->lastInsertId();
			
			//Uploadabout($nama_file_unik);
			//unlink("../../../images/$module2/$nama_file_unik");
		
			echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
			
		}catch(PDOException $e){
			echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
		}
	}
	  
	
	// remove modul
	elseif ($module==$module2 AND $act=='remove'){
		
		$del = $pdo->query("DELETE FROM about WHERE id_about='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>