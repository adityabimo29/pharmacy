<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/pembelian/aksi.php";
	$hal = "pembelian";
	$module = "pembelian";

	switch($_GET['act']){
		case "list":
			$distributors = $pdo->query("SELECT kode_distributor,nama FROM distributor ")->fetchAll();
			
			
			// $_SESSION['pembelian'] = array();
			// $_SESSION['pembelian'][] = array(
			// 	 'kd'=>1,
			// 	'nm'=>'tono'
			// );
			// unset($_SESSION['pembelian']);  
			
		
	?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-success">
				<div class="box-header">
					<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
					<ol class="breadcrumb">
						<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active"><?php echo $hal; ?></li>
					</ol>
					<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=save"
					method="POST" enctype="multipart/form-data" >
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Tanggal</label>
								<input type="text" id='tanggal' name='tanggal' class='form-control'>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Distributor <span title="wajib" style="color: red;">*
								</label>
								<?php if(isset($_SESSION['pembelian']) && $_SESSION['pembelian'] != null) { ?>
									<input name="kode_distributor" id="selectuser_id"  class='form-control' value='<?php echo $_SESSION['pembelian'][0]['kode_distributor']  ?>' readonly>
								<?php }else{ ?>
									<input id="distributor-auto" class='form-control'>
									<input name="kode_distributor" id="selectuser_id" type='hidden' class='form-control'>
								<?php } ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Admin</label>
								<input type="text"  name='id_admin' class='form-control' value='<?php echo $_SESSION['namaadmin'] ?>' readonly>
							</div>
						</div>
					</div>
					

				</div><!-- /.box-header -->
				<div class="row">
					<div class="col-md-12">
					
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Tambah Pembelian</h3>
						</div>
						<div class="panel-body row">
							<div class="col-md-12">
								<table class='table table-bordered table-striped table-hover' id='animal'>
									<thead >
										<th>Kode</th>
										<th>Nama</th>
										<th>Stok</th>
										<th>#</th>
									</thead>
									<tbody>
										<tr>
										<td class='pilih-brg' dataku=0 >Plih Distributor </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					</div>
					<div class="col-md-12">
						<table class='table table-bordered table-striped'  >
							<thead>
								<tr>
									<th class="center">KD</th>
									<th class="center">OBAT</th>
									<th class="center">NO BATCH</th>
									<th class="center">QTY</th>
									<th class="center">ED</th>
									<th>H.BELI</th>
									<th>H.DISKON</th>
									<th>H.JUAL</th>
									<th class="center">#</th>
								</tr>
							</thead>
							<tbody id='kukuru'>
								<?php if(isset($_SESSION['pembelian'])) : 
									$no = 0;
									$total_harga =0;
									$total_barang = 0;
									$beli = 0;
									foreach($_SESSION['pembelian'] as $pembelian): 
									
									// if($pembelian['harga_diskon'] > 0){
									// 	$beli = $pembelian['harga_diskon'];
									// }else{
									// 	$beli = $pembelian['harga_beli'];
									// }
									$beli = str_replace(".","",$pembelian['harga_beli']);
									$total_barang += $pembelian['qty'];
									$total_harga += $beli * $pembelian['qty'];
								?>
									<tr>
										<td><?php echo $pembelian['kode_obat'] ?></td>
										<td><?php echo $pembelian['nama_obat'] ?></td>
										<td><?php echo $pembelian['no_batch'] ?></td>
										<td><?php echo $pembelian['qty'] ?></td>
										<td><?php echo $pembelian['expired'] ?></td>
										<td><?php echo $pembelian['harga_beli'] ?></td>
										<td><?php echo $pembelian['harga_diskon'] ?></td>
										<td><?php echo $pembelian['harga_jual'] ?></td>
										<td>
										<a href="pembelian-edit-<?php echo $no ?> " class='btn btn-primary btn-sm'  > <i class='fa fa-pencil-square '></i> </a>
										<a href="pembelian-hapus-<?php echo $no ?> " class='btn btn-danger btn-sm'  > <i class='fa fa-trash '></i> </a>
										</td>
									</tr>
									
								<?php $no++;endforeach; endif?>
								<input type="hidden" name='total_harga' value='<?php echo $total_harga ?>'>
								<input type="hidden" name='total_barang' value='<?php echo $total_barang ?>'>
							</tbody>
						</table>
						
					<button type="submit" class="btn btn-success btn-lg"><i class="fa fa-fw fa-save"></i> Tambah Stok</button>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function tayo(a){
		
		let kukuru = document.querySelector('#kukuru');
		let baris = document.createElement('TR');
		let dt1   = document.createElement('TD');
		dt1.innerHTML = a;
		baris.appendChild(dt1);
		kukuru.appendChild(baris);
	}
		
	$(document).ready(function () {
		$("#tanggal").datepicker().datepicker("setDate", new Date());
		// let barangku = document.querySelector('.pilih-brg');
		// 		barangku.addEventListener('click', function () {
		// 			alert('adssa');
		// }
		// )
		<?php
		if(!isset($_SESSION['pembelian']) || $_SESSION['pembelian'] == null){
		$z = array();
		foreach($distributors as $item) {
				//array_push($z,$item);
				$z[] = array('value' => $item['kode_distributor'], 'label' => $item['kode_distributor'].
					" - ".$item['nama']);
			} ?>

		$("#distributor-auto").autocomplete({
			source: <?php echo json_encode($z) ?>,
			select: function (event, ui) {
				// Set selection
				$('#distributor-auto').val(ui.item.label); // display the selected text
				$('#selectuser_id').val(ui.item.value); // save selected id to input
				var id = ui.item.value;
				$("#animal").dataTable({
					"destroy": true,
					'bProcessing': true,
					'bServerSide': true,
		
					//disable order dan searching pada tombol aksi
					"columnDefs": [ {
					"targets": [0,3],
					"orderable": false,
					"searchable": false
		
					} ],
					"ajax":{
					url :"modul/pembelian/obat.php",
					data : {id:id},
					type: "post", 
				error: function (xhr, error, thrown) {
					console.log(xhr);
		
					}
				},
		
				});
				
				return false;
			}
		});
	<?php } else{ ?>
		var id = "<?php echo $_SESSION['pembelian'][0]['kode_distributor'] ?>";
		$("#animal").dataTable({
					"destroy": true,
					'bProcessing': true,
					'bServerSide': true,
		
					//disable order dan searching pada tombol aksi
					"columnDefs": [ {
					"targets": [0,3],
					"orderable": false,
					"searchable": false
		
					} ],
					"ajax":{
					url :"modul/pembelian/obat.php",
					data : {id:id},
					type: "post", 
				error: function (xhr, error, thrown) {
					console.log(xhr);
		
					}
				},
		
				});
	<?php } ?>

	});
</script>
<?php
	break;
	case "add":
	$kd=$_GET['kd'];
	
	$obat  = $pdo->query("SELECT * FROM obat WHERE kode_obat = '$kd' ")->fetch();
	if(!isset($obat['kode_obat'])){
		echo "<script>window.location = 'pembelian'</script>";
	}

		if(isset($_SESSION['pembelian']) || $_SESSION['pembelian'] != null){
		$count = count($_SESSION['pembelian']);
		for($i=0;$i < $count;$i++){
			if($kd === $_SESSION['pembelian'][$i]['kode_obat']){
				echo "<script>window.location = 'pembelian-edit-$i'</script>";
			}
		}
		}
		
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
								<label for="exampleInputEmail1">Kode Obat<span title="wajib"
										style="color: red;">*</span></label>
								<input name="kode_obat"  type="text" class="form-control" value='<?php echo $obat['kode_obat'] ?>' readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Obat</label>
								<input type="text"  class='form-control' value='<?php echo $obat['nama_obat'] ?>'
									readonly>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">No Batch <span title="wajib"
										style="color: red;">*</span></label>
								<input name="no_batch" type="text" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Qty <span title="wajib"
										style="color: red;">*</span></label>
								<input name="qty" type="number" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Beli (Satuan) <span title="wajib"
										style="color: red;">*</span></label>
								<input name="harga_beli" type="number" class="form-control  hbeli" placeholder='1000'  required>
								<small> <span style="color:red">*</span>) Input Nilai Menggunakan angka bulat . ex : 1000</small>
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Diskon </span></label>
								<input name="harga_diskon" type="number" class="form-control u" placeholder="500">
								<small> <span style="color:red">*</span>) Input Nilai Menggunakan angka bulat . ex : 500</small>
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label style="margin-top: 10px" for="exampleInputEmail1">Expired <span title="wajib"
										style="color: red;">*</span></label>
								<input name="expired" type="text" class="form-control" placeholder='12/20' required>
								<p class="help-block">*) mm/yy</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label style="margin-top: 10px" for="exampleInputEmail1">Harga Jual <span title="wajib"
										style="color: red;">*</span></label>
								<input name="harga_jual" type="number" class="form-control  hjual" placeholder="1500" required>
								<small> <span style="color:red">*</span>) Input Nilai Menggunakan angka bulat . ex : 1500</small>
							</div>
							
						</div>

					</div>
					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
								class="fa fa-fw fa-backward"></i> Back</a>

						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Tambah Barang</button>
					</div>
				</form>
			</div>
		</div>
