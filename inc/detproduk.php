

		<?php
		$onedatas = $pdo->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
		$tonedatas = $onedatas ->fetch(PDO::FETCH_ASSOC);

        $katego = $pdo->query("SELECT id_kategori,judul,judul_seo FROM kategori WHERE id_kategori='$tonedatas[id_kategori]'");
        $tkatego = $katego ->fetch(PDO::FETCH_ASSOC);

        $subkatego = $pdo->query("SELECT id_subkategori,judul,judul_seo FROM subkategori WHERE id_subkategori='$tonedatas[id_subkategori]'");
        $tsubkatego = $subkatego ->fetch(PDO::FETCH_ASSOC);

		$dilihat = $tonedatas['dilihat'] + 1;
		$statement = $pdo->prepare("UPDATE produk SET dilihat = '$dilihat' WHERE id_produk = '$tonedatas[id_produk]'");
		$count = $statement->execute();
		?>
	   	<div class="ed-container">
            <nav class="woocommerce-breadcrumb">
               <a href="../home">Home</a> <i class="fa fa-fw fa-angle-double-right"></i>
               <a href="../produk">Produk</a> <i class="fa fa-fw fa-angle-double-right"></i>
               <a href="../kategori/<?php echo $tkatego["judul_seo"].'-'.$tkatego["id_kategori"]; ?>"><?php echo $tkatego["judul"]; ?></a> <i class="fa fa-fw fa-angle-double-right"></i>
               <a href="../subkategori/<?php echo $tsubkatego["judul_seo"].'-'.$tsubkatego["id_subkategori"]; ?>"><?php echo $tsubkatego["judul"]; ?></a>
            </nav>

	      	<div id="primary">
	         <div class="woocommerce-notices-wrapper"></div>
	         <div id="product-723" class="post-723 product type-product status-publish has-post-thumbnail product_cat-produk-paket first instock shipping-taxable purchasable product-type-simple">
	            <div class="box-leftimg">

					<div class="boximgs">
						<div class="feature-img">
							<div id="wrap" class="wrap">
								<a href="../images/produk/<?php echo $tonedatas["gambar"]; ?>" class="cloud-zoom" style="cursor: move; position: relative; display: block;" rel="position:'inside', showTitle: false" id="zoom1">
									<img class="img-fluid" src=	"../images/produk/<?php echo $tonedatas["gambar"]; ?>" alt="">
								</a>
								<div class="mousetrap" style="background-image: url(&quot;.&quot;); z-index: 999; position: absolute; width: 100%; height: 300px; left: 0px; top: 0px; cursor: move;"></div>
							</div>				
							<a href="../images/produk/<?php echo $tonedatas["gambar"]; ?>" title="" id="zoom-btn" rel="prettyPhoto[]">
								<i class="fa fa-search-plus"></i>
							</a>					
						</div>
						<script type="text/javascript" charset="utf-8">
						$(document).ready(function(){
							$("area[rel^='prettyPhoto']").prettyPhoto();
							$(".feature-img:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',slideshow:300000, autoplay_slideshow: true});
							$(".feature-img:first a[rel^='prettyPhoto']").prettyPhoto({overlay_gallery: false, theme:'facebook', social_tools: false});
							
						});
						</script>
					</div>

                    <div class="boxslideproduk galleryz">
                        <div class="box-slideproduk">
							<div class="box-singels">
                            	<a data-slide-index="0" href="javascript: void(0);" rel="prettyPhoto[]"  class="active">
                            		<img src="../images/produk/small/<?php echo $tonedatas['gambar']; ?>" alt="<?php echo $tonedatas['judul']; ?>">
                            	</a>
                        	</div>
							<?php
							$no=1;
							$slgmbr = $pdo->query("SELECT * FROM slideproduk WHERE id_produk='$tonedatas[id_produk]' ORDER BY id_slideproduk ASC");
							while($tslgmbr = $slgmbr->fetch(PDO::FETCH_ASSOC)){
							?>
							<div class="box-singels">
                                <a data-slide-index="<?php echo $no; ?>" href="../images/slideproduk/<?php echo $tslgmbr['gambar']; ?>" rel="prettyPhoto[]" class="active">
                                	<img src="../images/slideproduk/small/<?php echo $tslgmbr['gambar']; ?>" alt="<?php echo $tslgmbr['judul']; ?>">
                                </a>
							</div>
							<?php
							$no++;
							}
							?>
                        </div>
                    </div>
					<script type="text/javascript" charset="utf-8">
					$(document).ready(function(){
						$(".galleryz:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
						$(".galleryz:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
						$(".galleryz:first a[rel^='prettyPhoto']").prettyPhoto({overlay_gallery: true, theme:'facebook', social_tools: false});
					});
					</script>
	            </div>
	            <div class="summary entry-summary">
	               	<h1 class="product_title entry-title"><?php echo $tonedatas["judul"]; ?></h1>
	               	<p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rp </span><?php echo rp($tonedatas["harga"]); ?></span></p>
	               
					<?php
					if(!isset($_COOKIE['jumlahqty'])){
						$cookie_name = "jumlahqty";
						$cookie_value = "1";
						setcookie($cookie_name, $cookie_value, time() + 3, "/");

						$jumlahqty = "1";
					}else{
						$jumlahqty = "$_COOKIE[jumlahqty]";
					}
					?>
					<form method="POST" action="../jumlah">
					<div class="jml-box">
						<input id="myForm" type="text" name="qty" style="float: left;text-align: center;height: 43px;" placeholder="Jumlah Pesanan" onchange="this.form.submit()" value="<?php echo $jumlahqty; ?>" maxlength="13">
					</div>
					</form>
					<div class="tombolbeli">
						<a href='https://api.whatsapp.com/send?phone=<?php echo $deskrip[7]; ?>&text=
							Nama : %0D%0A
							No. Hp : %0D%0A
							Alamat Lengkap : %0D%0A
							Barang yang dipesan : <?php echo "$tonedatas[judul]"; ?>%0D%0A
							Jumlah Barang : <?php echo "$jumlahqty"; ?>%0D%0A
							Url Produk : http://galleryolshop.com/produk/<?php echo "$tonedatas[judul_seo]-$tonedatas[id_produk]"; ?>'" class="btn btn-primary" target="_blank" title="Beli via whatsapp">
							<span class="fa fa-whatsapp"></span>
							<span class="spacer-normal-h"></span>
							<span class="btn-text">Beli
								<?php if(!isset($jumlahqty) OR ($jumlahqty>>1)){ ?>
								<span id="jumlah" class="label label-danger pull-right"><?php echo $jumlahqty; ?></span>
								<?php } ?>
							</span>
						</a>
					</div>
	               <div class="product_meta">
	                  <span class="posted_in">Kategori: <a href="../kategori/<?php echo $tkatego["judul"].'-'.$tkatego["id_kategori"]; ?>" rel="tag"><?php echo $tkatego["judul"]; ?></a></span><br>
	                  <?php if($tonedatas["kode_produk"]!=""){ ?>
	                  <span class="posted_in">Kode Produk: <?php echo $tonedatas["kode_produk"]; ?></span>
	                  <?php } ?>
	                  <span class="posted_in" style="text-transform: capitalize;">Stok: <?php echo $tonedatas["status"]; ?></span>
	               </div>
	            </div>
	            <div class="woocommerce-tabs wc-tabs-wrapper">
	               	<ul class="tabs wc-tabs" role="tablist">
	                  	<li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
	                     	<a href="#tab-description">Description</a>
	                  	</li>
	               	</ul>
	               	<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="display: block;">
	                  	<?php echo $tonedatas["deskripsi"]; ?>
	               	</div>
	            </div>
	            <section class="related products">
	               	<h2>Related products</h2>
	               	<ul class="products columns-4">
	               		<?php
                     	$produk = $pdo->query("SELECT id_kategori,id_produk,judul,judul_seo,gambar,deskripsi FROM produk ORDER BY tgl DESC LIMIT 3");
                     		while($tproduk = $produk->fetch(PDO::FETCH_ASSOC)){
                     			$katego = $pdo->query("SELECT id_kategori,judul,judul_seo FROM kategori WHERE id_kategori='$tproduk[id_kategori]'");
                     			$tkatego = $katego ->fetch(PDO::FETCH_ASSOC);

                     			$deskripsi = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$tproduk["deskripsi"])));
                     			$deskripsi2 = substr($deskripsi,0,strrpos(substr($deskripsi,0,177)," "));
	               		?>
	                  	<li class="post-718 product type-product status-publish has-post-thumbnail product_cat-produk-paket first instock shipping-taxable purchasable product-type-simple">
	                     	<div class="wrap-image-sale">
	                     		<a href="../produk/<?php echo $tproduk["judul"].'-'.$tproduk["id_produk"]; ?>">
	                     			<img width="300" height="300" src="../images/produk/<?php echo $tproduk["gambar"]; ?>" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" sizes="(max-width: 300px) 100vw, 300px">
	                     		</a>
	                     	</div>
	                     	<a href="../kategori/<?php echo $tkatego["judul"].'-'.$tkatego["id_kategori"]; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
	                        	<h3 class="product-title "><?php echo $tkatego["judul"]; ?></h3>
	                     	</a>
		                    <div itemprop="description">
		                    	<p><?php echo $deskripsi2; ?></p>
		                    </div>
	                     	<a class="button" href="../produk/<?php echo $tproduk["judul"].'-'.$tproduk["id_produk"]; ?>">Lihat Detail</a>
	                  	</li>
	               		<?php
                     	}
	               		?>

	               	</ul>
	            </section>
	         </div>
	      </div>
	   </div>