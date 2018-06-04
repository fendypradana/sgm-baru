<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  if (form.kode.value == ""){
    alert("Anda belum mengisikan Kode.");
    form.kode.focus();
    return (false);
  }
  return (true);
}

function validasi2(form2){
  if (form2.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form2.email.focus();
    return (false);
  }
  if (form2.password.value == ""){
    alert("Anda belum mengisikan Password.");
    form2.password.focus();
    return (false);
  }
  return (true);
}

function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;
  return true;
}
</script>
<?php
// Halaman utama (Home)
if ($_GET[module]=='home'){
echo'<div class="banner">
              <div class="slides">
				<div class="slides_container">';
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 6");
  while ($r=mysql_fetch_array($sql)){
  $deskripsi=substr($r[deskripsi],0,150);
  	echo"
                  <div class='imgeslider'><img src='foto_produk/$r[gambar]' alt='lapy' title='product' width='360' height='240' />
                <div class='banner-text'>
                      <h1>$r[nama_produk]</h1>
                      <p>$deskripsi</p>
                      </div>
              </div>";
			  }
				
   echo"           </div>
          </div>
        </div>
		";

  echo "<div class='center_title_bar'>Produk Terbaru</div>";
  
  	$per_page = 6;

										$page_query = mysql_query("SELECT COUNT(*) FROM produk");
										$pages = ceil(mysql_result($page_query, 0) / $per_page);

										$page = (isset($_GET[page])) ? (int)$_GET[page] : 1;
										$start = ($page - 1) * $per_page;
										
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $start, $per_page");
  
  while ($r=mysql_fetch_array($sql)){
    
    include "diskon_stok.php";
	echo " <div class='product-info'>
	<a href='motor.php?module=detailproduk&id=$r[id_produk]'>$r[nama_produk]</a>
		<a href='motor.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/$r[gambar]' border='0' height='120' title='Detail' /></a>
            
            <div ><span>$divharga</span></div>
               <ul>
				 <li><a href='#' > $tombol </a></li>
              </ul>
          </div>";
  }
  
  echo "</br></br><center>";
for($i = 1; $i <= $pages; $i++){  
if($page != $i){  
echo "[<a href='motor.php?module=home&page=$i'>$i</a>] ";
}else{  
echo "[$i] ";  
}  
}
echo "</center>"; 
}
//MODULE INI DIGUNAKAN UNTUK MEMBUAT MENU BARU////////////////////////////////////

elseif ($_GET[module]=="barang") {
	echo "<div class='center_title_bar'>Produk Terbaru</div>";
	
	$per_page = 6;

										$page_query = mysql_query("SELECT COUNT(*) FROM produk");
										$pages = ceil(mysql_result($page_query, 0) / $per_page);

										$page = (isset($_GET[page])) ? (int)$_GET[page] : 1;
										$start = ($page - 1) * $per_page;
										
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $start, $per_page");
  while ($r=mysql_fetch_array($sql)){
    
    include "diskon_stok.php";
	echo " <div class='product-info'>
	<a href='motor.php?module=detailproduk&id=$r[id_produk]'>$r[nama_produk]</a>
		<a href='motor.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/$r[gambar]' border='0' height='120' title='Detail' /></a>
            
            <div ><span>$divharga</span></div>
               <ul>
				 <li><a href='#' > $tombol </a></li>
              </ul>
          </div>";
  }
  //membuat pagination 
echo "</br></br><center>";
for($i = 1; $i <= $pages; $i++){  
if($page != $i){  
echo "[<a href='motor.php?module=barang&page=$i'>$i</a>] ";
}else{  
echo "[$i] ";  
}  
}
echo "</center>";  
}

