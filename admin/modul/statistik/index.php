<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
	include "../system/fungsi_indotgl3.php";
	
	$aksi="modul/statistik/aksi.php";
	$hal = "statistik";
	$_SESSION['halaman'] = $hal;
	$module = "statistik";
	
	if(!isset($_COOKIE['sort'])){$sort= "default";}else{$sort= $_COOKIE['sort'];}
	if(!isset($_COOKIE['periode'])){$periode= "default";}else{$periode= $_COOKIE['periode'];}

	if($sort=="default"){
		$sql = "ORDER BY tgl_masuk DESC";
		$sortname = "Default";
	}elseif($sort=="terlama"){
		$sql = "ORDER BY tgl_masuk ASC";
		$sortname = "Tanggal Terlama";
	}elseif($sort=="terbaru"){
		$sql = "ORDER BY tgl_masuk DESC";
		$sortname = "Tanggal Terbaru";
	}elseif($sort=="browserasc"){
		$sql = "ORDER BY browser ASC";
		$sortname = "Browser (A-Z)";
	}elseif($sort=="browserdesc"){
		$sql = "ORDER BY browser DESC";
		$sortname = "Browser (Z-A)";
	}elseif($sort=="platformasc"){
		$sql = "ORDER BY platform ASC";
		$sortname = "Platform (A-Z)";
	}elseif($sort=="platformdesc"){
		$sql = "ORDER BY platform DESC";
		$sortname = "Platform (Z-A)";
	}elseif($sort=="hitasc"){
		$sql = "ORDER BY hits ASC";
		$sortname = "Hits Terendah";
	}elseif($sort=="hitdesc"){
		$sql = "ORDER BY hits DESC";
		$sortname = "Hits Tertinggi";
	}else{
		$sql = "ORDER BY tgl_masuk DESC";
	}

	if(!isset($_COOKIE['rangetime'])){
		$isir = "";
		$datasql = "SELECT * FROM statistik $sql LIMIT 10";
		$datasql2 = "WHERE ip!='0'";
	}else{
		//12/23/2018 05:00:00 - 12/23/2018 19:59:00
		$bln=substr($_COOKIE['rangetime'],0,2);
		$tgl=substr($_COOKIE['rangetime'],3,2);
		$thn=substr($_COOKIE['rangetime'],6,4);
		$jam=substr($_COOKIE['rangetime'],11,8);
		$tgl_awal = "$thn-$bln-$tgl $jam";

		$bln2=substr($_COOKIE['rangetime'],22,2);
		$tgl2=substr($_COOKIE['rangetime'],25,2);
		$thn2=substr($_COOKIE['rangetime'],28,4);
		$jam2=substr($_COOKIE['rangetime'],33,8);
		$tgl_akhir = "$thn2-$bln2-$tgl2 $jam2";

		$isir = $_COOKIE["rangetime"];

		$datasql = "SELECT * FROM statistik WHERE tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' $sql";
		$datasql2 = "WHERE tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir'";
		//echo "$datasql2";
	}

