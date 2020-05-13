

         <?php
         $onedatas = $pdo->query("SELECT * FROM page WHERE id_page='$_GET[id]'");
         $tonedatas = $onedatas ->fetch(PDO::FETCH_ASSOC);
         ?>
         <div class="ed-container">
            <div id="primary" class="content-area">
               <main id="main" class="site-main" role="main">                  
                  <header class="page-header" style="margin-top: 20px;">
                     <h1 class="page-title"><span><?php echo $tonedatas["judul"]; ?></span></h1>
                  </header>
                  <div class="archive medium-image">
                     <?php
                     $artik = $pdo->query("SELECT id_artikel,judul,judul_seo,gambar,deskripsi FROM artikel WHERE status='aktif' ORDER BY tgl DESC");
                     while($tartik = $artik->fetch(PDO::FETCH_ASSOC)){
                        $deskripsi = htmlentities(strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$tartik["deskripsi"])));
                        $deskripsi2 = substr($deskripsi,0,strrpos(substr($deskripsi,0,377)," "));
                     ?>
                     <article id="post-663" class="post-663 post type-post status-publish format-standard has-post-thumbnail hentry category-blogs">
                        <div class="content-thumbnail">
                           <div class="post-thumbnail">
                              <img src="images/artikel/small/<?php echo $tartik["gambar"]; ?>" alt="<?php echo $tartik["judul"]; ?>"> 
                           </div>
                           <div class="wrap-content">
                              <header class="entry-header">
                                 <h2 class="entry-title"><a href="artikel/<?php echo $tartik["judul_seo"]."-".$tartik["id_artikel"]; ?>" rel="bookmark"><?php echo $tartik["judul"]; ?></a></h2>
                              </header>
                              <div class="entry-content">
                                 <?php echo $deskripsi2; ?><br>
                                 <a href="artikel/<?php echo $tartik["judul_seo"]."-".$tartik["id_artikel"]; ?>">Read More</a> 
                              </div>
                           </div>
                        </div>
                     </article>
                     <?php
                     }
                     ?>
                  </div>
               </main>
            </div>
         </div>