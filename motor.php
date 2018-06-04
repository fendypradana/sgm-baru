<?php 
  error_reporting(0);
  session_start();	
	include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
	include "config/fungsi_rupiah.php";
	include "config/fungsi_gambar.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SGM</title>
	<link rel="stylesheet" type="text/css" href="template/css/style.css"  media="screen" />
	<link rel="stylesheet" type="text/css" href="template/css/common.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="template/css/button.css" media="screen" />
	<script src="template/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="template/js/slides.min.jquery.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function(){
			$('.slides').slides({
				preload: true,
				generatePagination: true,
				play:3000
			});
		});
	</script>
</head>
<body>
<!--Wrapper-->
<div id="wrapper"> 
      <!--Page-->
      <div class="page shadow"> 
    <!--Header-->
    <div id="header">
          <div class="primary-section">
        <div class="logo"><img src="template/images/logo.png" /></div>
		<div class="header-aside"> 
          <ul>
		<?php
		if ($_SESSION[email]=="") {
			echo "
			<li class='border'><a href='motor.php?module=login' class='log'> Masuk </a></li>
            <li><a href='motor.php?module=register' class='user'>Daftar</a></li>
			";
		}
		else {
			echo "<li><a href='logout.php' class='log'> Keluar </a></li>";
		}
		?>
          </ul>
            </div>
      </div>
          <div class="nav-section">
        <ul class="navigation">
              <li class="home"><a href="motor.php?module=home" class="home">Beranda </a></li>
			  <li><a href="motor.php?module=barang">Produk</a></li>
              <li><a href="motor.php?module=pesanan">Pemesanan</a></li>
              <li><a href="motor.php?module=pengiriman">Pengiriman</a></li>
            </ul>
        </div>
    <!--Header--> 
    <!--Content-->
    <div id="content">
          <div class="sidebar">
		  
        <div class="latest-product ">
              <h2>Kategori</h2>
              <ul class="info">
			  <?php
			              $kategori=mysql_query("select nama_kategori, kategori.id_kategori, 
                                  count(produk.id_produk) as jml 
                                  from kategori left join produk 
                                  on produk.id_kategori=kategori.id_kategori 
                                  group by nama_kategori");
            $no=1;
            while($k=mysql_fetch_array($kategori)){
                echo "<li><a href='motor.php?module=detailkategori&id=$k[id_kategori]'> $k[nama_kategori] ($k[jml])</a></li>";
              $no++;
            }
            ?>
          </ul>
           </div>
      </div>
          <div class="content-right" >
	<?PHP include "tengah.php";?> 
      </div>
     </div>
    <!-- Content--> 
  </div>
      <!--Footer-->
      <div id="footer">
    <div class="footer-top">
    <div class="page">
          <div class="footer-bottom">
		
        </div>
        </div>
  </div>
      <!--Footer--> 
    </div>
<!--Wrapper-->
</body>
</html>
