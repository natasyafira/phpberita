<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - Website Berita</title>
    <!-- Favicon icon -->
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
                                    <h4 class="text-center mb-4">LOGIN</h4>
                                    <form action="auth.php" method="post" style="width:100%;">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control" placeholder="Username"
                                                name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" placeholder="Password"
                                                name="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" value="login"
                                                class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <a href="daftar.php" class="btn btn-success btn-block">Daftar</a>

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


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./assets/admin/vendor/global/global.min.js"></script>
    <script src="./assets/admin/js/quixnav-init.js"></script>
    <script src="./assets/admin/js/custom.min.js"></script>

</body>