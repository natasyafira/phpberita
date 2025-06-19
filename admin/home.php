<?php
include_once('../koneksi.php');
include 'header.php';
$kategori = $conn->query("SELECT * FROM kategori");
$jumlahkategori = $kategori->num_rows;

// $pengumuman = $conn->query("SELECT * FROM pengumuman");
// $jumlahpengumuman = $pengumuman->num_rows;

// $galeri = $conn->query("SELECT * FROM galeri");
// $jumlahgaleri = $galeri->num_rows;

// $aspirasi = $conn->query("SELECT * FROM aspirasi");
// $jumlahaspirasi = $aspirasi->num_rows;

?>

<div class="content-body">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-8 col-md-12">
                <div class="card justify-content-center">
                    <div class="card-header">
                        <img src="" style="width:100%;border-radius:10%;" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Jumlah kategori </div>
                            <div class="stat-digit"><?= $jumlahkategori ?></div>
                        </div>
                        <div class="card-footer align-items-center justify-content-between">
                            <center>
                                <a class="small text-white stretched-link" href="kategoridaftar.php"><button
                                        type="button" class="btn btn-lg btn-primary">Lihat Data</button></a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>

        <?php include 'footer.php'; ?>