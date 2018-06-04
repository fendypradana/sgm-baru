<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET[halaman]=='home'){
  if ($_SESSION['leveluser']=='admin'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website. </p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }
}

// Bagian Penjualan
elseif ($_GET[halaman]=='penjualan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_penjualan/penjualan.php";
  }
}

elseif ($_GET[halaman]=='laporanpemesanan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporanpemesanan/laporan.php";
  }
}

// Bagian Kategori
elseif ($_GET[halaman]=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Produk
elseif ($_GET[halaman]=='produk'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_produk/produk.php";
  }
}

// Bagian pelanggan
elseif ($_GET[halaman]=='pelanggan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pelanggan/pelanggan.php";
  }
}

// Bagian pelanggan
elseif ($_GET[halaman]=='kustomer'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kustomer/kustomer.php";
  }
}

// Bagian petugas
elseif ($_GET[halaman]=='petugas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_petugas/supir.php";
  }
}

// Bagian Order
elseif ($_GET[halaman]=='order'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_order/order.php";
  }
}

// Bagian Kota/Ongkos Kirim
elseif ($_GET[halaman]=='kirim'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kirim/kirim.php";
  }
}

// Bagian Laporan
elseif ($_GET[halaman]=='laporan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<h2>Ma'af, halaman belum lengkap</h2>
  <p><b>MASIH DALAM PROSES</b></p>";
}
?>
