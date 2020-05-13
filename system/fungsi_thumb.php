<?php
include "z_setting.php";
	
function UploadAll($fupload_name,$folder,$lebar,$tinggi){
	global $imgname1;
	global $imgname2;
	
	$vdir_upload = "../../../images/$folder/";
	$vdir_upload2 = "../../../images/$folder/small/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	if($lebar==0){if($src_width>1200){$dst_width = 1200;}else{$dst_width = $src_width;}}else{$dst_width=$lebar;}
	if($tinggi==0){$dst_height = ($dst_width/$src_width)*$src_height;}else{$dst_height=$tinggi;}

	$im = imagecreatetruecolor($dst_width,$dst_height);
	imagealphablending($im, false);
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $color);
	imagesavealpha($im, true);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }

	$dst_height2 = $src_width / 2;
	$dst_width2 = ($dst_height2/$src_height)*$src_width;

	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	imagealphablending($im2, false);
	$color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
	imagefill($im2, 0, 0, $color);
	imagesavealpha($im2, true);
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);
}


function UploadProduk($fupload_name){
	global $imgname1;
	
	//direktori gambar
	$vdir_upload = "../../../images/produk/";
	$vdir_upload2 = "../../../images/produk/small/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);
	
	if($src_width>1200){
		$dst_width = 1200;
	}elseif($src_width<640){
		$dst_width = 640;
	}else{
		$dst_width = $src_width;
	}
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	imagealphablending($im, false);
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $color);
	imagesavealpha($im, true);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }

	$dst_width2 = 500;
	$dst_height2 = ($dst_width2/$src_width)*$src_height;

	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	
	imagealphablending($im2, false);
	$color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
	imagefill($im2, 0, 0, $color);
	imagesavealpha($im2, true);
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);
}


function UploadSlideproduk($fupload_name){
	global $imgname1;
	
	//direktori gambar
	$vdir_upload = "../../../images/slideproduk/";
	$vdir_upload2 = "../../../images/slideproduk/small/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);
	
	if($src_width>1200){
		$dst_width = 1200;
	}elseif($src_width<640){
		$dst_width = 640;
	}else{
		$dst_width = $src_width;
	}
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	imagealphablending($im, false);
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $color);
	imagesavealpha($im, true);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }

	$dst_width2 = 500;
	$dst_height2 = ($dst_width2/$src_width)*$src_height;

	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	
	imagealphablending($im2, false);
	$color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
	imagefill($im2, 0, 0, $color);
	imagesavealpha($im2, true);
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);
}

function UploadAbout($fupload_name){
	global $imgname1;
	global $imgname2;
	
	//direktori gambar
	$vdir_upload = "../../../images/about/";
	$vdir_upload2 = "../../../images/about/small/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];

	//Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	//identitas file asli  
	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	$dst_width = 1000;
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	// Turn off transparency blending (temporarily)
	imagealphablending($im, false);
	// Create a new transparent color for image
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	// Completely fill the background of the new image with allocated color.
	imagefill($im, 0, 0, $color);
	// Restore transparency blending
	imagesavealpha($im, true);
	//0, 0, 0, 0 letak gambar
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }

	$dst_height2 = 347;
	$dst_width2 = ($dst_height2/$src_height)*$src_width;

	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	
	imagealphablending($im2, false);
	// Create a new transparent color for image
	$color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
	// Completely fill the background of the new image with allocated color.
	imagefill($im2, 0, 0, $color);
	// Restore transparency blending
	imagesavealpha($im2, true);
	
	//0, 0, 0, 0 letak gambar
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im2,$vdir_upload2 . $imgname2."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im2,$vdir_upload2 . $imgname2."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im2,$vdir_upload2 . $imgname2."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im2,$vdir_upload2 . $imgname2."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);
}











function UploadSosmed($fupload_name){
	
	global $imgname1;
	
	//direktori gambar
	$vdir_upload = "../../../images/sosmed/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];

	//Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	//identitas file asli  
	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	$dst_width = 40;
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	// Turn off transparency blending (temporarily)
	imagealphablending($im, false);
	// Create a new transparent color for image
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	// Completely fill the background of the new image with allocated color.
	imagefill($im, 0, 0, $color);
	// Restore transparency blending
	imagesavealpha($im, true);
	//0, 0, 0, 0 letak gambar
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
}



function UploadModul($fupload_name){
	//direktori gambar
	$vdir_upload = "../../../images/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];

	//Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function UploadPage($fupload_name){
	global $imgname1;
	
	//direktori gambar
	$vdir_upload = "../../../images/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];

	//Simpan gambar dalam ukuran sebenarnya
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	//identitas file asli  
	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);

	$dst_width = $src_width;
	$dst_height = $src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	// Turn off transparency blending (temporarily)
	imagealphablending($im, false);
	// Create a new transparent color for image
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	// Completely fill the background of the new image with allocated color.
	imagefill($im, 0, 0, $color);
	// Restore transparency blending
	imagesavealpha($im, true);
	//0, 0, 0, 0 letak gambar
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }

	imagedestroy($im_src);
	imagedestroy($im);
}


function UploadAdmin($fupload_name){
	global $imgname1;
	
	//direktori gambar
	$vdir_upload = "../../../images/admin/";
	$vdir_upload2 = "../../../images/admin/small/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);
	
	if($src_width>600){
		$dst_width = 600;
	}else{
		$dst_width = $src_width;
	}
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	imagealphablending($im, false);
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $color);
	imagesavealpha($im, true);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }

	$dst_width2 = 300;
	$dst_height2 = ($dst_width2/$src_width)*$src_height;

	$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
	
	imagealphablending($im2, false);
	$color = imagecolorallocatealpha($im2, 0, 0, 0, 127);
	imagefill($im2, 0, 0, $color);
	imagesavealpha($im2, true);
	imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im2,$vdir_upload2 . $imgname1."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
	imagedestroy($im2);
}


function UploadBanner($fupload_name){
	global $imgname1;
	
	//direktori gambar
	$vdir_upload = "../../../images/banner/";
	$vfile_upload = $vdir_upload . $fupload_name;
	$tipe_file   = $_FILES['fupload']['type'];
	move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

	if ($tipe_file=="image/jpeg" ){
		$im_src = imagecreatefromjpeg($vfile_upload);
	}elseif ($tipe_file=="image/png" ){
		$im_src = imagecreatefrompng($vfile_upload);
	}elseif ($tipe_file=="image/gif" ){
		$im_src = imagecreatefromgif($vfile_upload);
    }elseif ($tipe_file=="image/wbmp" ){
		$im_src = imagecreatefromwbmp($vfile_upload);
    }
	$src_width = imageSX($im_src);
	$src_height = imageSY($im_src);
	
	$dst_width = $src_width;
	$dst_height = ($dst_width/$src_width)*$src_height;

	$im = imagecreatetruecolor($dst_width,$dst_height);
	
	imagealphablending($im, false);
	$color = imagecolorallocatealpha($im, 0, 0, 0, 127);
	imagefill($im, 0, 0, $color);
	imagesavealpha($im, true);
	imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

	if ($_FILES["fupload"]["type"]=="image/jpeg" ){
		imagejpeg($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/png" ){
		imagepng($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif ($_FILES["fupload"]["type"]=="image/gif" ){
		imagegif($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
		imagewbmp($im,$vdir_upload . $imgname1."-" . $fupload_name);
    }
  
	imagedestroy($im_src);
	imagedestroy($im);
}
?>
