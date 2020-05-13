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
	$module2="slider";
	$hal = "slider";
	$act=$_GET["act"];
	
	// Update modul
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

		$judul_seo 	= seo($_POST["judul"]);
		
		if (!empty($lokasi_file)){
			$edit = $pdo->query("SELECT gambar FROM slider WHERE id_slider='$_POST[id_slider]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/$module2/$tedit[gambar]");
			unlink("../../../images/$module2/small/$tedit[gambar]");
			
			$gbr = $imgname1."-".$nama_file_unik;
			try {
				$sql = "UPDATE slider   
						SET judul 			= :judul,
							gambar 			= :gambar,
							url 			= :url,
							urutan 			= :urutan,
							tgl_update 		= NOW()
						WHERE id_slider 	= :id_slider
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":url", $_POST["url"], PDO::PARAM_STR);
				$statement->bindParam(":urutan", $_POST["urutan"], PDO::PARAM_INT);
				$statement->bindParam(":id_slider", $_POST["id_slider"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				UploadAll($nama_file_unik,'slider',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");

			
				echo "<script>window.location = '../../$module-edit-$_POST[id_slider]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_slider]'</script>";
			}
		}else{
			try {
				$sql = "UPDATE slider   
						SET judul 			= :judul,
							url 			= :url,
							urutan 			= :urutan,
							tgl_update 		= NOW()
						WHERE id_slider 	= :id_slider
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":url", $_POST["url"], PDO::PARAM_STR);
				$statement->bindParam(":urutan", $_POST["urutan"], PDO::PARAM_INT);
				$statement->bindParam(":id_slider", $_POST["id_slider"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_slider]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_slider]'</script>";
			}
		}
	}
	  
	
	// add modul
	elseif ($module==$module2 AND $act=='add'){
		$jdl2 = substr($_POST["judul"],0,100);
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($jdl2);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;
		
		
		if(empty($nama_file)){
			echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
		}else{
			try{
				$gbr = $imgname1."-".$nama_file_unik;
				
				$stmt = $pdo->prepare("INSERT INTO slider
											(judul, url, gambar, urutan, tgl_update)
										VALUES(:judul,:url,:gambar,:urutan, now() )" );
				
				$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$stmt->bindParam(":url", $_POST["url"], PDO::PARAM_STR);
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$stmt->bindParam(":urutan", $_POST["urutan"], PDO::PARAM_INT);
				$count = $stmt->execute();
				$insertId = $pdo->lastInsertId();
				
				UploadAll($nama_file_unik,'slider',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	  
	
	// remove modul
	elseif ($module==$module2 AND $act=='remove'){
		$edit = $pdo->query("SELECT gambar FROM slider WHERE id_slider='$_GET[id]'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/$module2/$rr[gambar]");
		unlink("../../../images/$module2/small/$rr[gambar]");
		
		$del = $pdo->query("DELETE FROM slider WHERE id_slider='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>