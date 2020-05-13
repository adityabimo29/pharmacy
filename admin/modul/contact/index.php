<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/contact/aksi.php";
	$hal = "Contact";
	$module = "contact";

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
					</div><!-- /.box-header -->
				
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th width="2%" class="center">No</th>
							<th class="center">Nama</th>
							<th class="center">Email</th>
							<th class="center">Status</th>
							<th class="center">Tanggal Masuk</th>
							<th  class="center">Aksi</th>
						  </tr>
						</thead>
						<tbody>
						<?php
						$no = 1;
						$tampil = $pdo->query("SELECT * from contact ORDER BY id_contact ASC");
						while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
						?>
							<tr>
								<td align="center"><?php echo  $no; ?></td>
								<td><?php echo $r['name']; ?></td>
								<td align="center"><?php echo  $r['email']; ?></td>
								<td align="center"><?php echo  $r['status']; ?></td>
								<td align="center"><?php echo  tgl2($r['tgl_masuk']); ?></td>
								
								<td align="center">
									<a href="<?php echo $module; ?>-edit-<?php echo $r['id_contact']; ?>" class="btn btn-success btnadmin" role="button" aria-pressed="true" style="min-width: 50px;margin-bottom: 5px;"><i class="fa fa-fw fa-edit"></i> View</a>
									
									<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $r['id_contact']; ?>"  class="btn btn-danger btnadmin" role="button" aria-pressed="true" style="min-width: 60px;margin-bottom: 5px;"><i class="fa fa-fw fa-trash"></i> Delete</a>
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
			</section><!-- /.col -->
			
		
	<?php
		break;
		case "edit":
		$edit = $pdo->query("SELECT * FROM contact WHERE id_contact='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		
		
		$sql = "UPDATE contact SET status = 'Readed' WHERE id_contact 	= :id_contact";
		$statement = $pdo->prepare($sql);
		$statement->bindParam(":id_contact", $_GET["id"], PDO::PARAM_INT);
		$count = $statement->execute();
	?>
			<section class="content">
			  <div class="row">
				<!-- left column -->
				<div class="col-md-6">
				  <div class="box box-black">
					<div class="box-header">
						<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
						<ol class="breadcrumb">
							<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
							<li><a href="contact">Contact</a></li>
							<li class="active">Read Contact</li>
						</ol>
					</div><!-- /.box-header -->
					<div class="box-body no-padding">
					  <div class="mailbox-read-info">
						<table>
							<tr>
								<td>Nama</td><td width="10px">:</td><td><?php echo $tedit['name']; ?></td>
							</tr>
							<tr>
								<td>Subject</td><td width="10px">:</td><td><?php echo $tedit['subject']; ?></td>
							</tr>
							<tr>
								<td>Email</td><td>:</td><td><?php echo $tedit['email']; ?></td>
							</tr>
							<tr>
								<td>Tanggal Masuk</td><td>:</td><td><?php echo tgl2($tedit['tgl_masuk']); ?></td>
							</tr>
							<tr>
								<td>Message</td><td>:</td><td><?php echo $tedit['message']; ?></td>
							</tr>
						</table>
						
					  </div><!-- /.mailbox-read-info -->
					  <div class="mailbox-read-message">
						<?php //echo $tedit['note']; ?>
					  </div><!-- /.mailbox-read-message -->
					</div><!-- /.box-body -->
					<div class="box-footer">
					  <!-- <div class="pull-right">
						<button class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
						<button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
					  </div> -->					  
						<a href="contact" type="button" class="btn btn-success" ><i class="fa fa-fw fa-backward"></i> Back</a>
						
						<a onClick="javascript: return confirm('Data yang Sudah di Hapus TIDAK BISA Dikembalikan Kembali. Apakah Anda yakin ingin Menghapus Data Ini!!');" href="modul/contact/aksi.php?module=<?php echo $module; ?>&act=remove&id=<?php echo $tedit['id_contact']; ?>" title="Hapus"><button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button></a>
					  <!-- <button class="btn btn-default"><i class="fa fa-print"></i> Print</button> -->
					</div><!-- /.box-footer -->
				  </div><!-- /. box -->
				</div>
			</section>
			
			
			
	<?php
		break;  
	}
}
?>