switch($_GET['act']){
default:
?><section class="content">
		<div class="row">
		<div class="col-md-12">

		  <div class="box box-black">
			<div class="box-header">
				<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
				<ol class="breadcrumb">
					<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active"><?php echo $hal; ?></li>
				</ol>
			</div>
		
			<div class="col-md-12">
				<div class="col-md-5 col-xs-12 nopadding">
					<a class="btn btn-app" href="statistik">
	                    <i class="fa fa-th-list"></i> List
	                </a>
					<a class="btn btn-app" href="statistik-bar">
	                    <i class="fa fa-bar-chart"></i> Bar Chart
	                </a>
					<a class="btn btn-app" href="modul/statistik/print.php?module=statistik&act=range&tipe=list" target="_blank">
	                    <i class="fa fa-print"></i> Print
	                </a>
				</div>

				<div class="col-md-5 col-xs-12 nopadding">
					<div class="boxselect">
		                <div class="form-group">
		                    <label>Tanggal & Waktu:</label>
		                    <form method="POST" action="setting2">
		                    <input type="hidden" name="tipe" value="<?php echo $_GET["tipe"]; ?>">
		                    <input type="hidden" name="act" value="<?php echo $_GET["act"]; ?>">
		                    <div class="input-group">
		                      	<div class="input-group-addon">
		                        	<i class="fa fa-clock-o"></i>
		                      	</div>
		                     	<input name="rangetime" type="text" class="form-control pull-right active" id="reservationtime" value="<?php echo $isir; ?>">
		                     	<span class="input-group-btn">
			                       	<button type="submit" class="btn btn-primary btn-flat">Apply</button>
			                    </span>
		                    </div>
			                </form>
		                </div>
					</div>
				</div>

				<div class="col-md-2 col-xs-12 nopadding">
					<div class="boxselect">
						<label>Urut Berdasarkan: </label>
							<select onchange="location = this.value;" class="form-control input-sm">
							<option value="sorts-default-statistik-list" <?php if($sort=="default"){echo "selected";}else{} ?>>Default</option>
							<option value="sorts-terlama-statistik-list" <?php if($sort=="terlama"){echo "selected";}else{} ?>>Tanggal Terlama</option>
							<option value="sorts-terbaru-statistik-list" <?php if($sort=="terbaru"){echo "selected";}else{} ?>>Tanggal Terbaru</option>
							<option value="sorts-browserasc-statistik-list" <?php if($sort=="browserasc"){echo "selected";}else{} ?>>Browser (A - Z)</option>
							<option value="sorts-browserdesc-statistik-list" <?php if($sort=="browserdesc"){echo "selected";}else{} ?>>Browser (Z - A)</option>
							<option value="sorts-platformasc-statistik-list" <?php if($sort=="platformasc"){echo "selected";}else{} ?>>Platform (A - Z)</option>
							<option value="sorts-platformdesc-statistik-list" <?php if($sort=="platformdesc"){echo "selected";}else{} ?>>Platform (Z - A)</option>
							<option value="sorts-hitasc-statistik-list" <?php if($sort=="hitasc"){echo "selected";}else{} ?>>Hits Terendah</option>
							<option value="sorts-hitdesc-statistik-list" <?php if($sort=="hitdesc"){echo "selected";}else{} ?>>Hits Tertinggi</option>
						</select>
					</div>
				</div>
			</div>
		
			<div class="box-body table-responsive">
				<?php 
				if(isset($_COOKIE['rangetime'])){
					$onedataz = $pdo->query("SELECT count(id) as totap,sum(hits) as totah FROM statistik $datasql2");
					$total = $onedataz ->fetch(PDO::FETCH_ASSOC);
				?>
				<div class="col-md-6 col-xs-12 nopadding">
					<table class="tabel-ket">
						<tr>
							<td colspan="2" align="center"><b>Statistik Pengunjung</b></td>
						</tr><tr>
							<td><b>Tanggal & Waktu</b></td>
							<td><?php echo "$tgl_awal - $tgl_akhir"; ?></td>
						</tr><tr>
							<td><b>Total Pengunjung</b></td>
							<td><?php echo "$total[totap]"; ?></td>
						</tr><tr>
							<td><b>Total Hits</b></td>
							<td><?php echo "$total[totah]"; ?></td>
						</tr>
						<?php if((isset($_COOKIE['sort']) AND ($sort!="default"))){ ?>
						<tr>
							<td><b>Urutkan Berdasarkan</b></td>
							<td><?php echo "$sortname"; ?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
				<?php } ?>

				<table id="example1" class="table table-bordered table-striped th-black">
				<thead>
				  <tr>
					<th width="30px" class="center">No</th>
					<th class="center">IP</th>
					<th class="center">Hits</th>
					<th class="center">Browser</th>
					<th class="center">Platform</th>
					<th class="center">Tanggal</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$no = 1;
				$tampil = $pdo->query("$datasql");
				while($r = $tampil->fetch(PDO::FETCH_ASSOC)){
				?>
					<tr>
						<td align="center"><?php echo  $no; ?></td>
						<td><?php echo $r['ip']; ?></td>
						<td align="center"><?php echo $r['hits']; ?></td>
						<td><?php echo $r['browser']; ?></td>
						<td><?php echo $r['platform']; ?></td>
						<td align="center"><?php echo  tgl3($r['tgl_masuk']); ?></td>
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
	case "bar":
?>
<section class="content">
	<div class="row">
	<div class="col-md-12">

	<div class="box box-black">
		<div class="box-header">
			<h1 style="text-transform: capitalize;"><?php echo $hal; ?></h1>
			<ol class="breadcrumb">
				<li><a href="media.php?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="media.php?module=statistik&tipe=list&act=list"> <?php echo $hal; ?></a></li>
				<li class="active"><?php echo $hal; ?></li>
			</ol>
		</div>
	
		<div class="col-md-12">
			<div class="col-md-5 col-xs-12 nopadding">
				<a class="btn btn-app" href="statistik-list">
                    <i class="fa fa-th-list"></i> List
                </a>
				<a class="btn btn-app" href="statistik-bar">
                    <i class="fa fa-bar-chart"></i> Bar Chart
                </a>
				<a class="btn btn-app" href="modul/statistik/print.php?module=statistik&act=range&tipe=bar" target="_blank">
                    <i class="fa fa-print"></i> Print
                </a>
			</div>

			<div class="col-md-5 col-xs-12 nopadding">
				<div class="boxselect">
	                <div class="form-group">
	                    <label>Tanggal & Waktu:</label>
	                    <form method="POST" action="setting2">
	                    <input type="hidden" name="act" value="<?php echo $_GET["act"]; ?>">
	                    <div class="input-group">
	                      	<div class="input-group-addon">
	                        	<i class="fa fa-clock-o"></i>
	                      	</div>
	                     	<input name="rangetime" type="text" class="form-control pull-right active" id="reservationtime" value="<?php echo $isir; ?>">
	                     	<span class="input-group-btn">
		                       	<button type="submit" class="btn btn-primary btn-flat">Apply</button>
		                    </span>
	                    </div>
		                </form>
	                </div>
				</div>
			</div>


			<div class="col-md-2 col-xs-12 nopadding">
				<div class="boxselect">
					<label>Periode: </label>
						<select onchange="location = this.value;" class="form-control input-sm">
						<option value="periode-default-statistik-bar" <?php if($periode=="default"){echo "selected";}else{} ?>>Default</option>
						<option value="periode-harian-statistik-bar" <?php if($periode=="harian"){echo "selected";}else{} ?>>Harian</option>
						<option value="periode-bulanan-statistik-bar" <?php if($periode=="bulanan"){echo "selected";}else{} ?>>Bulan</option>
					</select>
				</div>
			</div>
		</div>
   
        <div class="box-body">
			<?php 
			if(isset($_COOKIE['rangetime'])){
				$onedataz = $pdo->query("SELECT count(id) as totap,sum(hits) as totah FROM statistik $datasql2");
				$total = $onedataz ->fetch(PDO::FETCH_ASSOC);
			?>
			<div class="col-md-6 col-xs-12 nopadding">
				<table class="tabel-ket">
					<tr>
						<td colspan="2" align="center"><b>Statistik Pengunjung</b></td>
					</tr><tr>
						<td><b>Tanggal & Waktu</b></td>
						<td><?php echo "$tgl_awal - $tgl_akhir"; ?></td>
					</tr><tr>
						<td><b>Total Pengunjung</b></td>
						<td><?php echo "$total[totap]"; ?></td>
					</tr><tr>
						<td><b>Total Hits</b></td>
						<td><?php echo "$total[totah]"; ?></td>
					</tr>
				</table>
			</div>
			<?php } ?>

          	<div style="width: 100%">
				<canvas id="canvas" width="100%" height="auto" style="width: 100%"></canvas>
			</div>
        </div>
 	</div>
</section>
<?php
	break;
	}
}
?>
