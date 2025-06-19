<?php
include_once('../koneksi.php');
$conn->query("DELETE FROM kategori WHERE id='$_GET[id]'");

echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='kategoridaftar.php';</script>";