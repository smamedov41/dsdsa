
    <!--====================  footer area ====================-->
    <div class="footer-area bg-img space__inner--ry120" data-bg="<?=URL?>public/assets/img/backgrounds/footer-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-widget__logo space__bottom--40">
                            <a href="<?=URL.MF::$_lang?>">
                                <img src="<?=URL?>public/assets/img/logo-white.png" class="img-fluid" alt="">
                            </a>
                        </div>
                        <p class="footer-widget__text space__bottom--20"><?= isset($this->def[7])? $this->def[7] : '' ?></p>
                        <ul class="social-icons">
                            <?php
                            if(isset($this->def[9]) && !empty($this->def[9])){
                                ?><li><a href="<?= $this->def[9] ?>" target="_blank"><i class="fa fa-facebook"></i></a></li> <?php
                            }
                            if(isset($this->def[10]) && !empty($this->def[10])){
                                ?><li><a href="<?= $this->def[10] ?>" target="_blank"><i class="fa fa-twitter"></i></a></li> <?php
                            }
                            if(isset($this->def[11]) && !empty($this->def[11])){
                                ?><li><a href="<?= $this->def[11] ?>" target="_blank"><i class="fa fa-instagram"></i></a></li> <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="footer-widget space__top--15 space__top__md--40 space__top__lm--40">
                        <h5 class="footer-widget__title space__bottom--20"><?=Lang::get('{Bölmələr}')?></h5>
                        <ul class="footer-widget__menu">
                            <?php
                            if(isset($this->menuFooter) && !empty($this->menuFooter)) {
                                foreach ($this->menuFooter as $key=>$value) {
                                    ?><li><a href="<?=Func::create_link($value)?>"><?= $value['title'] ?></a></li><?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-widget__title space__top--15 space__bottom--20 space__top__md--40 space__top__lm--40"><?=Lang::get('{Bizimlə əlaqə}')?></h5>
                    <div class="footer-contact-wrapper">
                        <div class="single-footer-contact">
                            <div class="single-footer-contact__icon"><i class="fa fa-map-marker"></i></div>
                            <div class="single-footer-contact__text"><?= isset($this->def[6])? $this->def[6] : '' ?></div>
                        </div>
                        <div class="single-footer-contact">
                            <div class="single-footer-contact__icon"><i class="fa fa-phone"></i></div>
                            <div class="single-footer-contact__text"><?= isset($this->def[4])? $this->def[4] : '' ?></div>
                        </div>
                        <div class="single-footer-contact">
                            <div class="single-footer-contact__icon"><i class="fa fa-globe"></i></div>
                            <div class="single-footer-contact__text"><?= isset($this->def[8])? $this->def[8] : '' ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright text -->
    <div class="copyright-area background-color--deep-dark space__inner--y30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="copyright-text">Copyright <?=date('Y')?> | <?=Lang::get('{Bütün hüquqlar qorunur}')?>.</p>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of footer area  ====================-->

    <!--====================  scroll top ====================-->
    <button class="scroll-top" id="scroll-top">
        <i class="fa fa-angle-up"></i>
    </button>
    <!--====================  End of scroll top  ====================-->

    <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="<?=URL?>public/assets/js/modernizr-2.8.3.min.js"></script>
    <!-- jQuery JS -->
    <script src="<?=URL?>public/assets/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?=URL?>public/assets/js/bootstrap.min.js"></script>
    <!-- Popper JS -->
    <script src="<?=URL?>public/assets/js/popper.min.js"></script>
    <!-- Slick slider JS -->
    <script src="<?=URL?>public/assets/js/plugins/slick.min.js"></script>
    <!-- Counterup JS -->
    <script src="<?=URL?>public/assets/js/plugins/counterup.min.js"></script>
    <!-- Waypoint JS -->
    <script src="<?=URL?>public/assets/js/plugins/waypoint.min.js"></script>
    <!-- Justified Gallery JS -->
    <script src="<?=URL?>public/assets/js/plugins/justifiedGallery.min.js"></script>
    <!-- Image Loaded JS -->
    <script src="<?=URL?>public/assets/js/plugins/imageloaded.min.js"></script>
    <!-- Maosnry JS -->
    <script src="<?=URL?>public/assets/js/plugins/masonry.min.js"></script>
    <!-- Light Gallery JS -->
    <script src="<?=URL?>public/assets/js/plugins/light-gallery.min.js"></script>
    <!-- Mailchimp JS -->
    <script src="<?=URL?>public/assets/js/plugins/mailchimp-ajax-submit.min.js"></script>
    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->
    <!--
    <script src="<?=URL?>public/assets/js/plugins/plugins.min.js"></script>
    -->
    <!-- Main JS -->
    <script src="<?=URL?>public/assets/js/main.js"></script>

    <?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            ?><script src="<?= URL ?>public/<?= $js ?>"></script><?php
        }
    }
    ?>
</body>
</html>