<?php
session_start();
include_once('../koneksi.php');
include 'header.php';

// Cek jika user belum login
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu'); location='../login.php';</script>";
    exit;
}

$iduser = $_SESSION['user']['iduser'];

// Ambil data user
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
                        <form method="post">
                            <div class="form-group mb-3">
                                <label for="nama" class="mb-2">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="username" class="mb-2">Username</label>
                                <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">Password</label>
                                <input type="text" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengganti password">
                                <span class="text-danger">Kosongkan jika tidak ingin mengganti password</span>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success float-right pull-right" name="simpan">Simpan</button>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['simpan'])) {
                            $nama = $_POST['nama'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            if (!empty($password)) {
                                $query = "UPDATE user SET username='$username', password='$password', nama='$nama' WHERE iduser='$iduser'";
                            } else {
                                $query = "UPDATE user SET username='$username', nama='$nama' WHERE iduser='$iduser'";
                            }

                            if ($conn->query($query)) {
                                // Update juga session agar perubahan langsung terasa
                                $_SESSION['user']['username'] = $username;
                                $_SESSION['user']['nama'] = $nama;

                                echo "<script>alert('Data berhasil diubah'); location='ubahprofil.php';</script>";
                            } else {
                                echo "<script>alert('Gagal mengubah data');</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
