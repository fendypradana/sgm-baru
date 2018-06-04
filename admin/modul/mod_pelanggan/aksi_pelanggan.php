<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$halaman=$_GET[halaman];
$act=$_GET[act];

// Hapus
if ($halaman=='kustomer' AND $act=='hapus'){
  mysql_query("DELETE FROM kustomer WHERE id_kustomer='$_GET[id]'");
  header('location:../../motor.php?halaman='.$halaman);
}

// Input kustomer
elseif ($halaman=='kustomer' AND $act=='input'){
  mysql_query("INSERT INTO kustomer(nama_lengkap) VALUES('$_POST[nama_lengkap]')");
  header('location:../../motor.php?halaman='.$halaman);
}

// Update kustomer
elseif ($halaman=='kustomer' AND $act=='update'){
  mysql_query("UPDATE kustomer SET nama_lengkap = '$_POST[nama_lengkap]' WHERE id_kustomer = '$_POST[id]'");
  header('location:../../motor.php?halaman='.$halaman);
}
}
?>
