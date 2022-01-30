<?php
include "koneksi.php";

if (isset($_POST["simpan"])) {
    $kt        = $_POST['namakt'];
    $alias     = $_POST['aliaskt'];

    if ($kt && $alias) {
        // Tambah data
        $sql = "insert into kategori_artikels (`nama_kategori`, `alias`) values ('$kt','$alias');";
        $qinsert = mysqli_query($conn, $sql);
        if ($qinsert) {
           echo 'data save';
        } else {
            echo 'data tidak tersave';
        }
    } else {
        echo 'harus terisi';
    }
}
?>
