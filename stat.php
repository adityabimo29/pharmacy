<?php
	error_reporting(0);
	// Statistik user
	date_default_timezone_set("Asia/Bangkok");
	$ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
	$tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
	$waktu   = time();
	
	$bataswaktu       = time() - 300;
	

    include "system/cek_browser.php";
    $obj = new BrowserDetection();
    $data = $obj->detect()->getInfo();

    $detek 	= explode(",", $data);
	$browser=$detek[0];
	$platform=$detek[1];
	
	
	$stmtc = $pdo->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal' AND browser='$browser' AND platform='$platform'");
	$row_count = $stmtc->rowCount();
	if($row_count == 0){
		$stmt = $pdo->prepare("INSERT INTO statistik
									(ip, tanggal, hits, online, browser, platform)
								VALUES(:ip,:tanggal,'1',:waktu,:browser, :platform)" );
		
		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		$stmt->bindParam(":tanggal", $tanggal, PDO::PARAM_STR);
		$stmt->bindParam(":waktu", $waktu, PDO::PARAM_STR);
		$stmt->bindParam(":browser", $browser, PDO::PARAM_STR);
		$stmt->bindParam(":platform", $platform, PDO::PARAM_STR);
		$stmt->execute();
	}else{
		$results = $stmtc->fetch(PDO::FETCH_ASSOC);
		
		$sql = "UPDATE statistik
						SET hits 			= hits+1,
							online 			= :online,
							ip 				= :ip
						WHERE id 	= :id
					  ";
					  
		$statement = $pdo->prepare($sql);
		$statement->bindParam(":ip", $ip, PDO::PARAM_STR);
		$statement->bindParam(":online", $waktu, PDO::PARAM_STR);
		$statement->bindParam(":id", $results['id'], PDO::PARAM_STR);
		$statement->execute();
	}

  	/*
	$edit1 = $pdo->query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip ASC"); //pengunjung hari ini
	$edit2 = $pdo->query("SELECT hits FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal ASC"); //hits hari ini
	$edit3 = $pdo->query("SELECT SUM(hits) as totalz FROM statistik");
	$edit4 = $pdo->query("SELECT * FROM statistik WHERE online > '$bataswaktu'");
	$edit5 = $pdo->query("SELECT COUNT(hits) as totalz FROM statistik");
	
	
	$row_count1 = $edit1->rowCount();
	$row_count2 = $edit2->rowCount();
	$row_count3 = $edit3->fetch(PDO::FETCH_ASSOC);
	$row_count4 = $edit4->rowCount();
	$row_count5 = $edit5->fetch(PDO::FETCH_ASSOC);
	*/
	
/*
echo '
<div class="boxvisitor">
	<ul>
   		<li><i class="fa fa-group"></i> Today Visitors : '.$row_count1.'</li>
   	 	<li><i class="fa fa-star-o"></i> Hits Today :  '.$row_count2.'</li>
   	 	<li><i class="fa fa-star"></i> Total Hits :  '.$row_count3['totalz'].'</li>
    	<li><i class="fa fa-user"></i> Online Visitors : <b>'.$row_count4.' </b></li>
   	 	<li><i class="fa fa-bar-chart"></i>Total Visitors :  '.$row_count5['totalz'].'</li>
    </ul>
</div>
';
*/

?>