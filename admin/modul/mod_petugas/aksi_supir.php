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

// Hapus Petugas
if ($halaman=='petugas' AND $act=='hapus'){
  mysql_query("DELETE FROM petugas WHERE id_petugas='$_GET[id]'");
  header('location:../../motor.php?halaman='.$halaman);
}

// Input petugas
elseif ($halaman=='petugas' AND $act=='input'){
  mysql_query("INSERT INTO petugas(nama_petugas, telpon) VALUES('$_POST[nama_petugas]','$_POST[telpon]')");
  header('location:../../motor.php?halaman='.$halaman);
}

// Update petugas
elseif ($halaman=='petugas' AND $act=='update'){
  mysql_query("UPDATE petugas SET nama_petugas = '$_POST[nama_petugas]', telpon = '$_POST[telpon]' WHERE id_petugas = '$_POST[id]'");
  header('location:../../motor.php?halaman='.$halaman);
}
}
?>
