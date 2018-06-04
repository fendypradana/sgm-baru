<?php
$aksi="modul/mod_pelanggan/aksi_pelanggan.php";
switch($_GET[act]){
  // Tampil Pelanggan
  default:
    echo "<h2>Pelanggan</h2>
          <input type=button value='Tambah Pelanggan' 
          onclick=\"window.location.href='?halaman=kustomer&act=tambahkategori';\">
          <table>
          <tr><th>no</th><th>nama kustomer</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM kustomer ORDER BY id_kustomer DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kategori]</td>
             <td><a href=?halaman=kustomer&act=editkategori&id=$r[id_kategori]>Edit</a> | 
	               <a href=$aksi?halaman=kustomer&act=hapus&id=$r[id_kategori]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Pelanggan
  case "tambahkategori":
    echo "<h2>Tambah Pelanggan</h2>
          <form method=POST action='$aksi?halaman=kustomer&act=input'>
          <table>
          <tr><td>Nama Pelanggan</td><td> : <input type=text name='nama_kategori'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Pelanggan  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kustomer WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Pelanggan</h2>
          <form method=POST action=$aksi?halaman=kustomer&act=update>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table>
          <tr><td>Nama Pelanggan</td><td> : <input type=text name='nama_kategori' value='$r[nama_kategori]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
