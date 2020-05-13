	<?php
	include "../../../system/koneksi.php";
	if(empty($_GET['act'])){}elseif($_GET['act']=='save'){
		//'Text','Textarea','Judul & Text','Judul & Textarea','Text Images','Textarea Images','Images'
		
		if(($_POST['jenis_modul']=='Images')OR($_POST['jenis_modul']=='Text Images')OR($_POST['jenis_modul']=='Textarea Images')){			
			$lokasi_file 	= $_FILES['fupload']['tmp_name'];
			$nama_file   	= $_FILES['fupload']['name'];
			$acak           = rand(00,99);
			$nama_file_unik = $acak.$nama_file;
			
			
			$edit = $pdo->query("SELECT gambar FROM modul WHERE id_modul='$_POST[id_modul]'");
			$tedit = $edit->fetch(PDO::FETCH_ASSOC);
			unlink("../../../images/$tedit[gambar]");
			
			if (empty($lokasi_file)){ $gambar=$_POST['gambar']; }else{ Uploadmodul($nama_file_unik); $gambar=$nama_file_unik; }
		}
		
		$nama_seo     	= seo(trim($_POST['nama']));

		try {
			$sql = "UPDATE modul   
					SET nama 			= :nama,
						deskripsi 		= :deskripsi,
						gambar 			= :gambar,
						tgl_update 		= NOW()
					WHERE id_modul 		= :id_modul
				  ";
				  
			$statement = $pdo->prepare($sql);
			$statement->bindParam(":nama", $_POST["nama"], PDO::PARAM_STR);
			$statement->bindParam(":deskripsi", $_POST["deskripsi"], PDO::PARAM_STR);
			$statement->bindParam(":gambar", $gambar, PDO::PARAM_STR);
			$statement->bindParam(":id_modul", $_POST["id_modul"], PDO::PARAM_INT);
			$count = $statement->execute();
			
			echo "<script>alert('Modul berhasil di Update'); window.location = '../../media.php?module=$module&act=edit&id=$_POST[id_modul]'</script>";
		}catch(PDOException $e){
			echo 'Updated failed!';
			echo 'Error: ' . $e->getMessage();
			
			$this->pdo->rollback();
			
			return false;
		}
		
	}elseif($_GET['act']=='list'){
		if(empty($_GET['tabel'])){
			$tabel = "modul";
		}elseif($_GET['act']=='list'){
			$tabel = $_GET['tabel'];
		}
	?>
		<table border="1">
		<tr>
			<th>Field</th>
			<th>Type</th>
			<th>Null</th>
			<th>Key</th>
			<th>Default</th>
			<th>Extra</th>
			<th colspan="2">Aksi</th>
		</tr>
		<?php
		$tampil = $pdo->query("SHOW COLUMNS FROM 18_02_8_prambananvillagetour.$tabel");
		while($r = $tampil->fetch(PDO::FETCH_ASSOC)){  
		?>
			<tr>
				<td><?php echo  $r['Field']; ?></td>
				<td><?php echo  $r['Type']; ?></td>
				<td><?php echo  $r['Null']; ?></td>
				<td><?php echo  $r['Key']; ?></td>
				<td><?php echo  $r['Default']; ?></td>
				<td><?php echo  $r['Extra']; ?></td>
				<td align="center">
					<a href="?act=edit&tabel=modul&field=<?php echo  $r['Field']; ?>" class="btn btn-success btnadmin2" role="button" aria-pressed="true" style="min-width: 70px;margin-bottom: 5px;">Edit</a>
				</td>
				<td align="center">
					<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/modul/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_modul']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 70px;margin-bottom: 5px;">Delete</a>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
			
	<?php
	}elseif($_GET['act']=='edit'){
	?>
	<form role="form" action="modul/modul/aksi.php?module=modul&act=update" method="POST" enctype="multipart/form-data" >
	<label for="exampleInputEmail1">Field : <?php echo $_GET['field']; ?></label>
	<input name="nama" type="text" class="form-control" style="width: 100%">
	<button type="submit" class="btn btn-primary">Update</button>
	<input type="button" class="btn btn-success" value="Kembali" onclick="location.href='?act=list&tabel=modul&Field=id_modul'">
	</form>
			
	<?php
	}elseif(empty($_GET['act'])){
	}
	?>