//Module Warning
elseif ($_GET[module]=='warning') {
	echo "<div id='info'>! Untuk Melakukan Hal ini Anda Harus Login Terlebih Dahulu <a href='motor.php?module=login'>disini</a></div>";
}
// Modul detail produk
elseif ($_GET[module]=='detailproduk'){
  // Tampilkan detail produk berdasarkan produk yang dipilih
	$detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
	$r = mysql_fetch_array($detail);
  
  include "diskon_stok.php";
  
  echo "
    	  <div class='product-detail'>
              <div class='img'><a href='foto_produk/$r[gambar]'><img src='foto_produk/$r[gambar]' border='0' width='230' height='210'/></a><br/>
            <div class='prod_price'>$divharga</div>
            <div style='text-align:center;margin-right:18px;'>(stok: $r[stok])</div>
            $tombol
			  </div>
            <div class='product_title_big'><h2>$r[nama_produk]</h2></div>
              <div class='deskripsi'>$r[deskripsi]</div>
          </div>";
          
}
// Modul produk per kategori
elseif ($_GET[module]=='detailkategori'){
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);

  echo "<div class='center_title_bar'>Kategori: $n[nama_kategori]</div>";

  $per_page = 6;
	$page_query = mysql_query("SELECT COUNT(*) FROM produk WHERE id_kategori='$_GET[id]'");
	$pages = ceil(mysql_result($page_query, 0) / $per_page);
    $page = (isset($_GET[page])) ? (int)$_GET[page] : 1;
	$start = ($page - 1) * $per_page;
										
	//$sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $start, $per_page");
  // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
 	$sql = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
            ORDER BY id_produk DESC LIMIT $start, $per_page");		 
	$jumlah = mysql_num_rows($sql);

	// Apabila ditemukan produk dalam kategori
	if ($jumlah > 0){
  while ($r=mysql_fetch_array($sql)){

    include "diskon_stok.php";
	echo " <div class='product-info'>
	<h2><a href='motor.php?module=detailproduk&id=$r[id_produk]'>$r[nama_produk]</a></h2>
		<a href='motor.php?module=detailproduk&id=$r[id_produk]'><img src='foto_produk/$r[gambar]' border='0' height='120' title='Detail' /></a>
           <span>$divharga</span>
               <ul>
                <li><a href='#'> $tombol </a></li>
              </ul>
          </div>";
  }
  //membuat pagination 
echo "</br></br><center>";
for($i = 1; $i <= $pages; $i++){  
if($page != $i){  
echo "[<a href='motor.php?module=detailkategori&id=$_GET[id]&page=$i'>$i</a>] ";
}else{  
echo "[$i] ";  
}  
}
echo "</center>"; 
  }
  else{
    echo "<p align=center>Belum ada produk pada kategori ini.</p>";
  }
}

// Modul Pemesanan
elseif ($_GET[module]=='pesanan'){
  // Tampilkan produk-produk yang telah dipesan
	$sid = $_SESSION[email];
	$sql = mysql_query("SELECT * FROM orders, orders_detail, produk, kustomer WHERE orders.id_kustomer=kustomer.id_kustomer 
                    AND orders_detail.id_produk=produk.id_produk 
                    AND orders_detail.id_orders=orders.id_orders AND kustomer.email='$sid'");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Pemesanan masih kosong');
        window.location=('index.php')</script>";
    }
  else{  
    echo "<div class='center_title_bar'>Pemesanan</div>
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <table border=0 cellpadding=3 align=center width='95%'>
          <tbody>
          <tr bgcolor='#D22E23'><th>No</th><th>Produk</th><th>Nama Produk</th><th>Qty</th>
          <th>Harga</th><th>Sub Total</th><th>Status</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
    echo "<tr style='color:#000;border: 1px solid #ECECEC'><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><br><img src=foto_produk/small_$r[gambar]></td>
              <td>$r[nama_produk]</td>
              <td>$r[jumlah]</td>
              <td>$hargadisc</td>
              <td>$subtotal_rp</td>
              <td>$r[status_order]</td>
          </tr>";
    $no++; 
  } 
  echo "
        </tbody></table><br />
        
        </div>
        
          </div>    
          </div>
          </div>";
  }

}


