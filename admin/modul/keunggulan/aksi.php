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
	include "../../../system/fungsi_all.php";
	include "../../../system/z_setting.php";

	$module=$_GET["module"];
	$module2="keunggulan";
	$hal = "keunggulan";
	$act=$_GET["act"];
	
	if ($module==$module2 AND $act=='update'){
		$jdl2 = substr($_POST["judul"],0,100);
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($jdl2);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;
				
		if(empty($_POST["urutan"]) OR ($_POST["urutan"]=="")){$urutan = "0";}else{$urutan = $_POST['urutan'];}

		if (!empty($nama_file)){
			$edit = $pdo->query("SELECT gambar FROM keunggulan WHERE id_keunggulan='$_POST[id_keunggulan]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/keunggulan/$tedit[gambar]");
			unlink("../../../images/keunggulan/small/$tedit[gambar]");
				
			$gbr = $imgname1."-".$nama_file_unik;
			try {
				$sql = "UPDATE keunggulan SET
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							status 			= :status,
							urutan 			= :urutan,
							gambar 			= :gambar
						WHERE id_keunggulan 	= :id_keunggulan
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":urutan", $urutan, PDO::PARAM_INT);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":id_keunggulan", $_POST["id_keunggulan"], PDO::PARAM_INT);
				$count = $statement->execute();

				UploadAll($nama_file_unik,'keunggulan',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../keunggulan-edit-$_POST[id_keunggulan]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../keunggulan-edit-$_POST[id_keunggulan]'</script>";
			}
		}else{
			$urutan = $_POST['urutan'];
			try {
				$sql = "UPDATE keunggulan SET
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							status 			= :status,
							urutan 			= :urutan
						WHERE id_keunggulan 	= :id_keunggulan
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":urutan", $urutan, PDO::PARAM_INT);
				$statement->bindParam(":id_keunggulan", $_POST["id_keunggulan"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../keunggulan-edit-$_POST[id_keunggulan]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../keunggulan-edit-$_POST[id_keunggulan]'</script>";
			}
		}
	}

	elseif ($module==$module2 AND $act=='add'){
		$jdl2 = substr($_POST["judul"],0,80);
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($_POST["judul"]);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;

		$judul_seo 	= seo($_POST["judul"]);
		
		if(empty($_POST["urutan"]) OR ($_POST["urutan"]=="")){$urutan = "0";}else{$urutan = $_POST['urutan'];}
		
		if(!empty($nama_file)){
			$gbr = $imgname1."-".$nama_file_unik;		
			try{
				$stmt = $pdo->prepare("INSERT INTO keunggulan
										(judul,judul_seo,status,urutan,gambar)
										VALUES(:judul,:judul_seo,:status,:urutan,:gambar)" );
				
				$stmt->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$stmt->bindParam(":urutan", $urutan, PDO::PARAM_INT);
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);			
				$count = $stmt->execute();
				$insertId = $pdo->lastInsertId();

				UploadAll($nama_file_unik,'keunggulan',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}else{
			try{
				$stmt = $pdo->prepare("INSERT INTO keunggulan
										(judul,judul_seo,status,urutan)
										VALUES(:judul,:judul_seo,:status,:urutan)" );
				
				$stmt->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$stmt->bindParam(":urutan", $urutan, PDO::PARAM_STR);			
				$count = $stmt->execute();				
				$insertId = $pdo->lastInsertId();
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	
	elseif ($module==$module2 AND $act=='remove'){		
		$edit = $pdo->query("SELECT gambar FROM keunggulan WHERE id_keunggulan='$_GET[id]'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/$module2/$rr[gambar]");
		unlink("../../../images/$module2/small/$rr[gambar]");

		$del = $pdo->query("DELETE FROM keunggulan WHERE id_keunggulan='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	elseif($module==$module2 AND $act=='romoveimg'){
		$edit = $pdo->query("SELECT gambar FROM keunggulan WHERE id_keunggulan='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/$module2/$tedit[gambar]");
		unlink("../../../images/$module2/small/$tedit[gambar]");
			
		$statement = $pdo->prepare("UPDATE keunggulan SET gambar='' WHERE id_keunggulan='$_GET[id]'");
		$count = $statement->execute();
		
		echo "<script>window.location = '../../$module2-edit-$_GET[id]'</script>";
	}
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>