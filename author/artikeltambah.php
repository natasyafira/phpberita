<?php
include_once('../koneksi.php');
$datapenulis = array();
$ambil = $conn->query("SELECT idpenulis, namapenulis FROM penulis");
while ($tiap = $ambil->fetch_assoc()) {
    $datapenulis[] = $tiap;
}

$datakategori = array();
$key = $conn->query("SELECT id, namakategori FROM kategori");
while ($sel = $key->fetch_assoc()){
    $datakategori[] = $sel;
}

include 'header.php'; ?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Penulis</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Artikel</label>
                                <input type="text" required class="form-control" name="judul">
                            </div>
                            <div class="form-group">
                                <label>Nama penulis</label>
                                <select class="form-control" name="idpenulis" required>
                                    <option value="">Pilih penulis</option>
                                    <?php foreach ($datapenulis as $key => $value) : ?>
                                    <option value="<?php echo htmlspecialchars($value["idpenulis"]); ?>">
                                        <?php echo htmlspecialchars($value["namapenulis"]); ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <select class="form-control" name="idkategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($datakategori as $key => $value) : ?>
                                    <option value="<?php echo htmlspecialchars($value["id"]); ?>">
                                        <?php echo htmlspecialchars($value["namakategori"]); ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggalInput">Tanggal</label>
                                <input type="date" required class="form-control" id="tanggalInput" name="tanggal">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"
                                    required></textarea>
                                <script>
                                CKEDITOR.replace('deskripsi');
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <div class="letak-input" style="margin-bottom: 10px;">
                                    <input type="file" class="form-control" name="foto" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" name="save">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['save'])) {
    if (empty($_POST['judul']) || empty($_POST['idpenulis']) || empty($_POST['idkategori']) || empty($_POST['tanggal']) || empty($_POST['deskripsi']) || empty($_FILES['foto']['name'])) {
        echo "<script>alert('Semua kolom wajib diisi, termasuk foto!');</script>";
        echo "<script>location='index.php?halaman=artikeltambah';</script>";
        exit;
    }

    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $idpenulis = mysqli_real_escape_string($conn, $_POST['idpenulis']);
    $idkategori = mysqli_real_escape_string($conn, $_POST['idkategori']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    $target_dir = "../foto/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $upload_path = $target_dir . basename($namafoto);

    if (move_uploaded_file($lokasifoto, $upload_path)) {
        $query_insert = "INSERT INTO artikel
            (idpenulis, idkategori, judul, tanggal, deskripsi, foto)
            VALUES(
                '$idpenulis',
                '$idkategori',
                '$judul',
                '$tanggal',
                '$deskripsi',
                '$namafoto'
            )";

        if ($conn->query($query_insert)) {
            echo "<script>alert('Data Artikel Berhasil Disimpan');</script>";
            echo "<script>location='artikeldaftar.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data artikel: " . $conn->error . "');</script>";
            echo "<script>location='artikeltambah.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload foto.');</script>";
        echo "<script>location='artikeltambah.php';</script>";
    }
}
?>

<?php include 'footer.php'; ?>