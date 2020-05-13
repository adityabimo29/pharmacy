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
	$module2="artikel";
	$hal = "artikel";
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
		
		$tgl 	= explode("/", $_POST['tgl']);
		$tgl1=$tgl[0];
		$bln=$tgl[1];
		$thn=$tgl[2];
		$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";

		if($_POST["keyword"]==""){ $keyword = ucfirst($_POST["judul"]); }else{ $keyword = $_POST["keyword"]; }
		if($_POST["description"]==""){ $description = ucfirst($_POST["judul"]); }else{ $description = $_POST["description"]; }
		
		if (empty($nama_file)){
			try {
				$sql = "UPDATE artikel SET
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							status 			= :status,
							deskripsi 		= :deskripsi,

							keyword 		= :keyword,
							description 	= :description,
							tgl 			= :tgl,
							tgl_update		= now()
						WHERE id_artikel 	= :id_artikel
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				
				$statement->bindParam(":keyword", $keyword, PDO::PARAM_STR);
				$statement->bindParam(":description", $description, PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_artikel", $_POST["id_artikel"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				UploadAll($nama_file_unik,'artikel',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_artikel]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_artikel]'</script>";
			}
		}else{
			$edit = $pdo->query("SELECT gambar FROM artikel WHERE id_artikel='$_POST[id_artikel]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/$module2/$tedit[gambar]");
			unlink("../../../images/$module2/small/$tedit[gambar]");
			
			$gbr = $imgname1."-".$nama_file_unik;

			try {
				$sql = "UPDATE artikel SET
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							status 			= :status,
							gambar 			= :gambar,
							deskripsi 		= :deskripsi,

							keyword 		= :keyword,
							description 	= :description,
							tgl 			= :tgl,
							tgl_update		= now()
						WHERE id_artikel 	= :id_artikel
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);

				$statement->bindParam(":keyword", $keyword, PDO::PARAM_STR);
				$statement->bindParam(":description", $description, PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_artikel", $_POST["id_artikel"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				UploadAll($nama_file_unik,'artikel',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_artikel]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_artikel]'</script>";
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
		
		$tgl 	= explode("/", $_POST['tgl']);
		$tgl1=$tgl[0];
		$bln=$tgl[1];
		$thn=$tgl[2];
		date_default_timezone_set('Asia/Jakarta');
		if($_POST['tgl']!=''){$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";}else{ $tgl_post = date('Y-m-d h:i:sa');}
		
		if($_POST["keyword"]==""){ $keyword = ucfirst($_POST["judul"]); }else{ $keyword = $_POST["keyword"]; }
		if($_POST["description"]==""){ $description = ucfirst($_POST["judul"]); }else{ $description = $_POST["description"]; }

		if(empty($nama_file)){
			echo "<script>window.alert('Gambar harus di isi!'); window.location(history.back(-1))</script>";
		}else{
			try{
				$gbr = $imgname1."-".$nama_file_unik;
				
				$stmt = $pdo->prepare("INSERT INTO artikel
										(judul,judul_seo,status,gambar,deskripsi,keyword,description,tgl,tgl_update)
										VALUES(:judul,:judul_seo,:status,:gambar,:deskripsi,:keyword,:description,:tgl,now())");
				
				$stmt->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
				$stmt->bindParam(":description", $description, PDO::PARAM_STR);
				$stmt->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);			
				$count = $stmt->execute();				
				$insertId = $pdo->lastInsertId();

				UploadAll($nama_file_unik,'artikel',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	  
	
	// remove modul
	elseif ($module==$module2 AND $act=='remove'){
		$edit = $pdo->query("SELECT gambar FROM artikel WHERE id_artikel='$_GET[id]'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/$module2/$rr[gambar]");
		unlink("../../../images/$module2/small/$rr[gambar]");
		
		$del = $pdo->query("DELETE FROM artikel WHERE id_artikel='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	
	elseif ($module==$module2 AND $act=='removeimg'){
		$edit = $pdo->query("SELECT id_artikel,gambar FROM artikel WHERE id_artikel='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/$module2/$tedit[gambar]");
		unlink("../../../images/$module2/small/$tedit[gambar]");
		
		$statement = $pdo->prepare("UPDATE artikel SET gambar='' WHERE id_artikel='$_GET[id]'");
		$count = $statement->execute();
		
		header('location:../../'.$module2.'-edit-'.$tedit['id_artikel']);
	}
	
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>