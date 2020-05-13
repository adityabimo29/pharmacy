<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";

}else{
	$aksi="modul/page/aksi.php";
		
	$hal = "Page";
	$module = "page";

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
									<li class="active"><a href="<?php echo "$module"; ?>"><?php echo $hal; ?></a></li>
								</ol>
							</div><!-- /.box-header -->
							<!-- <button class="btn bg-olive margin" onclick="window.location.href='?module=modul&act=add';">Tambah Halaman</button> -->
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th width="2%">No</th>
									<th width="23%">Nama Content / Halaman</th>
									<th width="15%">Tanggal Update</th>
									<th width="15%" colspan="2">Aksi</th>
								</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;
								$tampil = $pdo->query("SELECT * FROM page WHERE status='On' AND tampil='Ya' ORDER BY id_page ASC");
								while($r = $tampil->fetch(PDO::FETCH_ASSOC)){  
									$tanggal2=tgl2($r['tgl_update']);
								?>
									<tr>
										<td align="center"><?php echo  $no; ?></td>
										<td><?php echo  $r['judul']; ?></td>
										<td><?php echo  $tanggal2; ?></td>
										<td align="center">
											<a href="<?php echo $module; ?>-edit-<?php echo $r['id_page']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="min-width: 50px;margin-bottom: 5px;">Edit</a>
										<?php
										if($r['hapus']=="Yes"){
										?>
											<a href="modul/modul/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_page']; ?>" title="Hapus"><img src="hr.gif"></a>
										</td>
										<?php
										}
										?>
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
		$edit = $pdo->query("SELECT * FROM page WHERE id_page='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	?>
			<section class="content">
			  <div class="row">
			  
				<!-- left column -->
				<div class="col-md-12">
					<!-- general form elements -->
					<div class="box box-black">
						<div class="box-header with-border">
							<h1 style="text-transform: capitalize;">Edit <?php echo $hal; ?></h1>
							<ol class="breadcrumb">
								<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
								<li class=""><a href="<?php echo "$module"; ?>"><?php echo $hal; ?></a></li>
								<li class="active">Edit <?php echo $tedit['judul']; ?></li>
							</ol>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form role="form" action="modul/page/aksi.php?module=page&act=update" method="POST" enctype="multipart/form-data" >
							<input type="hidden" name="id_page" value="<?php echo $tedit['id_page']; ?>">
							<input type="hidden" name="jenis_modul" value="<?php echo $tedit['jenis_modul']; ?>">
							<input type="hidden" name="gambar" value="<?php echo $tedit['gambar']; ?>">
							
							<div class="box-body table-responsive">			
								<?php
								if( ($tedit['jenis_modul']=='Judul & Text') OR ($tedit['jenis_modul']=='Judul & Textarea') OR ($tedit['jenis_modul']=='All')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Judul Halaman</label>
									<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>">
								</div>
								<?php
								}else{
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Judul Halaman</label>
									<input name="judul" type="text" class="form-control" value="<?php echo $tedit['judul']; ?>" readonly>
								</div>
								<?php
								}
								
								if(($tedit['jenis_modul']=='Images')OR($tedit['jenis_modul']=='Images SEO')OR($tedit['jenis_modul']=='Text Images')OR($tedit['jenis_modul']=='Textarea Images')OR($tedit['jenis_modul']=='All')){
								?>
								<div class="form-group">
									<label for="exampleInputFile">Gambar</label>
									<?php if($tedit['gambar']!=""){ ?>
										<p class="help-block"><img src="../images/page/<?php echo $tedit['gambar']; ?>" width="200px"></p>
										<a href="modul/page/aksi.php?module=page&act=romoveimg&id=<?php echo $tedit['id_page']; ?>">Hapus Gambar</a>
									<?php } ?>
									<?php echo $tedit['keterangan']; ?>
									<input name="fupload" type="file">
								</div>
								<?php
								}else{
									echo '<input name="fupload" type="file" style="display: none;">';
								}
								?>
								
								
								<?php
								if(($tedit['jenis_modul']=='Text')OR($tedit['jenis_modul']=='Judul & Text')OR($tedit['jenis_modul']=='Text Images')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label><br>
									<textarea name="deskripsi" style="width: 100%; height: 200px;"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}elseif(($tedit['jenis_modul']=='Textarea')OR($tedit['jenis_modul']=='Textarea SEO')OR($tedit['jenis_modul']=='Judul & Textarea')OR($tedit['jenis_modul']=='Textarea Images')OR($tedit['jenis_modul']=='All')){
								?>
								<div class="form-group">
									<label for="exampleInputEmail1">Deskripsi</label>
									<textarea class="ckeditor" name="deskripsi"><?php echo $tedit['deskripsi']; ?></textarea>
								</div>
								<?php
								}
								?>
								
								<?php
								if(($tedit['jenis_modul']=='Text')OR($tedit['jenis_modul']=='Textarea')OR($tedit['jenis_modul']=='Judul & Text')OR($tedit['jenis_modul']=='Judul & Textarea')OR($tedit['jenis_modul']=='Images')OR($tedit['jenis_modul']=='Textarea Images')){
									echo '<input type="hidden" name="title" value="">';
									echo '<input type="hidden" name="keyword" value="">';
									echo '<input type="hidden" name="description" value="">';
								}else{
								?>
								<div class="panel panel-default">
									<!-- /.panel-heading -->
									<div class="panel-body">
									<label for="exampleInputEmail1">SEO (Search Engine Optimization)
										<span data-toggle="tooltip" title="SEO berfungsi untuk meningkatkan rating website di pencarian google, sekali pasang SEO minimal membutuhkan waktu 3 Bulan untuk terdeteksi Google." class="badge bg-light-blue" >?</span>
									</label>
										<!-- Nav tabs -->
										<ul class="nav nav-tabs">
											<li class="active"><a href="#tit" data-toggle="tab">Title</a></li>
											<li class=""><a href="#key" data-toggle="tab">Keyword</a></li>
											<li class=""><a href="#desz" data-toggle="tab">Description</a></li>
										</ul>
		
										<!-- Tab panes -->
										<div class="tab-content">
											<div class="tab-pane fade active in" id="tit">
												<div class="form-group">
													<label for="exampleInputEmail1">Title</label>
														 <span data-toggle="tooltip" title="Title adalah judul halaman yang akan terindek oleh mesin pencarian Google, Title berfungsi untuk meningkatkan rating web di google" class="badge bg-light-blue" >?</span>
														 
													<textarea name="title" maxlength="128" style="width: 100%;height: 100px;"><?php echo $tedit['title']; ?></textarea>
													<p class="help-block">*) Title Maksimal 128 Karakter </p>
												</div>
											</div>
											<div class="tab-pane fade" id="key">
												<div class="form-group">
													<label for="exampleInputEmail1">Keyword</label>
														 <span data-toggle="tooltip" title="Keyword adalah kata-kata yang akan terindek oleh mesin pencarian Google, Keyword berfungsi untuk meningkatkan rating web di google, keyword bisa lebih dari 1, contoh : Cake Jogja, Cake Thiwul, dll" class="badge bg-light-blue" >?</span>
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
									<!-- /.panel-body -->
								</div>
								<?php
								}
								?>
									
							</div><!-- /.box-body -->
		
							<div class="box-footer">
								<button type="submit" class="btn btn-secondary"><i class="fa fa-fw fa-save"></i> Save</button>
								<!--
								<input type="button" class="btn btn-success" value="Kembali" onclick="location.href='?module=<?php echo $module; ?>'">
								-->
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
