<?php
session_start();
//error_reporting(0);
require_once('../../../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";
	include "../../../system/fungsi_all.php";
	include "../../../system/z_setting.php";

	$module=$_GET["module"];
	$module2="penjualan";
	$hal = "penjualan";
	$act=$_GET["act"];
	
	// Update modul
	if ($module==$module2 AND $act=='update'){

		try {
			$sql = "UPDATE obat SET
						kode_obat 					= :kode_obat,
						nama_obat 					= :nama_obat,
						kode_distributor 			= :kode_distributor
					WHERE id_obat 	= :id_obat
				  ";
				  
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":kode_obat", $_POST["kode_obat"], PDO::PARAM_STR);
			$stmt->bindParam(":nama_obat", $_POST["nama_obat"], PDO::PARAM_STR);
			$stmt->bindParam(":kode_distributor", $_POST["kode_distributor"], PDO::PARAM_STR);
			$stmt->bindParam(":id_obat", $_POST["id_obat"], PDO::PARAM_INT);
			$count = $stmt->execute();
		
			echo "<script>alert('Data Telah diupdate');window.location = '../../obat-edit-$_POST[id_obat]'</script>";
		}catch(PDOException $e){
			echo "<script>alert('$hal Gagal diedit!'); window.location = '../../obat-edit-$_POST[id_obat]'</script>";
		}
	}

	elseif ($module==$module2 AND $act=='save'){
		
		try{

			// Cek Apakah Stok Tersedia
			foreach($_SESSION['penjualan'] as $row){

			$qk = $row['kode_obat'];
			$old_stok = $pdo->query("SELECT stok FROM obat WHERE kode_obat ='$qk' ")->fetch();
				if( $row['qty'] > $old_stok['stok']){
					echo "<script>alert('Stok tidak mencukupi');window.location = '../../$module2'</script></script>";
				}
			}

			$tgl 	= explode("/", $_POST['tanggal']);
			$tgl1=$tgl[0];
			$bln=$tgl[1];
			$thn=$tgl[2];
			
			date_default_timezone_set('Asia/Jakarta');
			$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['tanggal'])));
			$tgl_post = "$thn-$bln-$tgl1";
			$total_biaya = $_POST['total_biaya'] + $_POST['biaya_racik'] + $_POST['biaya_resep'];
	
				$stmt = $pdo->prepare("INSERT INTO penjualan
									(tanggal,nama_pelanggan,dokter,asal_rs,biaya_racik,biaya_resep,total_biaya,total_obat,id_admin,resep)
									VALUES(:tanggal,:nama_pelanggan,:dokter,:asal_rs,:biaya_racik,:biaya_resep,:total_biaya,:total_obat,:id_admin,:resep)" );
			
			$stmt->bindParam(":tanggal", $date, PDO::PARAM_STR);
			$stmt->bindParam(":nama_pelanggan", $_POST["nama_pelanggan"], PDO::PARAM_STR);
			$stmt->bindParam(":dokter", $_POST["dokter"], PDO::PARAM_STR);
			$stmt->bindParam(":asal_rs", $_POST["asal_rs"], PDO::PARAM_STR);
			$stmt->bindParam(":biaya_racik", $_POST["biaya_racik"], PDO::PARAM_INT);
			$stmt->bindParam(":biaya_resep", $_POST["biaya_resep"], PDO::PARAM_INT);
			$stmt->bindParam(":total_biaya", $total_biaya, PDO::PARAM_INT);
			$stmt->bindParam(":total_obat", $_POST["total_obat"], PDO::PARAM_INT);
			$stmt->bindParam(":id_admin", $_SESSION['idadmin'], PDO::PARAM_INT);
			$stmt->bindParam(":resep", $_POST["resep"], PDO::PARAM_STR);

			$count = $stmt->execute();				
			$insertId = $pdo->lastInsertId();


			// masukkan ke detail
			$_SESSION['print_penjualan'] = array();   
			
			foreach($_SESSION['penjualan'] as $row){
				$stmt = $pdo->prepare("INSERT INTO detail_penjualan
									(id_penjualan,kode_obat,jumlah,sub_total)
									VALUES(:id_penjualan,:kode_obat,:jumlah,:sub_total)" );

			$sub_total = $row['qty'] * $row['harga'];
			$_SESSION['print_penjualan'][] = array(
				'kode_obat'=>$row['kode_obat'],
				'nama_obat'=>$row['nama_obat'],
                'qty'=>$row['qty'],
                'sub_total'=>$sub_total
		   );

			$stmt->bindParam(":id_penjualan", $insertId, PDO::PARAM_INT);
			$stmt->bindParam(":kode_obat", $row['kode_obat'], PDO::PARAM_STR);
			$stmt->bindParam(":jumlah", $row['qty'], PDO::PARAM_INT);
			$stmt->bindParam(":sub_total", $sub_total, PDO::PARAM_INT);

			$count = $stmt->execute();


			// update stok
			$qk = $row['kode_obat'];
			$old_stok = $pdo->query("SELECT stok FROM obat WHERE kode_obat ='$qk' ")->fetch();
			
			$sql = "UPDATE obat SET
						stok			= :stok
					WHERE kode_obat 	= :kode_obat
				  ";
				  
			$stmt2 = $pdo->prepare($sql);
			$total_stok = $old_stok['stok'] - $row['qty'];
			$stmt2->bindParam(":stok", $total_stok, PDO::PARAM_INT);
			$stmt2->bindParam(":kode_obat", $row['kode_obat'], PDO::PARAM_STR);
			
			$count = $stmt2->execute();

			
			}
			unset($_SESSION['penjualan']);

			echo "<script>alert('Data Berhasil ditambah');window.location = '../../$module2-print'</script></script>";
		   
		
			
		}catch(PDOException $e){
			echo "$e";
		}
	}
	  
	
	elseif ($module==$module2 AND $act=='add'){
		
		try{
			// $distri = $_POST['kode_distributor'];
			// $kd_obat = $_POST['kode_obat'];
			// $query = $pdo->prepare( "SELECT id_obat FROM obat WHERE kode_distributor = ? AND kode_obat = ? " );
			// $query->bindValue( 1, $distri );
			// $query->bindValue( 2, $kd_obat );
			// $query->execute();
			// $tgl 	= explode("/", $_POST['tanggal']);
			// $tgl1=$tgl[0];
			// $bln=$tgl[1];
			// $thn=$tgl[2];
			
			// date_default_timezone_set('Asia/Jakarta');
			// $date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['tanggal'])));
			// $tgl_post = "$thn-$bln-$tgl1";

		// 	if( $query->rowCount() > 0 ) { 
		// 		$stmt = $pdo->prepare("INSERT INTO penjualan
		// 							(tanggal,kode_distributor,kode_obat,no_batch,qty,expired,harga_beli,harga_diskon,harga_jual,id_admin)
		// 							VALUES(:tanggal,:kode_distributor,:kode_obat,:no_batch,:qty,:expired,:harga_beli,:harga_diskon,:harga_jual,:id_admin)" );
			
		// 	$stmt->bindParam(":tanggal", $date, PDO::PARAM_STR);
		// 	$stmt->bindParam(":kode_distributor", $_POST["kode_distributor"], PDO::PARAM_STR);
		// 	$stmt->bindParam(":kode_obat", $_POST["kode_obat"], PDO::PARAM_STR);
		// 	$stmt->bindParam(":no_batch", $_POST["no_batch"], PDO::PARAM_INT);
		// 	$stmt->bindParam(":qty", $_POST["qty"], PDO::PARAM_INT);
		// 	$stmt->bindParam(":expired", $_POST["expired"], PDO::PARAM_STR);
		// 	$stmt->bindParam(":harga_beli", $_POST["harga_beli"], PDO::PARAM_INT);
		// 	$stmt->bindParam(":harga_diskon", $_POST["harga_diskon"], PDO::PARAM_INT);
		// 	$stmt->bindParam(":harga_jual", $_POST["harga_jual"], PDO::PARAM_INT);
		// 	$stmt->bindParam(":id_admin", $_POST["id_admin"], PDO::PARAM_INT);

		// 	$count = $stmt->execute();				
		// 	$insertId = $pdo->lastInsertId();
		
		// 	echo "<script>alert('Data Berhasil ditambah');window.location = '../../$module2-edit-$insertId'</script>";
		//    }
		//    else {
		// 	echo "<script>alert('Kode Distributor atau Kode Obat tidak ditemukan');window.location = '../../$module2-add'</script>";
		//    }
		$kd_obat = $_POST['kode_obat'];
		$kd_distributor = $pdo->query("SELECT kode_distributor,nama_obat from obat WHERE kode_obat = '$kd_obat' ")->fetch();
		if(isset($_SESSION['penjualan'])){
			$_SESSION['penjualan'][] = array(
					'kode_obat'=>$_POST['kode_obat'],
					'nama_obat' =>$kd_distributor['nama_obat'],
					'no_batch'=>$_POST['no_batch'],
					'qty'=>$_POST['qty'],
					'expired'=>$_POST['expired'],
					'harga_beli'=>$_POST['harga_beli'],
					'harga_diskon'=>$_POST['harga_diskon'],
					'harga_jual'=>$_POST['harga_jual'],
					'kode_distributor'=>$kd_distributor['kode_distributor']
				);

		}else{
			$_SESSION['penjualan'] = array();
			$_SESSION['penjualan'][] = array(
				'kode_obat'=>$_POST['kode_obat'],
				'nama_obat' =>$kd_distributor['nama_obat'],
			   'no_batch'=>$_POST['no_batch'],
			   'qty'=>$_POST['qty'],
			   'expired'=>$_POST['expired'],
			   'harga_beli'=>$_POST['harga_beli'],
			   'harga_diskon'=>$_POST['harga_diskon'],
			   'harga_jual'=>$_POST['harga_jual'],
			   'kode_distributor'=>$kd_distributor['kode_distributor']
		   );
		}
		echo "<script>window.location = '../../$module2'</script>";	
			
		}catch(PDOException $e){
			echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
		}
	}

	elseif ($module==$module2 AND $act=='updateBarang'){
		
		try{


			$_SESSION['penjualan'][$_POST['kodeku']] = array(
					'kode_obat'=>$_POST['kode_obat'],
					'nama_obat' =>$_POST['nama_obat'],
					'no_batch'=>$_POST['no_batch'],
					'qty'=>$_POST['qty'],
					'expired'=>$_POST['expired'],
					'harga_beli'=>$_POST['harga_beli'],
					'harga_diskon'=>$_POST['harga_diskon'],
					'harga_jual'=>$_POST['harga_jual'],
					'kode_distributor'=>$_POST['kode_distributor']
				);


		echo "<script>window.location = '../../$module2'</script>";	
			
		}catch(PDOException $e){
			echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
		}
	}

	elseif ($module==$module2 AND $act=='import'){
		$allowedFileType = [
			'application/vnd.ms-excel',
			'text/xls',
			'text/xlsx',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'application/octet-stream'
		];
		
		if (in_array($_FILES["file"]["type"], $allowedFileType)) {

			$targetPath = 'uploads/' . $_FILES['file']['name'];
			move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
	
			$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	
			$spreadSheet = $Reader->load($targetPath);
			$excelSheet = $spreadSheet->getActiveSheet();
			$spreadSheetAry = $excelSheet->toArray();
			$sheetCount = count($spreadSheetAry);
	
			for ($i = 0; $i <= $sheetCount; $i ++) {
				$kode = "";
				if (isset($spreadSheetAry[$i][1])) {
					$kode = $spreadSheetAry[$i][1];
				}
				$nama = "";
				if (isset($spreadSheetAry[$i][2])) {
					$nama = $spreadSheetAry[$i][2];
				}
				$kode_distributor = "";
				if (isset($spreadSheetAry[$i][3])) {
					$kode_distributor = $spreadSheetAry[$i][3];
				}
	
				if (! empty($nama) || ! empty($kode)) {

					$stmt = $pdo->prepare("INSERT INTO obat
									(kode_obat,nama_obat,kode_distributor)
									VALUES(:kode_obat,:nama_obat,:kode_distributor)" );
			
					$stmt->bindParam(":kode_obat", $kode, PDO::PARAM_STR);
					$stmt->bindParam(":nama_obat", $nama, PDO::PARAM_STR);
					$stmt->bindParam(":kode_distributor", $kode_distributor, PDO::PARAM_STR);
					

					$count = $stmt->execute();	
					$insertId = $pdo->lastInsertId();
					$filenya = $_FILES["file"]["name"];
					unlink("uploads/$filenya");
					if (! empty($insertId)) {
						$type = "success";
						$message = "Excel Data Imported into the Database";
					} else {
						$type = "error";
						$message = "Problem in Importing Excel Data";
					}
				}
			}
		} else {
			$type = "error";
			$message = "Invalid File Type. Upload Excel File.";
		}
		
		echo "<script>window.alert('$message');window.location = '../../$module2'</script>";
	}

	elseif ($module==$module2 AND $act=='hapusBarang'){

		$kd=$_GET['kd'];

		unset($_SESSION['penjualan'][$kd]);
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	elseif ($module==$module2 AND $act=='remove'){

		$del = $pdo->query("DELETE FROM penjualan WHERE id_penjualan='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>