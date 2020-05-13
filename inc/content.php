<?php 
if($_GET['module']=='home'){
	include("inc/home.php");
}

elseif($_GET['module']=='produk'){
	include("inc/produk.php");
}
elseif($_GET['module']=='artikel'){
	include("inc/artikel.php");
}
elseif($_GET['module']=='detartikel'){
	include("inc/detartikel.php");
}


elseif($_GET['module']=='detproduk'){
	include("inc/detproduk.php");
}
elseif($_GET['module']=='kategori'){
	include("inc/kategori.php");
}
elseif($_GET['module']=='subkategori'){
	include("inc/subkategori.php");
}


elseif($_GET['module']=='detpage'){
	include("inc/detpage.php");
}


elseif($_GET['module']=='save-contact'){
	$name = "$_POST[fname] $_POST[lname]";
	
	//if(!empty($_POST['kode'])){
	//	if($_POST['kode']==$_SESSION['captcha_session']){

			$vv = $pdo->query("SELECT email FROM admin WHERE id='1'");
			$mailadmin = $vv->fetch(PDO::FETCH_ASSOC);
			
			$ss = $pdo->query("SELECT gambar FROM module WHERE id_module='1'");
			$logozz = $ss->fetch(PDO::FETCH_ASSOC);

			$to = "$mailadmin[email]";
			$subjectz = "Message From Website puslitbangperhutani.com";
			
			$headers = "From: " . strip_tags($_POST['email']) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$messagez = '<html><body>';
			$messagez .= '<img src="https://puslitbangperhutani.com/images/module/'.$logozz['gambar'].'" alt=""/>';
			$messagez .= '<table rules="all" style="border-color: #666;" cellpadding="10" width="400px">';
			$messagez .= "<tr style='background: #eee;'><td colspan='2'>Kontak From " . $_POST['email'] . "</td></tr>";
			$messagez .= "<tr style='background: #eee;'><td width='150px'><strong>Name:</strong> </td><td width='250px'>" . $name . "</td></tr>";
			$messagez .= "<tr><td><strong>Subject:</strong> </td><td>" . strip_tags($_POST['subject']) . "</td></tr>";
			$messagez .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
			$messagez .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
			$messagez .= "</table>";
			$messagez .= "</body></html>";
			
			//mail($to,$subjectz,$messagez, $headers);
			
			try {
				$stmt = $pdo->prepare("INSERT INTO contact
											(name,email,subject,message,status,tgl_masuk)
											VALUES(:name,:email,:subject,:message,'New', now())" );
					
				$stmt->bindParam(":name", $name, PDO::PARAM_STR);
				$stmt->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
				$stmt->bindParam(":subject", $_POST["subject"], PDO::PARAM_STR);
				$stmt->bindParam(":message", $_POST["message"], PDO::PARAM_STR);
				$count = $stmt->execute();
			
				echo "<script>window.alert('Your message has been sent.');window.location=('about-us');</script>";
			}catch(PDOException $e){
				echo "<script>window.alert('Your message failed to send.');window.location=('javascript:history.go(-1)');</script>";
			}
		//}else{			
		//	echo "<script>window.alert('Captcha code does not match!');window.location=('javascript:history.go(-1)');</script>";
		//}
	//}else{
	//	echo "<script>window.alert('You have not entered the captcha code yet!');window.location=('javascript:history.go(-1)');</script>";
	//}
}



elseif($_GET['module']=='jumlah') { 
	$cookie_name = "jumlahqty";
	$cookie_value = $_POST['qty'];
	setcookie($cookie_name, $cookie_value, time() + 7, "/"); // 86400 = 1 day
	
	echo "<script>window.location(history.back(-1))</script>";
	die();
}
elseif($_GET['module']=='pencarian') { 
	$cookie_name = "cari";
	$cookie_value = $_POST['kata'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	
	//echo "<script>window.location(search)</script>";
	//header('location:search');
	header("Location: search");
	die();
}
elseif($_GET['module']=='search') { 
	include("inc/search.php");
}

else{
	echo "ERROR";
}
?>