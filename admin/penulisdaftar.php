<?php
include_once('../koneksi.php');
include 'header.php'; ?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Penulis</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="example">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penulis</th>
                                        <th>No Hp Penulis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $result = $conn->query("SELECT * FROM penulis order by namapenulis desc, idpenulis desc");
                                    while ($data = $result->fetch_array()) :
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['namapenulis'] ?></td>
                                        <td><?= $data['nohppenulis'] ?></td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="penulisedit.php?id=<?= $data['idpenulis'] ?>">Edit</a>
                                            <a class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                href="penulishapus.php?id=<?= $data['idpenulis'] ?>">Hapus</a>
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