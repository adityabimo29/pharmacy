<?php
include "../../../../sys/koneksi.php";

$z=mysql_fetch_array(mysql_query("SELECT deskripsi FROM modul WHERE id_modul='19' "));
echo "$z[deskripsi]";
?>