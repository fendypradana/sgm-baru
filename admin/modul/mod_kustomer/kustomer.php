<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kustomer/aksi_kustomer.php";
switch($_GET[act]){
  // Tampil
  default:
    echo "<h2>Pelanggan</h2>
          <table>
          <tr><th>no</th><th>nama</th><th>alamat</th><th>aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM kustomer");
	$no=1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_order]);
      echo "<tr><td align=center>$no</td>
                <td>$r[nama_lengkap]</td>
                <td>$r[alamat]</td>
		        <td><a href=?halaman=kustomer&act=detailkustomer&id=$r[id_kustomer]>Detail</a></td></tr>";
      $no++;
    }
    echo "</table>";

    break;
  
    
  case "detailkustomer":
    $edit = mysql_query("SELECT * FROM kustomer WHERE id_kustomer ='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    

    echo "<h2>Detail Pelanggan</h2>
		<table border=0 width=500>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama</td><td> : $r[nama_lengkap]</td></tr>
        <tr><td>Alamat</td><td> : $r[alamat]</td></tr>
        <tr><td>Nomor Telepon</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
        </table>";

    break;  
}
}
?>
