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
$id=$_POS[id];
if ($halaman=='penjualan' AND $act=='tambah'){
	
		$sid = $_SESSION[email];
	
		$sql2 = mysql_query("SELECT stok FROM produk WHERE id_produk='$id'");
		$r=mysql_fetch_array($sql2);
		$stok=$r[stok];
	  
	  if ($stok == 0){
		  echo "stok habis";
	  }
	  else{
		// check if the product is already
		// in cart table for this session
		$sql = mysql_query("SELECT id_produk FROM orders_temp
				WHERE id_produk='$_GET[id]'");
		$ketemu=mysql_num_rows($sql);
		if ($ketemu==0){
			// put the product in cart table
			mysql_query("INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp)
					VALUES ('$_GET[id]', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
		} else {
			// update product quantity in cart table
			mysql_query("UPDATE orders_temp 
					SET jumlah = jumlah + 1
					WHERE id_session ='$sid' AND id_produk='$_GET[id]'");		
		}	
		deleteAbandonedCart();
		header('Location:motor.php?halaman=penjualanbelanja');
	  }				
	}

	elseif ($halaman=='penjualan' AND $act=='hapus'){
		mysql_query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
		header('Location:motor.php?halaman=penjualanbelanja');				
	}

elseif ($halaman=='penjualan' AND $act=='update'){
  $id       = $_POST[id];
  $jml_data = count($id);
  $jumlah   = $_POST[jml]; // quantity
  for ($i=1; $i <= $jml_data; $i++){
	$sql2 = mysql_query("SELECT stok_temp FROM orders_temp	WHERE id_orders_temp='".$id[$i]."'");
	while($r=mysql_fetch_array($sql2)){
    if ($jumlah[$i] > $r[stok_temp]){
        echo "<script>window.alert('Jumlah yang dibeli melebihi stok yang ada');
        window.location=('motor.php?halaman=penjualanbelanja')</script>";
    }
    elseif($jumlah[$i] == 0){
        echo "<script>window.alert('Anda tidak boleh menginputkan angka 0 atau mengkosongkannya!');
        window.location=('motor.php?halaman=penjualanbelanja')</script>";
    }
    else{
      mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah[$i]."'
                                      WHERE id_orders_temp = '".$id[$i]."'");
      header('Location:motor.php?halaman=penjualanbelanja');
    }
  }
  }
}
}
?>