// Modul Pengiriman
elseif ($_GET[module]=='pengiriman'){
  // Tampilkan produk-produk yang telah dipesan
	$sid = $_SESSION[email];
	$sql = mysql_query("SELECT * FROM orders, orders_detail, produk, kustomer WHERE orders.id_kustomer=kustomer.id_kustomer 
                    AND orders_detail.id_produk=produk.id_produk 
                    AND orders_detail.id_orders=orders.id_orders AND kustomer.email='$sid'");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Pemesanan masih kosong');
        window.location=('index.php')</script>";
    }
  else{  
    echo "<div class='center_title_bar'>Pengiriman</div>
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <table border=0 cellpadding=3 align=center width='95%'>
          <tbody>
          <tr bgcolor='#D22E23'><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th><th>Harga</th><th>Tanggal</th><th>jam</th><th>petugas</th>
          <th>Status</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
    echo "<tr align=center style='color:#000;border: 1px solid #ECECEC'><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><br><img src=foto_produk/small_$r[gambar]></td>
              <td>$r[nama_produk]</td>
              <td>$r[jumlah]</td>
              <td>$hargadisc</td>
              <td>$r[tgl_order]</td>
              <td>$r[jam_order]</td>
              <td>$r[petugas]</td>
              <td>$r[status_order]</td>
          </tr>";
    $no++; 
  } 
  echo "
        </tbody></table><br />
        
        </div>
        
          </div>    
          </div>
          </div>";
  }

}


// Modul Pemesanan
elseif ($_GET[module]=='pesan'){
  // Tampilkan produk-produk yang telah dipesan
	$sid = $_SESSION[email];
	$sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Pemesanan masih kosong');
        window.location=('index.php')</script>";
    }
  else{  
    echo "<div class='center_title_bar'>Pemesanan</div>
          <div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
          <form method=post action=aksi.php?module=keranjang&act=update>
          <table border=0 cellpadding=3 align=center width='95%'>
          <tbody>
          <tr bgcolor='#D22E23'><th>No</th><th>Produk</th><th>Nama Produk</th><th>Qty</th>
          <th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");

    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
    
    echo "<tr style='color:#000;border: 1px solid #ECECEC'><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><br><img src=foto_produk/small_$r[gambar]></td>
              <td>$r[nama_produk]</td>
              <td><select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
              for ($j=1;$j <= $r[stok];$j++){
                  if($j == $r[jumlah]){
                   echo "<option selected>$j</option>";
                  }else{
                   echo "<option>$j</option>";
                  }
              }
        echo "</select></td>
              <td>$hargadisc</td>
              <td>$subtotal_rp</td>
              <td align=center><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
              <img src=images/kali.png border=0 title=Hapus></a></td>
          </tr>";
    $no++; 
  } 
  echo "<tr style='color:#000'><td colspan=6 align=right><br><b>Total</b>:</td><td colspan=2><br>Rp. <b>$total_rp</b></td></tr>
        <tr><td colspan=3><br /><a href='motor.php?module=simpantransaksimember' class='button'>Selesai</a></a><br /></td></tr>
        </tbody></table></form><br />
        
        </div>
        
          </div>    
          </div>
          </div>";
  }

}

