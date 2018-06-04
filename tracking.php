<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "db_sgm";

mysql_connect($server, $username, $password) or die("<h1>Koneksi Mysql Error : </h1>" . mysql_error());
mysql_select_db($database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysql_error());

@$operasi = $_GET['operasi'];

switch ($operasi) {
    case "view":
          /* Source code untuk Menampilkan data */
     
        $query_tampil_data = mysql_query("SELECT * FROM tabel_biodata") or die(mysql_error());
        $data_array = array();
        while ($data = mysql_fetch_assoc($query_tampil_data)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);

        break;
    case "insert":
        /* Source code untuk Insert data */
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
        $query_insert_data = mysql_query("INSERT INTO pengiriman (nama, alamat) VALUES('$nama', '$alamat')");
        if ($query_insert_data) {
            echo "Data Berhasil Disimpan";
        } else {
            echo "Error Insert Data " . mysql_error();
        }

        break;
    case "get_data_by_id":
        /* Source code untuk Edit data dan mengirim data berdasarkan id yang diminta */
        @$id = $_GET['id'];

        $query_tampil_data = mysql_query("SELECT * FROM tabel_biodata WHERE id='$id'") or die(mysql_error());
        $data_array = array();
        $data_array = mysql_fetch_assoc($query_tampil_data);
        echo "[" . json_encode($data_array) . "]";


        break;
    case "update":
        /* Source code untuk Updatedata */
        @$lat = $_GET['lat'];
        @$lon = $_GET['lon'];
        @$sta = $_GET['sta'];
        @$id = $_GET['id'];
        $query_update_data = mysql_query("UPDATE pengiriman SET status='$sta', lat='$lat', lon='$lon' WHERE id='$id'");
        if ($query_update_data) {
            echo "Location Updated";
        } else {
            echo "Periksa Koneksi";
        }
        break;
    case "delete":
        /* Source code untuk Deletedata */
        @$id = $_GET['id'];
        $query_delete_data = mysql_query("DELETE FROM tabel_data WHERE id='$id'");
        if ($query_delete_data) {
            echo "Delete Data Berhasil";
        } else {
            echo mysql_error();
        }

        break;

    default:
        break;
}
?>
