<?php
session_start();
include_once('../koneksi.php');
include 'header.php';
$iduser = $_SESSION['admin']['iduser'];
$ambildata = $conn->query("SELECT * FROM user WHERE iduser='$iduser'");
$data = $ambildata->fetch_assoc();
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ubah Profil</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="tanggal" class="mb-2">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal" class="mb-2">Username</label>
                                <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal" class="mb-2">Password</label>
                                <input type="text" class="form-control" name="password" value="">
                                <span class="text-danger">Kosongkan jika tidan ingin mengganti password</span>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success float-right pull-right" name="simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['simpan'])) {
            $conn->query("UPDATE user SET username='$_POST[username]',password='$_POST[password]',nama='$_POST[nama]' WHERE iduser='$iduser'") or die(mysqli_error($conn));
            echo "<script>alert('Data Berhasil Di Ubah');</script>";
            echo "<script>location='ubahprofil.php';</script>";
        }
        ?>

        <?php include 'footer.php'; ?>