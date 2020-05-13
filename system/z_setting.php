<?php
	//error_reporting(0);
	$code = "khmi";
	//'text','textarea','images'

	$sql7 = $pdo->query("SELECT id_module,deskripsi,gambar,jenis_modul FROM module WHERE status='on' ORDER BY id_module ASC");
	while($tsql7 = $sql7->fetch(PDO::FETCH_ASSOC)){
		if($tsql7['jenis_modul']!='images'){
			$deskrip[$tsql7['id_module']] = $tsql7['deskripsi'];
		}else{
			$deskrip[$tsql7['id_module']] = $tsql7['gambar'];
		}
	}
	//Humas Indonesia,HumasIndonesia.id,humasindonesia.id,humas-indonesia,humas-indonesia
	//Jogja Indo Trans,Jogjaindotrans.com,jogjaindotrans.com,jogja-indo-trans,jogja-indo-trans
	$nmgweb 	= explode(",", $deskrip[0]);
	$ng1=$nmgweb[0]; //nama web admin Jogja Indo Trans
	$ng2=$nmgweb[1]; //nama web url text Jogjaindotrans.com
	$ng3=$nmgweb[2]; //nama web url jogjaindotrans.com
	$ng4=$nmgweb[3]; //gambar 1
	$ng5=$nmgweb[4]; //gambar 2
	
	$namaweb  	= $ng1;
	$namaweb1  	= $ng2;
	$namaweb2  	= $ng3;
	$imgname1  	= $ng4;
	$imgname2  	= $ng5;
?>