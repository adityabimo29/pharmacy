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

	$module=$_GET["module"];
	$module2="admin";
	$act=$_GET["act"];
	
	// Update modul
	if ($module==$module2 AND $act=='update'){
		$edit = $pdo->query("SELECT username FROM admin");
		$ketemu = $edit->rowCount();
		if($ketemu<=0){
			echo "<script>alert('Admin dengan Username : $_POST[username] sudah terdaftar, pilih username lainnya.'); window.location(history.back(-1))</script>";
		}else{			
			//$jdl2 = substr($_POST["judul"],0,80);
			$lokasi_file 	= $_FILES['fupload']['tmp_name'];
			$nama_file   	= $_FILES['fupload']['name'];
			$tipe_file   	= $_FILES['fupload']['type'];
			$ukuran   		= $_FILES['fupload']['size'];
			$tipe_file2   	= seo2($tipe_file);
			//$seojdul        = seo($jdl2);
			$acak           = rand(00,99);
			$nama_file_unik = "admin-".$acak.".".$tipe_file2;
			
			$username = $_POST['username'];
			$nama_lengkap_seo= seo($_POST["nama_lengkap"]);
			
			if($_POST['password_lama']!=$_POST['password']){
				$pass     = md5($_POST['password']);
			}else{
				$pass     = $_POST['password_lama'];
			}
			
			if(!empty($nama_file)){
				$gbr = $imgname1."-".$nama_file_unik;
				try{
					$sql = "UPDATE admin   
							SET nama_lengkap 	= :nama_lengkap,
								nama_lengkap_seo= :nama_lengkap_seo,
								email 			= :email,
								no_telp 		= :no_telp,
								username 		= :username,
								password 		= :password,
								level 			= :level,
								status 			= :status,
								gambar 			= :gambar,
								deskripsi		= :deskripsi
							WHERE id 			= :id
						  ";
						  
					$statement = $pdo->prepare($sql);
					$statement->bindParam(":nama_lengkap", $_POST["nama_lengkap"], PDO::PARAM_STR);
					$statement->bindParam(":nama_lengkap_seo", $nama_lengkap_seo, PDO::PARAM_STR);
					$statement->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
					$statement->bindParam(":no_telp", $_POST["no_telp"], PDO::PARAM_STR);
					$statement->bindParam(":username", $username, PDO::PARAM_STR);
					$statement->bindParam(":password", $pass, PDO::PARAM_STR);
					$statement->bindParam(":level", $_POST["level"], PDO::PARAM_STR);
					$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
					$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
					$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
					$statement->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
					$count = $statement->execute();
					
					UploadAdmin($nama_file_unik);
					unlink("../../../images/admin/$nama_file_unik");
					
					echo "<script>alert('Data Admin berhasil diedit'); window.location = '../../media.php?module=admin&act=edit&id=$_POST[id]'</script>";
				}catch(PDOException $e){
					echo "<script>window.alert('Admin Gagal ditambah!'); window.location(history.back(-1))</script>";
				}
			}else{
				try{
					$sql = "UPDATE admin   
							SET nama_lengkap 	= :nama_lengkap,
								nama_lengkap_seo= :nama_lengkap_seo,
								email 			= :email,
								no_telp 		= :no_telp,
								username 		= :username,
								password 		= :password,
								level 			= :level,
								status 			= :status,
								deskripsi		= :deskripsi
							WHERE id 			= :id
						  ";
						  
					$statement = $pdo->prepare($sql);
					$statement->bindParam(":nama_lengkap", $_POST["nama_lengkap"], PDO::PARAM_STR);
					$statement->bindParam(":nama_lengkap_seo", $nama_lengkap_seo, PDO::PARAM_STR);
					$statement->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
					$statement->bindParam(":no_telp", $_POST["no_telp"], PDO::PARAM_STR);
					$statement->bindParam(":username", $username, PDO::PARAM_STR);
					$statement->bindParam(":password", $pass, PDO::PARAM_STR);
					$statement->bindParam(":level", $_POST["level"], PDO::PARAM_STR);
					$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
					$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
					$statement->bindParam(":id", $_POST["id"], PDO::PARAM_INT);
					$count = $statement->execute();
					
					echo "<script>alert('Data Admin berhasil diedit'); window.location = '../../media.php?module=admin&act=edit&id=$_POST[id]'</script>";
				}catch(PDOException $e){
					echo "<script>window.alert('Admin Gagal ditambah!'); window.location(history.back(-1))</script>";
				}
			}
		}
	}
	
	
	elseif ($module==$module2 AND $act=='add'){
		$edit = $pdo->query("SELECT username FROM admin WHERE username='$_POST[username]'");
		$ketemu = $edit->rowCount();
		if($ketemu>=1){
			echo "<script>alert('Admin dengan Username : $_POST[username] sudah terdaftar, pilih username lainnya.'); window.location(history.back(-1))</script>";
		}elseif($_POST["password"]==""){
			echo "<script>alert('Password tidak boleh Kosong.'); window.location(history.back(-1))</script>";
		}else{
			//$jdl2 = substr($_POST["judul"],0,80);
			$lokasi_file 	= $_FILES['fupload']['tmp_name'];
			$nama_file   	= $_FILES['fupload']['name'];
			$tipe_file   	= $_FILES['fupload']['type'];
			$ukuran   		= $_FILES['fupload']['size'];
			$tipe_file2   	= seo2($tipe_file);
			//$seojdul        = seo($jdl2);
			$acak           = rand(00,99);
			$nama_file_unik = "admin-".$acak.".".$tipe_file2;
			
			$password = md5($_POST["password"]);
			$nama_lengkap_seo= seo($_POST["nama_lengkap"]);
			
			if(empty($nama_file)){
				try{
					$stmt = $pdo->prepare("INSERT INTO admin
									(username,password,nama_lengkap,nama_lengkap_seo,email,no_telp,level,status,deskripsi)
									VALUES(:username,:password,:nama_lengkap,:nama_lengkap_seo,:email,:no_telp,:level,:status,:deskripsi)" );
						
					$stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
					$stmt->bindParam(":password", $password, PDO::PARAM_INT);
					$stmt->bindParam(":nama_lengkap", $_POST["nama_lengkap"], PDO::PARAM_STR);
					$stmt->bindParam(":nama_lengkap_seo", $_POST["nama_lengkap_seo"], PDO::PARAM_STR);
					$stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
					$stmt->bindParam(":no_telp", $_POST["no_telp"], PDO::PARAM_STR);
					$stmt->bindParam(":level", $_POST["level"], PDO::PARAM_STR);
					$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
					$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
					$count = $stmt->execute();				
					$insertId = $pdo->lastInsertId();
				
					echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
					
				}catch(PDOException $e){
					echo "<script>window.alert('Admin Gagal ditambah!'); window.location(history.back(-1))</script>";
				}
			}else{
				$gbr = $imgname1."-".$nama_file_unik;
				try{
					$stmt = $pdo->prepare("INSERT INTO admin
									(username,password,gambar,nama_lengkap,nama_lengkap_seo,email,no_telp,level,status,deskripsi)
									VALUES(:username,:password,:gambar,:nama_lengkap,:nama_lengkap_seo,:email,:no_telp,:level,:status,:deskripsi)" );
						
					$stmt->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
					$stmt->bindParam(":password", $password, PDO::PARAM_INT);					
					$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);
					$stmt->bindParam(":nama_lengkap", $_POST["nama_lengkap"], PDO::PARAM_STR);
					$stmt->bindParam(":nama_lengkap_seo", $_POST["nama_lengkap_seo"], PDO::PARAM_STR);
					$stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
					$stmt->bindParam(":no_telp", $_POST["no_telp"], PDO::PARAM_STR);
					$stmt->bindParam(":level", $_POST["level"], PDO::PARAM_STR);
					$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
					$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
					$count = $stmt->execute();
					$insertId = $pdo->lastInsertId();
					
					UploadAdmin($nama_file_unik);
					unlink("../../../images/admin/$nama_file_unik");
				
					echo "<script>window.location = '../../$module2-edit-$insertId'</script>";
					
				}catch(PDOException $e){
					//echo 'Connection failed: ' . $e->getMessage();
					echo "<script>window.alert('Admin Gagal ditambah!'); window.location(history.back(-1))</script>";
				}
			}
		}
	}
	
	elseif ($module==$module2 AND $act=='remove'){
		$edit = $pdo->query("SELECT gambar,level FROM admin WHERE id='$_GET[id]'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		
		if($rr["level"]!="super admin"){
			unlink("../../../images/admin/$rr[gambar]");
			unlink("../../../images/admin/small/$rr[gambar]");
			
			$del = $pdo->query("DELETE FROM admin WHERE id='$_GET[id]'");
			$del->execute();
		}
		
		//echo "<script>alert('Berita Berhasil dihapus'); window.location = '../../$module2'</script>";
		echo "<script>window.location = '../../$module2'</script>";
	}
}
?>
