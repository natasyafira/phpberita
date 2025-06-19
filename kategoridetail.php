<?php include_once('layouts/master.php');
include_once('koneksi.php');
?>

<div class="hero-area2  slider-height2 hero-overly2 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="hero-cap text-center pt-50">
                    <h2>kategori Detail</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
<div class="ourwork">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <?php
                        $id_kategori = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                        $result_kategori = $conn->query("SELECT * FROM kategori WHERE id = '$id_kategori' LIMIT 1");
                        $data_kategori = $result_kategori->fetch_array();
                        if ($data_kategori) :
                        ?>
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded" style="border-radius: 10px;">
                    <img class="card-img-top" src="foto/<?= htmlspecialchars($data_kategori['foto']) ?>" width="100%"
                        alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title text-primary">
                            <a href="kategoridetail.php?id=<?= htmlspecialchars($data_kategori['id']); ?>">
                                <?= htmlspecialchars($data_kategori['namakategori']); ?>
                            </a>
                        </h2>
                        <p class="card-text">
                            <small class="text-muted"><?= tanggal(date($data_kategori['tanggal'])); ?></small>
                        </p>
                        <br>
                        <p class="card-text">
                            <i class="fa fa-tag text-success"></i>
                            <?= htmlspecialchars($data_kategori['isi']) ?>
                        </p>
                    </div>
                </div>
                <?php
        else :
            echo "<p>Kategori tidak ditemukan.</p>";
        endif;
        ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                <h3>Artikel Terkait Kategori:
                    <?= htmlspecialchars($data_kategori['namakategori'] ?? 'Tidak Ditemukan'); ?>
                </h3>
                <hr>
                <?php
                    if ($id_kategori > 0) {
                        $query_artikel_terkait = "
                            SELECT
                                artikel.*,
                                penulis.namapenulis,
                                kategori.namakategori,
                                artikel.foto AS foto_artikel
                            FROM
                                artikel
                            LEFT JOIN penulis ON artikel.idpenulis = penulis.idpenulis
                            LEFT JOIN kategori ON artikel.idkategori = kategori.id
                            WHERE
                                artikel.idkategori = '$id_kategori'
                            ORDER BY
                                artikel.tanggal DESC 
                        ";

                        $result_artikel = $conn->query($query_artikel_terkait);

                        if ($result_artikel && $result_artikel->num_rows > 0) {
                            while ($artikel = $result_artikel->fetch_assoc()) {
                    ?>
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded">
                    <div class="row no-gutters">
                        <?php if (!empty($artikel['foto']) && file_exists("../foto/" . $artikel['foto_artikel'])) : ?>
                        <div class="col-lg-4 col-md-4">
                            <img src="../foto/<?= htmlspecialchars($artikel['foto_artikel']) ?>" class="card-img"
                                alt="<?= htmlspecialchars($artikel['judul']) ?>">
                        </div>
                        <?php endif; ?>
                        <div
                            class="col-md-<?= (!empty($artikel['foto_artikel']) && file_exists("../foto/" . $artikel['foto_artikel'])) ? '8' : '12'; ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="artikeldetail.php?id=<?= htmlspecialchars($artikel['idartikel']) ?>">
                                        <?= htmlspecialchars($artikel['judul']) ?>
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Penulis: <?= htmlspecialchars($artikel['namapenulis'] ?? 'N/A') ?> |
                                        Tanggal: <?= tanggal(date($artikel['tanggal'])) ?> |
                                        Kategori: <?= htmlspecialchars($artikel['namakategori'] ?? 'N/A') ?>
                                    </small>
                                </p>
                                <p class="card-text"><?= substr(strip_tags($artikel['deskripsi']), 0, 200) ?>...</p>
                                <a href="artikeldetail.php?id=<?= htmlspecialchars($artikel['idartikel']) ?>"
                                    class="btn btn-primary btn-sm">
                                    Baca Artikel Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            } else {
                echo "<p>Tidak ada artikel yang ditemukan untuk kategori ini.</p>";
            }
        } else {
            echo "<p>ID Kategori tidak valid untuk mencari artikel.</p>";
        }
        ?>
            </div>
        </div>

        <div class="row mb-3">
            <?php
            $result = $conn->query("SELECT * FROM kategori order by id desc limit 3");
            while ($data = $result->fetch_array()) :
            ?>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4">
                <div class="card mb-3 shadow p-3 mb-5 bg-white rounded" style="border-radius: 10px;">
                    <img class="card-img-top" src="foto/<?= $data['foto'] ?>" width="100%" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title text-primary"><a
                                href="kegiatandetail.php?id=<?php echo $data['id']; ?>"><?php echo $data['namakategori']; ?></a>
                        </h2>
                        <p class="card-text"><small
                                class="text-muted"><?php echo tanggal(date($data['tanggal'])); ?></small></p>
                        <br>
                        <p class="card-text"><i class="fa fa-tag text-success"></i> <?= $data['namakategori'] ?></p>
                        <br>
                        <a href="kegiatandetail.php?id=<?php echo $data['id']; ?>"
                            class="btn btn-primary float-right">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include_once('layouts/footer.php') ?>