<?php
$nama_user = isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : 'Tamu';
?>

<footer>
   <div class="footer-area">
      <div class="container">
         <div class="footer-top footer-padding">
            <div class="row justify-content-between">
               <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                  <div class="single-footer-caption mb-50">
                     <div class="footer-tittle">
                        <h4>Alamat</h4>
                        <ul>
                           <p><a href="#">Jl. Cikiwul No 4 Rt 04 Rw 04 kel, Cikiwul Kec Bantargebang, Cikiwul, Kec. Bantargebang, Kota Bekasi, Jawa Barat</a></p>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                  <div class="single-footer-caption mb-50">
                     <div class="footer-tittle">
                        <h4>Tautan</h4>
                        <ul>
                           <li><a href="#">Profil Sekolah</a></li>
                           <li><a href="#">Ekstrakulikuler</a></li>
                           <li><a href="#">Galeri</a></li>
                           <li><a href="#">Pengumuman</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                  <div class="single-footer-caption mb-50">
                     <div class="footer-tittle">
                        <h4>Kontak Kami</h4>
                        <ul>
                           <p><a href="#">+628 8983 2291</a></p>
                           <p><a href="#">smpn49bekasi@gmail.com</a></p>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-bottom">
    <div class="row d-flex justify-content-center align-items-center text-center">
        <div class="col-xl-12 col-lg-8">
            <div class="footer-copy-right">
                <p>
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved
                </p>
                <p>Login sebagai: <strong><?php echo $nama_user; ?></strong></p>
            </div>
        </div>
    </div>
</div>
      </div>
   </div>
   </div>
   <!-- Footer End-->
</footer>
<!-- Scroll Up -->
<div id="back-top">
   <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>


<!-- JS here -->
<!-- All JS Custom Plugins Link Here here -->
<script src="assets/home/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="assets/home/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="assets/home/assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="assets/home/assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="assets/home/assets/js/wow.min.js"></script>
<script src="assets/home/assets/js/animated.headline.js"></script>
<script src="assets/home/assets/js/jquery.magnific-popup.js"></script>

<!-- Nice-select, sticky -->
<script src="assets/home/assets/js/jquery.nice-select.min.js"></script>
<script src="assets/home/assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="assets/home/assets/js/contact.js"></script>
<script src="assets/home/assets/js/jquery.form.js"></script>
<script src="assets/home/assets/js/jquery.validate.min.js"></script>
<script src="assets/home/assets/js/mail-script.js"></script>
<script src="assets/home/assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="assets/home/assets/js/plugins.js"></script>
<script src="assets/home/assets/js/main.js"></script>

</body>