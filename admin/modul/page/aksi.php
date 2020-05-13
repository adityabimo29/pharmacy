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
	$module2="page";
	$act=$_GET["act"];

	if($module==$module2 AND $act=='update'){
		//'Text','Textarea','Textarea SEO','Judul & Text','Judul & Textarea','Text Images','Textarea Images','Images','Images SEO','SEO','All'
		
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($_POST["judul"]);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;
		
		$judul_seo     	= seo(trim($_POST['judul']));
		
		if(empty($nama_file)){
			try {
				$sql = "UPDATE page   
						SET judul 			= :judul,
							judul_seo 		= :judul_seo,
							deskripsi 		= :deskripsi,
							title 			= :title,
							keyword 		= :keyword,
							description 	= :description,
							tgl_update 		= NOW()
						WHERE id_page 		= :id_page
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $judul_seo, PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":title", $_POST["title"], PDO::PARAM_STR);
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":id_page", $_POST["id_page"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				echo "<script>window.location = '../../media.php?module=$module&act=edit&id=$_POST[id_page]'</script>";
			}catch(PDOException $e){
				echo "<script>window.alert('Halaman Gagal diedit!'); window.location(history.back(-1))</script>";
			}
		}else{
				$edit = $pdo->query("SELECT gambar FROM page WHERE id_page='$_POST[id_page]'");
				$tedit = $edit->fetch(PDO::FETCH_ASSOC);
				unlink("../../../images/page/$tedit[gambar]");
			
				UploadPage($nama_file_unik);
				$gbr = $imgname1."-".$nama_file_unik;
				unlink("../../../images/page/$nama_file_unik");
				
				try {
					$sql = "UPDATE page   
							SET judul 			= :judul,
								judul_seo 		= :judul_seo,
								deskripsi 		= :deskripsi,
								title 			= :title,
								keyword 		= :keyword,
								description 	= :description,
								gambar 			= :gambar,
								tgl_update 		= NOW()
							WHERE id_page 		= :id_page
						  ";
						  
					$statement = $pdo->prepare($sql);
					$statement->bindParam(":judul", $_POST["judul"], PDO::PARAM_STR);
					$statement->bindParam(":judul_seo", $judul_seo, PDO::PARAM_STR);
					$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
					$statement->bindParam(":title", $_POST["title"], PDO::PARAM_STR);
					$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
					$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
					$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
					$statement->bindParam(":id_page", $_POST["id_page"], PDO::PARAM_INT);
					$count = $statement->execute();
					
					
					echo "<script>window.location = '../../media.php?module=$module&act=edit&id=$_POST[id_page]'</script>";
				}catch(PDOException $e){
					echo "<script>window.alert('Halaman Gagal diedit!'); window.location(history.back(-1))</script>";
				}
		}
	}
	
	
	elseif($module==$module2 AND $act=='romoveimg'){
		$gambar = '';
		$edit = $pdo->query("SELECT gambar FROM page WHERE id_page='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/page/$tedit[gambar]");
		unlink("../../../images/page/small/$tedit[gambar]");
			
				$sql = "UPDATE page   
						SET gambar 			= :gambar
						WHERE id_page 	= :id_page
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
				$statement->bindParam(":id_page", $_GET["id"], PDO::PARAM_INT);
				$count = $statement->execute();
		
		header('location:../../page-edit-'.$_GET["id"]);
	}
}
?>

<center style="margin-top: 250px;"><img src="../../load.gif"></center>