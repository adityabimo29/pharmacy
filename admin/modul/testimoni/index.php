<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	$aksi="modul/testimoni/aksi.php";
	$hal = "Testimoni";
	$_SESSION['halaman'] = $hal;
	$module = "testimoni";

	switch($_GET['act']){
		case "list":
	?>
	<section class="content">
		<div class="row"><div class="col-md-12">

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
					<th width="30px" class="center">No</th>
					<th class="center">Nama</th>
					<th class="center">Gambar</th>
					<th class="center">Status</th>
					<th class="center">Tanggal</th>
					<th width="180px"  class="center">Aksi</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$tampil = $pdo->query("SELECT * FROM testimoni ORDER BY tgl DESC");
				while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<td align="center"><?php echo  $no; ?></td>
					<td><?php echo  $r['nama']; ?></td>
					<td align="center"><div style="max-height:120px;overflow: hidden;"><a href="../images/<?php echo "testimoni/$r[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "testimoni/small/$r[gambar]"; ?>" style="max-width: 150px;" alt=""></a></td>
					<td align="center" class="besar"><?php echo  $r['status']; ?></td>
					<td align="center"><?php echo  tgl2($r['tgl']); ?></td>
					
					<td align="center">
						<a href="<?php echo $module; ?>-edit-<?php echo $r['id_testimoni']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
						
						<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_testimoni']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 90px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
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
					<th class="center">Nama</th>
					<th class="center">Gambar</th>
					<th class="center">Status</th>
					<th class="center">Date</th>
					<th width="180px"  class="center">Tanggal</th>
				  </tr>
				</tfoot>
			  </table>
			</div>

		</div></div>
	</section>
			
	<?php
	break;
	case "add":
	
	date_default_timezone_set('Asia/Jakarta');
	$tgl = date("d-m-Y");
	$time = date("H:i");
	?>
	<section class="content">
	  <div class="row">
		<div class="col-md-12">
		  <div class="box box-primary">
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
							<label for="exampleInputEmail1">Status</label>
							<select name="status" class="form-control">
								<option value="aktif">Aktif</option>
								<option value="tidak aktif">Tidak Aktif</option>
							</select>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Nama</label>
							<input name="nama" type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-12 nopadding">
							<div class="col-md-6 col-xs-6 nopadding">
							<div class="form-group">
								<label for="exampleInputEmail1">Publish Date & Time</label>
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
							<label for="exampleInputFile">Gambar</label>
							<div class="photo">
								<input name="fupload" type="file" id="exampleInputFile">
							</div>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Testimoni</label>
							<textarea name="deskripsi" style="width: 100%;height: 100px;"></textarea>
						</div>
					</div>
					
				</div>

				<div class="box-footer">
					<a href="<?php echo $module; ?>" type="button" class="btn btn-success" ><i class="fa fa-fw fa-backward"></i> Back</a>

					<button type="submit" class="btn btn-secondary"><i class="fa fa-fw fa-save"></i> Save</button>
				</div>
			</form>
		  </div>
		</div>
	</section>
		
	<?php
	break;
	case "edit":
	$edit = $pdo->query("SELECT * FROM testimoni WHERE id_testimoni='$_GET[id]'");
	$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	
	$thn=substr($tedit['tgl'],0,4);
	$bln=substr($tedit['tgl'],5,2);
	$tgl=substr($tedit['tgl'],8,2);
	$tgl_post = "$tgl/$bln/$thn";
	
	$time=substr($tedit['tgl'],11,5);	
	?>
	<section class="content">
	  <div class="row">
		<div class="col-md-12">
		  <div class="box box-primary">
			<div class="box-header">
				<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
				<ol class="breadcrumb">
					<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="<?php echo $module; ?>"><?php echo $hal; ?></a></li>
					<li class="active">Edit</li>
				</ol>
			</div>
			
			<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=update" method="POST" enctype="multipart/form-data" >
				<input type="hidden" name="id_testimoni" value="<?php echo $tedit['id_testimoni']; ?>">
				
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
							<label for="exampleInputEmail1">Nama</label>
							<input name="nama" type="text" class="form-control" value="<?php echo $tedit['nama']; ?>">
						</div>
					</div>
						
					<div class="col-md-6">
						<div class="col-md-12 nopadding">
							<div class="col-md-6 col-xs-6 nopadding">
							<div class="form-group">
								<label for="exampleInputEmail1">Publish Date & Time</label>
								<div class="input-group">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input name="tgl" type="text" class="form-control" value="<?php echo $tgl_post; ?>"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
								</div>
							</div>
							</div>
							<div class="col-md-6 col-xs-6 nopadding">
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
							<label for="exampleInputFile">Gambar</label>
							<div class="photo">
								<p class="help-block"><a href="../images/<?php echo "testimoni/$tedit[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "testimoni/$tedit[gambar]"; ?>" style="max-width:220px;" alt=""></a></p>
							
								<input name="fupload" type="file">
							</div>
						</div>
					</div>
					
					<div class="col-md-12">						
						<div class="form-group">
							<label for="exampleInputEmail1">Testimoni</label>
							<textarea name="deskripsi" style="width: 100%;height: 100px;"><?php echo $tedit['deskripsi']; ?></textarea>
						</div>
					</div>

					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-success" ><i class="fa fa-fw fa-backward"></i> Back</a>

						<button type="submit" class="btn btn-secondary"><i class="fa fa-fw fa-save"></i> Update</button>
					</div>
				</div>
			</form>
		  </div>
		</div>
	</section>
			
			
			
	<?php
		break;  
	}
}
?>
