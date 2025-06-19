<?php
include_once('layouts/master.php');
include_once('koneksi.php');

// 1. Ambil dan amankan ID artikel dari URL
$id_artikel = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika ID artikel tidak valid, redirect atau tampilkan error
if ($id_artikel === 0) {
    echo "<script>alert('ID Artikel tidak valid!');</script>";
    echo "<script>location='index.php';</script>"; // Arahkan ke halaman utama atau daftar artikel
    exit;
}

// 2. Ambil data artikel beserta nama penulis dan kategori
$query_artikel = "
    SELECT
        artikel.*,
        penulis.namapenulis,
        kategori.namakategori
    FROM
        artikel
    LEFT JOIN penulis ON artikel.idpenulis = penulis.idpenulis
    LEFT JOIN kategori ON artikel.idkategori = kategori.id
    WHERE
        artikel.idartikel = '$id_artikel'
    LIMIT 1
";
$result_artikel = $conn->query($query_artikel);
$data_artikel = $result_artikel->fetch_assoc();

// Jika artikel tidak ditemukan
if (!$data_artikel) {
    echo "<script>alert('Artikel tidak ditemukan!');</script>";
    echo "<script>location='index.php';</script>"; // Arahkan ke halaman utama atau daftar artikel
    exit;
}

?>
<div class="hero-area2 slider-height2 hero-overly2 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="hero-cap text-center pt-50">
                    <h2><?= htmlspecialchars($data_artikel['judul']); ?></h2>
                    <p class="text-white">
                        <i class="fa fa-user"></i>
                        <?= htmlspecialchars($data_artikel['namapenulis'] ?? 'Penulis Tidak Diketahui'); ?>
                        &nbsp;|&nbsp;
                        <i class="fa fa-calendar"></i> <?= tanggal(date($data_artikel['tanggal'])); ?> &nbsp;|&nbsp;
                        <i class="fa fa-tags"></i> <a
                            href="kategoridetail.php?id=<?= htmlspecialchars($data_artikel['idkategori']); ?>"
                            class="text-white"><?= htmlspecialchars($data_artikel['namakategori'] ?? 'Kategori Tidak Diketahui'); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>

<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <?php if (!empty($data_artikel['foto']) && file_exists("foto/" . $data_artikel['foto'])) : ?>
                            <img class="card-img rounded-0" src="foto/<?= htmlspecialchars($data_artikel['foto']); ?>"
                                alt="<?= htmlspecialchars($data_artikel['judul']); ?>">
                            <?php else : ?>
                            <img class="card-img rounded-0" src="assets/img/blog/default-blog-image.jpg"
                                alt="No Image Available">
                            <?php endif; ?>
                            <a href="#" class="blog_item_date">
                                <h3><?= date('d', strtotime($data_artikel['tanggal'])); ?></h3>
                                <p><?= date('M', strtotime($data_artikel['tanggal'])); ?></p>
                            </a>
                        </div>

                        <div class="blog_details">
                            <h2 class="blog-head" style="color: #2d2d2d;">
                                <?= htmlspecialchars($data_artikel['judul']); ?></h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-user"></i>
                                        <?= htmlspecialchars($data_artikel['namapenulis'] ?? 'Penulis Tidak Diketahui'); ?></a>
                                </li>
                                <li><a
                                        href="kategoridetail.php?id=<?= htmlspecialchars($data_artikel['idkategori']); ?>"><i
                                            class="fa fa-tags"></i>
                                        <?= htmlspecialchars($data_artikel['namakategori'] ?? 'Kategori Tidak Diketahui'); ?></a>
                                </li>
                            </ul>
                            <div class="blog-content">
                                <?= $data_artikel['deskripsi']; ?> </div>
                        </div>
                    </article>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form method="post" action="blog.php">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="keyword" placeholder='Cari Artikel'
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari Artikel'">
                                    <div class="input-group-append">
                                        <button class="btns" type="submit" name="cari" value="cari"><i
                                                class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title" style="color: #2d2d2d;">Kategori Artikel</h4>
                        <ul class="list cat-list">
                            <?php
                            // Ambil semua kategori untuk ditampilkan di sidebar
                            $query_all_kategori = $conn->query("SELECT id, namakategori FROM kategori ORDER BY namakategori ASC");
                            if ($query_all_kategori->num_rows > 0) {
                                while ($kat = $query_all_kategori->fetch_assoc()) {
                            ?>
                            <li>
                                <a href="kategoridetail.php?id=<?= htmlspecialchars($kat['id']); ?>" class="d-flex">
                                    <p><?= htmlspecialchars($kat['namakategori']); ?></p>
                                </a>
                            </li>
                            <?php
                                }
                            } else {
                                echo "<li><p>Tidak ada kategori.</p></li>";
                            }
                            ?>
                        </ul>
                    </aside>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title" style="color: #2d2d2d;">Artikel Terbaru</h3>
                        <?php
                        // Ambil 5 artikel terbaru
                        $query_latest_articles = $conn->query("SELECT idartikel, judul, tanggal, foto FROM artikel ORDER BY tanggal DESC LIMIT 5");
                        if ($query_latest_articles->num_rows > 0) {
                            while ($latest_art = $query_latest_articles->fetch_assoc()) {
                        ?>
                        <div class="media post_item">
                            <?php if (!empty($latest_art['foto']) && file_exists("foto/" . $latest_art['foto'])) : ?>
                            <img src="foto/<?= htmlspecialchars($latest_art['foto']); ?>" alt="post" width="80">
                            <?php endif; ?>
                            <div class="media-body">
                                <a href="artikeldetail.php?id=<?= htmlspecialchars($latest_art['idartikel']); ?>">
                                    <h3 style="color: #2d2d2d;"><?= htmlspecialchars($latest_art['judul']); ?></h3>
                                </a>
                                <p><?= tanggal(date($latest_art['tanggal'])); ?></p>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo "<p>Tidak ada artikel terbaru.</p>";
                        }
                        ?>
                    </aside>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('layouts/footer.php'); ?>