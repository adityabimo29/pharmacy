<?php
   ob_start();
   session_start();
   error_reporting(0);
   include_once "system/koneksi.php";
   include_once "system/class_paging_1902.php";
   include_once "system/z_setting.php";
   include_once "system/fungsi_telp.php";
   include_once "system/fungsi_rupiah.php";
   include_once "system/fungsi_indotgl2.php";
   include_once "system/fungsi_all.php";
?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Gallery Olshop <?php echo $_GET["module"]; ?></title>

      <link rel="stylesheet" href="../assets/css/cv.css" type="text/css" media="all">
      <link rel="stylesheet" href="../assets/css/font-awesome.css" type="text/css" media="all">
      <link rel="stylesheet" href="../assets/css/style.css" type="text/css" media="all">
      <link rel="stylesheet" href="../assets/css/responsive.css" type="text/css" media="all">
      <link rel="stylesheet" href="../assets/css/custom-bsv.css" type="text/css" media="all">
      <link rel="stylesheet" href="../assets/css/zicustom2.css" type="text/css" media="all">
      <?php
      if($_GET["module"]=="detproduk"){
      ?>
      <link rel="stylesheet" href="../assets/css/woocommerce.css" type="text/css" media="all">
      <link rel="stylesheet" href="../assets/css/woocommerce-layout.css" type="text/css" media="all">
      <?php
      }
      ?>

      <script type="text/javascript" src="../assets/js/jquery-migrate.min.js"></script>
      <script src="../assets/js/jquery-1.7.1.min.js"></script>
      <link rel="stylesheet" href="../assets/plugins/menu/menu.css">
      <script src="../assets/plugins/menu/menu.js"></script>
   </head>
