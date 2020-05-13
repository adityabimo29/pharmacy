<?php
include "../../../system/koneksi.php";
include "../../../system/fungsi_all.php";
include "../../../system/z_setting.php";
session_start();
$dataTemp = json_decode($_POST['dataTemp']);
$_SESSION['penjualan'] = array();
foreach($dataTemp as $data) {
    
			$_SESSION['penjualan'][] = array(
				'kode_obat'=>$data[0],
				'nama_obat'=>$data[1],
                'qty'=>$data[4],
                'harga'=>$data[5]
		   );
}
	



?>