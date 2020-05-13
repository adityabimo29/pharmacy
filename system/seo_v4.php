<?php 
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

function getDomainName($url){
	$pieces = parse_url($url);
	$domain = isset($pieces['host']) ? $pieces['host'] : '';
	if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
		return $regs['domain'];
	}
	return FALSE;
}
$url = getDomainName("$actual_link"); 

$default 	= "$namaweb";
$default2 	= "$namaweb1";
$default3 	= "$url";
//$default4 	= "$actual_link";
$default4 	= "http://localhost/jmw/proyek/baru/18-10-5-perhutani/4.online";

if(($_GET['module']=='home')OR($_GET['module']=='berita')OR($_GET['module']=='detpage')OR($_GET['module']=='detpage2')OR($_GET['module']=='jurnal')OR($_GET['module']=='kontak')OR($_GET['module']=='kegiatan')){
	$tseo = $pdo->query("SELECT gambar,title,keyword,description FROM page WHERE id_page='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[title]";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	if($seo["gambar"]==""){
	$imageshare = "images/default-share.jpg";
	}else{
	$imageshare = "images/page/$seo[gambar]";
	}
	$urlshare = $default4."/$_GET[module]";

}elseif(($_GET['module']=='detberita')){
	$tseo = $pdo->query("SELECT id_berita,judul,judul_seo,gambar,keyword,description FROM berita WHERE id_berita='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[judul] | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	if($seo["gambar"]==""){
	$imageshare = "images/default-share.jpg";
	}else{
	$imageshare = "images/berita/$seo[gambar]";
	}
	$urlshare = $default4."/berita/$seo[judul_seo]-$seo[id_berita]";

}elseif(($_GET['module']=='detkegiatan')){
	$tseo = $pdo->query("SELECT id_kegiatan,judul,judul_seo,gambar,keyword,description FROM kegiatan WHERE id_kegiatan='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[judul] | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	if($seo["gambar"]==""){
	$imageshare = "images/default-share.jpg";
	}else{
	$imageshare = "images/kegiatan/$seo[gambar]";
	}
	$urlshare = $default4."/kegiatan/$seo[judul_seo]-$seo[id_kegiatan]";


}elseif(($_GET['module']=='about')){
	$tseo = $pdo->query("SELECT id_about,judul,judul_seo,gambar,keyword,description FROM about WHERE id_about='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[judul] | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	if($seo["gambar"]==""){
	$imageshare = "images/default-share.jpg";
	}else{
	$imageshare = "images/about/$seo[gambar]";
	}
	$urlshare = $default4."/tentang-kami/$seo[judul_seo]-$seo[id_about]";


}elseif(($_GET['module']=='kategori_perpustakaan')){
	$tseo = $pdo->query("SELECT id_kategori_perpustakaan,judul,judul_seo,keyword,description FROM kategori_perpustakaan WHERE judul_seo='$_GET[seo]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[judul] | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	$imageshare = "images/default-share.jpg";
	$urlshare = $default4."/perpustakaan/$seo[judul_seo]";


}elseif(($_GET['module']=='komersial')OR($_GET['module']=='publikasi')){
	$tseo = $pdo->query("SELECT id_kategori_produk,judul,judul_seo,keyword,description FROM kategori_produk WHERE judul_seo='$_GET[seo]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[judul] | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	$imageshare = "images/default-share.jpg";
	$urlshare = $default4."/produk/$seo[judul_seo]";


}elseif(($_GET['module']=='detproduk')){
	$tseo = $pdo->query("SELECT id_produk,judul,judul_seo,gambar,keyword,description FROM produk WHERE id_produk='$_GET[id]'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[judul] | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	if($seo["gambar"]==""){
	$imageshare = "images/default-share.jpg";
	}else{
	$imageshare = "images/produk/$seo[gambar]";
	}
	$urlshare = $default4."/produk/$seo[judul_seo]-$seo[id_produk]";
	
}elseif(($_GET['module']=='search')){
	$tseo = $pdo->query("SELECT title, keyword, description FROM page WHERE id_page='0'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "Search | $default";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	$imageshare = "images/default-share.jpg";
	$urlshare = $default4."/$_GET[module]";
	
}else{
	$tseo = $pdo->query("SELECT title, keyword, description FROM page WHERE id_page='0'");
	$seo = $tseo->fetch(PDO::FETCH_ASSOC);
	
	$title = "$seo[title]";
	$keyword = "$seo[keyword]";
	$description = "$seo[description]";
	
	$imageshare = "images/default-share.jpg";
	$urlshare = $default4."/$_GET[module]";
}
?><title><?php echo $title; ?></title>
		<meta name="keywords" content="<?php echo $keyword; ?>">
		<meta name="description" content="<?php echo $description; ?>">
		<link rel="icon" type="image/x-icon" href="<?php echo $default4 ?>/images/icon.png" />
      
		<meta name="google-site-verification" content="KoNB7ULrtMVacGLqQeBEc2IXjxCAXm5-j3OnfNit0WE" />
		<meta name="googlebot" content="index,follow">
		<meta name="googlebot-news" content="index,follow">
		<meta name="robots" content="index,follow">

		<meta property="fb:app_id" content="501046580289991">
		<meta property="og:title" content="<?php echo $title; ?>">
		<meta property="og:type" content="article">
		<meta property="og:site_name" content="<?php echo $default; ?>">
	  
		<meta name="image_src" content="<?php echo $default4.'/'.$imageshare ?>">
		<meta property="og:image" content="<?php echo $default4.'/'.$imageshare ?>">
		<meta property="og:image:alt" content="<?php echo $default4.'/'.$imageshare ?>">
		<meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="620" />
		<meta property="og:image:height" content="413" />
		<meta property="og:url" content="<?php echo $urlshare ?>">
		
		<link rel="canonical" href="<?php echo $urlshare ?>">
		
		<meta property="og:description" content="<?php echo $description; ?>">
		<meta name="news_keywords" content="<?php echo $keyword; ?>">
		<link rel="shortlink" href="<?php echo $default3 ?>">