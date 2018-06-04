<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
error_reporting(0);

include "class.ezpdf.php";
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "rupiah.php";
  
$pdf = new Cezpdf('A4','landscape');
 
// Set margin dan font
$pdf->ezSetCmMargins(3, 3, 3, 3);
$pdf->selectFont('fonts/Courier.afm');

$all = $pdf->openObject();

// Tampilkan logo
$pdf->setStrokeColor(0, 0, 0, 1);
$pdf->addJpegFromFile('logo.jpg',20,800,69);

// Teks di tengah atas untuk judul header
$pdf->addText(350, 575, 20,'<b>Pemesanan</b>');
$pdf->addText(300, 550, 18,'<b>Surya Gemilang Motor</b>');
//Garis atas untuk header
$pdf->line(2, 525, 840, 525);

//Garis bawah untuk footer
$pdf->line(2, 50, 840, 50);

//Teks kiri bawah
date_default_timezone_set("Asia/Jakarta");
$pdf->addText(10,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

$pdf->closeObject();

// Tampilkan object di semua halaman
$pdf->addObject($all, 'all');

$sekarang=date('Y-m-d');

// Query untuk merelasikan kedua tabel di filter berdasarkan tanggal
$sql = mysql_query("SELECT orders.id_orders as faktur,DATE_FORMAT(tgl_order, '%d-%m-%Y') as tanggal,
                    nama_produk,jumlah,harga,nama_lengkap,alamat,telpon
                    FROM orders, orders_detail, produk, kustomer
                    WHERE (orders.id_kustomer=kustomer.id_kustomer) 
                    AND (orders_detail.id_produk=produk.id_produk) 
                    AND (orders_detail.id_orders=orders.id_orders)
                    AND (orders.status_order='Diproses')");
$jml = mysql_num_rows($sql);

if ($jml > 0){
$i = 1;
while($r = mysql_fetch_array($sql)){
  $quantityharga=rp($r[jumlah]*$r[harga]);
  $hargarp=rp($r[harga]); 
  $faktur=$r[faktur];
  
  $data[$i]=array('<b>No</b>'=>$i,  
                  '<b>Tanggal</b>'=>$r[tanggal], 
                  '<b>Nama</b>'=>$r[nama_lengkap], 
                  '<b>Alamat</b>'=>$r[alamat], 
                  '<b>Telp</b>'=>$r[telpon], 
                  '<b>Produk</b>'=>$r[nama_produk], 
                  '<b>Qty</b>'=>$r[jumlah], 
                  '<b>Harga</b>'=>$hargarp,
                  '<b>Sub Total</b>'=>$quantityharga);
	$total = $total+($r[jumlah]*$r[harga]);
	$totqu = $totqu + $r[jumlah];
  $i++;
}

$pdf->ezTable($data, '', '', '');

$tot=rp($total);
$pdf->ezText("\n\nTotal keseluruhan : Rp. {$tot}");
$pdf->ezText("\nJumlah pesanan : {$jml} unit");
$pdf->ezText("Jumlah keseluruhan pesanan: {$totqu} unit");

// Penomoran halaman
$pdf->ezStartPageNumbers(420, 15, 8);
$pdf->ezStream();
}
else{
$skrg=date('d-M-Y');
  echo "Tidak ada transaksi/order pada Tanggal <b>$skrg</b><br /><br />
       <input type=button value=Kembali onclick=self.history.back()>";
}
}
?>
