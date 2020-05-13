<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/banner/aksi.php";
	$hal = "Banner";
	$module = "banner";

	switch($_GET['act']){
		case "list":
	?>
			<section class="content">
				<div class="row">
				<div class="col-md-12">

				  <div class="box box-black">
					<div class="box-header">
						<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
						<ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li class="active"><?php echo $hal; ?></li>
						</ol>
						
						<button class="btn bg-gray" onclick="window.location.href='banner-add';"><i class="fa fa-plus" aria-hidden="true"></i> Add <?php echo $hal; ?></button>
					</div><!-- /.box-header -->
				
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th width="50px" class="center">No</th>
							<th width="50px" class="center">Urutan</th>
							<th class="center">Title</th>
							<th class="center">Gambar</th>
							<th class="center">URL</th>
							<th class="center">Tanggal Update</th>
							<th width="180px" class="center">Action</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						$tampil = $pdo->query("SELECT * FROM banner ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
						while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
						?>
							<tr>
								<td align="center"><?php echo $no; ?></td>
								<td align="center"><?php echo $r['urutan']; ?></td>
								<td><?php echo $r['judul']; ?></td>
								<td align="center"><a href="../images/<?php echo $module; ?>/<?php echo $r['gambar']; ?>" target="_blank"><img src="../images/<?php echo $module; ?>/small/<?php echo $r['gambar']; ?>" width="180px" alt=""></a></td>
								<td><?php echo  $r['url']; ?></td>
								<td align="center"><?php echo  tgl2($r['tgl_update']); ?></td>
								
								<td align="center">
									<a href="<?php echo $module; ?>-edit-<?php echo $r['id_banner']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
									
									<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_banner']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
								</td>
							</tr>
						<?php
						$no++;
						}
						?>
						</tbody>
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->
				</div>
				</div>
			</section>
					
					
			
	
	<?php
		break;
		case "add":
	?>
			<section class="content">
				<div class="row">
				<div class="col-md-12">
				  <!-- general form elements -->
				  <div class="box box-black">
					<div class="box-header">
						<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
						<ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
							<li class="active">Add <?php echo $module; ?></li>
						</ol>
					</div><!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="modul/banner/aksi.php?module=<?php echo $module; ?>&act=add" method="POST" enctype="multipart/form-data" >
						
						<div class="box-body table-responsive">
						
								<div class="form-group">
									<label for="exampleInputEmail1">Judul <span title="wajib" style="color: red;">*</span></label>
									<input name="judul" type="text" class="form-control" required>
								</div>
						
								<div class="form-group">
									<label for="exampleInputEmail1">URL</label>
									<input type="text" name="url" class="form-control">
								</div>
						
								<div class="form-group">
									<label for="exampleInputEmail1">Urutan</label>
									<input name="urutan" type="text" class="form-control">
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Posisi Banner</label>
									<select name="posisi" class="form-control">
										<option value="1">Home Top Header</option>
										<option value="2">Home Footer</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="exampleInputFile">Gambar <span title="wajib" style="color: red;">*</span></label>
									<div class="photo">
										<input name="fupload" type="file" id="exampleInputFile">
									</div>
								</div>
							
						</div><!-- /.box-body -->

						<div class="box-footer">
							<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary" ><i class="fa fa-fw fa-backward"></i> Back</a>
								
							<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Save</button>
						</div>
					</form>
				  </div><!-- /.box -->
				</div>
			</section>
			
	
	<?php
		break;
		case "edit":
		$edit = $pdo->query("SELECT * FROM banner WHERE id_banner='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		
	?>
			<section class="content">
			  <div class="row">
			  
				<!-- left column -->
				<div class="col-md-12">
				  <!-- general form elements -->
				  <div class="box box-black">
					<div class="box-header">
						<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
						<ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
							<li class="active"><?php echo $tedit['judul']; ?></li>
						</ol>
					</div><!-- /.box-header -->
					
					<!-- form start -->
					<form role="form" action="modul/banner/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="id_banner" value="<?php echo $tedit['id_banner']; ?>">
						
						<div class="box-body table-responsive">
						
							<div class="form-group">
								<label for="exampleInputEmail1">Judul <span title="wajib" style="color: red;">*</span></label>
								<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>" required>
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">URL</label>
								<input name="url" type="text" class="form-control" value="<?php echo $tedit['url']; ?>">
							</div>
					
							<div class="form-group">
								<label for="exampleInputEmail1">Urutan</label>
								<input name="urutan" type="text" class="form-control" value="<?php echo $tedit['urutan']; ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Posisi Banner</label>
								<select name="posisi" class="form-control">
									<option value="1" <?php if($tedit['posisi']=='1'){echo "selected";} ?>>Home Top Header</option>
									<option value="2" <?php if($tedit['posisi']=='2'){echo "selected";} ?>>Home Footer</option>
								</select>
							</div>
								
							<div class="form-group">
								<label for="exampleInputFile">Gambar <span title="wajib" style="color: red;">*</span></label>
								<div class="photo">
									<p class="help-block"><a href="../images/<?php echo "banner/$tedit[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "banner/small/$tedit[gambar]"; ?>" width="220px"></a></p>
								
									<input name="fupload" type="file" id="exampleInputFile">
									<p class="help-block">*) Gambar Lebar 1200px and Tinggi 570px</p>
								</div>
							</div>
							

							<div class="box-footer">
								<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary" ><i class="fa fa-fw fa-backward"></i> Back</a>
								
								<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Update</button>
							</div>
					</form>
				  </div><!-- /.box -->
				</div>
			</section>
			
	<?php
		break;  
	}
}
?>
