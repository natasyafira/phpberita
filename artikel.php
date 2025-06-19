<?php
include_once('layouts/master.php');
include_once('koneksi.php');

if (!function_exists('tanggal')) {
    function tanggal($date) {
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $date);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}

function potong($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
?>
<main>
    <div class="hero-area2 slider-height2 hero-overly2 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center pt-50">
                        <h2>Semua Artikel</h2>
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
                    <?php
                    // Amankan keyword pencarian
                    $keyword = isset($_POST["keyword"]) ? mysqli_real_escape_string($conn, $_POST["keyword"]) : '';

                    if (isset($_POST["cari"]) && !empty($keyword)) {
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
                                artikel.judul LIKE '%$keyword%' OR artikel.deskripsi LIKE '%$keyword%'
                            ORDER BY
                                artikel.tanggal DESC, artikel.idartikel DESC
                        ";
                    } else {
                        $query_artikel = "
                            SELECT
                                artikel.*,
                                penulis.namapenulis,
                                kategori.namakategori
                            FROM
                                artikel
                            LEFT JOIN penulis ON artikel.idpenulis = penulis.idpenulis
                            LEFT JOIN kategori ON artikel.idkategori = kategori.id
                            ORDER BY
                                artikel.tanggal DESC, artikel.idartikel DESC
                        ";
                    }

                    $result_artikel = $conn->query($query_artikel);

                    if ($result_artikel && mysqli_num_rows($result_artikel) > 0) {
                        while ($data_artikel = $result_artikel->fetch_array()) :
                    ?>
                    <div class="blog_left_sidebar">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <?php if (!empty($data_artikel['foto']) && file_exists("foto/" . $data_artikel['foto'])) : ?>
                                <img class="card-img rounded-0"
                                    src="foto/<?= htmlspecialchars($data_artikel['foto']); ?>"
                                    alt="<?= htmlspecialchars($data_artikel['judul']); ?>">
                                <?php else : ?>
                                <img class="card-img rounded-0" src="assets/img/blog/default-blog-image.jpg"
                                    alt="No Image Available">
                                <?php endif; ?>
                                <a class="blog_item_date">
                                    <h3><?= date('d', strtotime($data_artikel['tanggal'])); ?></h3>
                                    <p><?= date('M', strtotime($data_artikel['tanggal'])); ?></p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block"
                                    href="artikeldetail.php?id=<?= htmlspecialchars($data_artikel['idartikel']); ?>">
                                    <h2 class="blog-head" style="color: #2d2d2d;">
                                        <?= htmlspecialchars($data_artikel['judul']); ?></h2>
                                </a>
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
                                <p class="blog-content">
                                    <?= potong(strip_tags($data_artikel['deskripsi']), 50); ?>... </p>
                                <a href="artikeldetail.php?id=<?= htmlspecialchars($data_artikel['idartikel']); ?>"
                                    class="btn btn-primary float-right text-white">Baca Selengkapnya</a>
                                <div style="clear:both;"></div>
                            </div>
                        </article>
                    </div>
                    <?php
                        endwhile;
                    } else {
                        ?>
                    <div class="card mb-3 shadow p-3 mb-5 bg-white rounded" style="border-radius: 10px;">
                        <div class="card-body text-center">
                            <img src="assets/img/blog/empty.jpg" alt="Data Tidak Ada" width="150px" class="mb-3">
                            <h2 class="card-title text-primary">Artikel Tidak Ditemukan</h2>
                            <p class="card-text">Maaf, tidak ada artikel yang sesuai dengan kriteria pencarian Anda atau
                                belum ada artikel yang dipublikasikan.</p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form method="post">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder='Cari Artikel...' onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Cari Artikel...'"
                                            value="<?= htmlspecialchars($keyword); ?>">
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
                                    <a href="kategoridetail.php?id=<?= htmlspecialchars($kat['id']); ?>"
                                        class="d-flex justify-content-between align-items-center">
                                        <p><?= htmlspecialchars($kat['namakategori']); ?></p>
                                        <?php
                                                // Hitung jumlah artikel per kategori
                                                $count_artikel = $conn->query("SELECT COUNT(*) AS total FROM artikel WHERE idkategori = '{$kat['id']}'")->fetch_assoc();
                                                ?>
                                        <span>(<?= $count_artikel['total']; ?>)</span>
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
                                <img src="foto/<?= htmlspecialchars($latest_art['foto']); ?>" alt="post" width="80"
                                    height="80" style="object-fit: cover;">
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
</main>
<?php include_once('layouts/footer.php') ?>