<?php
if($_GET["module"]=="detproduk"){
?><body class="product-template-default single single-product postid-723 wp-custom-logo woocommerce woocommerce-page woocommerce-js fullwidth  right-sidebar">
<?php
}else{
?>
<body class="archive post-type-archive post-type-archive-product wp-custom-logo woocommerce woocommerce-page woocommerce-js hfeed fullwidth">
<?php
} 
?>
   <div id="fb-root"></div>
   <script>(function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.4&appId=891372647565029";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));</script>


      <div id="page" class="site">
         <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
         <header id="masthead" class="site-header left" role="banner">
            <div class="buttom-header">
               <div class="ed-container">
                  <div class="site-branding">
                     <div class="site-logo">
                        <a href="../home" class="custom-logo-link" rel="home" itemprop="url"><img width="133" height="40" src="../images/module/<?php echo $deskrip[1]; ?>" class="custom-logo" alt="Boseva" itemprop="logo"></a> 
                     </div>
                  </div>
                  <div class="wrap-right">
                     <div class="header-call-to">
                        <p>Chat Kami</p>
                        <a href="https://api.whatsapp.com/send?phone=+<?php echo telp($deskrip[7]); ?>&text=Gallery%20Olshop" target="_blank"><i class="fa fa-mobile"></i><?php echo $deskrip[7]; ?></a> 
                     </div>
                  </div>
               </div>
            </div>
            <div class="menu-wrap">
               <div class="ed-container">
                  <div id="cssmenu" class="mobile-hidden">
                     <div id="menu-button-fz" class="">Menu</div>
                     <ul class="" style="display: block;">
                        <li><a href="../home"><i class="fa fa-fw fa-home logoi"></i> Home</a></li>
                        <li class="has-sub"><span class="submenu-button-fz"></span><a href="../produk">Produk</a>
                           <ul style="display: block;" class="">
                              <?php
                              $katsz = $pdo->query("SELECT id_kategori,judul,judul_seo FROM kategori WHERE status='aktif' ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
                              while($ykatsz = $katsz->fetch(PDO::FETCH_ASSOC)){
                                 $subkats = $pdo->query("SELECT id_subkategori FROM subkategori WHERE id_kategori='$ykatsz[id_kategori]' LIMIT 1");
                                 $ketemu = $subkats->rowCount();
                                 if($ketemu<=0){
                                    echo '<li><a href="../kategori/'.$ykatsz["judul_seo"].'-'.$ykatsz["id_kategori"].'"> '.$ykatsz["judul"].'</a></li>';
                                 }else{
                                    echo '
                                    <li class="has-sub"><span class="submenu-button-fz"></span><a href="../kategori/'.$ykatsz["judul_seo"].'-'.$ykatsz["id_kategori"].'"> '.$ykatsz["judul"].'</a>
                                       <ul style="">';
                                          $sukatsz = $pdo->query("SELECT id_subkategori,judul,judul_seo FROM subkategori WHERE id_kategori='$ykatsz[id_kategori]' AND status='aktif' ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
                                          while($tsukatsz = $sukatsz->fetch(PDO::FETCH_ASSOC)){
                                             echo'<li><a href="../subkategori/'.$tsukatsz["judul_seo"].'-'.$tsukatsz["id_subkategori"].'">'.$tsukatsz["judul"].'</a></li>';
                                          }
                                    echo'</ul>
                                    </li>
                                    ';
                                 }
                              }
                              ?>
                           </ul>
                        </li>
                        <li><a href="../tentang-kami">Tentang Kami</a></li>
                        <li><a href="../reseller">Reseller</a></li>
                        <li><a href="../artikel">Artikel</a></li>
                        <li><a href="../cara-pembayaran">Cara Pembayaran</a></li>
                     </ul>
                  </div>


                  <nav id="site-navigation" class="main-navigation desktop-hidden" role="navigation">
                     <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Primary Menu</button>
                     <div class="close"> × </div>
                     <div class="menu-menu-2-container">
                        <ul id="primary-menu" class="menu nav-menu" aria-expanded="false">
                           <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="../home"><i class="fa fa-fw fa-home logoi"></i> Home</a></li>
                           <li class="menu-item menu-item-type-post_type menu-item-object-page">
                              <a href="../produk">Produk</a>
                              <ul class="categoryzy">
                              <?php
                              $katsz = $pdo->query("SELECT id_kategori,judul,judul_seo FROM kategori WHERE status='aktif' ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
                              while($ykatsz = $katsz->fetch(PDO::FETCH_ASSOC)){
                                 $subkats = $pdo->query("SELECT id_subkategori FROM subkategori WHERE id_kategori='$ykatsz[id_kategori]' LIMIT 1");
                                 $ketemu = $subkats->rowCount();
                                 if($ketemu<=0){
                                    echo '<li><a href="../kategori/'.$ykatsz["judul_seo"].'-'.$ykatsz["id_kategori"].'"><i class="fa fa-fw fa-angle-right"></i>  '.$ykatsz["judul"].'</a></li>';
                                 }else{
                                    echo '
                                    <li><span class="submenu-button-fz"></span><a href="../kategori/'.$ykatsz["judul_seo"].'-'.$ykatsz["id_kategori"].'"><i class="fa fa-fw fa-angle-right"></i>  '.$ykatsz["judul"].'</a>
                                       <ul class="subcategoryzy">';
                                          $sukatsz = $pdo->query("SELECT id_subkategori,judul,judul_seo FROM subkategori WHERE id_kategori='$ykatsz[id_kategori]' AND status='aktif' ORDER BY case when urutan=0 then 1 else 0 end, urutan ASC");
                                          while($tsukatsz = $sukatsz->fetch(PDO::FETCH_ASSOC)){
                                             echo'<li><a href="../subkategori/'.$tsukatsz["judul_seo"].'-'.$tsukatsz["id_subkategori"].'"><i class="fa fa-fw fa-angle-double-right"></i> '.$tsukatsz["judul"].'</a></li>';
                                          }
                                    echo'</ul>
                                    </li>
                                    ';
                                 }
                              }
                              ?>
                              </ul>
                           </li>
                           <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="../tentang-kami">Tentang Kami</a></li>
                           <li class="menu-item menu-item-type-custom menu-item-object-custom"><a href="../reseller">Reseller</a></li>
                           <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="../artikel">Artikel</a></li>
                           <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="../cara-pembayaran">Cara Pembayaran</a></li>
                        </ul>
                     </div>
                  </nav>

                  <div class="header-search">
                     <a href="javascript:void(0)"><i class="fa fa-search"></i></a>
                     <div class="search-box">
                        <div class="close"> × </div>
                        <form method="get" class="searchform" action="../pencarian" role="search">
                           <div class="search-in-select">
                              <select name="post_type" class="select-search-type">
                                 <option value="">All</option>
                                 <option value="product">Product</option>
                                 <option value="post">Post</option>
                              </select>
                           </div>
                           <input type="text" name="kata" value="" class="search-field" placeholder="Search...">
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </header>

         <div id="content" class="site-content">
         <?php include "inc/content.php"; ?>
         </div>

         <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="top-footer footer-column-3">
               <div class="ed-container">
                  <div class="footer-block-one footer-block">
                     <aside id="custom_html-11" class="widget_text widget widget_custom_html">
                        <h2 class="widget-title">LAYANAN PENGGUNA</h2>
                        <div class="textwidget custom-html-widget">
                           <?php echo $deskrip[2]; ?>
                        </div>
                     </aside>
                     <aside id="custom_html-11" class="widget_text widget widget_custom_html">
                        <h2 class="widget-title">IKUTI KAMI</h2>
                        <div class="textwidget custom-html-widget">
                           <div class="box-sosmed-footer">
                           <?php
                              $ungg = $pdo->query("SELECT id_modul_sosmed,url FROM sosmed WHERE status='aktif' ORDER BY id_sosmed ASC");
                              while($tungg = $ungg->fetch(PDO::FETCH_ASSOC)){
                                 $ms = $pdo->query("SELECT gambar FROM modul_sosmed WHERE id_modul_sosmed='$tungg[id_modul_sosmed]'");
                                 $tms = $ms ->fetch(PDO::FETCH_ASSOC);

                                 echo '<a href="'.$tungg["url"].'" target="_blank">'.$tms["gambar"].'</a>';
                              }
                              ?>
                           </div>
                        </div>

                        <div class="box-google">
                           <div id="google_translate_element"></div>
                           <script type="text/javascript">
                           function googleTranslateElementInit() {
                             new google.translate.TranslateElement({pageLanguage: 'id'}, 'google_translate_element');
                           }
                           </script>
                           <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        </div>
                     </aside>
                  </div>
                  <div class="footer-block-two footer-block">
                     <aside id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
                        <h2 class="widget-title">MAPS</h2>
                        <div class="textwidget custom-html-widget">
                           <?php echo $deskrip[3]; ?>
                        </div>
                     </aside>
                  </div>
                  <div class="footer-block-four footer-block">
                     <aside id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
                        <h2 class="widget-title">FOLLOW US</h2>
                        <div class="textwidget custom-html-widget">
                            <?php /* echo $deskrip[14]; */?>
                          <div class="fb-like-box" data-href="<?php echo $deskrip[4]; ?>" data-width="348px" data-colorscheme="dark" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
                           
                           
                           
                        </div>
                     </aside>
                  </div>
               </div>
            </div>
            <div class="site-info">
               <div class="ed-container">
                  <div class="footer-copyright">
                     <div class="copyright-text">
                        Copyright 2019 Gallery Olshop 
                     </div>
                  </div>
               </div>
            </div>
         </footer>
      </div>

      <!-- WhatsHelp.io widget -->
      <script type="text/javascript">
         (function () {
            var options = {
               whatsapp: "<?php echo telp($deskrip[7]); ?>", // WhatsApp number
               call: "<?php echo $deskrip[6]; ?>", // Call phone number
               company_logo_url: "https://www.shareicon.net/data/2015/09/19/103503_support_448x512.png", // URL of company logo (png, jpg, gif)
               greeting_message: "Selamat datang di website Gallery Olshop,<br> Kami siap melayani anda..", // Text of greeting message
               call_to_action: "Message us", // Call to action
               button_color: "#860015", // Color of button
               position: "left", // Position may be 'right' or 'left'
               order: "whatsapp,call" // Order of buttons
            };
            var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
         })();
      </script>
      <!-- /WhatsHelp.io widget -->
      <?php if($_GET["module"]=="detproduk"){ ?>
      <!-- Popup-->
      <link href="../assets/plugins/prettyPhoto/css/prettyPhoto.css" rel="stylesheet">
      <script src="../assets/plugins/prettyPhoto/js/jquery.prettyPhoto.js"></script>
      <!-- Popup-->
      <script type="text/javascript" src="../assets/plugins/cloud-zoom/cloud-zoom.1.0.2.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function() {
         $('.colorbox').colorbox({
           overlayClose: true,
           maxWidth:'95%',
           rel:'gallery',
           opacity: 0.5
      }); 
      });
      </script>
      
      <link rel="stylesheet" type="text/css" href="../assets/plugins/cloud-zoom/custom_colorbox.css" media="screen" />
      <?php } ?>

      <?php include "stat.php"; ?>
      <div id="back-to-top" style="right: 15px;"><i class="fa fa-long-arrow-up"></i></div>

      <link rel="stylesheet" id="testimonials-modern-css" href="../assets/css/content.css" type="text/css" media="all">
      <link rel="stylesheet" id="wpmtst-grid-style-css" href="../assets/css/grid.css" type="text/css" media="all">
      <link rel="stylesheet" id="wpmtst-font-awesome-css" href="../assets/css/font-awesome.min.css" type="text/css" media="all">


      <script type="text/javascript" src="../assets/js/navigation.js"></script>
      <script type="text/javascript" src="../assets/js/custom.js"></script>
   </body>
</html>