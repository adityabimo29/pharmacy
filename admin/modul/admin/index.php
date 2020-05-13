<?php
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
$aksi="modul/admin/aksi.php";
$hal = "Admin";
$module = "admin";
	
switch($_GET['act']){
	// Tampil Modul
	default:
	if ($_SESSION['leveladmin']!='admin'){
		echo "<script>window.alert('Hanya Super Admin yang memiliki akses halaman ini!'); window.location(home)</script>";
	}
?>
    <section class="content-header">
		<h1>Daftar <?php echo $hal; ?></h1>
		<ol class="breadcrumb">
			<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Daftar <?php echo $hal; ?></li>
		</ol>
    </section>
	
    <section class="content">
		<div class="row">
			<div class="col-xs-12">

          <div class="box box-body">
            <div class="box-header">
              <h3 class="box-title">Daftar <?php echo $hal; ?></h3>
            </div>
			<button class="btn bg-olive margin" onclick="window.location.href='admin-tambah';">Tambah <?php echo $hal; ?></button>
            <div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="30px">No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No Telpon</th>
                    <th>Level Admin</th>
                    <th>Terakhir Login</th>
                    <th width="180px" colspan="2">Aksi</th>
                  </tr>
                </thead>
                <tbody>
				<?php
					$no = 1;
					$tampil = $pdo->query("SELECT * FROM admin ORDER BY id ASC");
					while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
					$tanggal2=tgl2($r['last_login']);
				?>
					<tr>
						<td align="center"><?php echo  $no; ?></td>
						<td><?php echo $r['nama_lengkap']; ?></td>
						<td><?php echo $r['email']; ?></td>
						<td><?php echo $r['no_telp']; ?></td>
						<td><?php echo $r['level']; ?></td>
						<td><?php echo $tanggal2; ?></td>
						<td align="center">
							<a href="<?php echo $module; ?>-edit-<?php echo $r['id']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="width: 70px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i> Edit</a>
						
						<?php if($r['level']!="super admin"){ ?>
							<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/admin/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="width: 80px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
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
                    <th width="30px">No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No Telpon</th>
                    <th>Level Admin</th>
                    <th>Terakhir Login</th>
                    <th width="180px" colspan="2">Aksi</th>
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
	case "add":	
	if ($_SESSION['leveladmin']!='admin'){
		echo "<script>window.alert('Hanya Super Admin yang memiliki akses halaman ini!'); window.location(home)</script>";
	}
?>
	<section class="content">
	  <div class="row">
		<!-- left column -->
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Tambah Akun <?php echo $hal; ?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form role="form" action="modul/admin/aksi.php?module=admin&act=add" method="POST" enctype="multipart/form-data" >
				<div class="box-body table-responsive">
				
					<div class="form-group">
						<label for="exampleInputEmail1">Nama Lengkap</label>
						<input name="nama_lengkap" type="text" class="form-control">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input name="email" type="text" class="form-control">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">No Telpon</label>
						<input name="no_telp" type="text" class="form-control">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input name="username" type="text" class="form-control" required>
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">Password</label>
						<input name="password" type="password" class="form-control" required>
					</div>
					
					<div class="form-group">
						<label>Level Admin 
							</label>
						<select class="form-control" name="level">
							<!-- <option value="admin">Admin</option> -->
							<option value="gudang">Gudang</option>
							<option value="apoteker">Apoteker</option>
						</select>
					</div>
					
					<div class="form-group">
						<label>Status Admin</label>
						<select class="form-control" name="status">
							<option value="Aktif">Aktif</option>
							<option value="Blokir">Blokir</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="exampleInputFile">Gambar</label>
						<div class="photo">
							<input name="fupload" type="file" id="exampleInputFile">
						</div>
					</div>
					
				
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Update</button>
				</div>
			</form>
		  </div>
		</div>
	</section>
		
<?php
    break;
	case "edit":
	if ($_SESSION['leveladmin']!='super admin'){
		if ($_SESSION['idadmin']!=$_GET['id']){
			echo "<script>alert('Data Admin berhasil diedit'); window.location = 'home'</script>";
		}
	}
	$edit = $pdo->query("SELECT * FROM admin WHERE id='$_GET[id]'");
	$tedit = $edit->fetch(PDO::FETCH_ASSOC);
	
?>
	<section class="content">
	  <div class="row">
		<!-- left column -->
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Edit Akun <?php echo $hal; ?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form role="form" action="modul/admin/aksi.php?module=admin&act=update" method="POST" enctype="multipart/form-data" >
				<input type="hidden" name="id" value="<?php echo $tedit['id']; ?>">
				<input type="hidden" name="password_lama" value="<?php echo $tedit['password']; ?>">
				<div class="box-body table-responsive">
				
					<div class="form-group">
						<label for="exampleInputEmail1">Nama Lengkap</label>
						<input name="nama_lengkap" type="text" class="form-control" value="<?php echo $tedit['nama_lengkap']; ?>">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						<input name="email" type="text" class="form-control" value="<?php echo $tedit['email']; ?>">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">No Telpon</label>
						<input name="no_telp" type="text" class="form-control" value="<?php echo $tedit['no_telp']; ?>">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input name="username" type="text" class="form-control" value="<?php echo $tedit['username']; ?>">
					</div>
				
					<div class="form-group">
						<label for="exampleInputEmail1">Password</label>
						<input name="password" type="password" class="form-control" value="<?php echo $tedit['password']; ?>">
					</div>
					
					<div class="form-group">
						<label>Level Admin
							<span data-toggle="tooltip" title="Level Super Admin = level tertinggi di admin, admin ini memiliki semua akses halaman admin. Level Admin = Memiliki Hak Akses sama dengan Super Admin hanya saja tidak memiliki akses untuk menambah admin baru. Level Pewarta = Hanya memiliki akses untuk menambah dan Mengedit Berita." class="badge bg-light-blue" >?</span></label>
						<select class="form-control" name="level">
							<option value="admin" <?php if($tedit['level']=='admin'){echo "selected";}?>>Admin</option>
							<option value="pewarta" <?php if($tedit['level']=='pewarta'){echo "selected";}?>>Pewarta</option>
						</select>
					</div>
					
					<div class="form-group">
						<label>Status Admin</label>
						<select class="form-control" name="status">
							<option value="Aktif" <?php if($tedit['status']=='Aktif'){echo "selected";}?>>Aktif</option>
							<option value="Blokir" <?php if($tedit['status']=='Blokir'){echo "selected";}?>>Blokir</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="exampleInputFile">Gambar</label>
						<div class="photo">
							<p class="help-block"><a href="../images/<?php echo "admin/$tedit[gambar]"; ?>" target="_blank"><img src="../images/<?php echo "admin/$tedit[gambar]"; ?>" style="max-width:220px;" alt=""></a></p>
						
							<input name="fupload" type="file">
						</div>
					</div>
						
					<div class="form-group">
						<label for="exampleInputEmail1">Deskripsi</label>
						<textarea class="ckeditor" name="deskripsi"><?php echo $tedit['deskripsi']; ?></textarea>
					</div>
				
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Update</button>
				</div>
			</form>
		  </div>
		</div>
	</section>
		
<?php
    break;
	case "view":
	$edit = $pdo->query("SELECT * FROM admin WHERE id='$_GET[id]'");
	$tedit = $edit->fetch(PDO::FETCH_ASSOC);
?>
	<section class="content">
	  <div class="row">
		<!-- left column -->
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title">Detail Akun <?php echo $hal; ?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form role="form" action="modul/admin/aksi.php?module=admin&act=update" method="POST" enctype="multipart/form-data" >
				<div class="box-body table-responsive">
				
					<div class="col-md-2">
						<div class="form-group">
							<label for="exampleInputEmail1">Foto</label>
							<p class="help-block">
							<?php 
							if($tedit['gambar']!=''){
								echo '<img src="../images/admin/small/'.$tedit['gambar'].'" width="100%">';
							}else{
								echo '<img src="user-male-circle-filled.png" width="100%">';
							}
							?>
							</p>
						</div>
					</div>
				
					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Lengkap</label>
							<p class="help-block"><?php echo $tedit['nama_lengkap']; ?></p>
						</div>
					
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<p class="help-block"><?php echo $tedit['email']; ?></p>
						</div>
						
						<div class="form-group">
							<label>Level Admin</label>
							<p class="help-block"><?php echo $tedit['level']; ?></p>
						</div>
					</div>
					
					<div class="col-md-3">					
						<div class="form-group">
							<label for="exampleInputEmail1">Username</label>
							<p class="help-block"><?php echo $tedit['username']; ?></p>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">No Telpon</label>
							<p class="help-block"><?php echo $tedit['no_telp']; ?></p>
						</div>
						
						<div class="form-group">
							<label>Status Admin</label>
							<p class="help-block"><?php echo $tedit['status']; ?></p>
						</div>
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
