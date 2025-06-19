<?php include_once('../koneksi.php');
include 'header.php';

$idartikel = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($idartikel === 0) {
    echo "<script>alert('ID Artikel tidak valid!');</script>";
    echo "<script>location='artikeldaftar.php';</script>";
    exit;
}

$ambildata = $conn->query("SELECT * FROM artikel WHERE idartikel='$idartikel'");
$data = $ambildata->fetch_assoc();

if (!$data) {
    echo "<script>alert('Artikel dengan ID tersebut tidak ditemukan!');</script>";
    echo "<script>location='artikeldaftar.php';</script>";
    exit;
}

$datapenulis = array();
$ambil_penulis = $conn->query("SELECT idpenulis, namapenulis FROM penulis");
while ($tiap_penulis = $ambil_penulis->fetch_assoc()) {
    $datapenulis[] = $tiap_penulis;
}

$datakategori = array();
$ambil_kategori = $conn->query("SELECT id, namakategori FROM kategori");
while ($tiap_kategori = $ambil_kategori->fetch_assoc()){
    $datakategori[] = $tiap_kategori;
}

?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Artikel</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Judul Artikel</label>
                                <input type="text" required class="form-control" name="judul"
                                    value="<?php echo htmlspecialchars($data['judul']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama penulis</label>
                                <select class="form-control" name="idpenulis" required>
                                    <option value="">Pilih penulis</option>
                                    <?php foreach ($datapenulis as $key => $value) : ?>
                                    <option value="<?php echo htmlspecialchars($value["idpenulis"]); ?>"
                                        <?php echo ($data['idpenulis'] == $value["idpenulis"]) ? 'selected' : ''; ?>>
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
                                    <option value="<?php echo htmlspecialchars($value["id"]); ?>"
                                        <?php echo ($data['idkategori'] == $value["id"]) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($value["namakategori"]); ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggalInput">Tanggal</label>
                                <input type="date" required class="form-control" id="tanggalInput" name="tanggal"
                                    value="<?php echo htmlspecialchars($data['tanggal']); ?>">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="10"
                                    required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                                <script>
                                CKEDITOR.replace('deskripsi');
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Foto Lama</label><br>
                                <?php if (!empty($data['foto']) && file_exists("../foto/" . $data['foto'])) : ?>
                                <img src="../foto/<?php echo htmlspecialchars($data['foto']); ?>" width="200px"
                                    class="img-thumbnail">
                                <?php else : ?>
                                <p>Tidak ada foto lama atau foto tidak ditemukan.</p>
                                <?php endif; ?>
                                <br>
                                <label>Unggah Foto Baru (Kosongkan jika tidak ingin mengubah)</label>
                                <div class="letak-input" style="margin-bottom: 10px;">
                                    <input type="file" class="form-control" name="foto_baru">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right" name="update">Update
                                Artikel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['update'])) {
            $judul_baru = mysqli_real_escape_string($conn, $_POST['judul']);
            $idpenulis_baru = mysqli_real_escape_string($conn, $_POST['idpenulis']);
            $idkategori_baru = mysqli_real_escape_string($conn, $_POST['idkategori']);
            $tanggal_baru = mysqli_real_escape_string($conn, $_POST['tanggal']);
            $deskripsi_baru = mysqli_real_escape_string($conn, $_POST['deskripsi']);

            $namafoto_baru = $_FILES['foto_baru']['name'];
            $lokasifoto_baru = $_FILES['foto_baru']['tmp_name'];

            $target_dir = "../foto/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $foto_untuk_db = $data['foto'];

            if (!empty($namafoto_baru)) {
                $upload_path_baru = $target_dir . basename($namafoto_baru);

                if (move_uploaded_file($lokasifoto_baru, $upload_path_baru)) {
                    if (!empty($data['foto']) && file_exists($target_dir . $data['foto'])) {
                        unlink($target_dir . $data['foto']);
                    }
                    $foto_untuk_db = $namafoto_baru;
                } else {
                    echo "<script>alert('Gagal mengupload foto baru. Menggunakan foto lama.');</script>";
                }
            }

            $query_update = "UPDATE artikel SET
                                idpenulis = '$idpenulis_baru',
                                idkategori = '$idkategori_baru',
                                judul = '$judul_baru',
                                tanggal = '$tanggal_baru',
                                deskripsi = '$deskripsi_baru',
                                foto = '$foto_untuk_db'
                             WHERE idartikel = '$idartikel'"; // Gunakan $idartikel yang sudah ada

            if ($conn->query($query_update)) {
                echo "<script>alert('Data Artikel Berhasil Diperbarui!');</script>";
                echo "<script>location='artikeldaftar.php';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data artikel: " . $conn->error . "');</script>";
                echo "<script>location='artikeledit&id=$idartikel';</script>";
            }
        }
        ?>

        <?php include 'footer.php'; ?>