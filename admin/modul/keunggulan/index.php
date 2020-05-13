<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/keunggulan/aksi.php";
	$hal = "keunggulan";
	$module = "keunggulan";

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
				
				<button class="btn bg-gray margin besar" onclick="window.location.href='<?php echo $module; ?>-add';"><i class="fa fa-plus" aria-hidden="true"></i> Tambah keunggulan</button>
			</div>
		
			<div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
				<thead>
				  <tr>
					<th width="5" class="center">No</th>
					<th class="center">Judul</th>
					<th class="center">Gambar</th>
					<th class="center">Urutan</th>
					<th class="center">Status</th>
					<th width="200px" class="center">Aksi</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$tampil = $pdo->query("SELECT * from keunggulan ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
				while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
				?>
					<tr>
						<td align="center"><?php echo  $no; ?></td>
						<td><?php echo $r['judul']; ?></td>
						<td align="center"><img src="../images/<?php echo "keunggulan/$r[gambar]"; ?>" height="100px" alt=""></td>
						<td align="center"><?php echo $r['urutan']; ?></td>
						<td align="center" style="text-transform: capitalize;"><?php echo  $r['status']; ?></td>
						
						<td align="center">
							<a href="<?php echo $module; ?>-edit-<?php echo $r['id_keunggulan']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 100px;margin-bottom: 5px;" title="Edit keunggulan"><i class="fa fa-fw fa-edit"></i> Edit</a>
							
							<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/keunggulan/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_keunggulan']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 100px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
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
					<th class="center">Gambar</th>
					<th class="center">Urutan</th>
					<th class="center">Status</th>
					<th width="200px" class="center">Aksi</th>
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
						<div class="form-group">
							<label for="exampleInputFile">Gambar</label>
							<div class="photo">
							
							<input name="fupload" type="file" id="exampleInputFile">
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
	$edit = $pdo->query("SELECT * FROM keunggulan WHERE id_keunggulan='$_GET[id]'");
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
				<input type="hidden" name="id_keunggulan" value="<?php echo $tedit['id_keunggulan']; ?>">
				
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
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Urutan</label>
							<input name="urutan" type="text" class="form-control" value="<?php echo $tedit['urutan']; ?>" maxlength="5">
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputFile">Gambar</label>
							<div class="photo">
								<p class="help-block"><a href="../images/<?php echo "keunggulan/$tedit[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "keunggulan/small/$tedit[gambar]"; ?>" width="220px" alt=""></a></p>
							
								<?php if($tedit['gambar']!=""){ ?>
								<a href="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=romoveimg&id=<?php echo $tedit['id_keunggulan']; ?>">Hapus Gambar</a>
								<?php } ?>
							<input name="fupload" type="file">
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
	}
}
?>
