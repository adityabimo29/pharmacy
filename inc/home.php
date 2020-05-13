
            <section class="slider">
               <div>
                  <?php if($_GET["module"]=="home"){ ?>
                     <!-- Slider -->
                     <div id="main-slider" class="flexslider" style="float: left;">
                        <ul class="slides">
                        <?php
                        $sliders = $pdo->query("SELECT * FROM slider ORDER BY id_slider DESC");
                        while($tsliders = $sliders->fetch(PDO::FETCH_ASSOC)){
                        ?>
                           <li><img src="images/slider/<?php echo "$tsliders[gambar]"; ?>" alt="<?php echo $tsliders['judul']; ?>" /></li>
                        <?php
                        } 
                        ?>
                        </ul>
                     </div>
                     <!-- end slider -->
                  <?php } ?>
               </div>
            </section>

            <div class="ed-container">
               <div id="widget-area-one-section">
                  <aside id="custom_html-2" class="widget_text widget widget_custom_html">
                     <div class="textwidget custom-html-widget">
                        <div class="slogan-subtitle">
                        <?php
                        $htp = $pdo->query("SELECT deskripsi FROM page WHERE id_page='6'");
                        $thtp = $htp ->fetch(PDO::FETCH_ASSOC);
                        echo $thtp["deskripsi"];
                        ?>
                        </div>
                        <div class="container-consult">
                           <a href="https://api.whatsapp.com/send?phone=+<?php echo telp($deskrip[7]); ?>&text=Gallery%20Olshop" target="_blank" class="button button-consult">Konsultasi Sekarang</a>
                        </div>
                     </div>
                  </aside>
                  <aside id="custom_html-3" class="widget_text widget widget_custom_html">
                     <div class="textwidget custom-html-widget"></div>
                  </aside>
                  <aside id="custom_html-12" class="widget_text widget widget_custom_html">
                     <div class="textwidget custom-html-widget">
                        <h2 class="heading-reason">
                           Alasan Gallery Olshop
                        </h2>
                        <div class="pt-cv-wrapper">
                           <div class="pt-cv-view pt-cv-grid pt-cv-colsys" id="pt-cv-view-9e4d8dcpvd">
                              <div data-id="pt-cv-page-1" class="pt-cv-page" data-cvc="4">
                                 <?php
                                 $keungu = $pdo->query("SELECT * FROM keunggulan ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
                                 while($tkeungu = $keungu->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <div class="col-md-3 col-sm-6 col-xs-6 pt-cv-content-item pt-cv-1-col">
                                    <div class="pt-cv-ifield">
                                       <a href="#" class="_self pt-cv-href-thumbnail pt-cv-thumb-default" target="_self"><img width="300" height="300" src="images/keunggulan/<?php echo $tkeungu["gambar"]; ?>" class="pt-cv-thumbnail" alt="" sizes="(max-width: 300px) 100vw, 300px"></a>
                                       <h4 class="pt-cv-title"><a href="#" class="_self" target="_self"><?php echo $tkeungu["judul"]; ?></a></h4>
                                    </div>
                                 </div>
                                 <?php
                                 }
                                 ?>
                              </div>
                           </div>
                        </div>
                        <div class="container-consult">
                           <a href="https://api.whatsapp.com/send?phone=+<?php echo telp($deskrip[7]); ?>&text=Gallery%20Olshop" target="_blank" class="button button-consult">Konsultasi Sekarang</a>
                        </div>
                     </div>
                  </aside>
                  <aside id="strong-testimonials-view-widget-2" class="widget strong-testimonials-view-widget">
                     <div class="textwidget">
                        <h2 class="heading-reason">
                           Apa Kata Mereka
                        </h2>
                     </div>
                     <div class="strong-view strong-view-id-2 modern" data-count="3">
                        <div class="strong-content strong-grid columns-3">

                           <?php
                           $keungu = $pdo->query("SELECT * FROM testimoni WHERE status='aktif' ORDER BY tgl DESC");
                           while($tkeungu = $keungu->fetch(PDO::FETCH_ASSOC)){
                           ?>
                           <div class="testimonial post-555">
                              <div class="testimonial-inner">
                                 <div class="testimonial-content">
                                    <h3 class="testimonial-heading"><?php echo $tkeungu["judul"]; ?></h3>
                                    <p><?php echo $tkeungu["deskripsi"]; ?></p>
                                 </div>
                                 <div class="testimonial-client">
                                    <div class="testimonial-image"><img width="75" height="75" src="images/testimoni/<?php echo $tkeungu["gambar"]; ?>" class="attachment-widget-thumbnail size-widget-thumbnail wp-post-image" alt="" sizes="(max-width: 75px) 100vw, 75px"></div>
                                    <div class="testimonial-name"><?php echo $tkeungu["nama"]; ?></div>
                                 </div>
                                 <div class="clear"></div>
                              </div>
                           </div>
                           <?php
                           }
                           ?>
                        </div>
                     </div>
                  </aside>
               </div>
               <div id="cta-section">
                  <div class="cta-content">
                     <div class="box-home2">
                     <?php
                     $htp2 = $pdo->query("SELECT deskripsi FROM page WHERE id_page='7'");
                     $thtp2 = $htp2 ->fetch(PDO::FETCH_ASSOC);
                     echo $thtp2["deskripsi"];
                     ?>
                     </div>
                     <a href="https://api.whatsapp.com/send?phone=+<?php echo telp($deskrip[7]); ?>&text=Gallery%20Olshop" target="_blank">Konsultasi Sekarang</a>
                  </div>
                  <figure>
                     <img src="images/temp/PBC-png-8001.png" alt="Meet Your Personal Beauty Consultant!">
                  </figure>
               </div>
               <div id="widget-area-two-section">
                  <aside id="custom_html-13" class="widget_text widget widget_custom_html">
                     <div class="textwidget custom-html-widget">
                        <div class="container-consult">
                           <a href="produk" target="_blank" class="button button-consult">Menuju Halaman Produk</a>
                        </div>
                     </div>
                  </aside>
               </div>
            </div>