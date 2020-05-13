

		<main class="Main Main--products-list">
		   <section class="Main-content" data-content-field="main-content">
		      <section class="ProductList products-collection-v2 clear sqs-pinterest-products-wrapper" id="yui_3_17_2_1_1548228719858_146">
		         <div class="ProductList-grid clear" data-items-per-row="4">
		         	<h3 style="margin-top: -120px;font-size: 27px;">Search : <?php echo $_COOKIE['cari'];; ?></h3>
					<?php
		            $page     = new pagingAll;
		            $batas    = 12;
		            $posisi   = $page->cariPosisi($batas);

					$multidata = $pdo->query("SELECT id_produk,judul,judul_seo,gambar FROM produk WHERE id_kategori!='4' AND judul LIKE '%$_COOKIE[cari]%' ORDER BY tgl DESC LIMIT $posisi,$batas");
					$multidata2 = $pdo->query("SELECT id_produk FROM produk WHERE id_kategori!='4' AND judul LIKE '%$_COOKIE[cari]%' ORDER BY tgl DESC");
					while($tmultidata = $multidata->fetch(PDO::FETCH_ASSOC)){
					?>
		            <div class="ProductList-item hentry author-noden post-type-store-item article-index-1 sqs-product-quick-view-button-hover-area image-is-loaded" id="thumb-18v7-721" data-item-id="5b558ddb0e2e72a170de3233" >
		               <a href="produk/<?php echo $tmultidata["judul_seo"]."-".$tmultidata["id_produk"]; ?>" class="ProductList-item-link"></a>
		               <figure class="ProductList-outerImageWrapper" id="yui_3_17_2_1_1548228719858_1153">
		                  <div class="ProductList-innerImageWrapper sqs-pinterest-image" id="yui_3_17_2_1_1548228719858_1152" style="overflow: hidden;">
		                     <img class="ProductList-image ProductList-image--primary loaded" alt="<?php echo $tmultidata["judul"]; ?>" src="images/produk/<?php echo $tmultidata["gambar"]; ?>" data-image-resolution="500w">
		                  </div>
		                  <div class="ProductList-statusWrapper sqs-product-mark-wrapper">
		                  </div>
		               </figure>
		               <section class="ProductList-overlay">
		                  <div class="ProductList-meta">
		                     <h1 class="ProductList-title"><?php echo $tmultidata["judul"]; ?></h1>
		                  </div>
		               </section>
		            </div>
					<?php
					}
		            $jmldata     = $multidata2->rowCount();
		            $jmlhalaman  = $page->jmlhalaman($jmldata, $batas);
		            $linkHalaman = $page->navHalaman($_GET['page'], $jmlhalaman, 'search');
		          
		            if($jmldata>$batas){
		            ?>
		            <div class="product-item col-md-12">
		              <div class="wp-pagenavi">
		                <center><?php echo $linkHalaman; ?></center>
		              </div>
		            </div>
		            <?php
		            }
		            ?>

		         </div>
		      </section>
		      <script>
		         document.querySelector('.ProductList-grid').dataset.itemsPerRow = Static.SQUARESPACE_CONTEXT.tweakJSON["tweak-product-list-items-per-row"];
		      </script>
		   </section>
		</main>