</section>
<script type="text/javascript">
	let hbeli = document.querySelector('.hbeli');
	let beliku = 0;
	let hjual = document.querySelector('.hjual');
	let jualku = 0;
	hbeli.addEventListener('change', function(){
		beliku = this.value;
		
	});

	hjual.addEventListener('change', function() {
		jualku = this.value;

		if(hbeli.value > jualku){
			alert("Harga Jual Lebih Rendah !");
			this.value = '';
			this.focus();
		}
		
	})


</script>
<?php
	break;
	case "print":
	if(!isset($_SESSION['PRINT_PEMBELIAN'])){
		echo "<script>window.location = 'pembelian'</script>";
	}
		
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
					</ol>
				</div>

				<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=printPembelian"
					method="POST" enctype="multipart/form-data">
					<div class="box-body table-responsive">
						<p class="alert alert-info">Input Pembelian Berhasil Dilakukan !</p>
					</div>
					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
								class="fa fa-fw fa-backward"></i> Kembali</a>

						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Download Faktur Pembelian</button>
					</div>
				</form>
			</div>
		</div>
</section>
<?php
	break;
	case "editBarang":
	$kd=$_GET['kd'];
	
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

				<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=updateBarang"
					method="POST" enctype="multipart/form-data">
					<div class="box-body table-responsive">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Obat<span title="wajib"
										style="color: red;">*</span></label>
								<input type="hidden" name ='kodeku' value='<?php echo $kd ?>' >
								<input type="hidden" name ='kode_distributor' value='<?php echo $_SESSION['pembelian'][$kd]['kode_distributor'] ?>' >
								<input name="kode_obat"  type="text" class="form-control" value='<?php echo $_SESSION['pembelian'][$kd]['kode_obat'] ?>' readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Obat</label>
								<input type="text" name='nama_obat'  class='form-control' value='<?php echo $_SESSION['pembelian'][$kd]['nama_obat'] ?>'
									readonly>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">No Batch <span title="wajib"
										style="color: red;">*</span></label>
								<input name="no_batch" type="text" class="form-control" required value='<?php echo $_SESSION['pembelian'][$kd]['no_batch'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Qty <span title="wajib"
										style="color: red;">*</span></label>
								<input name="qty" type="number" class="form-control" required value='<?php echo $_SESSION['pembelian'][$kd]['qty'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Beli <span title="wajib"
										style="color: red;">*</span></label>
								<input name="harga_beli" type="number" class="form-control uang hbeli" required value='<?php echo $_SESSION['pembelian'][$kd]['harga_beli'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Diskon </span></label>
								<input name="harga_diskon" type="number" class="form-control uang" value='<?php echo $_SESSION['pembelian'][$kd]['harga_diskon'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Expired <span title="wajib"
										style="color: red;">*</span></label>
								<input name="expired" type="text" class="form-control" placeholder='12/20' required value='<?php echo $_SESSION['pembelian'][$kd]['expired'] ?>'>
								<p class="help-block">*) mm/yy</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Jual <span title="wajib"
										style="color: red;">*</span></label>
								<input name="harga_jual" type="number" class="form-control uang jual" required value='<?php echo $_SESSION['pembelian'][$kd]['harga_jual'] ?>'>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
								class="fa fa-fw fa-backward"></i> Back</a>

						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Update Barang</button>
					</div>
				</form>
			</div>
		</div>
