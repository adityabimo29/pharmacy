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
	$module2="blog";
	$hal = "Blog";
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
		
		if (!empty($nama_file)){
			$edit = $pdo->query("SELECT gambar FROM blog WHERE id_blog='$_POST[id_blog]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/$module2/$tedit[gambar]");
			unlink("../../../images/$module2/small/$tedit[gambar]");
			
			UploadBlog($nama_file_unik);
			$gbr = $imgname1."-".$nama_file_unik;

			try {
				$sql = "UPDATE blog SET
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							deskripsi 		= :deskripsi,
							status 			= :status,
							gambar 			= :gambar,
							
							keyword 		= :keyword,
							description 	= :description,
							tgl 			= :tgl,
							tgl_update 		= now()
						WHERE id_blog 	= :id_blog
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_blog", $_POST["id_blog"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				unlink("../../../images/$module2/$nama_file_unik");
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_blog]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_blog]'</script>";
			}
		}else{
			try {
				$sql = "UPDATE blog SET
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							deskripsi 		= :deskripsi,
							status	 		= :status,
							
							keyword 		= :keyword,
							description 	= :description,
							tgl 			= :tgl,
							tgl_update 		= now()
						WHERE id_blog 	= :id_blog
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_blog", $_POST["id_blog"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_blog]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_blog]'</script>";
			}
		}
	}
	  
	
	// add modul
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
		
		if(empty($nama_file)){
			echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
		}else{
			try{
				UploadBlog($nama_file_unik);
				$gbr = $imgname1."-".$nama_file_unik;
				unlink("../../../images/$module2/$nama_file_unik");
				
				$stmt = $pdo->prepare("INSERT INTO blog
										(judul,judul_seo,deskripsi,status,gambar,keyword,description,tgl,tgl_update)
										VALUES(:judul,:judul_seo,:deskripsi,:status,:gambar,:keyword,:description, :tgl,now())" );
				
				$stmt->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				
				$stmt->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$stmt->bindParam(":description", $_POST["description"], PDO::PARAM_STR);				
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$stmt->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
			
				$count = $stmt->execute();
				
				$insertId = $pdo->lastInsertId();
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	  
	
	// remove modul
	elseif ($module==$module2 AND $act=='remove'){
		$edit = $pdo->query("SELECT gambar FROM blog WHERE id_blog='$_GET[id]'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/$module2/$rr[gambar]");
		unlink("../../../images/$module2/small/$rr[gambar]");
		
		$del = $pdo->query("DELETE FROM blog WHERE id_blog='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>