

         <?php
         $onedatas = $pdo->query("SELECT * FROM subkategori WHERE id_subkategori='$_GET[id]'");
         $tonedatas = $onedatas ->fetch(PDO::FETCH_ASSOC);

         $katego = $pdo->query("SELECT * FROM kategori WHERE id_kategori='$tonedatas[id_kategori]'");
         $tkatego = $katego ->fetch(PDO::FETCH_ASSOC);
         ?>
         <div class="ed-container">
            <nav class="woocommerce-breadcrumb">
               <a href="../home">Home</a> <i class="fa fa-fw fa-angle-double-right"></i>
               <a href="../produk">Produk</a> <i class="fa fa-fw fa-angle-double-right"></i>
               <a href="../kategori/<?php echo $tkatego["judul_seo"].'-'.$tkatego["id_kategori"]; ?>"><?php echo $tkatego["judul"]; ?></a> <i class="fa fa-fw fa-angle-double-right"></i>
               <a href="../subkategori/<?php echo $tonedatas["judul_seo"].'-'.$tonedatas["id_kategori"]; ?>"><?php echo $tonedatas["judul"]; ?></a>
            </nav>
            <div id="primary">
                  <header class="woocommerce-products-header">
                     <h1 class="woocommerce-products-header__title page-title"><?php echo $tonedatas["judul"]; ?></h1>
                  </header>
                  <div class="wp-store-products columns-3">
                  <ul class="products columns-3">

                    <?php
                    $page    = new pagingAll;
                    $batas   = 9;
                    $posisi  = $page->cariPosisi($batas);

                    $produk = $pdo->query("SELECT id_kategori,id_produk,judul,judul_seo,gambar,deskripsi,harga FROM produk WHERE id_kategori='$tonedatas[id_kategori]' AND id_subkategori='$tonedatas[id_subkategori]' ORDER BY tgl DESC LIMIT $posisi,$batas");
                    $multidata2 = $pdo->query("SELECT id_produk FROM produk WHERE id_kategori='$tonedatas[id_kategori]' AND id_subkategori='$tonedatas[id_subkategori]' ORDER BY tgl DESC");
                    while($tproduk = $produk->fetch(PDO::FETCH_ASSOC)){
                     	$deskripsi = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$tproduk["deskripsi"])));
                     	$deskripsi2 = substr($deskripsi,0,strrpos(substr($deskripsi,0,177)," "));
                    ?>
                    <li class="post-723 product type-product status-publish has-post-thumbnail product_cat-produk-paket first instock shipping-taxable purchasable product-type-simple">
                        <div class="wrap-image-sale">
                           <a href="../produk/<?php echo $tproduk["judul_seo"].'-'.$tproduk["id_produk"]; ?>">
                              <img width="300" height="300" src="../images/produk/small/<?php echo $tproduk["gambar"]; ?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" sizes="(max-width: 300px) 100vw, 300px">
                           </a>
                        </div>
                        <a href="../kategori/<?php echo $tonedatas["judul_seo"].'-'.$tonedatas["id_kategori"]; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                           <h3 class="product-title "><?php echo $tonedatas["judul"]; ?></h3>
                        </a>
                        <div itemprop="description">
                           <?php echo $deskripsi2; ?>
                        </div>
                        <span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp</span>295,000.00</span></span>
                        <a class="button" href="../produk/<?php echo $tproduk["judul_seo"].'-'.$tproduk["id_produk"]; ?>">Lihat Detail</a>
                    </li>
                    <?php
                    }
	                $row_count = $multidata2->rowCount();
	                $jmldata     = $row_count;
	                
	                $jmlhalaman  = $page->jmlhalaman($jmldata, $batas);
	                $linkHalaman = $page->navHalaman($_GET['page'], $jmlhalaman, "../subkategori/$tonedatas[judul_seo]-$_GET[id]");
	                
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
                  </ul>
               </div>
            </div>
         </div>