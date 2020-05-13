<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/distributor/aksi.php";
	$hal = "distributor";
	$module = "distributor";

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

					<button class="btn btn-primary margin"
						onclick="window.location.href='<?php echo $module; ?>-add';"><i class="fa fa-plus"
							aria-hidden="true"></i> Tambah distributor</button>
					<button class="btn btn-success margin"
						onclick="window.location.href='<?php echo $module; ?>-import';"><i class="fa fa-file-excel-o"
							aria-hidden="true"></i> Import Excel</button>
				</div><!-- /.box-header -->

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5" class="center">Kode</th>
								<th class="center">NPWP</th>
								<th class="center">Nama</th>
								<th class="center">Alamat</th>
								<th class="center">No HP</th>
								<th width="320px" class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
				$no = 1;
				$tampil = $pdo->query("SELECT * from distributor ORDER BY nama DESC");
				while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
				?>
							<tr>
								<td align="center"><?php echo  $r['kode_distributor']; ?></td>
								<td><?php echo $r['npwp']; ?></td>
								<td><?php echo $r['nama']; ?></td>
								<td><?php echo $r['alamat']; ?></td>
								<td><?php echo $r['no_hp']; ?></td>
								<td align="center">
									<a href="<?php echo $module; ?>-edit-<?php echo $r['id_distributor']; ?>"
										class="btn btn-success btnadmin" role="button" aria-pressed="true"
										style="width: 100px;margin-bottom: 5px;" title="Edit distributor"><i
											class="fa fa-fw fa-edit"></i> Edit</a>

									<!--
							<a href="<?php echo $module; ?>-view-<?php echo $r['id_distributor']; ?>" class="btn btn-primary btnadmin" role="button" aria-pressed="true" style="width: 100px;margin-bottom: 5px;" title="View Detail distributor"><i class="fa fa-fw fa-sticky-note-o"></i> View</a>
							-->

									<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
										href="modul/distributor/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_distributor']; ?>"
										class="btn btn-danger btnadmin" role="button" aria-pressed="true"
										style="width: 100px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i>
										Delete</a>


								</td>

							</tr>
							<?php
				$no++;
				}
				?>
						</tbody>
					</table>
				</div>
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
			<div class="box box-black">
				<div class="box-header">
					<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
					<ol class="breadcrumb">
						<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
						<li class="active">Tambah <?php echo $module; ?></li>
					</ol>
				</div>

				<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=add"
					method="POST" enctype="multipart/form-data">
					<div class="box-body table-responsive">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Distributor <span title="wajib"
										style="color: red;">*</span></label>
								<input name="kode_distributor" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">NPWP <span title="wajib"
										style="color: red;">*</span></label>
								<input name="npwp" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama <span title="wajib"
										style="color: red;">*</span></label>
								<input name="nama" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">No HP </label>
								<input name="no_hp" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Alamat </label>
								<textarea name="alamat" id="" cols="30" rows="5" class='form-control'></textarea>
							</div>
						</div>

					</div>
					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
								class="fa fa-fw fa-backward"></i> Back</a>

						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
</section>

<?php
		break;
		case "import":
	?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-header">
					<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
					<ol class="breadcrumb">
						<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
						<li class="active">Import Excel</li>
					</ol>
				</div>
				<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=template"
					method="POST" enctype="multipart/form-data">
				<button class="btn btn-warning margin"
						type='submit'><i class="fa fa-file-excel-o"
							aria-hidden="true"></i> Download Template Excel</button>
				</form>
							<hr>
				<form role="form" action='modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=import' name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" method='post'>

					<div class="box-body table-responsive">

						<div class="col-md-6">
							<div class="form-group">
								<label>Pilih File Excel</label> 
									<input type="file" name="file" id="file" accept=".xls,.xlsx">
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
									class="fa fa-fw fa-backward"></i> Back</a>

							<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i>
								Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
</section>

