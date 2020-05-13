<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
	echo "<link href='style.css' rel='stylesheet' type='text/css'>
	<center>Untuk mengakses modul, Anda harus login <br>";
	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}else{
    $edit = mysql_query("SELECT * FROM page WHERE id_page='5'");
    $r    = mysql_fetch_array($edit);
	$jdl = "home";
	
	$tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
	$pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC"));
	$totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
	$hits             = mysql_num_rows(mysql_query("SELECT hits FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC")); 
	$totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
	$tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
	$bataswaktu       = time() - 300;
	$pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));
	
?>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $pengunjung; ?></h3>
                  <p>Pengunjung Hari Ini</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div><!-- ./col -->
			
            <div class="col-lg-3 col-xs-12">
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $hits; ?></h3>
                  <p>Hits Hari Ini</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div><!-- ./col -->
			
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $pengunjungonline; ?></h3>
                  <p>Pengunjung Online</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div><!-- ./col -->
		  
            <div class="col-lg-3 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <h3><?php echo $totalhits; ?></h3>
                  <p>Total Hits</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div><!-- ./col -->
		  
            <div class="col-lg-12 col-xs-12">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $totalpengunjung; ?></h3>
                  <p>Total Pengunjung</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div><!-- ./col -->
		  
		  </div>
		</section>
		
		
<?php
}
?>
