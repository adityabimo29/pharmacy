<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/subkategori/aksi.php";
	$hal = "Sub Kategori";
	$module = "subkategori";

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
				
				<button class="btn bg-gray margin" onclick="window.location.href='<?php echo $module; ?>-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah <?php echo $hal; ?></button>
			</div>
		
			<div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th width="5" class="center">No</th>
					<th class="center">Judul</th>
					<th class="center">Kategori</th>
					<th class="center">Urutan</th>
					<th class="center">Status</th>
					<th class="center">Jumlah Produk</th>
					<th width="320px" class="center">Aksi</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$tampil = $pdo->query("SELECT * from subkategori ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
				while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
					$kate = $pdo->query("SELECT id_kategori,judul FROM kategori WHERE id_kategori='$r[id_kategori]'");
					$tkate = $kate ->fetch(PDO::FETCH_ASSOC);

					$stmt = $pdo->query("SELECT id_produk FROM produk WHERE id_subkategori='$r[id_subkategori]' ");
					$rowc = $stmt->rowCount();
				?>
					<tr>
						<td align="center"><?php echo  $no; ?></td>
						<td><?php echo $r['judul']; ?></td>
						<td align="center"><a href="kategori-edit-<?php echo $tkate['id_kategori']; ?>" target="_blank"><?php echo $tkate['judul']; ?></a></td>
						<td align="center"><?php echo $r['urutan']; ?></td>
						<td align="center" style="text-transform: capitalize;"><?php echo  $r['status']; ?></td>
						<td align="center"><?php echo $rowc; ?></td>
						
						<td align="center">
							<a href="<?php echo $module; ?>-edit-<?php echo $r['id_subkategori']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 100px;margin-bottom: 5px;" title="Edit subkategori"><i class="fa fa-fw fa-edit"></i> Edit</a>
							
							<!--
							<a href="<?php echo $module; ?>-view-<?php echo $r['id_subkategori']; ?>" class="btn btn-primary btnadmin" role="button" aria-pressed="true" style="width: 100px;margin-bottom: 5px;" title="View Detail subkategori"><i class="fa fa-fw fa-sticky-note-o"></i> View</a>
							-->
							
							<?php if($r['hapus']!='No'){ ?>
							<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/subkategori/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_subkategori']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 100px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
							<?php } ?>
							
						</td>
						
					</tr>
				<?php
				$no++;
				}
				?>
				</tbody>
				<tfoot>
				  <tr>
					<th width="5" class="center">No</th>
					<th class="center">Judul</th>
					<th class="center">Kategori</th>
					<th class="center">Urutan</th>
					<th class="center">Status</th>
					<th class="center">Jumlah Produk</th>
					<th width="320px" class="center">Aksi</th>
				  </tr>
				</tfoot>
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
			
			<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=add" method="POST" enctype="multipart/form-data" >
				<div class="box-body table-responsive">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Judul <span title="wajib" style="color: red;">*</span></label>
							<input name="judul" type="text" class="form-control" required>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Kategori <span title="wajib" style="color: red;">*</span></label>
							<select name="id_kategori" class="form-control">
								<?php
								$tampil = $pdo->query("SELECT id_kategori,judul FROM kategori WHERE status='aktif' ORDER BY id_kategori ASC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
									echo '<option value="'.$r['id_kategori'].'">'.$r['judul'].'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Status</label>
							<select name="status" class="form-control">
								<option value="aktif">Aktif</option>
								<option value="tidak aktif">Tidak Aktif</option>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Urutan</label>
							<input name="urutan" type="text" class="form-control" maxlength="2">
						</div>
					</div>
					
				
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<label for="exampleInputEmail1">SEO (Search Engine Optimization)
									<span data-toggle="tooltip" title="SEO berfungsi untuk meningkatkan rating website di pencarian google, sekali pasang SEO minimal membutuhkan waktu 3 Bulan untuk terdeteksi Google." class="badge bg-light-blue" >?</span></label>
								</label>
								<ul class="nav nav-tabs">
									<li class="active"><a href="#key" data-toggle="tab">Keyword</a></li>
									<li class=""><a href="#desz" data-toggle="tab">Description</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane fade active in" id="key">
										<div class="form-group">
											<label for="exampleInputEmail1">Keyword</label>
												 <span data-toggle="tooltip" title="Keyword adalah kata-kata yang akan terindek oleh mesin pencarian Google, Keyword berfungsi untuk meningkatkan rating web di google, keyword bisa lebih dari 1, contoh : Produk Jogja, Produk Khas Jogja, dll" class="badge bg-light-blue" >?</span>
											<textarea name="keyword" style="width: 100%;height: 100px;"></textarea>
										</div>
									</div>
									<div class="tab-pane fade" id="desz">
										<div class="form-group">
											<label for="exampleInputEmail1">Description</label>
												 <span data-toggle="tooltip" title="Description adalah deskripsi singkat dari halaman ini, Description akan terindek oleh mesin pencarian Google dan berfungsi untuk meningkatkan rating web di google" class="badge bg-light-blue" >?</span>
											<textarea name="description" style="width: 100%;height: 100px;"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="box-footer">
					<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary" ><i class="fa fa-fw fa-backward"></i> Back</a>
						
					<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Save</button>
				</div>
			</form>
		  </div>
		</div>
	</section>
		
	<?php
	break;
	case "edit":
	$edit = $pdo->query("SELECT * FROM subkategori WHERE id_subkategori='$_GET[id]'");
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
			
			<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
				<input type="hidden" name="id_subkategori" value="<?php echo $tedit['id_subkategori']; ?>">
				
				<div class="box-body table-responsive">
				
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Judul <span title="wajib" style="color: red;">*</span></label>
							<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>" required>
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
						<div class="form-group">
							<label for="exampleInputEmail1">Kategori <span title="wajib" style="color: red;">*</span></label>
							<select name="id_kategori" class="form-control" required>
								<option value="0">-- Pilih Kategori --</option>
								<?php
								$tampil = $pdo->query("SELECT id_kategori,judul FROM kategori WHERE status='aktif' ORDER BY id_kategori ASC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
									if($tedit['id_kategori']!=$r['id_kategori']){
									echo '<option value="'.$r['id_kategori'].'">'.$r['judul'].'</option>';
									}else{
									echo '<option value="'.$r['id_kategori'].'" selected>'.$r['judul'].'</option>';
									}
								}
								?>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Urutan</label>
							<input name="urutan" type="text" class="form-control" value="<?php echo $tedit['urutan']; ?>" maxlength="5">
						</div>
					</div>
				
					<div class="col-md-12">								
						<div class="panel panel-default">
							<div class="panel-body">
								<label for="exampleInputEmail1">SEO (Search Engine Optimization)
									<span data-toggle="tooltip" title="SEO berfungsi untuk meningkatkan rating website di pencarian google, sekali pasang SEO minimal membutuhkan waktu 3 Bulan untuk terdeteksi Google." class="badge bg-light-blue" >?</span>
								</label>
								<ul class="nav nav-tabs">
									<li class="active"><a href="#key" data-toggle="tab">Keyword</a></li>
									<li class=""><a href="#desz" data-toggle="tab">Description</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane fade active in" id="key">
										<div class="form-group">
											<label for="exampleInputEmail1">Keyword</label>
												 <span data-toggle="tooltip" title="Keyword adalah kata-kata yang akan terindek oleh mesin pencarian Google, Keyword berfungsi untuk meningkatkan rating web di google, keyword bisa lebih dari 1, contoh : Produk Jogja, Produk Khas Jogja, dll" class="badge bg-light-blue" >?</span>
											<textarea name="keyword" style="width: 100%;height: 100px;"><?php echo $tedit['keyword']; ?></textarea>
										</div>
									</div>
									<div class="tab-pane fade" id="desz">
										<div class="form-group">
											<label for="exampleInputEmail1">Description</label>
												 <span data-toggle="tooltip" title="Description adalah deskripsi singkat dari halaman ini, Description akan terindek oleh mesin pencarian Google dan berfungsi untuk meningkatkan rating web di google" class="badge bg-light-blue" >?</span>
											<textarea name="description" style="width: 100%;height: 100px;"><?php echo $tedit['description']; ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary" ><i class="fa fa-fw fa-backward"></i> Back</a>
						
						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Update</button>
					</div>
				</div>
			</form>
		  </div>
		</div>
	</section>
	
	<?php
	break;
	case "view":
	$edit = $pdo->query("SELECT * FROM subkategori WHERE id_subkategori='$_GET[id]'");
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
							
							<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary" ><i class="fa fa-fw fa-backward"></i> Back</a>
							
							<a href="<?php echo $module; ?>-edit-<?php echo $tedit['id_subkategori']; ?>" type="button" class="btn btn-success" ><i class="fa fa-fw fa-edit"></i> Edit</a>

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
														<label for="exampleInputEmail1">Judul subkategori</label>
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
															<p class="help-block"><a href="../images/<?php echo "subkategori/$tedit[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "subkategori/small/$tedit[gambar]"; ?>" width="220px" alt=""></a></p>
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
							<h1 style="text-transform: capitalize;">Semua Produk di subkategori <?php echo $tedit['judul']; ?></h1>
						</div>
				
						<div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th width="30px" class="center">No</th>
									<th class="center">Judul</th>
									<th class="center">subkategori</th>
									<th class="center">Gambar</th>
									<th class="center">Status</th>
									<th class="center">Date</th>
									<th width="180px"  class="center">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;
								$tampil = $pdo->query("SELECT k.judul as jk,p.* FROM subkategori k,produk p WHERE p.id_subkategori=k.id_subkategori AND p.id_subkategori='$_GET[id]' ORDER BY p.tgl DESC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
								?>
									<tr>
										<td align="center"><?php echo  $no; ?></td>
										<td><?php echo  $r['judul']; ?></td>
										<td align="center"><?php echo  $r['jk']; ?></td>
										<td align="center"><div style="max-height:120px;overflow: hidden;"><a href="../images/<?php echo "produk/$r[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "produk/small/$r[gambar]"; ?>" style="max-width: 150px;" alt=""></a></div></td>
										<td align="center"><?php echo  $r['status']; ?></td>
										<td align="center"><?php echo  tgl2($r['tgl']); ?></td>
										
										<td align="center">
											<a href="produk-edit-<?php echo $r['id_produk']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
											
											<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/produk/aksi.php?module=produk&act=remove&id=<?php echo $r['id_produk']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 90px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
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
									<th class="center">subkategori</th>
									<th class="center">Gambar</th>
									<th class="center">Status</th>
									<th class="center">Date</th>
									<th width="180px"  class="center">Aksi</th>
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
