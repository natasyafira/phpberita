<?php
include_once('../koneksi.php');
$conn->query("DELETE FROM artikel WHERE idartikel='$_GET[id]'");

echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='artikeldaftar.php';</script>";