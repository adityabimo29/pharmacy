		
		  	<?php
		  	$onedatas = $pdo->query("SELECT * FROM artikel WHERE id_artikel='$_GET[id]'");
		  	$tonedatas = $onedatas ->fetch(PDO::FETCH_ASSOC);
		  	?>
		   	<div class="ed-container">
		      <div id="primary" class="content-area">
		         <main id="main" class="site-main" role="main">
		         	<div class="detartikel">
			            <nav class="woocommerce-breadcrumb">
			               <a href="../home">Home</a> <i class="fa fa-fw fa-angle-double-right"></i>
			               <a href="../artikel">Artikel</a> <i class="fa fa-fw fa-angle-double-right"></i>
			               <a href="../artikel/<?php echo $tonedatas["judul_seo"].'-'.$tonedatas["id_artikel"]; ?>"><?php echo $tonedatas["judul"]; ?></a>
			            </nav>

			            <header class="page-header">
			               <h1 class="page-title"><span><?php echo $tonedatas["judul"]; ?></span></h1>
			            </header>
			            <div class="box-img-detartikel">
			               <img src="../images/artikel/<?php echo $tonedatas["gambar"]; ?>">
			            </div>
			            <div class="page-content">
			               <?php echo $tonedatas["deskripsi"]; ?>
			            </div>
		            </div>
		         </main>
		      </div>
		   </div>