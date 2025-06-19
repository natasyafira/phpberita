<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Daftar - Website Berita</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/admin/images/logo1.png">
    <link href="./assets/admin/css/style.css" rel="stylesheet">
    <style>
        body {
            background-image: url("assets/bglogin.jpg");
            height: 1000px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">DAFTAR AKUN</h4>
                                    <form action="proses_daftar.php" method="post" style="width:100%;">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Peran / Nama</strong></label>
                                            <select class="form-control" name="nama" required>
                                                <option value="">-- Pilih Peran --</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="Author">Author</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>No HP (khusus Author)</strong></label>
                                            <input type="text" class="form-control" name="nohp" placeholder="Contoh: 081234567890">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="daftar" class="btn btn-success btn-block">Daftar</button>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="login.php" class="btn btn-primary btn-block">Kembali ke Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/admin/vendor/global/global.min.js"></script>
    <script src="./assets/admin/js/quixnav-init.js"></script>
    <script src="./assets/admin/js/custom.min.js"></script>
</body>
</html>
