<?php include_once('layouts/master.php');
include_once('koneksi.php');
?>
<div class="slider-area hero-overly">
    <div class="single-slider hero-overly  slider-height d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-9">
                    <div class="hero__caption">
                        <span>Selamat Datang Di Website</span>
                        <h1>Berita Artikel</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- <div class="popular-location section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-location mb-30">
                    <div class="location-img">
                        <img style="width:370px ;" src="" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-location mb-30">
                    <div class="location-img">
                        <img style="width:400px ;" src="" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-location mb-30">
                    <div class="location-img">
                        <img style="width:400px ;" src="assets/home/assets/img/gallery/bg3.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="peoples-visit dining-padding-top">
    <div class="single-visit left-img">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-8">
                    <div class="visit-caption">
                        <h3>TENTANG Berita Artikel</h3>
                        <p style="font-size:20px ;">Tentu, mari kita bahas mengenai website berita.

                            Apa Itu Website Berita?
                            Website berita adalah platform daring yang menyajikan informasi terkini dan faktual kepada
                            publik. Fungsinya mirip dengan koran, majalah, atau siaran berita televisi, namun dalam
                            format digital yang dapat diakses kapan saja dan dari mana saja melalui perangkat yang
                            terhubung internet.</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-blog-area section-padding30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center mb-70">
                    <h2>kategori Terbaru</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
         $result = $conn->query("SELECT * FROM kategori order by id desc limit 3");
         while ($data = $result->fetch_array()) :
         ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-team mb-30">
                    <div class="team-img">
                        <img src="foto/<?= $data['foto'] ?>" alt="">
                    </div>
                    <div class="team-caption">
                        <h3><a href="kategoridetail.php?id=<?php echo $data['id']; ?>"><?php echo $data['namakategori']; ?>
                                </< /a>
                        </h3>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

</main>
<?php include_once('layouts/footer.php') ?>