<?php include_once('../koneksi.php');
include 'header.php';
$ambildata = $conn->query("SELECT * FROM penulis WHERE idpenulis='$_GET[id]'");
$data = $ambildata->fetch_assoc();
?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Penulis</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama penulis</label>
                                <input type="text" class="form-control" name="penulis"
                                    value=" <?php echo $data['namapenulis']; ?>">
                            </div>
                            <div class="form-group">
                                <label>No Hp Penulis</label>
                                <input type="text" class="form-control" name="nohppenulis"
                                    value=" <?php echo $data['nohppenulis']; ?>">
                            </div>
                            <button class="btn btn-primary pull-right" name="edit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['edit'])) {
	$conn->query("UPDATE penulis SET namapenulis='$_POST[penulis]', nohppenulis='$_POST[nohppenulis]' WHERE idpenulis='$_GET[id]'");
	echo "<script>alert('Data Berhasil Di Edit');</script>";
	echo "<script> location ='penulisdaftar.php';</script>";
}
        ?>

        <?php include 'footer.php'; ?>