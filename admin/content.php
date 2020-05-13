<?php
//error_reporting(E_PARSE); 

if($_SESSION['leveladmin'] === 'admin' ){

	if ($_GET['module']=='home'){
		include "modul/home/index.php";
	}

	elseif($_GET['module']=='lap-pembelian'){
		include "modul/lap-pembelian/index.php";
	}

	elseif($_GET['module']=='lap-penjualan'){
		include "modul/lap-penjualan/index.php";
	}

	elseif($_GET['module']=='backup'){
		include "modul/backup/index.php";
	}

	elseif($_GET['module']=='lap-stok'){
		include "modul/lap-stok/index.php";
	}

	elseif($_GET['module']=='artikel'){
		include "modul/artikel/index.php";
	}

	elseif($_GET['module']=='penjualan'){
		include "modul/penjualan/index.php";
	}

	elseif($_GET['module']=='cek-stok'){
		include "modul/cek-stok/index.php";
	}

	elseif($_GET['module']=='pembelian'){
		include "modul/pembelian/index.php";
	}

	elseif($_GET['module']=='distributor'){
		include "modul/distributor/index.php";
	}

	elseif($_GET['module']=='obat'){
		include "modul/obat/index.php";
	}

	elseif($_GET['module']=='produk'){
		include "modul/produk/index.php";
	}


	elseif($_GET['module']=='kategori'){
		include "modul/kategori/index.php";
	}
	elseif($_GET['module']=='keunggulan'){
		include "modul/keunggulan/index.php";
	}
	elseif($_GET['module']=='testimoni'){
		include "modul/testimoni/index.php";
	}
	elseif($_GET['module']=='subkategori'){
		include "modul/subkategori/index.php";
	}

	elseif($_GET['module']=='sosmed'){
		include "modul/sosmed/index.php";
	}

	elseif($_GET['module']=='page'){
		include "modul/page/index.php";
	}

	elseif($_GET['module']=='slider'){
		include "modul/slider/index.php";
	}
	
	elseif($_GET['module']=='module'){
		include "modul/module/index.php";
	}
	
	elseif($_GET['module']=='contact'){
		include "modul/contact/index.php";
	}
	
	
	elseif($_GET['module']=='banner'){
		include "modul/banner/index.php";
	}
	
	elseif($_GET['module']=='admin'){
		include "modul/admin/index.php";
	}
	
	elseif($_GET['module']=='member'){
		include "modul/member/index.php";
	}
	
	elseif($_GET['module']=='commentbox'){
		include "modul/commentbox/index.php";
	}
	
	elseif($_GET['module']=='statistik'){
		include "modul/statistik/index.php";
	}

	else{
	  echo "<p><b>not found!</b></p>";
	}


if($_GET['module']=='setting') {
	if($_GET['set']=='limit'){
		$cookie_name = "limit";
		$cookie_value = $_GET['ll'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	}elseif($_GET['set']=='sort'){
		$cookie_name = "sort";
		$cookie_value = $_GET['ll'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	}
	
	if($_GET["page"]=="jurnal"){
		echo "<script>window.location = 'laporan-jurnal'</script>";
	}else{
		echo "<script>window.location = '$_GET[page]'</script>";
	}
}elseif($_GET['module']=='setting3') {
	if($_GET['set']=='periode'){
		$cookie_name = "periode";
		$cookie_value = $_GET['ll'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	}elseif($_GET['set']=='sort'){
		$cookie_name = "sort";
		$cookie_value = $_GET['ll'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	}
	
	echo "<script>window.location = '$_GET[page]-$_GET[act]'</script>";
}elseif($_GET['module']=='setting2') {
	$cookie_name = "rangetime";
	$cookie_value = $_POST['rangetime'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
	
	echo "<script>window.location = 'statistik-$_POST[act]'</script>";
}elseif($_GET['module']=='error'){
	include "modul/error/index.php";
}elseif($_GET['module']=='404'){
	include "modul/404.php";
}

}else if($_SESSION['leveladmin'] === 'gudang'){
	if($_GET['module']=='pembelian'){
		include "modul/pembelian/index.php";
	}

	elseif($_GET['module']=='cek-stok'){
		include "modul/cek-stok/index.php";
	}

	elseif($_GET['module']=='distributor'){
		include "modul/distributor/index.php";
	}

	elseif($_GET['module']=='obat'){
		include "modul/obat/index.php";
	}
	elseif($_GET['module']=='laporanStok'){
		include "modul/laporanStok/index.php";
	}

}else{
	if($_GET['module']=='penjualan'){
		include "modul/penjualan/index.php";
	}

	elseif($_GET['module']=='cek-stok'){
		include "modul/cek-stok/index.php";
	}
	elseif($_GET['module']=='laporanApoteker'){
		include "modul/laporanApoteker/index.php";
	}
}
?>