</section>
<script type="text/javascript">
	document.querySelector(".hbeli").addEventListener("change",function () {
  	$('.jual').attr('min', $(this).value());
})
</script>
<?php
		break;
		case "hapusBarang":
			$kd=$_GET['kd'];
			unset($_SESSION['pembelian'][$kd]);
		
			echo "<script>window.location = 'pembelian'</script>";
	?>
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

				<form role="form"
					action='modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=import'
					name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" method='post'>

					<div class="box-body table-responsive">

						<div class="col-md-6">
							<div class="form-group">
								<label>Choose Excel File</label>
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
		$edit = $pdo->query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
		$tedit = $edit->fetch(PDO::FETCH_ASSOC);
		$distributors = $pdo->query("SELECT * FROM distributor ")->fetchAll();
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
					<input type="hidden" name="id_pembelian" value="<?php echo $tedit['id_pembelian']; ?>">

					<div class="box-body table-responsive">

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode pembelian <span title="wajib"
										style="color: red;">*</span></label>
								<input name="kode_pembelian" type="text" class="form-control"
									value="<?php echo $tedit['kode_pembelian'] ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama pembelian <span title="wajib"
										style="color: red;">*</span></label>
								<input name="nama_pembelian" type="text" class="form-control"
									value="<?php echo $tedit['nama_pembelian'] ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Distributor <span title="wajib"
										style="color: red;">*</span></label>
								<input id="distributor-auto" class='form-control'
									value=<?php echo $tedit['kode_distributor'] ?>>
								<input name="kode_distributor" id="selectuser_id" type='hidden' class='form-control'>
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
<script type="text/javascript">
	$(document).ready(function () {

		<
		? php
		$z = array();
		foreach($distributors as $item) {
				//array_push($z,$item);
				$z[] = array('value' => $item['kode_distributor'], 'label' => $item['kode_distributor'].
					" - ".$item['nama']);
			} ?
			>
			var datas = < ? php echo json_encode($z) ? > ;
		$("#distributor-auto").autocomplete({
			source: datas,
			select: function (event, ui) {
				// Set selection
				$('#distributor-auto').val(ui.item.label); // display the selected text
				$('#selectuser_id').val(ui.item.value); // save selected id to input
				return false;
			}
		});
	});
</script>
<?php
	break;
	case "view":
	$edit = $pdo->query("SELECT * FROM pembelian WHERE id_pembelian='$_GET[id]'");
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

					<a href="<?php echo $module; ?>-edit-<?php echo $tedit['id_pembelian']; ?>" type="button"
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
												<label for="exampleInputEmail1">Judul pembelian</label>
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
															href="../images/<?php echo "pembelian/$tedit[gambar]"; ?>"
															target="_blank"><img
																src="../images/<?php echo "pembelian/small/$tedit[gambar]"; ?>"
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
					<h1 style="text-transform: capitalize;">Semua Produk di pembelian <?php echo $tedit['judul']; ?>
					</h1>
				</div>

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="30px" class="center">No</th>
								<th class="center">Judul</th>
								<th class="center">pembelian</th>
								<th class="center">Gambar</th>
								<th class="center">Status</th>
								<th class="center">Date</th>
								<th width="180px" class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								$tampil = $pdo->query("SELECT k.judul as jk,p.* FROM pembelian k,produk p WHERE p.id_pembelian=k.id_pembelian AND p.id_pembelian='$_GET[id]' ORDER BY p.tgl DESC");
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
								<th class="center">pembelian</th>
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