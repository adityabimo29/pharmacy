	<?php
	include "../../../system/koneksi.php";
	if($_GET['act']=='save'){
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
	?>
			<section class="content">
				<div class="row">
					<div class="col-xs-12">

						<div class="box">
							<button class="btn bg-olive margin" onclick="window.location.href='?module=modul&act=add';">Tambah Halaman</button>
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th width="2%">id</th>
									<th width="23%">Nama Content / Halaman</th>
									<th width="15%">Tanggal Update</th>
									<th width="15%" colspan="2">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$tampil = $pdo->query("SELECT * FROM modul ORDER BY id_modul ASC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){  
								?>
									<tr>
										<td align="center"><?php echo  $r['id_modul']; ?></td>
										<td><?php echo  $r['nama']; ?></td>
										<td><?php echo  $r['tgl_update']; ?></td>
										<td align="center">
											<a href="<?php echo $module; ?>-edit-<?php echo $r['id_modul']; ?>" class="btn btn-success btnadmin2" role="button" aria-pressed="true" style="min-width: 70px;margin-bottom: 5px;">Edit</a>
										</td>
										<td align="center">
											<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/modul/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_modul']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 70px;margin-bottom: 5px;">Delete</a>
										</td>
									</tr>
								<?php
								}
								?>
								</tbody>
							</table>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
			   
					</div><!-- /.col -->
				</div><!-- /.row -->
			</section><!-- /.content -->
			
	<?php
	}elseif($_GET['act']=='edit'){
		$edit = $pdo->query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
			<section class="content">
			  <div class="row">
			  
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h1 style="text-transform: capitalize;">Edit <?php echo $hal; ?></h1>
							<ol class="breadcrumb">
								<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
								<li class=""><a href="media.php?module=<?php echo "$module"; ?>"><?php echo $hal; ?></a></li>
								<li class="active">Edit <?php echo $tedit['nama']; ?></li>
							</ol>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="modul/modul/aksi.php?module=modul&act=update" method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="id_modul" value="<?php echo $tedit['id_modul']; ?>">
							<input type="hidden" name="jenis_modul" value="<?php echo $tedit['jenis_modul']; ?>">
							
							<div class="box-body table-responsive">			
								<?php
								if( ($tedit['jenis_modul']=='Judul & Text') OR ($tedit['jenis_modul']=='Judul & Textarea')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Halaman</label>
									<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama']; ?>">
								</div>
								<?php
								}else{
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Halaman</label>
									<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama']; ?>" readonly>
								</div>
								<?php
								}
								?>
								
								
								<?php
								if(($tedit['jenis_modul']=='Text')OR($tedit['jenis_modul']=='Judul & Text')OR($tedit['jenis_modul']=='Text Images')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label><br>
									<textarea name="deskripsi" style="width: 100%; height: 100px;"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}elseif(($tedit['jenis_modul']=='Textarea')OR($tedit['jenis_modul']=='Judul & Textarea')OR($tedit['jenis_modul']=='Textarea Images')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label>
									<textarea class="ckeditor" name="deskripsi"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}else{
									echo '<input type="hidden" name="deskripsi" value="'.$tedit['deskripsi'].'">';
								}
								
								if(($tedit['jenis_modul']=='Images')OR($tedit['jenis_modul']=='Text Images')OR($tedit['jenis_modul']=='Textarea Images')){
								?>
								<div class="form-group">
									<label for="exampleInputFile">Ganti Foto</label>
									<p class="help-block"><img src="../images/<?php echo $tedit['gambar']; ?>" width="200px"></p>
									<input name="fupload" type="file">
									<p class="help-block">*) Maksimal Lebar Foto 670pixel</p>
									<p class="help-block">*) Apabila Foto tidak diubah, dikosongkan saja.</p>
								</div>
								<?php
								}else{
									echo '<input type="hidden" name="gambar" value="'.$tedit['gambar'].'">';
								}
								?>
								
								
							</div><!-- /.box-body -->
		
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Update</button>
								<input type="button" class="btn btn-success" value="Kembali" onclick="location.href='media.php?module=<?php echo $module; ?>'">
							</div>
						</form>
					</div><!-- /.box -->
				</div>
			</section>
			
	<?php
	}
	?>