<?php include_once('../koneksi.php');
include 'header.php';
$ambildata = $conn->query("SELECT * FROM kategori WHERE id='$_GET[id]'");
$data = $ambildata->fetch_assoc();
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit kategori</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="tanggal" class="mb-2">Nama Kategori</label>
                                <input type="text" class="form-control" name="namakategori"
                                    value="<?= $data['namakategori'] ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal" class="mb-2">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal" class="mb-2">Isi kategori</label>
                                <textarea class="form-control" rows="5" id="isi" name="isi" value="<?= $data['isi'] ?>"
                                    required><?= $data['isi'] ?></textarea>
                                <script>
                                CKEDITOR.replace('isi');
                                </script>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="tanggal" class="mb-2">Foto kategori</label>
                                        <input type="file" class="form-control" name="foto">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="../foto/<?= $data['foto'] ?>" width="150px" style="border-radius:10px">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-success mr-5 float-right pull-right"
                                    name="simpan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['simpan'])) {
            $namafoto = $_FILES['foto']['name'];
            $lokasifoto = $_FILES['foto']['tmp_name'];
            move_uploaded_file($lokasifoto, "../foto/" . $namafoto);
            if (!empty($lokasifoto)) {
                move_uploaded_file($lokasifoto, "../foto/$namafoto");
                $conn->query("UPDATE kategori SET namakategori='$_POST[namakategori]',tanggal='$_POST[tanggal]',isi='$_POST[isi]',foto='$namafoto' WHERE id='$_GET[id]'") or die(mysqli_error($conn));
            } else {
                $conn->query("UPDATE kategori SET namakategori='$_POST[namakategori]',tanggal='$_POST[tanggal]',isi='$_POST[isi]' WHERE id='$_GET[id]'") or die(mysqli_error($conn));
            }
            echo "<script>alert('Data Berhasil Di Simpan');</script>";
            echo "<script>location='kategoridaftar.php';</script>";
        }
        ?>

        <?php include 'footer.php'; ?>