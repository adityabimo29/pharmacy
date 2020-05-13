<?php
session_start();
//error_reporting(0);

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";
	include "../../../system/fungsi_all.php";
	include "../../../system/z_setting.php";

	$module=$_GET["module"];
	$module2="kategori";
	$hal = "Kategori";
	$act=$_GET["act"];
	
	// Update modul
	if ($module==$module2 AND $act=='update'){
		$jdl2 = substr($_POST["judul"],0,100);
		$seojdul        = seo($jdl2);
				
		if(empty($_POST["urutan"]) OR ($_POST["urutan"]=="")){$urutan = "0";}else{$urutan = $_POST['urutan'];}
		
		if($_POST["keyword"]==""){ $keyword = ucfirst($_POST["judul"]); }else{ $keyword = $_POST["keyword"]; }
		if($_POST["description"]==""){ $description = ucfirst($_POST["judul"]); }else{ $description = $_POST["description"]; }
		try {
			$sql = "UPDATE kategori SET
						judul 			= :judul,
						judul_seo 		= :judul_seo,
						status 			= :status,
						urutan 			= :urutan,
						
						keyword 		= :keyword,
						description 	= :description
					WHERE id_kategori 	= :id_kategori
				  ";
				  
			$statement = $pdo->prepare($sql);
			$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
			$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
			$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
			$statement->bindParam(":urutan", $urutan, PDO::PARAM_INT);
			
			$statement->bindParam(":keyword", $keyword, PDO::PARAM_STR);
			$statement->bindParam(":description", $description, PDO::PARAM_STR);
			$statement->bindParam(":id_kategori", $_POST["id_kategori"], PDO::PARAM_INT);
			$count = $statement->execute();
		
			echo "<script>window.location = '../../kategori-edit-$_POST[id_kategori]'</script>";
		}catch(PDOException $e){
			echo "<script>alert('$hal Gagal diedit!'); window.location = '../../kategori-edit-$_POST[id_kategori]'</script>";
		}
	}
	  
	
	elseif ($module==$module2 AND $act=='add'){
		$jdl2 = substr($_POST["judul"],0,100);
		$seojdul        = seo($_POST["judul"]);
		
		if(empty($_POST["urutan"]) OR ($_POST["urutan"]=="")){$urutan = "0";}else{$urutan = $_POST['urutan'];}
		
		if($_POST["keyword"]==""){ $keyword = ucfirst($_POST["judul"]); }else{ $keyword = $_POST["keyword"]; }
		if($_POST["description"]==""){ $description = ucfirst($_POST["judul"]); }else{ $description = $_POST["description"]; }
		
		try{
			$stmt = $pdo->prepare("INSERT INTO kategori
									(judul,judul_seo,status,urutan,keyword,description)
									VALUES(:judul,:judul_seo,:status,:urutan,:keyword,:description)" );
			
			$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
			$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
			$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
			$stmt->bindParam(":urutan", $urutan, PDO::PARAM_INT);
			
			$stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
			$stmt->bindParam(":description", $description, PDO::PARAM_STR);			
			$count = $stmt->execute();				
			$insertId = $pdo->lastInsertId();
		
			echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
			
		}catch(PDOException $e){
			echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
		}
	}
	
	elseif ($module==$module2 AND $act=='remove'){
		$statement = $pdo->prepare("UPDATE produk SET id_kategori = '0' WHERE id_kategori = '$_GET[id]'");
		$count = $statement->execute();

		$del = $pdo->query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>