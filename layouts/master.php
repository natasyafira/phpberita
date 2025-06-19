<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Website Berita </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/home/assets/img/logo/logo.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/home/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/home/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/home/assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/home/assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/home/assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/home/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/home/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/home/assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/home/assets/css/slick.css">
    <link rel="stylesheet" href="assets/home/assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/home/assets/css/style.css">
    <style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
    </style>
</head>

<?php include_once('navbar.php');
date_default_timezone_set('Asia/Jakarta');
function tanggal($tgl)
{
   $tanggal = substr($tgl, 8, 2);
   $bulan = getBulan(substr($tgl, 5, 2));
   $tahun = substr($tgl, 0, 4);
   return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
   switch ($bln) {
      case 1:
         return "Januari";
         break;
      case 2:
         return "Februari";
         break;
      case 3:
         return "Maret";
         break;
      case 4:
         return "April";
         break;
      case 5:
         return "Mei";
         break;
      case 6:
         return "Juni";
         break;
      case 7:
         return "Juli";
         break;
      case 8:
         return "Agustus";
         break;
      case 9:
         return "September";
         break;
      case 10:
         return "Oktober";
         break;
      case 11:
         return "November";
         break;
      case 12:
         return "Desember";
         break;
   }
}
?>