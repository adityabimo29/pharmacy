<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else if($_SESSION['leveladmin'] !== 'admin'){
  echo "<script>window.location = '../../cek-stok'</script>";
}else{
	$tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
	$bataswaktu       = time() - 300;
	
	$edit1 = $pdo->query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC");
	$edit2 = $pdo->query("SELECT COUNT(hits) as totalz FROM statistik");
	$edit3 = $pdo->query("SELECT hits FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC");
	$edit4 = $pdo->query("SELECT SUM(hits) as totalz FROM statistik");
	$edit5 = $pdo->query("SELECT * FROM statistik WHERE online > '$bataswaktu'");

  $barangMasuk = $pdo->query("SELECT COUNT(total_barang) as Total FROM pembelian WHERE tanggal = '$tanggal' ")->fetch();
	$barangTerjual = $pdo->query("SELECT COUNT(total_obat) as total FROM penjualan WHERE tanggal = '$tanggal' ")->fetch();
	
	$row_count1 = $edit1->rowCount();
	$row_count3 = $edit3->rowCount();
	$row_count5 = $edit3->rowCount();

	$pengunjung       = $row_count1;
	$totalpengunjung  = $edit2->fetch(PDO::FETCH_ASSOC);
	$hits             = $row_count3;
	$totalhits        = $edit4->fetch(PDO::FETCH_ASSOC);
	$tothitsgbr       = $edit4->fetch(PDO::FETCH_ASSOC);
	$pengunjungonline = $row_count5;
	
?>
  <!-- Main content -->
  <section class="content">
    <div class="row">




      <?php
      $mwmb = $pdo->query("SELECT count(id_obat) as jml FROM obat");
      $tmwmb = $mwmb ->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-red"><a href="obat"><i class="fa fa-medkit" aria-hidden="true"></i></a></span>
          <div class="info-box-content">
            <span class="info-box-text" title="Total Member">Obat</span>
            <span class="info-box-number"><?php echo number_format($tmwmb["jml"]); ?></span>
          </div>
        </div>
      </div>

      <?php
      $mwmb4 = $pdo->query("SELECT count(id_distributor) as jml FROM distributor");
      $tmwmb4 = $mwmb4 ->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="info-box">
          <span class="info-box-icon bg-blue"><a href="distributor"><i class="fa fa-download" aria-hidden="true"></i></a></span>
          <div class="info-box-content">
            <span class="info-box-text" title="Total distributor">Total distributor</span>
            <span class="info-box-number"><?php echo number_format($tmwmb4["jml"]); ?></span>
          </div>
        </div>
      </div>


      <div class="col-md-12 col-sm-12 col-xs-12">
          <hr class="pemisah">
      </div>


      <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $barangMasuk['Total']; ?></h3>
            <p>Barang Masuk Hari Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-cubes" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

      <div class="col-lg-6 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php echo $barangTerjual['total']; ?></h3>
            <p>Barang Terjual Hari Ini</p>
          </div>
          <div class="icon">
            <i class="fa fa-star-o" aria-hidden="true"></i>
          </div>
        </div>
      </div><!-- ./col -->

      <!-- <div class="col-lg-4 col-xs-6">
        
        <div class="small-box bg-purple">
          <div class="inner">
            <h3><?php echo $totalhits['totalz']; ?></h3>
            <p>Total Hits</p>
          </div>
          <div class="icon">
            <i class="fa fa-star" aria-hidden="true"></i>
          </div>
        </div>
      </div> -->

   <!--    <div class="col-lg-6 col-xs-6">
       
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $pengunjungonline; ?></h3>
            <p>Pengunjung Online</p>
          </div>
          <div class="icon">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
        </div>
      </div> -->

    <!--   <div class="col-lg-6 col-xs-12">
        
        <div class="small-box bg-silver">
          <div class="inner">
            <h3><?php echo $totalpengunjung['totalz']; ?></h3>
            <p>Total Pengunjung</p>
          </div>
          <div class="icon">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
          </div>
        </div>
      </div> -->



      <?php
      $ch1 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='Google Chrome'");
      $ch2 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='Mozilla Firefox'");
      $ch3 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='Safari'");
      $ch4 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='Opera'");
      $ch5 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='UCBrowser'");
      $ch6 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='Internet Explorer'");
      //$ch7 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE browser='Undetect' OR browser='' AND browser!='Google Chrome' AND browser!='Mozilla Firefox' AND browser!='Safari' AND browser!='Opera' AND browser!='UCBrowser' AND browser!='Internet Explorer'");
      $ch7 = $pdo->query("SELECT count(id) as jml FROM statistik");

      $chr1 = $ch1 ->fetch(PDO::FETCH_ASSOC);
      $chr2 = $ch2 ->fetch(PDO::FETCH_ASSOC);
      $chr3 = $ch3 ->fetch(PDO::FETCH_ASSOC);
      $chr4 = $ch4 ->fetch(PDO::FETCH_ASSOC);
      $chr5 = $ch5 ->fetch(PDO::FETCH_ASSOC);
      $chr6 = $ch6 ->fetch(PDO::FETCH_ASSOC);
      $chr7 = $ch7 ->fetch(PDO::FETCH_ASSOC);
      $chr8 = $chr7["jml"]-($chr1["jml"] + $chr2["jml"] + $chr3["jml"] + $chr4["jml"] + $chr5["jml"] + $chr6["jml"]) ;
      ?>
      <!--
      <div class="col-md-6">
        <div class="box box-black">
          <div class="box-header with-border">
            <h3 class="box-title">Browser Usage</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <div class="chart-responsive">
                  <canvas id="pieChart" height="215" width="205" style="width: 205px; height: 215px;"></canvas>
                </div>
              </div><
              <div class="col-md-4">
                <ul class="chart-legend clearfix">
                  <li><i class="fa fa-circle text-red"></i> Chrome <div style="float: right;" id="BChrome"><?php echo $chr1["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-yellow"></i> Mozilla Firefox <div style="float: right;" id="BFireFox"><?php echo $chr2["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-aqua"></i> Safari <div style="float: right;" id="BSafari"><?php echo $chr3["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-light-blue"></i> Opera <div style="float: right;" id="BOpera"><?php echo $chr4["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-green"></i> UCBrowser <div style="float: right;" id="BUC"><?php echo $chr5["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-gray"></i> IE <div style="float: right;" id="BIE"><?php echo $chr6["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-black"></i> Other Browser <div style="float: right;" id="BOB"><?php echo $chr8; ?></div></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> -->



      <?php
      $chp1 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='Windows'");
      $chp2 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='Linux'");
      $chp3 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='Android'");
      $chp4 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='Apple'");
      $chp5 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='iPhone'");
      $chp6 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='iPad'");
      //$chp7 = $pdo->query("SELECT count(id) as jml FROM statistik WHERE platform='Undetect' OR platform=''");
      $chp7 = $pdo->query("SELECT count(id) as jml FROM statistik");

      $chrp1 = $chp1 ->fetch(PDO::FETCH_ASSOC);
      $chrp2 = $chp2 ->fetch(PDO::FETCH_ASSOC);
      $chrp3 = $chp3 ->fetch(PDO::FETCH_ASSOC);
      $chrp4 = $chp4 ->fetch(PDO::FETCH_ASSOC);
      $chrp5 = $chp5 ->fetch(PDO::FETCH_ASSOC);
      $chrp6 = $chp6 ->fetch(PDO::FETCH_ASSOC);
      $chrp7 = $chp7 ->fetch(PDO::FETCH_ASSOC);
      $chrp8 = $chrp7["jml"]-($chrp1["jml"] + $chrp2["jml"] + $chrp3["jml"] + $chrp4["jml"] + $chrp5["jml"] + $chrp6["jml"]) ;
      ?>
      <!-- <div class="col-md-6">
        <div class="box box-black">
          <div class="box-header with-border">
            <h3 class="box-title">Platform Usage</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                <div class="chart-responsive">
                  <canvas id="pieChart2" height="215" width="205" style="width: 205px; height: 215px;"></canvas>
                </div>
              </div>
              <div class="col-md-4">
                <ul class="chart-legend clearfix">
                  <li><i class="fa fa-circle text-red"></i> Windows <div style="float: right;" id="PWindows"><?php echo $chrp1["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-yellow"></i> Linux <div style="float: right;" id="BLinux"><?php echo $chrp2["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-aqua"></i> Android <div style="float: right;" id="BAndroid"><?php echo $chrp3["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-light-blue"></i> Apple <div style="float: right;" id="BApple"><?php echo $chrp4["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-green"></i> iPhone <div style="float: right;" id="BiPhone"><?php echo $chrp5["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-gray"></i> iPad <div style="float: right;" id="BiPad"><?php echo $chrp6["jml"]; ?></div></li>
                  <li><i class="fa fa-circle text-black"></i> Other Platform <div style="float: right;" id="BOP"><?php echo $chrp8; ?></div></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> -->


     <!--  <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="more-box">
          <a href="statistik">Selengkapnya</a>
        </div>
      </div> -->

		
		

    </div>
  </section>
<?php
}
?>
