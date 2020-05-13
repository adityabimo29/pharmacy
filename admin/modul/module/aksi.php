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

	$module=$_GET["module"];
	$module2="module";
	$act=$_GET["act"];
	
	if($module==$module2 AND $act=='update'){
		//'text','textarea','images'
		$jdl2 = substr($_POST["nama"],0,100);
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($jdl2);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;
		
		if (!empty($nama_file)){
			$edit = $pdo->query("SELECT gambar FROM module WHERE id_module='$_POST[id_module]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/module/$tedit[gambar]");

			$gbr = $imgname1."-".$nama_file_unik;

			try {
				$sql= 	"UPDATE module SET
							deskripsi 		= :deskripsi,
							gambar 			= :gambar
						WHERE id_module 	= :id_module
						";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":id_module", $_POST["id_module"], PDO::PARAM_INT);
				$count = $statement->execute();

				UploadAll($nama_file_unik,'module',1200,0); //nama_foto,folder,lebar,tinggi
				unlink("../../../images/$module2/$nama_file_unik");
				unlink("../../../images/$module2/small/$nama_file_unik");
			
				echo "<script>window.location = '../../module-edit-$_POST[id_module]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('Module Gagal diedit!'); window.location = '../../module-edit-$_POST[id_module]'</script>";
			}
		}else{
			try {
				$sql= 	"UPDATE module SET
							deskripsi 		= :deskripsi
						WHERE id_module 	= :id_module
						";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":id_module", $_POST["id_module"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../module-edit-$_POST[id_module]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('Module Gagal diedit!'); window.location = '../../module-edit-$_POST[id_module]'</script>";
			}
		}
	}
}
?>

<center style="margin-top: 250px;"><img src="../../load.gif"></center>