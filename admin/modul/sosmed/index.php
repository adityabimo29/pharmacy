<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/sosmed/aksi.php";
	$hal = "sosmed";
	$module = "sosmed";

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
						
						<button class="btn bg-gray" onclick="window.location.href='sosmed-add';"><i class="fa fa-plus" aria-hidden="true"></i> Add <?php echo $hal; ?></button>
					</div><!-- /.box-header -->
				
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th width="20px" class="center">No</th>
							<th class="center">Sosial Media</th>
							<th class="center">URL</th>
							<th class="center">Status</th>
							<th class="center">Tanggal Update</th>
							<th width="200px" class="center">Action</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						$tampil = $pdo->query("SELECT sosmed.*, modul_sosmed.judul, modul_sosmed.gambar FROM sosmed INNER JOIN modul_sosmed ON sosmed.id_modul_sosmed=modul_sosmed.id_modul_sosmed ORDER BY sosmed.id_sosmed ASC");
						while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
						?>
							<tr>
								<td align="center"><?php echo  $no; ?></td>
								<td align="center"><?php echo  $r['judul']; ?></td>
								<td><a href="<?php echo  $r['url']; ?>" target="_blank"><?php echo  $r['url']; ?></a></td>
								<td align="center"><?php echo  $r['status']; ?></td>
								<td align="center"><?php echo  tgl2($r['tgl_update']); ?></td>
								
								<td align="center">
									<a href="<?php echo $module; ?>-edit-<?php echo $r['id_sosmed']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
									
									<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_sosmed']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 90px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
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
					<form role="form" action="modul/sosmed/aksi.php?module=<?php echo $module; ?>&act=add" method="POST" enctype="multipart/form-data" >
						
						<div class="box-body table-responsive">

							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Sosial Media</label>
									<select name="id_modul_sosmed" class="form-control">
									<?php
									$sql1 = $pdo->query("SELECT * FROM modul_sosmed ORDER BY judul ASC");
									while($tsql1 = $sql1->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$tsql1['id_modul_sosmed'].'">'.$tsql1['judul'].'</option>';
									}
									?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Status</label>
									<select name="status" class="form-control">
										<option value="aktif">Aktif</option>
										<option value="tidak aktif">Tidak Aktif</option>
									</select>
								</div>
							</div>
								
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">URL</label>
									<input type="text" name="url" class="form-control">
									<p class="help-block">*) penulisan url harus mengunakan http:// atau https:// </p>
									<p class="help-block">*) contoh https://www.facebook.com/JogjaMediaWeb/ </p>
								</div>
							</div>
							
						</div><!-- /.box-body -->

						<div class="box-footer">
							<a href="<?php echo $module; ?>" type="button" class="btn btn-success" ><i class="fa fa-fw fa-backward"></i> Back</a> 

							<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Save</button>
						</div>
					</form>
				  </div><!-- /.box -->
				</div>
			</section>
			
	
	<?php
		break;
		case "edit":
		$edit = $pdo->query("SELECT * FROM sosmed WHERE id_sosmed='$_GET[id]'");
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
							<li class="active">Edit <?php echo $hal; ?></li>
						</ol>
					</div><!-- /.box-header -->
					
					<!-- form start -->
					<form role="form" action="modul/sosmed/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="id_sosmed" value="<?php echo $tedit['id_sosmed']; ?>">
						
						<div class="box-body table-responsive">
						
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Sosial Media</label>
									<select name="id_modul_sosmed" class="form-control">
									<?php
									$sql1 = $pdo->query("SELECT * FROM modul_sosmed ORDER BY judul ASC");
									while($tsql1 = $sql1->fetch(PDO::FETCH_ASSOC)){
										if($tedit['id_modul_sosmed']==$tsql1['id_modul_sosmed']){
											echo '<option value="'.$tsql1['id_modul_sosmed'].'" selected>'.$tsql1['judul'].'</option>';
										}else{
											echo '<option value="'.$tsql1['id_modul_sosmed'].'">'.$tsql1['judul'].'</option>';
										}
									}
									?>
									</select>
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Status</label>
									<select name="status" class="form-control">
										<option value="aktif" <?php if($tedit['status']=='aktif'){echo "selected";} ?>>Aktif</option>
										<option value="tidak aktif" <?php if($tedit['status']=='tidak aktif'){echo "selected";} ?>>Tidak Aktif</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">URL</label>
									<input name="url" type="text" class="form-control" value="<?php echo $tedit['url']; ?>">
									<p class="help-block">*) penulisan url harus mengunakan http:// atau https:// </p>
									<p class="help-block">*) contoh https://www.facebook.com/JogjaMediaWeb/ </p>
								</div>
							</div>
							

							<div class="box-footer">
								<a href="<?php echo $module; ?>" type="button" class="btn btn-success" ><i class="fa fa-fw fa-backward"></i> Back</a> 

								<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Save</button>
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
