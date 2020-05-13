
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Puslitbang Perhutani | Statistik Pengunjung</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <style type="text/css">
    	#canvas { 
	     	position: absolute; 
	     	width: 100%; 
	     	height: 100%; 
	     	overflow: hidden
	  	}
	  	@media print {
	  		.box-canvas{
		        height: 100% !important;
		        width: 100% !important;
	  		}
		    canvas.chart-canvas {
		        min-height: 100%;
		        max-width: 100%;
		        max-height: 100%;
		        height: auto!important;
		        width: auto!important;
		    }
		}
    </style>
  </head>
  <body onload="window.print();">
  <!--<body onload="window.print();">-->
    <div class="wrapper">
      <?php
ob_start();
//session_start();
include "../../../system/koneksi.php";
include "../../../system/fungsi_indotgl3.php";

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
	}

	switch($_GET['tipe']){
	default:
?>
<section class="content">
	<div class="row">
	<div class="col-md-12">

		<?php if($isir!=""){ ?>
		<div class="titlebox"><h1><b>Laporan</b></h1><br><b>Statistik Pengunjung</b></div>
		<?php }else{ ?>
		<div class="titlebox"><b>Laporan Statistik Pengunjung</b></div>
		<?php } ?>

	 	<div class="box-print">
			<?php 
			if(isset($_COOKIE['rangetime'])){
				$onedataz = $pdo->query("SELECT count(id) as totap,sum(hits) as totah FROM statistik $datasql2");
				$total = $onedataz ->fetch(PDO::FETCH_ASSOC);
			?>
			<div class="col-md-6 col-xs-12 nopadding">
				<table class="tabel-ket">
					<tr>
						<td><b>Tanggal & Waktu</b></td>
						<td><?php echo "$isir"; ?></td>
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

			<table class="tabel-print">
			<thead>
			  <tr>
				<th width="30px" class="center">No</th>
				<th width="20%" class="center">IP</th>
				<th width="10%" class="center">Hits</th>
				<th width="20%" class="center">Browser</th>
				<th width="20%" class="center">Platform</th>
				<th width="29%" class="center">Tanggal</th>
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
					<td class="rkiri"><?php echo $r['ip']; ?></td>
					<td align="center"><?php echo $r['hits']; ?></td>
					<td class="rkiri"><?php echo $r['browser']; ?></td>
					<td class="rkiri"><?php echo $r['platform']; ?></td>
					<td align="center"><?php echo  tgl3($r['tgl_masuk']); ?></td>
				</tr>
			<?php
			$no++;
			}
			?>
			</tbody>
		 	</table>
	  	</div>
   
	</div>
</section>

<?php
	break;
	case "bar":
?>
<section class="content">
	<div class="row">
	<div class="col-md-12">


		<?php if($isir!=""){ ?>
		<div class="titlebox"><h1><b>Laporan</b></h1><br><b>Statistik Pengunjung</b></div>
		<?php }else{ ?>
		<div class="titlebox"><b>Laporan Statistik Pengunjung</b></div>
		<?php } ?>
   
        <div class="box-body">
			<?php 
			if(isset($_COOKIE['rangetime'])){
				$onedataz = $pdo->query("SELECT count(id) as totap,sum(hits) as totah FROM statistik $datasql2");
				$total = $onedataz ->fetch(PDO::FETCH_ASSOC);
			?>
			<div class="col-md-6 col-xs-12 nopadding">
				<table class="tabel-ket">
					<tr>
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

          	<div class="box-canvas" style="width: 100%">
				<canvas id="canvas"></canvas>
			</div>
        </div>
</section>
<?php
	break;
	}
?>
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../dist/js/app.min.js"></script>

    <?php if($_GET["tipe"]=="bar"){ ?>
	<script src="../../plugins/ziChart/Chart.bundle.js"></script>
	<script src="../../plugins/ziChart/utils.js"></script>
	<?php
	include "../../../system/fungsi_bulan.php";
	if(isset($_COOKIE['periode']) AND ($_COOKIE['periode']=='harian')){
		$labe = $pdo->query("SELECT DAY(tanggal) AS col1,MONTH(tanggal) AS col2,Count(*) AS jml FROM statistik $datasql2 GROUP BY DAY(tanggal) ASC");
		$datasd = $pdo->query("SELECT DAY(tanggal),Count(*) AS jml FROM statistik $datasql2 GROUP BY DAY(tanggal) ASC");
	}elseif(isset($_COOKIE['periode']) AND ($_COOKIE['periode']=='bulanan')){
		$labe = $pdo->query("SELECT MONTH(tanggal) AS col1,Count(*) AS jml FROM statistik $datasql2 GROUP BY MONTH(tanggal) ASC");
		$datasd = $pdo->query("SELECT MONTH(tanggal),Count(*) AS jml FROM statistik $datasql2 GROUP BY MONTH(tanggal) ASC");
	}else{
		$labe = $pdo->query("SELECT MONTH(tanggal) AS col1,Count(*) AS jml FROM statistik $datasql2 GROUP BY MONTH(tanggal) ASC");
		$datasd = $pdo->query("SELECT MONTH(tanggal),Count(*) AS jml FROM statistik $datasql2 GROUP BY MONTH(tanggal) ASC");
	}
	?>
    <script type="text/javascript">

		var br = document.createElement("br");
     	var color = Chart.helpers.color;
		var barChartData = {
			labels: [<?php
					while($tsss = $labe->fetch(PDO::FETCH_ASSOC)){
						if(isset($_COOKIE['periode']) AND ($_COOKIE['periode']=='harian')){
							$bln7 = bulan2($tsss['col2']); echo "'$tsss[col1] $bln7',";
						}else{
							$bln7 = bulan($tsss['col1']);echo "'$bln7',";
						}
					}
					?>],
			datasets: [{
				type: 'bar',
				label: 'Statistik Pengunjung',
				backgroundColor: color(window.chartColors.red).alpha(0.2).rgbString(),
				borderColor: window.chartColors.red,
				data:[<?php
					while($tdatasd = $datasd->fetch(PDO::FETCH_ASSOC)){echo "$tdatasd[jml],";}
					?>]
			}],
	      	options: [{
	            animation: {
	                onComplete: function () {
	                    // set the PDF printing trigger when the animation is done
	                    // to have this working, the phantom-pdf menu in the left must
	                    // have the wait for printing trigger option selected
	                    window.JSREPORT_READY_TO_START = true
	                }
	            }
	        }]
		};

		// Define a plugin to provide data labels
		Chart.plugins.register({
			afterDatasetsDraw: function(chart) {
				var ctx = chart.ctx;

				chart.data.datasets.forEach(function(dataset, i) {
					var meta = chart.getDatasetMeta(i);
					if (!meta.hidden) {
						meta.data.forEach(function(element, index) {
							// Draw the text in black, with the specified font
							ctx.fillStyle = 'rgb(0, 0, 0)';

							var fontSize = 16;
							var fontStyle = 'normal';
							var fontFamily = 'Helvetica Neue';
							ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

							// Just naively convert to string for now
							var dataString = dataset.data[index].toString();

							// Make sure alignment settings are correct
							ctx.textAlign = 'center';
							ctx.textBaseline = 'middle';

							var padding = 5;
							var position = element.tooltipPosition();
							ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
						});
					}
				});
			}
		});

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					title: {
						display: false,
						text: 'Statistik Pengunjung'
					},
				}
			});
			$("#canvas").width('100%');
			
		};

		function countdown() {
		 	var count1 = 3;
		  	var myTimer = setInterval(function() {
		    	window.print();
		    	clearInterval(myTimer);
		  	}, 1000);
		}
		countdown();
    </script>
    <?php } ?>

    </div>

  </body>
</html>


