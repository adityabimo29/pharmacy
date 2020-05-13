<?php
include('../../../system/koneksi.php');

	$id = $_GET['id'];
	
	if($id==0) { //jika user memilih propinsi jawa barat
		echo "<option value='0'> None</option>";
	}else{
		$tampil = $pdo->query("SELECT id_subkategori,judul FROM subkategori WHERE id_kategori='$id' ORDER BY judul ASC");
		
		$r = $tampil->rowCount();
		if($r != 0){
			while($a = $tampil->fetch(PDO::FETCH_ASSOC)){
				echo"<option value='$a[id_subkategori]'>$a[judul]</option>";
				
			} 
		} else {
			echo "<option value='0'> Tidak Ada Sub Kategori!</option>";
		}
	}
?>