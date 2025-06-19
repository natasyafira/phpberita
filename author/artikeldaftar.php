<?php
include_once('../koneksi.php');
session_start();

// Cek login dan ambil idpenulis dari session
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Silakan login terlebih dahulu');location='../login.php';</script>";
    exit;
}

$idpenulis_login = $_SESSION['user']['idpenulis'] ?? null;

include 'header.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Artikel Anda</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="example">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Penulis</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;

                                    // Tampilkan hanya artikel dari penulis login
                                    $result = $conn->query("SELECT
                                        artikel.idartikel,
                                        artikel.judul,
                                        artikel.tanggal,
                                        artikel.deskripsi,
                                        artikel.foto AS foto_artikel, 
                                        penulis.namapenulis,
                                        kategori.namakategori
                                    FROM artikel
                                    LEFT JOIN penulis ON artikel.idpenulis = penulis.idpenulis
                                    LEFT JOIN kategori ON artikel.idkategori = kategori.id
                                    WHERE artikel.idpenulis = '$idpenulis_login'");

                                    while ($data = $result->fetch_assoc()) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($data['judul']) ?></td>
                                            <td><?= htmlspecialchars($data['tanggal']) ?></td>
                                            <td><?= htmlspecialchars($data['namapenulis']) ?></td>
                                            <td><?= htmlspecialchars($data['namakategori']) ?></td>
                                            <td><img src="../foto/<?= htmlspecialchars($data['foto_artikel']) ?>" width="150px" style="border-radius:10px"></td>
                                            <td>
                                                <a class="btn btn-primary" href="../artikeldetail.php?id=<?= $data['idartikel'] ?>">Lihat</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    
                                    <?php if ($result->num_rows == 0): ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada artikel yang Anda tulis.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
