<?php
$aksi="modul/mod_petugas/aksi_supir.php";
switch($_GET[act]){
  // Tampil
  default:
    echo "<h2>Petugas</h2>
          <input type=button value='Tambah Petugas' 
          onclick=\"window.location.href='?halaman=petugas&act=tambahpetugas';\">
          <table>
          <tr><th>no</th><th>nama petugas</th><th>Telepon</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM petugas ORDER BY id_petugas DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_petugas]</td>
             <td>$r[telpon]</td>
             <td><a href=?halaman=petugas&act=editpetugas&id=$r[id_petugas]>Edit</a> | 
	               <a href=$aksi?halaman=petugas&act=hapus&id=$r[id_petugas]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah
  case "tambahpetugas":
    echo "<h2>Tambah Petugas</h2>
          <form method=POST action='$aksi?halaman=petugas&act=input'>
          <table>
          <tr><td>Nama Petugas</td><td> : <input type=text name='nama_petugas'></td></tr>
          <tr><td>Telepon</td><td> : <input type=text name='telpon'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit
  case "editpetugas":
    $edit=mysql_query("SELECT * FROM petugas WHERE id_petugas='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Petugas</h2>
          <form method=POST action=$aksi?halaman=petugas&act=update>
          <input type=hidden name=id value='$r[id_petugas]'>
          <table>
          <tr><td>Nama Petugas</td><td> : <input type=text name='nama_petugas' value='$r[nama_petugas]'></td></tr>
          <tr><td>Telepon</td><td> : <input type=text name='telpon' value='$r[telpon]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
