<?php
include_once('../koneksi.php');
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
                                <label>Nama Penulis</label>
                                <input type="text" class="form-control" name="penulis">
                            </div>
                            <div class="form-group">
                                <label>No Hp Penulis</label>
                                <input type="text" class="form-control" name="nohppenulis">
                            </div>
                            <button class="btn btn-primary pull-right" name="tambah">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['tambah'])) {
	$penulis = $_POST["penulis"];
	$nohppenulis = $_POST["nohppenulis"];
	$conn->query("INSERT INTO penulis(namapenulis,nohppenulis)
		VALUES ('$penulis','$nohppenulis')");
	echo "<script> alert('Data Berhasil Di Simpan');</script>";
	echo "<script>location='penulisdaftar.php';</script>";
}
?>

<?php include 'footer.php'; ?>