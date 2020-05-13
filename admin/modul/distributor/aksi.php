<?php
session_start();
//error_reporting(0);
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once('../../../vendor/autoload.php');
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
	$module2="distributor";
	$hal = "distributor";
	$act=$_GET["act"];
	
	// Update modul
	if ($module==$module2 AND $act=='update'){

		try {
			$sql = "UPDATE distributor SET
						kode_distributor 			= :kode_distributor,
						npwp 						= :npwp,
						nama 						= :nama,
						alamat 						= :alamat,				
						no_hp 						= :no_hp
					WHERE id_distributor 	= :id_distributor
				  ";
				  
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":kode_distributor", $_POST["kode_distributor"], PDO::PARAM_STR);
			$stmt->bindParam(":nama", $_POST["nama"], PDO::PARAM_STR);
			$stmt->bindParam(":alamat", $_POST["alamat"], PDO::PARAM_STR);
			$stmt->bindParam(":no_hp", $_POST["no_hp"], PDO::PARAM_STR);	
			$stmt->bindParam(":npwp", $_POST["npwp"], PDO::PARAM_STR);
			$stmt->bindParam(":id_distributor", $_POST["id_distributor"], PDO::PARAM_INT);
			$count = $stmt->execute();
		
			echo "<script>alert('Data Telah diupdate');window.location = '../../distributor-edit-$_POST[id_distributor]'</script>";
		}catch(PDOException $e){
			echo "<script>alert('$hal Gagal diedit!'); window.location = '../../distributor-edit-$_POST[id_distributor]'</script>";
		}
	}
	  
	
	elseif ($module==$module2 AND $act=='add'){
		
		try{
			$stmt = $pdo->prepare("INSERT INTO distributor
									(kode_distributor,nama,npwp,alamat,no_hp)
									VALUES(:kode_distributor,:nama,:npwp,:alamat,:no_hp)" );
			
			$stmt->bindParam(":kode_distributor", $_POST["kode_distributor"], PDO::PARAM_STR);
			$stmt->bindParam(":nama", $_POST["nama"], PDO::PARAM_STR);
			$stmt->bindParam(":alamat", $_POST["alamat"], PDO::PARAM_STR);
			$stmt->bindParam(":no_hp", $_POST["no_hp"], PDO::PARAM_STR);	
			$stmt->bindParam(":npwp", $_POST["npwp"], PDO::PARAM_STR);

			$count = $stmt->execute();				
			$insertId = $pdo->lastInsertId();
		
			echo "<script>alert('Data Berhasil ditambah');window.location = '../../$module2-edit-$insertId'</script>";
			
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
				$nama = "";
				if (isset($spreadSheetAry[$i][1])) {
					$nama = $spreadSheetAry[$i][1];
				}
				$kode = "";
				if (isset($spreadSheetAry[$i][2])) {
					$kode = $spreadSheetAry[$i][2];
				}
				$alamat = "";
				if (isset($spreadSheetAry[$i][3])) {
					$alamat = $spreadSheetAry[$i][3];
				}
				$npwp = "";
				if (isset($spreadSheetAry[$i][4])) {
					$npwp = $spreadSheetAry[$i][4];
				}

				$no_hp = "";
				if (isset($spreadSheetAry[$i][5])) {
					$no_hp = $spreadSheetAry[$i][5];
				}
	
				if (! empty($nama) || ! empty($kode)) {
					try {
						$stmt = $pdo->prepare("INSERT INTO distributor
									(kode_distributor,nama,npwp,alamat,no_hp)
									VALUES(:kode_distributor,:nama,:npwp,:alamat,:no_hp)" );
			
					$stmt->bindParam(":kode_distributor", $kode, PDO::PARAM_STR);
					$stmt->bindParam(":npwp", $npwp, PDO::PARAM_STR);
					$stmt->bindParam(":nama", $nama, PDO::PARAM_STR);
					$stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
					$stmt->bindParam(":no_hp", $no_hp, PDO::PARAM_STR);

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
						echo "<script>window.alert('Data Sudah Ada');window.location = '../../distributor-import'</script>";
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
		$sheet->setCellValue('B1', 'Nama Distributor');
		$sheet->setCellValue('C1', 'Kode Distributor');
		$sheet->setCellValue('D1', 'Alamat');
		$sheet->setCellValue('E1', 'NPWP');
		$sheet->setCellValue('F1', 'No HP');
		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Template Excel Distributor.xlsx"');
		$writer->save("php://output");
		// $writer->save('Template Excel Distributor.xlsx');
		
		echo "<script>window.location = '../../$module2-add'</script>";
	}
	
	elseif ($module==$module2 AND $act=='remove'){

		$del = $pdo->query("DELETE FROM distributor WHERE id_distributor='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>