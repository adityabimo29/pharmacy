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
	$module2="produk";
	$hal = "Produk";
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

		if(!empty($lokasi_file)){
			$edit = $pdo->query("SELECT gambar FROM produk WHERE id_produk='$_POST[id_produk]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/produk/$tedit[gambar]");
			unlink("../../../images/produk/small/$tedit[gambar]");
			
			$gbr = $imgname1."-".$nama_file_unik;
			
			try {
				$sql = "UPDATE produk SET
							id_kategori		= :id_kategori,
							id_subkategori	= :id_subkategori,
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							kode_produk 	= :kode_produk,
							harga		 	= :harga,
							deskripsi 		= :deskripsi,
							keyword 		= :keyword,
							description 	= :description,
							gambar 			= :gambar,
							status 			= :status,
							tgl 			= :tgl
						WHERE id_produk 	= :id_produk
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":id_kategori", $_POST["id_kategori"], PDO::PARAM_STR);
				$statement->bindParam(":id_subkategori", $_POST["id_subkategori"], PDO::PARAM_STR);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":kode_produk", $_POST["kode_produk"], PDO::PARAM_STR);
				$statement->bindParam(":harga", $_POST["harga"], PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_produk", $_POST["id_produk"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				UploadProduk($nama_file_unik);
				unlink("../../../images/produk/$nama_file_unik");
			
				echo "<script>window.location = '../../produk-edit-$_POST[id_produk]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('Produk Gagal diedit!'); window.location = '../../produk-edit-$_POST[id_produk]'</script>";
			}
		}else{
			try {
				$sql = "UPDATE produk SET
							id_kategori		= :id_kategori,
							id_subkategori	= :id_subkategori,
							judul 			= :judul,
							judul_seo 		= :judul_seo,
							kode_produk 	= :kode_produk,
							harga 			= :harga,
							deskripsi 		= :deskripsi,
							keyword 		= :keyword,
							description 	= :description,
							status 			= :status,
							tgl 			= :tgl
						WHERE id_produk 		= :id_produk
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":id_kategori", $_POST["id_kategori"], PDO::PARAM_STR);
				$statement->bindParam(":id_subkategori", $_POST["id_subkategori"], PDO::PARAM_STR);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$statement->bindParam(":kode_produk", $_POST["kode_produk"], PDO::PARAM_STR);
				$statement->bindParam(":harga", $_POST["harga"], PDO::PARAM_STR);
				$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$statement->bindParam(":keyword", $_POST["keyword"], PDO::PARAM_STR);
				$statement->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
				$statement->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$statement->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);
				$statement->bindParam(":id_produk", $_POST["id_produk"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../produk-edit-$_POST[id_produk]'</script>";
			}catch(PDOException $e){
				echo "<script>alert('Produk Gagal diedit!'); window.location = '../../produk-edit-$_POST[id_produk]'</script>";
			}
		}
	}
	  
	
	// add modul
	elseif ($module==$module2 AND $act=='add'){
		$jdl2 = trim(substr($_POST["judul"],0,150));
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
		if($_POST['tgl']!=''){$tgl_post = "$thn-$bln-$tgl1 $_POST[time]";}else{ $tgl_post = date('Y-m-d H:i:s');}

		if($_POST["keyword"]==""){ $keyword = ucfirst($_POST["judul"]); }else{ $keyword = $_POST["keyword"]; }
		if($_POST["description"]==""){ $description = ucfirst($_POST["judul"]); }else{ $description = $_POST["description"]; }
		
		if(empty($nama_file)){
			echo "<script>window.alert('Gambar Tidak Boleh Kosong!'); window.location(history.back(-1))</script>";
		}elseif($_POST["id_kategori"]==0){
			echo "<script>window.alert('Pilih Kategori!'); window.location(history.back(-1))</script>";
		}else{
			try{
				$gbr = $imgname1."-".$nama_file_unik;

				$stmt = $pdo->prepare("INSERT INTO produk
				(id_kategori,id_subkategori,judul,judul_seo,kode_produk,harga,deskripsi,status,keyword,description,gambar,tgl)
			VALUES(:id_kategori,:id_subkategori,:judul,:judul_seo,:kode_produk,:harga,:deskripsi,:status,:keyword,:description,:gambar,:tgl )" );
				
				$stmt->bindParam(":id_kategori", $_POST["id_kategori"], PDO::PARAM_STR);
				$stmt->bindParam(":id_subkategori", $_POST["id_subkategori"], PDO::PARAM_INT);
				$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$stmt->bindParam(":judul_seo", $seojdul, PDO::PARAM_STR);
				$stmt->bindParam(":kode_produk", $_POST["kode_produk"], PDO::PARAM_STR);
				$stmt->bindParam(":harga", $_POST["harga"], PDO::PARAM_STR);
				$stmt->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
				$stmt->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
				$stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);
				$stmt->bindParam(":description", $description, PDO::PARAM_STR);
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$stmt->bindParam(":tgl", $tgl_post, PDO::PARAM_STR);			
				$count = $stmt->execute();				
				$insertId = $pdo->lastInsertId();
				
				UploadProduk($nama_file_unik);
				unlink("../../../images/produk/$nama_file_unik");
			
				echo "<script>alert('Produk Berhasil ditambah'); window.location = '../../$module2-edit-$insertId'</script>";				
			}catch(PDOException $e){
				echo "<script>window.alert('Produk Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	
	elseif ($module==$module2 AND $act=='remove'){
		$edit = $pdo->query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'");
		$rr = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/produk/$rr[gambar]");
		unlink("../../../images/produk/small/$rr[gambar]");
		
		$del = $pdo->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
		$del->execute();
		
		echo "<script>alert('Produk Berhasil dihapus'); window.location = '../../$module2'</script>";
	}
	
	
	elseif ($module==$module2 AND $act=='addgallery'){
		if($_POST["judul"]==""){
			$onedata = $pdo->query("SELECT judul FROM produk WHERE id_produk='$_POST[id]'");
			$tonedata = $onedata ->fetch(PDO::FETCH_ASSOC);
			$jdls 	= substr($tonedata["judul"],0,50);

			$acak	= rand(00,99);
			$judul 	= "$jdls $acak";
		}else{
			$judul = $_POST["judul"];
		}

		$jdl2 = substr($judul,0,100);
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($jdl2);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;
		
		if(empty($nama_file)){
			echo "<script>window.alert('Gambar harus di isi!'); window.location(history.back(-1))</script>";
		}else{
			$gbr = $imgname1."-".$nama_file_unik;
			try{
				$stmt = $pdo->prepare("INSERT INTO slideproduk
											(id_produk, judul, gambar)
										VALUES(:id_produk, :judul, :gambar )" );
				
				$stmt->bindParam(":id_produk", $_POST["id"], PDO::PARAM_STR);
				$stmt->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$stmt->bindParam(":gambar", $gbr, PDO::PARAM_STR);			
				$count = $stmt->execute();
				
				UploadSlideproduk($nama_file_unik);
				unlink("../../../images/slideproduk/$nama_file_unik");
			
				echo "<script>window.location = '../../$module2-edit-$_POST[id]-tab-gal'</script>";
				
			}catch(PDOException $e){
				echo "<script>window.alert('Gambar Gagal ditambah!'); window.location(history.back(-1))</script>";
			}
		}
	}
	
	
	elseif ($module==$module2 AND $act=='editgallery'){
		$jdl2 = trim(substr($_POST["judul"],0,140));
		$lokasi_file 	= $_FILES['fupload']['tmp_name'];
		$nama_file   	= $_FILES['fupload']['name'];
		$tipe_file   	= $_FILES['fupload']['type'];
		$ukuran   		= $_FILES['fupload']['size'];
		$tipe_file2   	= seo2($tipe_file);
		$seojdul        = seo($jdl2);
		$acak           = rand(00,99);
		$nama_file_unik = $seojdul."-".$acak.".".$tipe_file2;
		
		if (!empty($lokasi_file)){
			$edit = $pdo->query("SELECT gambar FROM slideproduk WHERE id_slideproduk='$_POST[id_slideproduk]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/slideproduk/$imgname1-$tedit[gambar]");
			unlink("../../../images/slideproduk/small/$imgname2-$tedit[gambar]");
			
			$gbr = $imgname1."-".$nama_file_unik;
			
			try {
				$sql = "UPDATE slideproduk   
						SET judul 			= :judul,
							gambar 			= :gambar
						WHERE id_slideproduk= :id_slideproduk
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":gambar", $gbr, PDO::PARAM_STR);
				$statement->bindParam(":id_slideproduk", $_POST["id_slideproduk"], PDO::PARAM_INT);
				$count = $statement->execute();
				
				UploadSlideproduk($nama_file_unik);
				unlink("../../../images/slideproduk/$nama_file_unik");
			
				echo "<script>window.location = '../../produk-edit-$_POST[id_produk]-tab-gal'</script>";
			}catch(PDOException $e){
				echo "<script>alert('Gambar Gagal diedit!'); window.location = '../../produk-editgallery-$_POST[id_slideproduk]'</script>";
			}
		}else{
			try {
				$sql = "UPDATE slideproduk   
						SET judul 			= :judul
						WHERE id_slideproduk= :id_slideproduk
					  ";
					  
				$statement = $pdo->prepare($sql);
				$statement->bindParam(":judul", $jdl2, PDO::PARAM_STR);
				$statement->bindParam(":id_slideproduk", $_POST["id_slideproduk"], PDO::PARAM_INT);
				$count = $statement->execute();
			
				echo "<script>window.location = '../../produk-edit-$_POST[id_produk]-tab-gal'</script>";
			}catch(PDOException $e){
				echo "<script>alert('Gallery Gagal diedit!'); window.location = '../../produk-editgallery-$_POST[id_slideproduk]'</script>";
			}
		}
	}
	
	
	elseif ($module==$module2 AND $act=='removegallery'){
		$edit = $pdo->query("SELECT id_slideproduk, id_produk, gambar FROM slideproduk WHERE id_slideproduk='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		unlink("../../../images/slideproduk/$tedit[gambar]");
		unlink("../../../images/slideproduk/small/$tedit[gambar]");
			
		$stmt = $pdo->prepare("DELETE FROM slideproduk WHERE id_slideproduk=:id_slideproduk");
		$stmt->bindValue(':id_slideproduk', $_GET["id"], PDO::PARAM_INT);
		$stmt->execute();
		
		header('location:../../'.$module2.'-edit-'.$tedit['id_produk'].'-tab-gal');
	}
	
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>