//Module Login
elseif ($_GET[module]=='login') {
	if ($_GET[act]=='aksilogin') {
echo "<div id='info'>";
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM	kustomer WHERE email='$email' AND password='$password'";
		$hasil = mysql_query($sql);
		$r = mysql_fetch_array($hasil);
		
		if(mysql_num_rows($hasil) == 0){
					 echo "Email atau Password Anda tidak benar<br />";
		}
		else{
		session_start();
		$_SESSION[email]= $r[email];
		$_SESSION[password]= $r[password];
	   echo "<script> alert('Silahkan Pesan');window.location='index.php'</script>\n";
		 exit(0);
		}
echo "</div>";
	}
  echo "
  <div class='login-box'>
  <h2>Form Login</h2>
      <form name=form2 action=motor.php?module=login&act=aksilogin method=POST onSubmit=\"return validasi2(this)\">
      <table>
      <tr><td>Email</td><td> <input type=text name=email size=30></td></tr>
      <tr><td>Password</td><td> <input type=password name=password size=30></td></tr>
      <tr><td><input type='submit' class='button' value='Login' id='submit'></td></tr>
      </table>
      </form></div>";
}
//Module Profil Kustomer
elseif ($_GET[module]=='profilKustomer') {
	$sql=mysql_query("SELECT * FROM kustomer WHERE email='$_SESSION[email]'");
	$p=mysql_fetch_array($sql);
	$password=md5($p['password']);
	echo "<div class='login-box'>
	<h2>Profil Saya</h2>
      <table width='90%'>
      <tr><td>Nama Lengkap</td><td> $p[nama_lengkap] </td></tr>
      <tr><td>Alamat Pengiriman</td><td> $p[alamat]</textarea></td></tr>
      <tr><td>Nomor Rekening</td><td> $p[rekening]</td></tr>
      <tr><td>Email</td><td>  $p[email]</td></tr>
      <tr><td colspan=2><a href='motor.php?module=editProfilKustomer'><img src='template/images/click-right.png' align='top'>Edit Profil</a></td></tr></table>
	</div>";
}
//Module editProfilKustomer
elseif ($_GET[module]=='editProfilKustomer') {
	if ($_GET[aksi]=='edit') {
		mysql_query("UPDATE  kustomer SET nama_lengkap='$_POST[nama]',
										  alamat= '$_POST[alamat]',
										  rekening= '$_POST[rekening]',
										  id_kota ='$_POST[kota]'
									WHERE email= '$_POST[email]'" ) ;
										  
		echo "<div id='info'>Anda Berhasil Mengedit Profil Anda <a href='motor.php?module=profilKustomer'>Lihat Disini</a></div>";
	}
	$sql=mysql_query("SELECT * FROM kustomer WHERE email='$_SESSION[email]'");
	$e=mysql_fetch_array($sql);
echo "
<div class='login-box'>
<h2>Form Edit Profil</h2>
      <form name=form action=motor.php?module=editProfilKustomer&aksi=edit method=POST onSubmit=\"return validasi(this)\">
      <table width='90%'>
      <tr><td>Nama Lengkap</td><td>  <input type=text name=nama size=30 value='$e[nama_lengkap]'></td></tr>
      <tr><td>Alamat Pengiriman</td><td> <textarea name='alamat'>$e[alamat]</textarea>
      <br /> Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.</td></tr>
      <tr><td>Nomor Rekening</td><td>  <input type=text name=rekening value='$e[rekening]'></td></tr>
      <tr><td></td><td>  <input type=hidden name=email size=30 value='$e[email]'></td></tr>
      <tr><td valign=top>Kota Tujuan</td><td>   
      <select name='kota'>
      <option value=0 selected>- Pilih Kota -</option>";
      $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
      while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
      }
  echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                  <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
      <tr><td colspan=2><input type='submit' class='button' value='Edit My Profil'></td></tr>
      </table>
      </form>
	  </div>";
}
//Module Register
elseif ($_GET[module]=='register') {
$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");
$password=md5($_POST[password]);
echo "<div id='info'>";
// Cek email kustomer di database
$cek_email=mysql_num_rows(mysql_query("SELECT email FROM kustomer WHERE email='$_POST[email]'"));
// Kalau email sudah ada yang pakai
if ($cek_email > 0){
  echo "Email <b>$_POST[email]</b> sudah ada yang pakai.<br />";
}
elseif (empty($_POST[nama]) || empty($_POST[password]) || empty($_POST[alamat]) || empty($_POST[telp]) || empty($_POST[email])|| empty($_POST[kode])){
  echo "Data yang Anda isikan belum lengkap<br />";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />";
}
else{
if(!empty($_POST['kode'])){
  if($_POST['kode']==$_SESSION['captcha_session']){
// simpan data kustomer 
mysql_query("INSERT INTO kustomer(nama_lengkap, password, alamat, telpon, email) 
             VALUES('$_POST[nama]','$_POST[password]','$_POST[alamat]','$_POST[telp]','$_POST[email]')");
			echo "<b>Anda berhasil Melakukan Registrasi</b><br/>
				Silahkan anda login <a href='motor.php?module=login'>disini</a>";
	}else{
	echo "Kode yang Anda masukkan tidak cocok<br />
	<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
	}else{
	echo "Anda belum memasukkan kode<br />
	<a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}

}
echo "</div>";
echo "
<div class='login-box'>
<h2>Form Register</h2>
      <form name=form action=motor.php?module=register method=POST onSubmit=\"return validasi(this)\">
      <table width='90%'>
      <tr><td>Nama Lengkap</td><td>  <input type=text name=nama size=30></td></tr>
      <tr><td>Password</td><td>  <input type=text name=password></td></tr>
      <tr><td>Alamat Pengiriman</td><td> <textarea name='alamat'></textarea>
      <br /> Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.</td></tr>
      <tr><td>Nomor Telepon</td><td>  <input type=text name=telp></td></tr>
      <tr><td>Email</td><td>  <input type=text name=email size=30></td></tr>
      
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
      <tr><td colspan=2><input type='submit' class='button' value='Daftar'></td></tr>
      </table>
      </form>
	  </div>";
}

// Modul selesai belanja
elseif ($_GET[module]=='selesaibelanja'){
echo "<div class='login-box'>";
  $sid = $_SESSION[email];
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
   	 exit(0);
	}
	else{
  echo "<h2>Kustomer Lama</h2>
      <form name=form2 action=simpan-transaksi-member.html method=POST onSubmit=\"return validasi2(this)\">
      <table>
      <tr><td>Email</td><td> <input type=text name=email size=30></td></tr>
      <tr><td>Password</td><td> <input type=password name=password size=30></td></tr>
      <tr><td><input type='submit' class='button' value='Login' id='submit'></td><td align=right><a href='motor.php?module=lupapassword'>Lupa Password?</a></td></tr>
      </table>
      </form><br/><br/>
";                      

  echo "<h2>Kustomer Baru</h2>";
    	  echo "
      <form name=form action=motor.php?module=simpantransaksi method=POST onSubmit=\"return validasi(this)\">
      <table width='90%'>
      <tr><td>Nama Lengkap</td><td>  <input type=text name=nama size=30></td></tr>
      <tr><td>Password</td><td>  <input type=text name=password></td></tr>
      <tr><td>Alamat Pengiriman</td><td>  <textarea name=alamat></textarea>
      <br /> Alamat pengiriman harus di isi lengkap, termasuk kota/kabupaten dan kode posnya.</td></tr>
      <tr><td>Nomor Rekening</td><td>  <input type=text name=></td></tr>
      <tr><td>Email</td><td>  <input type=text name=email size=30></td></tr>
      <tr><td valign=top>Kota Tujuan</td><td>   
      <select name='kota'>
      <option value=0 selected>- Pilih Kota -</option>";
      $tampil=mysql_query("SELECT * FROM kota ORDER BY nama_kota");
      while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[id_kota]>$r[nama_kota]</option>";
      }
  echo "</select> <br /><br />*)  Apabila tidak terdapat nama kota tujuan Anda, pilih <b>Lainnya</b>
                  <br />**) Ongkos kirim dihitung berdasarkan kota tujuan</td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php'></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6 maxlength=6><br /></td></tr>
      <tr><td colspan=2><input type='submit' class='button' value='Daftar'></td></tr>
      </table>
      </form>
	  </div>";
  }
} 

