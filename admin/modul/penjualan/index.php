<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	
	$aksi="modul/penjualan/aksi.php";
	$hal = "penjualan";
	$module = "penjualan";

	switch($_GET['act']){
		case "list":
			$distributors = $pdo->query("SELECT kode_distributor,nama FROM distributor ")->fetchAll();
			$_SESSION['print_penjualan'] = array();  
			
			// $_SESSION['penjualan'] = array();
			// $_SESSION['penjualan'][] = array(
			// 	 'kd'=>1,
			// 	'nm'=>'tono'
			// );
			// unset($_SESSION['penjualan']);  
			
		
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
					<!-- <form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=save"
					method="POST" enctype="multipart/form-data" > -->
					

				</div><!-- /.box-header -->
				<div class="row">
					<div class="col-md-6">
					
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Tambah penjualan</h3>
						</div>
						<div class="panel-body row">
							<div class="col-md-12">
								<table class='table table-bordered table-striped table-hover' id='animal'>
									<thead >
										<th>Kode</th>
										<th>Nama</th>
										<th>Stok</th>
										<th>Harga</th>
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
					<div class="col-md-6">
						<table class='table table-bordered table-striped korok'  >
							<thead>
								<tr>
									<th class="center">KD</th>
									<th class="center">OBAT</th>
									<th class="center">QTY</th>
									<th class="center">#</th>
								</tr>
							</thead>
							<tbody id='kukuru'>
								
								
								<input type="hidden" name='total_harga' value='<?php echo $total_harga ?>'>
								<input type="hidden" name='total_barang' value='<?php echo $total_barang ?>'>
							</tbody>
						</table>
					</div>
					<div class="col-md-3 col-md-offset-7 " style='margin-bottom:10px'>
				
					<a   class='btn btn-warning btn-lg btn-block byr'  ><i class="fa fa-fw fa-save"></i> Bayar</a>
				
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


		// Jika Barang baru ditambah ,qty barang ditable kanan tetap tersimpan / update qty sementara
		$('.korok tbody').on('change keyup input','.val-temp', function(){
			let current = $(this).closest('tr');
			var col1= current.find('td:eq(0)').text();
			var col2= current.find('td:eq(2)').find('input').val();
			for(let i = 0 ; i < dataset.length; i++){
				if(dataset[i][0] === col1){
					stoki = dataset[i][6];
					dataset[i][2] = "<input type='number' value='"+col2+"' min='1' class='val-temp' onKeyUp='if(this.value >"+ stoki +"){this.value='"+ stoki +"';}else if(this.value<0){this.value='0';} />";
					dataset[i][4] = col2;
				}
			}
			
		});

		// Hapus Barang
		$('.korok tbody').on('click','.hps', function(){
			let current = $(this).closest('tr');
			var col1= current.find('td:eq(0)').text();
			var col2= current.find('td:eq(2)').find('input').val();
			for(let i = 0 ; i < dataset.length; i++){
				if(dataset[i][0] === col1){
					dataset.splice(i,1);
				}
			}
			$('.korok').DataTable( {
				destroy: true,
				data: dataset,
				columns: [
					{ title: "KD" },
					{ title: "OBAT" },
					{ title: "QTY" },
					{ title: "#" }
				]
			} );
		});
		<?php
		unset($_SESSION['penjualan']);
		?>
		var dataset = <?php echo (!empty($_SESSION['penjualan'])) ? json_encode($_SESSION['penjualan']) : "[]" ?>;

		
		var kdku= [];
		var korok = $('.korok').DataTable( {
				destroy: true,
				data: dataset,
				columns: [
					{ title: "KD" },
					{ title: "OBAT" },
					{ title: "QTY" },
					{ title: "#" }
				]
			} );

		// Bayar Obat
		$(".byr").click(function(){
			
			if(dataset.length > 0){
				var myJSONText = JSON.stringify( dataset );
				$.ajax({ 
				type: "POST", 
				url: "modul/penjualan/temp_penj.php", 
				data: { dataTemp : myJSONText }, 
				success: function(data) { 
					location.href = "penjualan-add";
					
				 } 
		 		});

			}else{
				location.href = "penjualan";
			}
			 
			
			
		
		});
		onKeyUp=""
		$('#animal tbody').on('click','.pilih', function(){
			let current = $(this).closest('tr');
			var col1= current.find('td:eq(0)').text();
			var col2= current.find('td:eq(1)').text();
			var stoki= current.find('td:eq(2)').text();
			var col3= "<input type='number' value='1' min='1' max='" + stoki + "' class='val-temp'  /> ";
			var col4= "<a class='btn btn-danger btn-sm hps '><i class='fa fa-trash'></i></a>";
			var col5= 1;
			var col6= current.find('td:eq(3)').text();
			for(let i = 0 ; i < dataset.length; i++){
				if(dataset[i][0] === col1){
					return false
				}
			}
			var data = [];
			data.push(col1,col2,col3,col4,col5,col6,stoki);
			dataset.push(data);
			kdku.push(col1);
			$('.korok').DataTable( {
				destroy: true,
				data: dataset,
				columns: [
					{ title: "KD" },
					{ title: "OBAT" },
					{ title: "QTY" },
					{ title: "#" }
				]
			} );
			
		});
		

		$("#tanggal").datepicker().datepicker("setDate", new Date());


	});

	$("#animal").dataTable({
					"destroy": true,
					'bProcessing': true,
					'bServerSide': true,
		
					//disable order dan searching pada tombol aksi
					"columnDefs": [ {
					"targets": [0,4],
					"orderable": false,
					"searchable": false
		
					} ],
					"ajax":{
					url :"modul/penjualan/obat.php",
					type: "post", 
				error: function (xhr, error, thrown) {
					console.log(xhr);
		
					}
				},
		
				});
