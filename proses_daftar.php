<?php
include 'koneksi.php';

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // tidak di-hash (sesuai permintaan)
    $nama     = $_POST['nama'];     // Administrator atau Author
    $nohp     = $_POST['nohp'] ?? ''; // No HP untuk Author

    // Masukkan ke tabel user
    $query_user = "INSERT INTO user (username, password, nama) VALUES ('$username', '$password', '$nama')";
    $result_user = mysqli_query($conn, $query_user);

    if ($result_user) {
        // Jika role-nya Author, tambahkan juga ke tabel penulis
        if ($nama === 'Author') {
            $query_penulis = "INSERT INTO penulis (namapenulis, nohppenulis) VALUES ('$username', '$nohp')";
            mysqli_query($conn, $query_penulis);
        }

        echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran gagal!'); window.location='daftar.php';</script>";
    }
}
?>
