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

// Hapus Kategori
if ($halaman=='kategori' AND $act=='hapus'){
  mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../motor.php?halaman='.$halaman);
}

// Input kategori
elseif ($halaman=='kategori' AND $act=='input'){
  mysql_query("INSERT INTO kategori(nama_kategori) VALUES('$_POST[nama_kategori]')");
  header('location:../../motor.php?halaman='.$halaman);
}

// Update kategori
elseif ($halaman=='kategori' AND $act=='update'){
  mysql_query("UPDATE kategori SET nama_kategori = '$_POST[nama_kategori]' WHERE id_kategori = '$_POST[id]'");
  header('location:../../motor.php?halaman='.$halaman);
}
}
?>