// Modul simpan transaksi member
elseif ($_GET[module]=='simpantransaksimember'){
echo "<div style='color:#000'>";
$email = $_SESSION[email];
$password = $_SESSION[password];

$sql = "SELECT * FROM	kustomer WHERE email='$email' AND password='$password'";
$hasil = mysql_query($sql);
$r = mysql_fetch_array($hasil);
// fungsi untuk mendapatkan isi pesanan
function isi_keranjang(){
	$isikeranjang = array();
	$sid = $_SESSION[email];
	$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
	
	while ($r=mysql_fetch_array($sql)) {
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

$id = mysql_fetch_array(mysql_query("SELECT id_kustomer FROM kustomer WHERE email='$email' AND password='$password'"));

// mendapatkan nomor kustomer
$id_kustomer=$id[id_kustomer];

// simpan data pemesanan 
mysql_query("INSERT INTO orders(tgl_order,jam_order,id_kustomer) VALUES('$tgl_skrg','$jam_skrg','$id_kustomer')");

  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
	  	         WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}

  echo "<div class='center_title_bar'>Proses Transaksi Selesai</div>";
    	  echo "<div class='prod_box_big'>
        	<div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
      Data pemesan beserta ordernya adalah sebagai berikut: <br />
      <table>
      <tr><td>Nama Lengkap   </td><td> : <b>$r[nama_lengkap]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $r[alamat] </td></tr>
      <tr><td>Nomor Telepon         </td><td> : $r[telpon] </td></tr>
      <tr><td>E-mail         </td><td> : $r[email] </td></tr></table><hr /><br />
      
      Nomor Order: <b>$id_orders</b><br /><br />";

      $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");

echo "<table>
      <tr bgcolor=#6da6b1><th>No</th><th>Produk</th><th>Qty</th><th>Harga</th><th>Total</th></tr>";
      
$pesan="Terimakasih telah melakukan pemesanan online di toko online kami <br /><br />  
        Nama: $r[nama_lengkap] <br />
        Alamat: $r[alamat] <br/>
        Nomor Telepon: $r[telpon] <br /><hr />
        
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftarproduk)){
   $disc        = ($d[diskon]/100)*$d[harga];
   $hargadisc   = number_format(($d[harga]-$disc),0,",","."); 
   $subtotal    = ($d[harga]-$disc) * $d[jumlah];

   $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d[harga]);

   echo "<tr bgcolor=#dad0d0><td>$no</td><td>$d[nama_produk]</td><td align=center>$d[jumlah]</td>
                             <td align=right>$harga</td><td align=right>$subtotal_rp</td></tr>";

   $pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}

