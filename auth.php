<?php
session_start();
include_once('koneksi.php');

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Ambil data user dari database
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $ambil = $conn->query($query);

    if ($ambil->num_rows == 1) {
        $akun = $ambil->fetch_assoc();

        // Default session hanya akun
        $_SESSION["user"] = $akun;

        // Cek jika Author, ambil idpenulis dari tabel penulis berdasarkan nama
        if ($akun['nama'] == 'Author') {
            $nama_penulis = $akun['username']; // Bisa juga pakai $akun['nama'] kalau konsisten
            $getPenulis = $conn->query("SELECT idpenulis FROM penulis WHERE namapenulis = '$nama_penulis'");
            $penulis = $getPenulis->fetch_assoc();

            // Tambahkan idpenulis ke dalam session
            $_SESSION['user']['idpenulis'] = $penulis['idpenulis'] ?? null;

            echo "<script>alert('Login sebagai Author berhasil');</script>";
            echo "<script>location='author/home.php';</script>";
        } elseif ($akun['nama'] == 'Administrator') {
            echo "<script>alert('Login sebagai Administrator berhasil');</script>";
            echo "<script>location='admin/home.php';</script>";
        } else {
            echo "<script>alert('Peran tidak dikenali');</script>";
            echo "<script>location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Login Gagal, Username atau Password salah');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>
