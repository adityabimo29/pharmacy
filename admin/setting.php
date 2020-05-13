<?php
$img = $pdo->query("SELECT deskripsi FROM module WHERE id_module='0'");
$timg = $img ->fetch(PDO::FETCH_ASSOC);
$nmgweb 	= explode(",", $timg['deskripsi']);
$ng2=$nmgweb[1];
$namaweb  	= $ng1;
$imgname1  	= $ng2;;
?>