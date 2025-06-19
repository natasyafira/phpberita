<?php
include_once('../koneksi.php');
include 'header.php'; ?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar kategori</h4>
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
                                    $result = $conn->query("SELECT
                                        artikel.idartikel,
                                        artikel.judul,
                                        artikel.tanggal,
                                        artikel.deskripsi,
                                        artikel.foto AS foto_artikel, 
                                        penulis.namapenulis,
                                        kategori.namakategori,
                                        kategori.foto AS foto_kategori 
                                    FROM
                                        artikel
                                    LEFT JOIN penulis ON artikel.idpenulis = penulis.idpenulis
                                    LEFT JOIN kategori ON artikel.idkategori = kategori.id");
                                    while ($data = $result->fetch_array()) :
                                    ?>
                                    <tr>
                                        <td><?= $data['idartikel'] ?></td>
                                        <td><?= $data['judul'] ?></td>
                                        <td><?= $data['tanggal'] ?></td>
                                        <td><?= $data['namapenulis'] ?>
                                        <td><?= $data['namakategori'] ?></td>
                                        </td>
                                        <td><img src="../foto/<?= $data['foto_artikel'] ?>" width="150px"
                                                style="border-radius:10px"></td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="artikeledit.php?id=<?= $data['idartikel'] ?>">Edit</a>
                                            <a class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                href="artikelhapus.php?id=<?= $data['idartikel'] ?>">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
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