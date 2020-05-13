		
		  	<?php
		  	$onedatas = $pdo->query("SELECT * FROM page WHERE id_page='$_GET[id]'");
		  	$tonedatas = $onedatas ->fetch(PDO::FETCH_ASSOC);
		  	?>
		   	<div class="ed-container">
		      <div id="primary" class="content-area">
		         <main id="main" class="site-main" role="main">
		         	<div class="detartikel">
			            <header class="page-header">
			               <h1 class="page-title"><span><?php echo $tonedatas["judul"]; ?></span></h1>
			            </header>
			            <div class="page-content">
			               <?php echo $tonedatas["deskripsi"]; ?>
			            </div>
		            </div>
		         </main>
		      </div>
		   </div>