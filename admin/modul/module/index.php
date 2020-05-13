<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	$aksi="modul/module/aksi.php";
		
	$hal = "Module";
	$module = "module";

	switch($_GET['act']){
	  // Tampil Modul
	  default:
	?>
			<section class="content">
				<div class="row">
					<div class="col-xs-12">

						<div class="box box-black">
							<div class="box-header">
								<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
								<ol class="breadcrumb">
									<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
									<li class="active"><?php echo $hal; ?></li>
								</ol>
							</div>
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th width="2%">No</th>
									<th width="23%">Nama Modul</th>
									<th width="15%">Tanggal Update</th>
									<th width="15%" colspan="2">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;
								$tampil = $pdo->query("SELECT * FROM module WHERE tampil='ya' ORDER BY no_urut ASC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){  
									$tanggal2=tgl2($r['tgl_update']);
								?>
									<tr>
										<td align="center"><?php echo  $no; ?></td>
										<td><?php echo  $r['nama']; ?></td>
										<td align="center"><?php echo  $tanggal2; ?></td>
										<td align="center">
											<a href="<?php echo $module; ?>-edit-<?php echo $r['id_module']; ?>" class="btn btn-success btnadmin2" role="button" aria-pressed="true" style="min-width: 70px;margin-bottom: 5px;">Edit</a>
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
			   
					</div><!-- /.col -->
				</div><!-- /.row -->
			</section><!-- /.content -->
			
	<?php
		break;
		case "edit":
		$edit = $pdo->query("SELECT id_module,nama,deskripsi,gambar,jenis_modul FROM module WHERE id_module='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
			<section class="content">
			  <div class="row">
				<div class="col-md-12">
					<div class="box box-black">
						<div class="box-header with-border">
							<h1 style="text-transform: capitalize;">Edit <?php echo $hal; ?></h1>
							<ol class="breadcrumb">
								<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
								<li class=""><a href="media.php?module=<?php echo "$module"; ?>"><?php echo $hal; ?></a></li>
								<li class="active">Edit</li>
							</ol>
						</div>
						<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="id_module" value="<?php echo $tedit['id_module']; ?>">
							<input type="hidden" name="jenis_modul" value="<?php echo $tedit['jenis_modul']; ?>">
							
							<div class="box-body table-responsive">
								<div class="form-group">
									<label for="exampleInputEmail1">Nama Module</label>
									<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama']; ?>" readonly>
								</div>
								
								
								<?php
								if(($tedit['jenis_modul']=='text')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label><br>
									<textarea name="deskripsi" style="width: 100%; height: 100px;"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}elseif(($tedit['jenis_modul']=='textarea')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label>
									<textarea class="ckeditor" name="deskripsi"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}else{
									echo '<input type="hidden" name="deskripsi" value="'.$tedit['deskripsi'].'">';
								}
								
								
								if(($tedit['jenis_modul']=='images')){
								?>
								<div class="form-group">
									<label for="exampleInputFile">Gambar</label>
									<p class="help-block"><a href="../images/module/<?php echo $tedit['gambar']; ?>" target="_blank"><img src="../images/module/<?php echo $tedit['gambar']; ?>" width="200px" alt=""></a></p>
									<input name="fupload" type="file">
								</div>
								<?php
								}else{
									echo '<input type="hidden" name="gambar" value="'.$tedit['gambar'].'">';
								}
								?>
								
								
							</div><!-- /.box-body -->
		
							<div class="box-footer">
								<a href="<?php echo $module; ?>" type="button" class="btn btn-success" ><i class="fa fa-fw fa-backward"></i> Back</a>
							
								<button type="submit" class="btn btn-secondary"><i class="fa fa-fw fa-save"></i> Update</button>
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