</script>
<?php
	break;
	case "add":
	
	
	// $obat  = $pdo->query("SELECT * FROM obat WHERE kode_obat = '$kd' ")->fetch();
	if(!isset($_SESSION['penjualan'])){
		echo "<script>window.location = 'penjualan'</script>";
	}
		$total = 0;
		$tot_obat = 0;
		if(isset($_SESSION['penjualan']) || $_SESSION['penjualan'] != null){
			foreach($_SESSION['penjualan'] as $data) {
				$sub = ($data['qty'] * $data['harga']) + 1000;
				$total += $sub;
				$tot_obat += $data['qty'];
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

				<form role="form" action="modul/<?php echo $module; ?>/aksi.php?module=<?php echo $module; ?>&act=save"
					method="POST" enctype="multipart/form-data">
					<div class="box-body table-responsive">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Tanggal<span title="wajib"
										style="color: red;">*</span></label>
								<input name="tanggal" id='tanggal'  type="text" class="form-control" >
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Resep</label>
								<select name="resep" id="resep" class='form-control'>
									<option value="tidak">Tidak</option>
									<option value="ya">Ya</option>
									
								</select>
							</div>
						</div>
						
						<div id='copo' style='display:none'>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Pelanggan<span title="wajib"
										style="color: red;">*</span></label>
								<input name="nama_pelanggan"  type="text" class="form-control" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Dokter</label>
								<input name="dokter"  type="text" class="form-control" >
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Asal RS <span title="wajib"
										style="color: red;">*</span></label>
										<input name="asal_rs"  type="text" class="form-control" >
							</div>
						</div>


						</div>


						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Biaya Racik </label>
								<input name="biaya_racik" type="number" class="form-control" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Biaya Resep <span title="wajib"
										style="color: red;">*</span></label>
								<input name="biaya_resep" type="number" class="form-control" required>
								<input name="total_biaya" type="hidden" class="form-control " readonly value="<?php echo $total ?>">
								<input name="total_obat" type="hidden" class="form-control " readonly value="<?php echo $tot_obat ?>">
							</div>
						</div>
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Total Biaya </span></label>
								<input name="total_biaya" type="number" class="form-control totti" readonly value="<?php echo $total ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Dibayar </span></label>
								<input name="total_biaya" type="number" class="form-control dbr"  value="<?php echo $total ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kembali </span></label>
								<input name="kembali" id='kbl' type="number" class="form-control dbr"  value="0">
							</div>
						</div> -->
					</div>
					<div class="box-footer">
						<a href="<?php echo $module; ?>" type="button" class="btn btn-secondary"><i
								class="fa fa-fw fa-backward"></i> Back</a>

						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
</section>
<script type="text/javascript">
	
	$(document).ready(function () {

		$("#tanggal").datepicker().datepicker("setDate", new Date());
		$('.dbr').on('change keyup input', function(){
			var  t_harga = $('.totti').val();
			var  bayar = $(this).val();
			var res = bayar - t_harga;
			$('#kbl').val(res);
		});

		$('#resep').on('change', function(){
			//alert($(this).val());
			if($(this).val() === 'tidak'){
				$("#copo").css({ 'display' : 'none' });
			}else{
				$("#copo").css({ 'display' : 'block' });
			}
			
		});

	});
</script>
<?php
	break;
	case "print":
	
	
	?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="modul/penjualan/style.css">
		<!-- <style>@page { size: 58mm 100mm }</style> -->
        <title>Struk Penjualan</title>
    </head>
    <body class="receipt">
        <div class="ticket sheet padding-10mm">
            <!-- <img src="./logo.png" alt="Logo"> -->
            <p class="centered">Faktur Penjualan
                <br><?php echo $namaweb ?>
                <br><?php echo $deskrip[2] ?></p>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Q.</th>
                        <th class="description">Description</th>
                        <th class="price">$$</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['print_penjualan'] as $row) : ?>
                    <tr>
                        <td class="quantity"><?php echo $row['qty'] ?></td>
                        <td class="description"><?php echo $row['nama_obat'] ?></td>
                        <td class="price"><?php echo $row['sub_total'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <p class="centered">Terima Kasih Telah Membeli
                <br><?php echo $namaweb ?></p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <script src="modul/penjualan/script.js"></script>
    </body>
</html>

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
								<input type="hidden" name ='kode_distributor' value='<?php echo $_SESSION['penjualan'][$kd]['kode_distributor'] ?>' >
								<input name="kode_obat"  type="text" class="form-control" value='<?php echo $_SESSION['penjualan'][$kd]['kode_obat'] ?>' readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama Obat</label>
								<input type="text" name='nama_obat'  class='form-control' value='<?php echo $_SESSION['penjualan'][$kd]['nama_obat'] ?>'
									readonly>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">No Batch <span title="wajib"
										style="color: red;">*</span></label>
								<input name="no_batch" type="number" class="form-control" required value='<?php echo $_SESSION['penjualan'][$kd]['no_batch'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Qty <span title="wajib"
										style="color: red;">*</span></label>
								<input name="qty" type="number" class="form-control" required value='<?php echo $_SESSION['penjualan'][$kd]['qty'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Beli <span title="wajib"
										style="color: red;">*</span></label>
								<input name="harga_beli" type="number" class="form-control" required value='<?php echo $_SESSION['penjualan'][$kd]['harga_beli'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Diskon </span></label>
								<input name="harga_diskon" type="number" class="form-control" value='<?php echo $_SESSION['penjualan'][$kd]['harga_diskon'] ?>'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Expired <span title="wajib"
										style="color: red;">*</span></label>
								<input name="expired" type="text" class="form-control" placeholder='12/20' required value='<?php echo $_SESSION['penjualan'][$kd]['expired'] ?>'>
								<p class="help-block">*) mm/yy</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Harga Jual <span title="wajib"
										style="color: red;">*</span></label>
								<input name="harga_jual" type="number" class="form-control" required value='<?php echo $_SESSION['penjualan'][$kd]['harga_jual'] ?>'>
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

<?php
		break;
		case "hapusBarang":
			$kd=$_GET['kd'];
			unset($_SESSION['penjualan'][$kd]);
		
			echo "<script>window.location = 'penjualan'</script>";
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
		$edit = $pdo->query("SELECT * FROM penjualan WHERE id_penjualan='$_GET[id]'");
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
					<input type="hidden" name="id_penjualan" value="<?php echo $tedit['id_penjualan']; ?>">

					<div class="box-body table-responsive">

						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode penjualan <span title="wajib"
										style="color: red;">*</span></label>
								<input name="kode_penjualan" type="text" class="form-control"
									value="<?php echo $tedit['kode_penjualan'] ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Nama penjualan <span title="wajib"
										style="color: red;">*</span></label>
								<input name="nama_penjualan" type="text" class="form-control"
									value="<?php echo $tedit['nama_penjualan'] ?>" required>
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
	$edit = $pdo->query("SELECT * FROM penjualan WHERE id_penjualan='$_GET[id]'");
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

					<a href="<?php echo $module; ?>-edit-<?php echo $tedit['id_penjualan']; ?>" type="button"
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
												<label for="exampleInputEmail1">Judul penjualan</label>
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
															href="../images/<?php echo "penjualan/$tedit[gambar]"; ?>"
															target="_blank"><img
																src="../images/<?php echo "penjualan/small/$tedit[gambar]"; ?>"
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
					<h1 style="text-transform: capitalize;">Semua Produk di penjualan <?php echo $tedit['judul']; ?>
					</h1>
				</div>

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="30px" class="center">No</th>
								<th class="center">Judul</th>
								<th class="center">penjualan</th>
								<th class="center">Gambar</th>
								<th class="center">Status</th>
								<th class="center">Date</th>
								<th width="180px" class="center">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								$tampil = $pdo->query("SELECT k.judul as jk,p.* FROM penjualan k,produk p WHERE p.id_penjualan=k.id_penjualan AND p.id_penjualan='$_GET[id]' ORDER BY p.tgl DESC");
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
								<th class="center">penjualan</th>
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