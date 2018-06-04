<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_penjualan/aksi_penjualan.php";
switch($_GET[act]){
  // Tampil Order
  default:
  
  $tampilkan=mysql_query("SELECT * FROM produk ORDER BY id_produk");
		  $r    = mysql_fetch_array($tampilkan);
  
    echo "<h2>Transaksi Penjualan</h2>
          <form method=POST action=?halaman=penjualan&act=update&id=$r[id_produk]>
          

          <table>
		  <tr><td>Id Produk</td>  <td> : <select name='jml[$no]'  onChange='this.form.submit()'>";
 
          
          if ($r[id_produk]==0){
            echo "<option value=0 selected>- Pilih Id Produk -</option>";
          }   

          while($w=mysql_fetch_array($tampilkan)){
            if ($r[id_produk]==$w[id_produk]){
              echo "<option value=$w[id_produk] selected>$w[id_produk]</option>";
            }
            else{
              echo "<option value=$w[id_produk]>$w[id_produk]</option>";
            }
          }
    echo "</select></td></tr>
	<tr><td>Nama Barang</td>        <td> : $r[nama_produk]</td></tr>
          <tr><td>Harga Satuan</td> <td> : $r[harga]</td></tr>
          <tr><td>Quantity      </td><td>: <select name=status_order>$r[stok]</select></td> </tr>
		  <tr><td></td><td><a href=?halaman=penjualan&act=update>Tambah</a></td></tr>
          </table></form>";
  

  
		

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table border=0 width=500>
        <tr><th>Nama Produk</th><th>Berat(kg)</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total		
   $disc        = ($s[diskon]/100)*$s[harga];
   $hargadisc   = number_format(($s[harga]-$disc),0,",","."); 
   $subtotal    = ($s[harga]-$disc) * $s[jumlah];

    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s[harga]);

   $subtotalberat = $s[berat] * $s[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

    echo "<tr><td>$s[nama_produk]</td><td align=center>$s[berat]</td><td align=center>$s[jumlah]</td>
              <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";
  }

  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,kustomer,orders 
          WHERE kustomer.id_kota=kota.id_kota AND orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'"));
  $ongkoskirim1=$ongkos[ongkos_kirim];
  $ongkoskirim=$ongkoskirim1 * $totalberat;

  $grandtotal    = $total + $ongkoskirim; 

  $ongkoskirim_rp = format_rupiah($ongkoskirim);
  $ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
  $grandtotal_rp  = format_rupiah($grandtotal);    

echo "<tr><td colspan=4 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=4 align=right>Ongkos Kirim       Rp. : </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
      <tr><td colspan=4 align=right>Total Berat            : </td><td align=right><b>$totalberat</b> Kg</td></tr>      
      <tr><td colspan=4 align=right>Total Ongkos Kirim Rp. : </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=4 align=right>Grand Total        Rp. : </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table border=0 width=500>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama Kustomer</td><td> : $r[nama_lengkap]</td></tr>
        <tr><td>Alamat Pengiriman</td><td> : $r[alamat]</td></tr>
        <tr><td>Nomor Rekening</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
        </table>";

    break;  
}
}
?>
