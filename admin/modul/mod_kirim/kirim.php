<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kirim/aksi_kirim.php";
switch($_GET[act]){
  // Tampil Order
  default:
    echo "<h2>Pengiriman</h2>
          <table>
          <tr><th>nama kustomer</th><th>alamat</th><th>produk</th><th>jumlah</th><th>harga</th><th>tgl. kirim</th><th>jam</th><th>petugas</th><th>status</th><th>aksi</th></tr>";

    $tampil = mysql_query("SELECT * FROM orders,kustomer,orders_detail, produk  WHERE orders.id_kustomer=kustomer.id_kustomer AND orders.id_orders=orders_detail.id_orders
                     AND orders_detail.id_produk=produk.id_produk AND orders.status_order='Dikirim'");
  
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_order]);
      $tglkir=tgl_indo($r[tgl_kirim]);
      echo "<tr><td>$r[nama_lengkap]</td>
                <td>$r[alamat]</td>
                <td>$r[nama_produk]</td>
                <td>$r[jumlah]</td>
                <td>$r[harga]</td>
                <td>$tglkir</td>
                <td>$r[jam_kirim]</td>
                <td>$r[petugas]</td>
                <td>$r[status_order]</td>
		            <td><a href=?halaman=kirim&act=detailkirim&id=$r[id_orders]>Detail</a></td></tr>";
      $no++;
    }
    echo "</table>";

    break;
  
    
  case "detailkirim":
    $edit = mysql_query("SELECT * FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tgl_kirim]);
    
    if ($r[status_order]=='Diproses'){
        $pilihan_status = array('Diproses', 'Dikirim');
    }
    elseif ($r[status_order]=='Dikirim'){
        $pilihan_status = array('Dikirim', 'Terkirim');    
    }
    else{
        $pilihan_status = array('Diproses', 'Dikirim', 'Terkirim');    
    }

    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2>Detail Pengiriman</h2>
          <form method=POST action=$aksi?halaman=kirim&act=update>
          <input type=hidden name=id value=$r[id_orders]>

          <table>
          <tr><td>No. </td>        <td> : $r[id_orders]</td></tr>
          <tr><td>Tgl. & Jam </td> <td> : $tanggal & $r[jam_kirim]</td></tr>
          <tr><td>Status       </td><td>: <select name=status_order>$pilihan_order</select> 
          <input type=submit value='Ubah Status'></td></tr>
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, produk 
                     WHERE orders_detail.id_produk=produk.id_produk 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table border=0 width=500>
        <tr><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
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

    echo "<tr><td>$s[nama_produk]</td><td align=center>$s[jumlah]</td>
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

echo "<tr><td colspan=3 align=right>Total              Rp. : </td><td align=right><b>$total_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table border=0 width=500>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr><td>Nama Kustomer</td><td> : $r[nama_lengkap]</td></tr>
        <tr><td>Alamat Pengiriman</td><td> : $r[alamat]</td></tr>
        <tr><td>Nomor Telepon</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>
        </table>";

    break;  
}
}
?>