<?php
		break;
		case "edit":
		$edit = $pdo->query("SELECT * FROM distributor WHERE id_distributor='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-header">
					<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
					<ol class="breadcrumb">
						<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
						<li class="active">Edit</li>
					</ol>
				</div>

				<form role="form"
					action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=update"
					method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id_distributor" value="<?php echo $tedit['id_distributor']; ?>">

					<div class="box-body table-responsive">

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Distributor <span title="wajib"
										style="color: red;">*</span></label>
								<input name="kode_distributor" type="text" class="form-control"
									value="<?php echo $tedit['kode_distributor'] ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">NPWP <span title="wajib"
										style="color: red;">*</span></label>
								<input name="npwp" type="text" class="form-control" value="<?php echo $tedit['npwp'] ?>"
									required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama <span title="wajib"
										style="color: red;">*</span></label>
								<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama'] ?>"
									required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">No HP </label>
								<input name="no_hp" type="text" class="form-control"
									value="<?php echo $tedit['no_hp'] ?>" required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Alamat </label>
								<textarea name="alamat" id="" cols="30" rows="5"
									class='form-control'> <?php echo $tedit['alamat'] ?></textarea>
							</div>
						</div>

						<div class="box-footer">
							<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
									class="fa fa-fw fa-backward"></i> Back</a>

							<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i>
								Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
</section>

<?php
	break;
	case "view":
	$edit = $pdo->query("SELECT * FROM distributor WHERE id_distributor='$_GET[id]'");
	$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
<section class="content">
	<div class="row">

		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-header">
					<ol class="breadcrumb">
						<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
						<li class="active">View <?php echo $tedit['judul']; ?></li>
					</ol>

					<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
							class="fa fa-fw fa-backward"></i> Back</a>

					<a href="<?php echo $module; ?>-edit-<?php echo $tedit['id_distributor']; ?>" type="button"
						class="btn btn-success"><i class="fa fa-fw fa-edit"></i> Edit</a>

				</div>

				<div class="box-body table-responsive">
					<div class="col-md-12">
						<div class="panel panel-default">
							<!-- /.panel-heading -->
							<div class="panel-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tit" data-toggle="tab">Detail</a></li>
									<li class=""><a href="#key" data-toggle="tab">SEO</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane fade active in" id="tit">
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleInputEmail1">Judul distributor</label>
												<p class="help-block"><?php echo $tedit['judul']; ?></p>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Urutan</label>
												<p class="help-block"><?php echo $tedit['urutan']; ?></p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleInputEmail1">Status</label>
												<p class="help-block"><?php echo $tedit['status']; ?></p>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Unggulan</label>
												<p class="help-block"><?php echo $tedit['unggulan']; ?></p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleInputEmail1">Gambar</label>
												<div class="photo">
													<p class="help-block"><a
															href="../images/<?php echo "distributor/$tedit[gambar]"; ?>"
															target="_blank"><img
																src="../images/<?php echo "distributor/small/$tedit[gambar]"; ?>"
																width="220px" alt=""></a></p>
												</div>
											</div>
										</div>

									</div>
									<div class="tab-pane fade" id="key">
										<div class="col-md-4">
											<div class="form-group">
												<label for="exampleInputEmail1">Keyword</label>
												<p class="help-block"><?php echo $tedit['keyword']; ?></p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="exampleInputEmail1">Description</label>
												<p class="help-block"><?php echo $tedit['description']; ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">

			<div class="box">
				<div class="box-header">
					<h1 style="text-transform: capitalize;">Semua Produk di distributor <?php echo $tedit['judul']; ?>
					</h1>
				</div>

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="30px" class="center">No</th>
								<th class="center">Judul</th>
								<th class="center">distributor</th>
								<th class="center">Gambar</th>
								<th class="center">Status</th>
								<th class="center">Date</th>
								<th width="180px" class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								$tampil = $pdo->query("SELECT k.judul as jk,p.* FROM distributor k,produk p WHERE p.id_distributor=k.id_distributor AND p.id_distributor='$_GET[id]' ORDER BY p.tgl DESC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
								?>
							<tr>
								<td align="center"><?php echo  $no; ?></td>
								<td><?php echo  $r['judul']; ?></td>
								<td align="center"><?php echo  $r['jk']; ?></td>
								<td align="center">
									<div style="max-height:120px;overflow: hidden;"><a
											href="../images/<?php echo "produk/$r[gambar]"; ?>" target="_blank"><img
												src="../images/<?php echo "produk/small/$r[gambar]"; ?>"
												style="max-width: 150px;" alt=""></a></div>
								</td>
								<td align="center"><?php echo  $r['status']; ?></td>
								<td align="center"><?php echo  tgl2($r['tgl']); ?></td>

								<td align="center">
									<a href="produk-edit-<?php echo $r['id_produk']; ?>"
										class="btn btn-success btnadmin" role="button" aria-pressed="true"
										style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i>
										Edit</a>

									<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');"
										href="modul/produk/aksi.php?module=produk&act=remove&id=<?php echo $r['id_produk']; ?>"
										class="btn btn-danger btnadmin" role="button" aria-pressed="true"
										style="width: 90px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i>
										Delete</a>
								</td>

							</tr>
							<?php
								$no++;
								}
								?>
						</tbody>
						<tfoot>
							<tr>
								<th width="30px" class="center">No</th>
								<th class="center">Judul</th>
								<th class="center">distributor</th>
								<th class="center">Gambar</th>
								<th class="center">Status</th>
								<th class="center">Date</th>
								<th width="180px" class="center">Aksi</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>



<?php
		break;  
	}
}
?>