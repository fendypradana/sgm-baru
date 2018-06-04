<?php
  error_reporting(0);

session_start();

if (empty($_SESSION[username]) AND empty($_SESSION[passuser])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses Admin, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>

<html>
<head>
<title>SGM</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
	<div id="menu">
      <ul>
		<li><a href='motor.php?halaman=home'>Home</a></li>
		<li><a href='motor.php?halaman=order'>Pemesanan</a></li>
		<li><a href='motor.php?halaman=kategori'>Kategori</a></li>
		<li><a href='motor.php?halaman=produk'>Produk</a></li>
		<li><a href='motor.php?halaman=kustomer'>Pelanggan</a></li>
		<li><a href='motor.php?halaman=kirim'>Pengiriman</a></li>
		<li><a href='motor.php?halaman=petugas'>Petugas</a></li>
		<li><a href='motor.php?halaman=laporan'>Laporan</a></li>
		<li><a href='logout.php'>Logout</a></li>     
	 </ul>
	    <p>&nbsp;</p>
 	</div>

  <div id="content">
		<?php include "content.php"; ?>
  </div>
  
		<div id="footer">
			Surya Gemilang Motor
		</div>
</div>
</body>
</html>
<?php
}
?>
