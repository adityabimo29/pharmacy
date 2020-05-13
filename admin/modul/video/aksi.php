<?php
session_start();
//error_reporting(0);

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";
	include "../../../system/fungsi_thumb.php";
	include "../../../system/fungsi_all.php";
	include "../../../system/z_setting.php";
	include "../../../system/fungsi_youtube.php";

	$module=$_GET["module"];
	$module2="video";
	$hal = "Berita Video";
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
		
		$tgl 	= explode("/", $_POST['tgl']);
		$tgl1=$tgl[0];
		$bln=$tgl[1];
		$thn=$tgl[2];
		$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";

		$id_menu = "7";
		$video	= youtube($_POST["video"]);

		if($_POST["judul"]==""){
			echo "<script>window.alert('Judul tidak boleh kosong!'); window.location(history.back(-1))</script>";
		}elseif (!empty($nama_file)){
			$edit = $pdo->query("SELECT gambar FROM berita WHERE id_berita='$_POST[id_berita]' AND id_menu='7' ");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/berita/$tedit[gambar]");
			unlink("../../../images/berita/small/$tedit[gambar]");
			
			$gbr = $imgname1."-".$nama_file_unik;

			try {
				$sql = "UPDATE berita SET
							id_menu 		= :id_menu,
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							deskripsi 		= :deskripsi,
							status 			= :status,
							gambar 			= :gambar,
							video 			= :video,
							
							keyword 		= :keyword,
							description 	= :description,
							tgl 			= :tgl,
							tgl_update 		= now()
						WHERE id_berita 	= :id_berita
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":id_menu", $id_menu, PDO::PARAM_INT);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":video", $video, PDO::PARAM_STR);
				
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_berita", $_POST["id_berita"], PDO::PARAM_INT);
				$count = $statement->execute();
				
		    	UploadBerita($nama_file_unik);
				unlink("../../../images/berita/$nama_file_unik");
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_berita]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_berita]'</script>";
			}
		}else{
			try {
				$sql = "UPDATE berita SET
							id_menu			= :id_menu,
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							deskripsi 		= :deskripsi,
							status	 		= :status,
							video	 		= :video,
							
							keyword 		= :keyword,
							description 	= :description,
							tgl 			= :tgl,
							tgl_update 		= now()
						WHERE id_berita 	= :id_berita
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":id_menu", $id_menu, PDO::PARAM_INT);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":video", $video, PDO::PARAM_STR);
				
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_berita", $_POST["id_berita"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../$module-edit-$_POST[id_berita]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('$hal Gagal diedit!'); window.location = '../../$module-edit-$_POST[id_berita]'</script>";
			}
		}
	}
	  
	
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
		
		$tgl 	= explode("/", $_POST['tgl']);
		$tgl1=$tgl[0];
		$bln=$tgl[1];
		$thn=$tgl[2];
		date_default_timezone_set('Asia/Jakarta');
		if($_POST['tgl']!=''){$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";}else{ $tgl_post = date('Y-m-d h:i:sa');}
		
	    if($_POST["keyword"]==""){ $keyword = $jdl2.", $namaweb"; }else{ $keyword = $_POST["keyword"]; }
		if($_POST["description"]==""){ $description = $jdl2.", $namaweb"; }else{ $description = $_POST["description"]; }
		$id_menu = "7";
		$video	= youtube($_POST["video"]);
		

		if($_POST["judul"]==""){
			echo "<script>window.alert('Judul tidak boleh kosong!'); window.location(history.back(-1))</script>";
		}elseif(empty($nama_file)){
			try{
				
				$stmt = $pdo->prepare("INSERT INTO berita
										(id_menu,judul,judul_seo,deskripsi,status,video,keyword,description,tgl,tgl_update)
										VALUES(:id_menu,:judul,:judul_seo,:deskripsi,:status,:video,:keyword,:description, :tgl,now())" );
				
				$stmt->bindParam(":id_menu", $id_menu, PDO::PARAM_INT);
				$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$stmt->bindParam(":video", $video, PDO::PARAM_STR);
				$stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
				$stmt->bindParam(":description", $description, PDO::PARAM_STR);	
				$stmt->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$count = $stmt->execute();
				$insertId = $pdo->lastInsertId();
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}else{
			try{
				$gbr = $imgname1."-".$nama_file_unik;
				
				$stmt = $pdo->prepare("INSERT INTO berita
										(id_menu,judul,judul_seo,deskripsi,status,gambar,video,keyword,description,tgl,tgl_update)
										VALUES(:id_menu,:judul,:judul_seo,:deskripsi,:status,:gambar,:video,:keyword,:description, :tgl,now())" );
				
				$stmt->bindParam(":id_menu", $id_menu, PDO::PARAM_INT);
				$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
				$stmt->bindParam(":description", $description, PDO::PARAM_STR);				
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$stmt->bindParam(":video", $video, PDO::PARAM_STR);
				$stmt->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$count = $stmt->execute();
				$insertId = $pdo->lastInsertId();
				
				UploadBerita($nama_file_unik);
				unlink("../../../images/berita/$nama_file_unik");
			
				echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	  
	
	elseif ($module==$module2 AND $act=='remove'){
		$edit = $pdo->query("SELECT gambar FROM berita WHERE id_berita='$_GET[id]' AND id_menu='7'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/berita/$rr[gambar]");
		unlink("../../../images/berita/small/$rr[gambar]");
		
		$del = $pdo->query("DELETE FROM berita WHERE id_berita='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>