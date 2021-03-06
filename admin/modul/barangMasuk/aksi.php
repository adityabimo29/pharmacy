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
	$module2="pembelian";
	$hal = "pembelian";
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
			// $distri = $_POST['kode_distributor'];
			// $kd_obat = $_POST['kode_obat'];
			// $query = $pdo->prepare( "SELECT id_obat FROM obat WHERE kode_distributor = ? AND kode_obat = ? " );
			// $query->bindValue( 1, $distri );
			// $query->bindValue( 2, $kd_obat );
			// $query->execute();
			$tgl 	= explode("/", $_POST['tanggal']);
			$tgl1=$tgl[0];
			$bln=$tgl[1];
			$thn=$tgl[2];
			
			date_default_timezone_set('Asia/Jakarta');
			$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['tanggal'])));
			$tgl_post = "$thn-$bln-$tgl1";

	
				$stmt = $pdo->prepare("INSERT INTO pembelian
									(tanggal,kode_distributor,total_barang,total_harga,id_admin)
									VALUES(:tanggal,:kode_distributor,:total_barang,:total_harga,:id_admin)" );
			
			$stmt->bindParam(":tanggal", $date, PDO::PARAM_STR);
			$stmt->bindParam(":kode_distributor", $_POST["kode_distributor"], PDO::PARAM_STR);
			$stmt->bindParam(":total_barang", $_POST["total_barang"], PDO::PARAM_INT);
			$stmt->bindParam(":total_harga", $_POST["total_harga"], PDO::PARAM_INT);
			$stmt->bindParam(":id_admin", $_SESSION['idadmin'], PDO::PARAM_INT);

			$count = $stmt->execute();				
			$insertId = $pdo->lastInsertId();


			// masukkan ke detail
			foreach($_SESSION['pembelian'] as $row){
				$stmt = $pdo->prepare("INSERT INTO detail_pembelian
									(id_pembelian,kode_obat,no_batch,qty,expired,harga_beli,harga_diskon,harga_jual)
									VALUES(:id_pembelian,:kode_obat,:no_batch,:qty,:expired,:harga_beli,:harga_diskon,:harga_jual)" );

			$diskon = str_replace(".","",$row['harga_diskon']);
			$beli = str_replace(".","",$row['harga_beli']);
			$jual = str_replace(".","",$row['harga_jual']);

			$stmt->bindParam(":id_pembelian", $insertId, PDO::PARAM_INT);
			$stmt->bindParam(":kode_obat", $row['kode_obat'], PDO::PARAM_STR);
			$stmt->bindParam(":no_batch", $row['no_batch'], PDO::PARAM_STR);
			$stmt->bindParam(":qty", $row['qty'], PDO::PARAM_INT);
			$stmt->bindParam(":expired", $row['expired'], PDO::PARAM_STR);
			$stmt->bindParam(":harga_beli", $beli, PDO::PARAM_INT);
			$stmt->bindParam(":harga_diskon", $diskon, PDO::PARAM_INT);
			$stmt->bindParam(":harga_jual", $jual, PDO::PARAM_INT);

			$count = $stmt->execute();


			// update stok
			$qk = $row['kode_obat'];
			$old_stok = $pdo->query("SELECT stok FROM obat WHERE kode_obat ='$qk' ")->fetch();
			
			$sql = "UPDATE obat SET
						stok			= :stok
					WHERE kode_obat 	= :kode_obat
				  ";
				  
			$stmt2 = $pdo->prepare($sql);
			$total_stok = $old_stok['stok'] + $row['qty'];
			$stmt2->bindParam(":stok", $total_stok, PDO::PARAM_INT);
			$stmt2->bindParam(":kode_obat", $row['kode_obat'], PDO::PARAM_STR);
			
			$count = $stmt2->execute();

			// make to pdf
			$kk = $_POST["kode_distributor"];
			$tangg = $_POST['tanggal'];
			$dist = $pdo->query("SELECT nama,npwp,alamat FROM distributor WHERE kode_distributor ='$kk' ")->fetch();
			$mpdf = new \Mpdf\Mpdf();
			// Buffer the following html with PHP so we can store it to a variable later
			ob_start();
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			// This is where your script would normally output the HTML using echo or print
			echo "<style>
					table {
					font-family: arial, sans-serif;
					border-collapse: collapse;
					width: 100%;
					}
					
					td, th {
					border: 1px solid #000;
					text-align: left;
					padding: 8px;
					}

					
					hr {
					border:0;
					border-top: 3px double #000;

					}
					.bct{
						text-decoration-line: underline;
  						text-decoration-style: double;
					}
					
				</style>
				<script>
				</script>
				<p>Pembeli</p>
				<p>Nama   : ".$deskrip[12]."</p>
				<p>Alamat : ".$deskrip[2]. " Telp. ".$deskrip[6] ."</p>
				<p class='bct'>NPWP   : ".$deskrip[11]."</p>
				=============================================================
				<h3 class='bct' style='text-align:center'>FAKTUR PEMBELIAN</h3>
				=============================================================
				<p>Distributor</p>
				<p>Nama   : ".$dist['nama']."</p>
				<p>Alamat : ".$dist['alamat']."</p>
				<p>NPWP   : ".$dist['npwp']."</p>
				=============================================================
				<h4 style='text-align:center'>Faktur Pajak dari PKP</h4>
				<p>No.Faktur : ".$insertId."</p>
				<p>Tanggal   : ".$tangg."</p>
				=============================================================
				<table>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Qty</th>
						<th>H.Satuan</th>
						<th>Nominal</th>
					</tr>";
					$no=1;
					$potongan = 0;
					foreach($_SESSION['pembelian'] as $r){
					$beli =	str_replace(".","",$r['harga_beli']);
					echo "
						<tr>
							<td>".$no."</td>
							<td>".$r['kode_obat']."</td>
							<td>".$r['nama_obat']."</td>
							<td>".$r['qty']."</td>
							<td>".$r['harga_beli']."</td>
							<td>".$beli * $r['qty']."</td>
						</tr>";
						$no++;
						$diskon = str_replace(".","",$r['harga_diskon']);
						$potongan +=  $diskon * $r['qty'];

					}
				echo "</table>";
				$netto = $_POST['total_harga'] - $potongan;
				$dpp = 0.9 * $netto;
				$ppn = $dpp/10;
				echo "<p style='text-align:right'>JUMLAH UANG : ".$_POST["total_harga"]."</p>";
				echo "<p style='text-align:right'>POTONGAN HARGA : ".$potongan."</p>";
				echo "<p style='text-align:right'>NETTO : ".$netto."</p>";
				echo "<p style='text-align:right'>DPP : ".$dpp."</p>";
				echo "<p style='text-align:right'>PPN 10% : ".$ppn."</p>";
			// Now collect the output buffer into a variable
			$html = ob_get_contents();
			ob_end_clean();
			// $mpdf->WriteHTML($html);
			// $mpdf->Output();
			$_SESSION['PRINT_PEMBELIAN'] = $html;
			}
			unset($_SESSION['pembelian']);
			// echo "<script>if (confirm('Are you sure you want to save this thing into the database?')) {
			// 	// Save it!
			// 	window.open();
			//   } else {
			// 	// Do nothing!
			// 	alert('Data Berhasil ditambah');window.location = '../../$module2'</script>
			//   }";
			echo "<script>window.location = '../../$module2-print'</script></script>";
		   
		
			
		}catch(PDOException $e){
			echo "$e";
		}
	}

	elseif ($module==$module2 AND $act=='printPembelian'){
		
		try{
			$mpdf = new \Mpdf\Mpdf();
			$html = $_SESSION['PRINT_PEMBELIAN'];
			unset($_SESSION['PRINT_PEMBELIAN']);
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			//$mpdf->Output('Faktur_Pembelian.pdf',\Mpdf\Output\Destination::DOWNLOAD);
			

		echo "<script>window.location = '../../$module2'</script>";	
			
		}catch(PDOException $e){
			echo "<script>window.alert('$hal Gagal ditambah!'); window.location(history.back(-1))</script>";
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
		// 		$stmt = $pdo->prepare("INSERT INTO pembelian
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
		if($_POST['harga_beli'] > $_POST['harga_jual']){
			
		}
		$kd_obat = $_POST['kode_obat'];
		$kd_distributor = $pdo->query("SELECT kode_distributor,nama_obat from obat WHERE kode_obat = '$kd_obat' ")->fetch();
		if(isset($_SESSION['pembelian'])){
			$_SESSION['pembelian'][] = array(
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
			$_SESSION['pembelian'] = array();
			$_SESSION['pembelian'][] = array(
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


			$_SESSION['pembelian'][$_POST['kodeku']] = array(
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

		unset($_SESSION['pembelian'][$kd]);
		
		echo "<script>window.location = '../../$module2'</script>";
	}
	
	elseif ($module==$module2 AND $act=='remove'){

		$del = $pdo->query("DELETE FROM pembelian WHERE id_pembelian='$_GET[id]'");
		$del->execute();
		
		echo "<script>window.location = '../../$module2'</script>";
	}
}
?>
<center style="margin-top: 250px;"><img src="../../load.gif"></center>