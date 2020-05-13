<?php
include "../../../system/koneksi.php";
include "../../../system/fungsi_all.php";
include "../../../system/z_setting.php";

$id = $_GET['id'];
	
	
		$tampil = $pdo->query("SELECT kode_obat,nama_obat FROM obat WHERE kode_distributor='$id' ");
		
		$r = $tampil->rowCount();
		if($r != 0){
			while($a = $tampil->fetch(PDO::FETCH_ASSOC)){
				echo"<option value='$a[kode_obat]'>$a[nama_obat]</option>";
				
			} 
		} else {
			echo "<option value='0'> Tidak Ada Kode Obat !</option>";
		}
	



?>