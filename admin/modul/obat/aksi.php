<?php
session_start();
//error_reporting(0);
require_once('../../../vendor/autoload.php');
//use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	include "../../../system/koneksi.php";
	include "../../../system/fungsi_all.php";
	include "../../../system/z_setting.php";

	$module=$_GET["module"];
	$module2="obat";
	$hal = "obat";
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
	  
	
	elseif ($module==$module2 AND $act=='add'){
		
		try{
			$distri = $_POST['kode_distributor'];
			$query = $pdo->prepare( "SELECT kode_distributor FROM distributor WHERE kode_distributor = ?" );
			$query->bindValue( 1, $distri );
			$query->execute();
			if( $query->rowCount() > 0 ) { 
				$stmt = $pdo->prepare("INSERT INTO obat
									(kode_obat,nama_obat,kode_distributor)
									VALUES(:kode_obat,:nama_obat,:kode_distributor)" );
			
			$stmt->bindParam(":kode_obat", $_POST["kode_obat"], PDO::PARAM_STR);
			$stmt->bindParam(":nama_obat", $_POST["nama_obat"], PDO::PARAM_STR);
			$stmt->bindParam(":kode_distributor", $_POST["kode_distributor"], PDO::PARAM_STR);

			$count = $stmt->execute();				
			$insertId = $pdo->lastInsertId();
		
			echo "<script>alert('Data Berhasil ditambah');window.location = '../../$module2-edit-$insertId'</script>";
		   }
		   else {
			echo "<script>alert('Kode Distributor tidak ditemukan');window.location = '../../$module2'</script>";
		   }
			
			
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
	
			for ($i = 1; $i <= $sheetCount; $i ++) {
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

				$stok = "";
				if (isset($spreadSheetAry[$i][4])) {
					$stok = $spreadSheetAry[$i][4];
				}
	
				if (! empty($nama) || ! empty($kode)) {

					try {
						$stmt = $pdo->prepare("INSERT INTO obat
									(kode_obat,nama_obat,kode_distributor,stok)
									VALUES(:kode_obat,:nama_obat,:kode_distributor,:stok)" );
			
					$stmt->bindParam(":kode_obat", $kode, PDO::PARAM_STR);
					$stmt->bindParam(":nama_obat", $nama, PDO::PARAM_STR);
					$stmt->bindParam(":kode_distributor", $kode_distributor, PDO::PARAM_STR);
					$stmt->bindParam(":stok", $stok, PDO::PARAM_INT);

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
					} catch (Exception $e) {
						echo "<script>window.alert('Data Sudah Ada');window.location = '../../obat-import'</script>";
					}
				}
			}
		} else {
			$type = "error";
			$message = "Invalid File Type. Upload Excel File.";
		}
		
		echo "<script>window.alert('$message');window.location = '../../$module2'</script>";
	}

	elseif ($module==$module2 AND $act=='template'){
		
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Kode Obat');
		$sheet->setCellValue('C1', 'Nama Obat');
		$sheet->setCellValue('D1', 'Kode Distributor');
		$sheet->setCellValue('E1', 'Stok');
		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Template Excel Obat.xlsx"');
		$writer->save("php://output");
		// $writer->save('Template Excel Distributor.xlsx');
		
		echo "<script>window.location = '../../$module2-add'</script>";
	}
	
	elseif ($module==$module2 AND $act=='remove'){

		$del = $pdo->query("DELETE FROM obat WHERE id_obat='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>