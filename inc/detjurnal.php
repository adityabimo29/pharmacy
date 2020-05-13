
      <?php
      $onedatas = $pdo->query("SELECT * FROM jurnal WHERE id_jurnal='$_GET[id]'");
      $tonedatas = $onedatas ->fetch(PDO::FETCH_ASSOC);

      $dilihat = $tonedatas['dilihat'] + 1;
      $statement = $pdo->prepare("UPDATE jurnal SET dilihat = '$dilihat' WHERE id_jurnal = '$tonedatas[id_jurnal]'");
      $count = $statement->execute();
      ?>
      <main class="Main Main--blog-item" id="yui_3_17_2_1_1548224040040_102">
         <section class="Main-content" data-content-field="main-content" id="yui_3_17_2_1_1548224040040_101">
            <article id="post-5bb2f9e6e5e5f09b62c6b64a" class="BlogItem hentry author-noden post-type-text" data-item-id="5bb2f9e6e5e5f09b62c6b64a">
               <h1 class="BlogItem-title" data-content-field="title"><?php echo $tonedatas["judul"]; ?></h1>
               <div class="sqs-layout sqs-grid-12 columns-12" data-layout-label="Post Body" data-type="item" data-updated-on="1538459551230" id="item-5bb2f9e6e5e5f09b62c6b64a">
                  <div class="row sqs-row" id="yui_3_17_2_1_1548224040040_100">
                     <div class="col sqs-col-12 span-12" id="yui_3_17_2_1_1548224040040_99">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-d873e2d55e4a545119fb">
                           <div class="sqs-block-content">
                              <img src="../images/jurnal/<?php echo $tonedatas["gambar"]; ?>">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sqs-layout sqs-grid-12 columns-12" data-layout-label="Post Body" data-type="item" data-updated-on="1538459551230" id="item-5bb2f9e6e5e5f09b62c6b64a">
                  <div class="row sqs-row" id="yui_3_17_2_1_1548224040040_100">
                     <div class="col sqs-col-12 span-12" id="yui_3_17_2_1_1548224040040_99">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-d873e2d55e4a545119fb">
                           <div class="sqs-block-content">
                              <?php echo $tonedatas["deskripsi"]; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="Blog-meta BlogItem-meta">
                  <time class="Blog-meta-item Blog-meta-item--date" datetime="2018-10-02"><?php echo tgl2($tonedatas["tgl"]); ?></time>
               </div>
               <div class="BlogItem-share">
                  <div class="Share sqs-share-buttons">
                     <div class="Share-buttons">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>
                     </div>
                  </div>
               </div>
            </article>
         </section>
      </main>