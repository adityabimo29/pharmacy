<?php
include('../../../system/koneksi.php');

	$id_menu = $_GET['id_menu'];
	
	if($id_menu==0) { //jika user memilih propinsi jawa barat
		echo "<option value='0'> None</option>";
	}else{
		$tampil = $pdo->query("SELECT id_kategori,judul FROM kategori WHERE id_menu='$id_menu' ORDER BY judul ASC");
		
		$r = $tampil->rowCount();
		if($r != 0){
			echo "<option value='0'> Pilih Kategori!</option>";
			while($a = $tampil->fetch(PDO::FETCH_ASSOC)){
				echo"<option value='$a[id_kategori]'>$a[judul]</option>";
				
			} 
		} else {
			echo "<option value='0'> Tidak Ada Kategori!</option>";
		}
	}
?>