$kota=$r[id_kota];

$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$kota'"));
$ongkoskirim1=$ongkos[ongkos_kirim];
$ongkoskirim = $ongkoskirim1 * $totalberat;

$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);  

// dapatkan email_pengelola dan nomor rekening dari database
$sql2 = mysql_query("select email_pengelola,nomor_rekening,nomor_hp from modul where id_modul='43'");
$j2   = mysql_fetch_array($sql2);

$pesan.="<br /><br />Total : Rp. $total_rp 
         <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
         <br />Total Berat : $totalberat Kg
         <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
         <br />Grand Total : Rp. $grandtotal_rp 
         <br /><br />Silahkan lakukan pembayaran sebanyak Grand Total yang tercantum, rekeningnya: $j2[nomor_rekening]
         <br />Apabila sudah transfer, konfirmasi ke nomor: $j2[nomor_hp]";

$subjek="Pemesanan Online";

// Kirim email dalam format HTML
$dari = "From: $j2[email_pengelola]\r\n";
$dari .= "Content-type: text/html\r\n";

// Kirim email ke kustomer
mail($email,$subjek,$pesan,$dari);

// Kirim email ke pengelola toko online
mail("$j2[email_pengelola]",$subjek,$pesan,$dari);

echo "<tr><td colspan=4 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
      </table>";
echo "
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
          </div>"; 
		  
		echo "</div>"; 
}                    
?>
