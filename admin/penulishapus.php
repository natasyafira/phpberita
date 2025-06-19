<?php
include_once('../koneksi.php');
$conn->query("DELETE FROM penulis WHERE idpenulis='$_GET[id]'");

echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='penulisdaftar.php';</script>";