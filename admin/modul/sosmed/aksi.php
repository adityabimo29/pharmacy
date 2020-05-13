<?php
session_start();
error_reporting(0);

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";

	$module=$_GET["module"];
	$module2="sosmed";
	$hal = "sosmed";
	$act=$_GET["act"];
	
	// Update modul
	if ($module==$module2 AND $act=='update'){
		try {
			$sql = "UPDATE sosmed   
					SET id_modul_sosmed = :id_modul_sosmed,
						url 			= :url,
						status 			= :status,
						tgl_update 		= now()
					WHERE id_sosmed 	= :id_sosmed
				  ";
				  
			$statement = $pdo->prepare($sql);
			$statement->bindParam(":id_modul_sosmed", $_POST["id_modul_sosmed"], PDO::PARAM_INT);
			$statement->bindParam(":url", $_POST["url"], PDO::PARAM_STR);
			$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
			$statement->bindParam(":id_sosmed", $_POST["id_sosmed"], PDO::PARAM_INT);
			$count = $statement->execute();
		
			echo "<script>window.location = '../../sosmed'</script>";
		}catch(PDOException $e){
			echo "<script>alert('Sosial Media Gagal diedit!'); window.location = '../../sosmed-edit-$_POST[id_sosmed]'</script>";
		}
	}
	  
	
	// add modul
	elseif ($module==$module2 AND $act=='add'){
		try{
			$stmt = $pdo->prepare("INSERT INTO sosmed
										(id_modul_sosmed, url, status, tgl_update)
									VALUES(:id_modul_sosmed,:url,:status, now() )" );
			
			$stmt->bindParam(":id_modul_sosmed", $_POST["id_modul_sosmed"], PDO::PARAM_INT);
			$stmt->bindParam(":url", $_POST["url"], PDO::PARAM_STR);
			$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
		
			$count = $stmt->execute();
			
			$insertId = $pdo->lastInsertId();
		
			echo "<script>window.location = '../../$module2'</script>";
			
		}catch(PDOException $e){
			echo "<script>window.alert('Sosial Media Gagal ditambah!'); window.location(history.back(-1))</script>";
		}
	}
	  
	
	// remove modul
	elseif ($module==$module2 AND $act=='remove'){
		
		$del = $pdo->query("DELETE FROM sosmed WHERE id_sosmed='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>