<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	$aksi="modul/produk/aksi.php";
	$hal = "Produk";
	$module = "produk";

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
					<th width="20px" class="center">No</th>
					<th class="center">Judul <?php echo $hal; ?></th>
					<th class="center">Kategori</th>
					<th class="center">Sub Kategori</th>
					<th class="center">Gambar</th>
					<th class="center">Status</th>
					<th class="center">Tanggal Posting</th>
					<th width="200px"  class="center">Aksi</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$tampil = $pdo->query("SELECT id_produk,id_kategori,id_subkategori,judul,judul_seo,gambar,status,tgl FROM produk ORDER BY id_produk DESC");
				while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
					$kategori = $pdo->query("SELECT id_kategori,judul FROM kategori WHERE id_kategori='$r[id_kategori]'");
					$tkategori = $kategori->fetch(PDO::FETCH_ASSOC);

					$subkat = $pdo->query("SELECT id_subkategori,judul FROM subkategori WHERE id_subkategori='$r[id_subkategori]'");
					$tsubkat = $subkat->fetch(PDO::FETCH_ASSOC);
				?>
					<tr>
						<td align="center"><?php echo  $no; ?></td>
						<td><?php echo $r['judul']; ?></td>
						<td align="center"><?php echo $tkategori['judul']; ?></td>
						<td align="center"><?php echo $tsubkat['judul']; ?></td>
						<td align="center"><img src="../images/<?php echo "produk/small/$r[gambar]"; ?>" width="180px" alt=""></td>
						<td align="center" class="besar"><?php echo $r['status']; ?></td>
						<td align="center"><?php echo  tgl2($r['tgl']); ?></td>
						
						<td align="center">
							<a href="<?php echo $module; ?>-edit-<?php echo $r['id_produk']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="min-width: 50px;margin-bottom: 5px;">Edit</a>
							
							<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_produk']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 60px;margin-bottom: 5px;">Delete</a>
						</td>
						
					</tr>
				<?php
				$no++;
				}
				?>
				</tbody>
				<tfoot>
				  <tr>
					<th width="20px" class="center">No</th>
					<th class="center">Judul <?php echo $hal; ?></th>
					<th class="center">Kategori</th>
					<th class="center">Sub Kategori</th>
					<th class="center">Gambar</th>
					<th class="center">Status</th>
					<th class="center">Tanggal Posting</th>
					<th width="200px"  class="center">Aksi</th>
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
	
	date_default_timezone_set('Asia/Jakarta');
	$tgl = date("d-m-Y");
	$time = date("H:i");
	?>
	<script type="text/javascript" src="modul/jquery-1.9.1.min.js"></script>		
	<script type="text/javascript">
		$(document).ready(function(){
			$("#id_kategori").change(function(){
				var id = $("#id_kategori").val();
				$.ajax({
					url: "modul/produk/subkategori.php",
					data: "op=generatecontent&id="+id,
					cache: false,
					success: function(msg){
						$("#id_subkategori").html(msg);
					}
				});
			});
		});
	</script>
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
			
			
			<form role="form" action="modul/produk/aksi.php?module=<?php echo $module; ?>&act=add" method="POST" enctype="multipart/form-data" >
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
							<select id="id_kategori" name="id_kategori" class="form-control">
								<option value="0" selected>Pilih Kategori</option>
								<?php
								$tampil = $pdo->query("SELECT id_kategori,judul FROM kategori ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
									echo '<option value="'.$r['id_kategori'].'">'.$r['judul'].'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Kode produk</label>
							<input name="kode_produk" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Harga</label>
							<input name="harga" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Gambar</label>
							<input name="fupload" type="file" id="exampleInputFile">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Sub Kategori</label>
							<select id="id_subkategori" name="id_subkategori" class="form-control">
								<option value="0" selected>Tidak Ada Sub Kategori</option>
							</select>
						</div>
						
						<div class="col-md-12 nopadding">
							<div class="col-md-6 col-xs-6 nopadding">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal Posting</label>
								<div class="input-group">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input name="tgl" type="text" value="<?php echo $tgl; ?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
							</div>
							</div>
							<div class="col-md-6 col-xs-6 nopadding">
							  <div class="bootstrap-timepicker">
								<div class="form-group" style="margin-top: 5px;">
								  <label></label>
								  <div class="input-group">
									<input name="time" type="text" value="<?php echo $time; ?>" class="form-control timepicker">
									<div class="input-group-addon">
									  <i class="fa fa-clock-o"></i>
									</div>
								  </div>
								</div>
							  </div>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Status</label>
							<select name="status" class="form-control">
								<option value="tersedia">Tersedia</option>
								<option value="tidak tersedia">Tidak Tersedia</option>
								<option value="pre order">Pre Order</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Deskripsi</label>
							<textarea class="ckeditor" name="deskripsi"></textarea>
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
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		  </div>
		</div>
	</section>
		
	<?php
	break;
	case "edit":
	$edit = $pdo->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	
	$thn=substr($tedit['tgl'],0,4);
	$bln=substr($tedit['tgl'],5,2);
	$tgl=substr($tedit['tgl'],8,2);
	$tgl_post = "$tgl/$bln/$thn";
	
	$time=substr($tedit['tgl'],11,5);
	?>
	<script type="text/javascript" src="modul/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#id_kategori").change(function(){
				var id = $("#id_kategori").val();
				$.ajax({
					url: "modul/produk/subkategori.php",
					data: "op=generatecontent&id="+id,
					cache: false,
					success: function(msg){
						$("#id_subkategori").html(msg);
					}
				});
			});
		});
	</script>
		
	<section class="content">
	  <div class="row">
		<div class="col-md-12">
		  <div class="box box-primary">
			<div class="box-header">
				<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
				<ol class="breadcrumb">
					<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
					<li class="active">produk Edit</li>
				</ol>
			</div>
			
			<form role="form" action="modul/produk/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
				<input type="hidden" name="id_produk" value="<?php echo $tedit['id_produk']; ?>">
				
				<div class="box-body table-responsive">				
					<div class="col-md-12 nopadding">
						<div class="panel panel-default">
							<div class="panel-body">
								<ul class="nav nav-tabs">
									<li class="<?php if(($_GET['tab']=='edit')){echo "active";} ?>"><a href="#edit" data-toggle="tab" aria-expanded="<?php if(($_GET['tab']=='edit')){echo "true";} ?>">Edit</a></li>
									<li class="<?php if(($_GET['tab']=='gal')){echo "active";} ?>"><a href="#gal" data-toggle="tab" aria-expanded="<?php if(($_GET['tab']=='gal')){echo "true";} ?>">Gallery</a></li>
								</ul>

								<div class="tab-content">
									<div class="tab-pane fade <?php if(($_GET['tab']=='edit')){echo "active in";} ?>" id="edit">
										<div class="col-md-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Judul <span title="wajib" style="color: red;">*</span></label>
												<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>" required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleInputEmail1">Kategori <span title="wajib" style="color: red;">*</span></label>
												<select id="id_kategori" name="id_kategori" class="form-control">
													<?php
													$tampil = $pdo->query("SELECT id_kategori, judul FROM kategori ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
													while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
														if($tedit['id_kategori']==$r['id_kategori']){
															echo '<option value="'.$r['id_kategori'].'" selected>'.$r['judul'].'</option>';
														}else{
															echo '<option value="'.$r['id_kategori'].'">'.$r['judul'].'</option>';
														}
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Kode produk</label>
												<input name="kode_produk" type="text" class="form-control" value="<?php echo $tedit['kode_produk']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Harga</label>
												<input name="harga" type="text" class="form-control" value="<?php echo $tedit['harga']; ?>">
											</div>
											<div class="form-group">
												<label for="exampleInputFile">Gambar</label>
												<div class="photo">
													<p class="help-block">
														<a href="../images/<?php echo "produk/$tedit[gambar]"; ?>" target="_blank">
															<img src="../images/<?php echo "produk/small/$tedit[gambar]"; ?>" width="220px" alt="" />
														</a>
													</p>
												</div>
												
												<input name="fupload" type="file" id="exampleInputFile">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleInputEmail1">Sub Kategori</label>
												<select id="id_subkategori" name="id_subkategori" class="form-control">
												<?php
												if($tedit['id_subkategori']!='0'){
													$subk = $pdo->query("SELECT * FROM subkategori WHERE id_kategori='$tedit[id_kategori]' AND status='aktif' ORDER BY judul ASC");
													while($tsubk = $subk->fetch(PDO::FETCH_ASSOC)){
														if($tedit['id_subkategori']==$tsubk['id_subkategori']){
														echo '<option value="'.$tsubk['id_subkategori'].'" selected>'.$tsubk['judul'].'</option>';
														}else{
														echo '<option value="'.$tsubk['id_subkategori'].'">'.$tsubk['judul'].'</option>';
														}
													}
												}else{
													echo '<option value="0">Tidak Ada Sub Kategori!</option>';
												}
												?>
												</select>
											</div>
											
											<div class="col-md-12 nopadding">
												<div class="col-md-6 col-xs-6 nopadding">
												<div class="form-group">
													<label for="exampleInputEmail1">Publish Date & Time</label>
													<div class="input-group">
													  <div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													  </div>
													  <input name="tgl" type="text" class="form-control" value="<?php echo $tgl_post; ?>"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
													</div><!-- /.input group -->
												</div>
												</div>
												<div class="col-md-6 col-xs-6 nopadding">
												  <!-- time Picker -->
												  <div class="bootstrap-timepicker">
													<div class="form-group" style="margin-top: 5px;">
													  <label></label>
													  <div class="input-group">
														<input name="time" value="<?php echo $time; ?>" type="text" class="form-control timepicker">
														<div class="input-group-addon">
														  <i class="fa fa-clock-o"></i>
														</div>
													  </div>
													</div>
												  </div>
												</div>
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Status</label>
												<select name="status" class="form-control">
													<option value="tersedia" <?php if($tedit['status']=='tersedia'){echo "selected";} ?>>Tersedia</option>
													<option value="tidak tersedia" <?php if($tedit['status']=='tidak tersedia'){echo "selected";} ?>>Tidak Tersedia</option>
													<option value="pre order" <?php if($tedit['status']=='pre order'){echo "selected";} ?>>Pre Order</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-12">
											<div class="form-group">
												<label for="exampleInputEmail1">Deskripsi</label>
												<textarea class="ckeditor" name="deskripsi"><?php echo $tedit['deskripsi']; ?></textarea>
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
																<textarea name="keyword" style="width: 100%;height: 100px;"><?php echo "$tedit[keyword]"; ?></textarea>
															</div>
														</div>
														<div class="tab-pane fade" id="desz">
															<div class="form-group">
																<label for="exampleInputEmail1">Description</label>
																	 <span data-toggle="tooltip" title="Description adalah deskripsi singkat dari halaman ini, Description akan terindek oleh mesin pencarian Google dan berfungsi untuk meningkatkan rating web di google" class="badge bg-light-blue" >?</span>
																<textarea name="description" style="width: 100%;height: 100px;"><?php echo "$tedit[description]"; ?></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="tab-pane fade <?php if(($_GET['tab']=='gal')){echo "active in";} ?>" id="gal">
										<link rel="stylesheet" id="vcss-css" href="../assets/plugins/popup/v-css.css" type="text/css" media="all">
										<script src="../assets/js/jquery.js"></script>
										<div class="col-md-12" style="margin-top: 30px;margin-bottom: 60px;" id="gallery">
										  <div class="box-group" id="accordion">
											  <div class="box-header with-border">
												<h4 class="box-title">
												  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="">
													Gallery Product <input type="button" class="btn btn-success" value="Add" onclick="location.href='produk-addgallery-<?php echo $tedit['id_produk']; ?>' ">
												  </a>
												</h4>
											  </div>
											  <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="false" style="height: 0px;">
												<div class="box-body">
													<?php
													$subpro  = $pdo->query("SELECT * FROM slideproduk WHERE id_produk='$tedit[id_produk]' ORDER BY id_slideproduk ASC");
													while($tsubpro = $subpro ->fetch(PDO::FETCH_ASSOC)){
													?>
													<div class="col-md-3 col-xs-12" style="height: 167px;overflow: hidden;margin: 10px 0px;">
														<div class="photo">
															<a href="../images/slideproduk/<?php echo $tsubpro['gambar']; ?>" style="width: 100%; height: 150px;overflow: hidden;float: left;overflow: hidden;" title="<?php echo $tsubpro['judul']; ?>">
																
																<img src="../images/slideproduk/small/<?php echo $tsubpro['gambar']; ?>" style="width: 100%; min-height: 150px;overflow: hidden;" title="<?php echo $tsubpro['judul']; ?>">
															</a>
														</div>
														<br/><a href="produk-editgallery-<?php echo $tsubpro['id_slideproduk']; ?>">Edit</a> 
														|
														<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href='modul/produk/aksi.php?module=produk&act=removegallery&id=<?php echo $tsubpro['id_slideproduk']; ?>' >Hapus</a>
														
													</div>
													<?php
													}
													?>
												</div>
											  </div>
										  </div>
										</div>
										<script type="text/javascript" src="../assets/plugins/popup/vjQuery.libs.js" defer="defer"></script>
										<script type="text/javascript" src="../assets/plugins/popup/vjQuery.script.js" defer="defer"></script>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="box-footer">
						<button type="submit" class="btn btn-secondary">Save</button>
						
						<input type="button" class="btn btn-success" value="Back" onclick="location.href='<?php echo $module; ?>' ">
					</div>
				</div>
			</form>
		  </div>
		</div>
	</div>
	</section>
			
			
	<?php
		break;
		case "addgallery":
		$edit = $pdo->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
			<section class="content">
			  <div class="row">
			  
				<!-- left column -->
				<div class="col-md-12">
				  <!-- general form elements -->
				  <div class="box box-primary">
					<div class="box-header">
						<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
						<ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
							<li><a href="produk-edit-<?php echo $tedit['id_produk']; ?>">Edit produk</a></li>
							<li class="active">Tambah Gambar </li>
						</ol>
					</div><!-- /.box-header -->
					
					
					<!-- form start -->
					<form role="form" action="modul/produk/aksi.php?module=produk&act=addgallery" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="id" value="<?php echo $tedit['id_produk']; ?>">
						<div class="box-body table-responsive">
						
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">Judul Gambar</label>
									<input name="judul" type="text" class="form-control">
								</div>
								
								<div class="form-group">
									<label for="exampleInputFile">Gambar</label>
									<div class="photo">
									
									<input name="fupload" type="file" id="exampleInputFile">
									</div>
								
								</div><!-- /.box-body -->
							</div>
							
						</div><!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				  </div><!-- /.box -->
				</div>
			</section>
			
			
		
	<?php
		break;
		case "editgallery":
		$edit = $pdo->query("SELECT * FROM slideproduk WHERE id_slideproduk='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
			<section class="content">
			  <div class="row">
			  
				<!-- left column -->
				<div class="col-md-12">
				  <!-- general form elements -->
				  <div class="box box-primary">
					<div class="box-header">
						<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
						<ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
							<li><a href="produk-edit-<?php echo $tedit['id_produk']; ?>">Edit produk</a></li>
							<li class="active"><?php echo $tedit['judul']; ?></li>
						</ol>
					</div><!-- /.box-header -->
					
					<!-- form start -->
					<form role="form" action="modul/produk/aksi.php?module=produk&act=editgallery" method="POST" enctype="multipart/form-data" >
						<input type="hidden" name="id_produk" value="<?php echo $tedit['id_produk']; ?>">
						<input type="hidden" name="id_slideproduk" value="<?php echo $tedit['id_slideproduk']; ?>">
						
						<div class="box-body table-responsive">
						
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">Judul Gambar</label>
									<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>">
								</div>
								
								<div class="form-group">
									<label for="exampleInputFile">Gambar</label>
									<div class="photo">
										<p class="help-block"><a href="../images/<?php echo "slideproduk/$tedit[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "slideproduk/small/$tedit[gambar]"; ?>" width="220px"></a></p>
									
									<input name="fupload" type="file" id="exampleInputFile">
									</div>
								
								</div><!-- /.box-body -->
							</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Update</button>
								
								<input type="button" class="btn btn-success" value="Back" onclick="location.href='produk-edit-<?php echo $tedit['id_produk']; ?>' ">
							</div>
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
