<?php
function youtube($s) {
    $c = array ('');
    $d = array ('https://www.youtube.com/watch?v=','https://youtube.com/watch?v=','www.youtube.com/watch?v=','http://www.youtube.com/watch?v=','https://youtu.be/');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
    
    $s = str_replace($c, '', $s); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
?>
