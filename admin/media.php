<?php
ob_start();
session_start();
error_reporting(0);

if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){	
	echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>
	<center>Anda harus login dulu <br>";
	echo "<a href=index.php><b>LOGIN</b></a></center>";  
}else{	
	include "../system/koneksi.php";
	include "../system/z_setting.php";
	include "../system/fungsi_indotgl.php";
	include "../system/fungsi_indotgl2.php";
	include "../system/fungsi_rupiah.php";
	
	if(!isset($_COOKIE['menuz'])){
		$cookie_name = "menuz";
		$cookie_value = "0";
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		$style = "sidebar-mini";
	}elseif($_COOKIE['menuz']=="1"){
		$style = "sidebar-mini sidebar-collapse";
	}elseif($_COOKIE['menuz']=="0"){
		$style = "sidebar-mini";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $namaweb; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
    <link rel="shortcut icon" href="../images/favicon.ico">
	
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

	<!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css?<?php echo date('Y-m-d H:i:s') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css?<?php echo date('Y-m-d H:i:s') ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css?<?php echo date('Y-m-d H:i:s') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

	<link rel="stylesheet" href="plugins/jquery-ui-1.12.1/jquery-ui.min.css">
	<script src="plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="plugins/jquery.print.js">

	<style>
	.boxselect{padding: 0px 7px;width: 100%;margin-bottom: 11px;float: left;margin-right: 20px;}
	.boxselect label{margin-bottom: 0px;width: 100%;float: left;padding-right: 5px;padding-top: 5px;}
	.boxselect select{height: 34px;width: 100%;float: left;margin: 0px 5px;}
	.btn-secondary {background-color: #545b62;border-color: #4e555b;color: white;}
	.breadcrumb {padding: 8px 15px;margin-bottom: 20px;list-style: none;background-color: #222d32;border-radius: 4px;}
	th.center {text-align: center;}
	.formdate{width: 100%;}
	@media(max-width:768px){.hidden-mobile{display: none;}}
	.besar{text-transform: capitalize;}
	</style>

	<!-- Bootstrap 3.3.5 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
	

	<?php if($_GET["module"]=="statistik"){ ?>
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
	<?php } ?>
</head>
<body class="hold-transition skin-green-light <?php echo $style; ?>">
		<div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="media.php?module=home" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php echo $namaweb; ?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg" title="Admin <?php echo $namaweb; ?>"><b>SISTEM APOTIK</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <!-- <a id="ZyButton" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a> -->
		  
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
				
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="avatar1.png" class="user-image" alt="User Image">
						  <span class="hidden-xs"><?php $_SESSION['namalengkapadmin']; ?></span>
						</a>
						<ul class="dropdown-menu">
						  <!-- User image -->
						  <li class="user-header">
							<img src="avatar1.png" class="img-circle" alt="User Image">
							<p style="text-transform: capitalize;">
							  <?php echo $_SESSION['namalengkapadmin']; ?> - <?php echo $_SESSION['leveladmin']; ?>
							  <!-- <small>Member since Nov. 2012</small> -->
							</p>
						  </li>
						  <li class="user-footer">
							<div class="pull-left">
							  <a href="media.php?module=admin&act=edit&id=<?php echo $_SESSION['idadmin']; ?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
							  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
							</div>
						  </li>
						</ul>
					</li>

				  <!-- Control Sidebar Toggle Button -->
				</ul>
			</div>
		  
		  
		  
		  
		</nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel
          <center><div class="user-panel">
            <div class="image">
				<img src="../images/<?php //echo $deskrip[22]; ?>">
            </div>
          </div></center>
		   -->
			
          <!-- sidebar menu: : style can be found in sidebar.less -->
		<?php include "menu.php"; ?>
		  
		  
		  
        </section>
        <!-- /.sidebar -->
      </aside>
	  
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

		<?php include "content.php"; ?>
		
		
	  </div><!-- /.content-wrapper -->
      <footer class="main-footer no-print">
        <div class="pull-right hidden-xs">
          <b>Version</b> 17.12.1
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="http://jogjamediaweb.com">Jogja Media Web</a>.</strong> All rights reserved.
      </footer>
	 <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

	
	
    
    
    
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

<?php if($_GET["module"]=="home"){ ?>
    <script src="plugins/chartjs/Chart.min.js"></script>
    <script>
    	$(function () {
		  	//- PIE CHART -
		  	//-------------
		  	// Get context with jQuery - using jQuery's .get() method.
		  	var chrome = document.getElementById('BChrome').innerText;
		 	var ff = document.getElementById('BFireFox').innerText;
		  	var sf = document.getElementById('BSafari').innerText;
		 	var op = document.getElementById('BOpera').innerText;
		 	var buc = document.getElementById('BUC').innerText;
		 	var ie = document.getElementById('BIE').innerText;
		 	var bob = document.getElementById('BOB').innerText;

			//platform
		  	var plt1 = document.getElementById('PWindows').innerText;
		 	var plt2 = document.getElementById('BLinux').innerText;
		  	var plt3 = document.getElementById('BAndroid').innerText;
		 	var plt4 = document.getElementById('BApple').innerText;
		 	var plt5 = document.getElementById('BiPhone').innerText;
		 	var plt6 = document.getElementById('BiPad').innerText;
		 	var plt7 = document.getElementById('BOP').innerText;

			//browser
		  	var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
		  	var pieChart = new Chart(pieChartCanvas);

			//platform
		  	var pieChartCanvas2 = $("#pieChart2").get(0).getContext("2d");
		  	var pieChart2 = new Chart(pieChartCanvas2);

			var PieData = [
			    {
			      value: chrome,
			      color: "#f56954",
			      highlight: "#f56954",
			      label: "Chrome"
			    },
			    {
			      value: ff,
			      color: "#f39c12",
			      highlight: "#f39c12",
			      label: "Mozilla Firefox"
			    },
			    {
			      value: sf,
			      color: "#00c0ef",
			      highlight: "#00c0ef",
			      label: "Safari"
			    },
			    {
			      value: op,
			      color: "#3c8dbc",
			      highlight: "#3c8dbc",
			      label: "Opera"
			    },
			    {
			      value: buc,
			      color: "#00a65a",
			      highlight: "#00a65a",
			      label: "UCBrowser"
			    },
			    {
			      value: ie,
			      color: "#d2d6de",
			      highlight: "#d2d6de",
			      label: "Internet Explorer"
			    },
			    {
			      value: bob,
			      color: "#000000",
			      highlight: "#000000",
			      label: "Other Browser"
			    }
			];


			var PieData2 = [
			    {
			      value: plt1,
			      color: "#f56954",
			      highlight: "#f56954",
			      label: "Windows"
			    },
			    {
			      value: plt2,
			      color: "#f39c12",
			      highlight: "#f39c12",
			      label: "Linux"
			    },
			    {
			      value: plt3,
			      color: "#00c0ef",
			      highlight: "#00c0ef",
			      label: "Android"
			    },
			    {
			      value: plt4,
			      color: "#3c8dbc",
			      highlight: "#3c8dbc",
			      label: "Apple"
			    },
			    {
			      value: plt5,
			      color: "#00a65a",
			      highlight: "#00a65a",
			      label: "iPhone"
			    },
			    {
			      value: plt6,
			      color: "#d2d6de",
			      highlight: "#d2d6de",
			      label: "iPad"
			    },
			    {
			      value: plt7,
			      color: "#000000",
			      highlight: "#000000",
			      label: "Other Platform"
			    }
			];

		  var pieOptions = { //Boolean - Whether we should show a stroke on each segment
		    segmentShowStroke: true, //String - The colour of each segment stroke
		    segmentStrokeColor: "#fff", //Number - The width of each segment stroke
		    segmentStrokeWidth: 1, //Number - The percentage of the chart that we cut out of the middle
		    percentageInnerCutout: 50, // This is 0 for Pie charts		    //Number - Amount of animation steps
		    animationSteps: 100, //String - Animation easing effect
		    animationEasing: "easeOutBounce", //Boolean - Whether we animate the rotation of the Doughnut
		    animateRotate: true, //Boolean - Whether we animate scaling the Doughnut from the centre
		    animateScale: false, //Boolean - whether to make the chart responsive to window resizing
		    responsive: true, // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		    maintainAspectRatio: false, //String - A legend template
		    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>", //String - A tooltip template
		    tooltipTemplate: "<%=value %> <%=label%> users"
		  };
		  //Create pie or douhnut chart
		  // You can switch between pie and douhnut using the method below.
		  pieChart.Doughnut(PieData, pieOptions);
		  pieChart2.Doughnut(PieData2, pieOptions);
		  //-----------------
		  //- END PIE CHART -
		  //-----------------


		});
    </script>
<?php }elseif($_GET["module"]=="statistik"){ ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>

	<script src="plugins/ziChart/Chart.bundle.js"></script>
	<script src="plugins/ziChart/utils.js"></script>
	<?php
	include "../system/fungsi_bulan.php";
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
      	$(function () {
        	$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 1, use24hours: true, format: 'MM/DD/YYYY HH:mm:ss'});
      	});

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
		};
    </script>


<?php }else{ ?>
    
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
	
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>

    
	
	
    <script src="ckeditor/ckeditor.js"></script>

    <script>
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();
		$( '.uang' ).mask('000.000.000', {reverse: true});

        $("#example1").DataTable({
			"scrollX": true,
			fixedHeader: {
            header: true
        }
		});
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        $('#example3').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
		

        //Timepicker
        $(".timepicker").timepicker({
		  showMeridian: false, //format 24jm
          showInputs: false
        });
      });
    </script>
<?php } ?>


	<script type="text/javascript">
	function setCookie(name,value,days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days*24*60*60*1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	}
	function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	function eraseCookie(name) {   
		document.cookie = name+'=; Max-Age=-99999999;';  
	}

	</script>
	
	
  </body>
</html>
<?php
}
?>
