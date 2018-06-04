<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_petugas/aksi_petugas.php";
switch($_GET[act]){
  // Tampil
  default:
    echo "<h2>Petugas</h2>
          <table>
          <tr><th>no</th><th>nama</th><th>Telepon</th><th>aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM petugas");
	$no=1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_order]);
      echo "<tr><td align=center>$no</td>
                <td>$r[nama_petugas]</td>
                <td>$r[telpon]</td>
		        <td><a href=?halaman=petugas&act=detailpetugas&id=$r[id_petugas]>Detail</a></td></tr>";
      $no++;
    }
    echo "</table>";

    break;
  
    
  case "detailpetugas":
    $edit = mysql_query("SELECT * FROM petugas WHERE id_petugas ='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    

    echo "<h2>Detail Petugas</h2>
		<table border=0 width=500>
        <tr><th colspan=2>Data Petugas</th></tr>
        <tr><td>Nama</td><td> : $r[nama_petugas]</td></tr>
        <tr><td>Nomor Telepon</td><td> : $r[telpon]</td></tr>
        </table>";

    break;  
}
}
?>
