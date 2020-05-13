<?php
function seoall($aa,$bb) {
	if($bb=='judul'){
		$hasil = substr($aa,0,100);
   		return $hasil;

	}elseif($bb=='tipefile'){
	    $c = array (' ');
	    $d = array ('/','image');

	    $a = str_replace($d, '', $aa); // Hilangkan karakter yang telah disebutkan di array $d
	    
	    $hasil = strtolower(str_replace($c, '-', $a)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $hasil;
	
	}elseif($bb=='seojdul'){
	    $c = array (' ');
	    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','“','”','’');

	    $a = strtolower($aa);
	    $b = str_replace($d, ' ', $a); // Hilangkan karakter yang telah disebutkan di array $d
	    $hasil = strtolower(str_replace($c, '-', $a)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	    return $hasil;
	
	}
}


//fungsi judul ke judul_seo
function seo($s) {
    $c = array (' ','--','---','----');
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','“','”','’');

    $e = str_replace($d, ' ', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
    $f = strtolower(str_replace($c, '-', $e)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $f;
}

//fungsi jenis gambar
function seo2($s) {
    $c = array (' ');
    $d = array ('/','image');

    $e = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
    $f = strtolower(str_replace($c, '-', $e)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $f;
}


function seo3($s) {
    $c = array (' ');
    $d = array ('--','---','----');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}


function tgldb($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	return $tahun.'-'.$bulan.'-'.$tanggal;		 
}

function tgl($tgl){
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	return $tanggal.'/'.$bulan.'/'.$tahun;		 
}
?>