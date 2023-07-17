
    <!--====================  breadcrumb area ====================-->
    <div class="page-breadcrumb bg-img space__bottom--r120" data-bg="<?=URL?>public/assets/img/backgrounds/bc-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-breadcrumb-content text-center">
                        <h1><?=((isset($this->pages['subtitle']) && !empty($this->pages['subtitle']))?$this->pages['subtitle']:(isset($this->pages['title'])?$this->pages['title']:''))?></h1>
                        <ul class="page-breadcrumb-links">
                            <li><a href="<?=URL.MF::$_lang?>"><?=Lang::get('{Ana səhifə}')?> </a></li>
                            <li><?=isset($this->pages['title'])?$this->pages['title']:''?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  about area ====================-->
    <div class="about-area space__bottom--r120 about-mobile">
        <div class="container">
            <div class="row align-items-center row-25">
                <div class="col-md-12">
                    <div class="about-content">
                        <?=isset($this->pages['text'])?$this->pages['text']:''?>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                    <div class="about-image space__bottom__lm--30 text-center">
                        <iframe width="650" height="450" src="https://www.youtube.com/embed/FKigcUxL-yw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of about area  ====================-->

    <!--====================  cta area ====================-->
    <div class="about-cta cta-area cta-area-bg bg-img" data-bg="<?=URL?>public/assets/img/backgrounds/cta-bg2.jpg">
        <div class="cta-wrapper background-color--dark-overlay space__inner__top--50 space__inner__bottom--150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="cta-block cta-block--default-color">
                            <p class="cta-block__light-text text-center"><?=Lang::get('{Uzun illərin təcrübəsinə güvənərək}')?></p>
                            <p class="cta-block__semi-bold-text cta-block__semi-bold-text--medium text-center"><?=Lang::get('{Bizimlə əməkdaşlıq üçün əlaqə saxlayın}')?></p>
                            <p class="cta-block__bold-text text-center"><?= isset($this->def[4])? $this->def[4] : '' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of cta area  ====================-->

    <?php require __DIR__.'/../feature_block.php'; ?>

    <!--====================  team area ====================-->
    <div class="team-area space__bottom--r120 position-relative about-team">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 space__bottom__md--40 space__bottom__lm--40">
                    <div class="team-member-title-wrapper">
                        <!-- section title -->
                        <div class="section-title space__bottom--30 space__bottom__md--30  space__bottom__lm--20">
                            <h3 class="section-title__sub"><?=Lang::get('{Bizim komandanın}')?></h3>
                            <h2 class="section-title__title"><?=Lang::get('{Professional heyyəti}')?></h2>
                        </div>
                        <p class="team-text"><?=Lang::get('{Bir komanda üçün lazım olan bütün keyfiyyətlərə sahib peşəkar heyyət ilə sizə xidmət göstərməkdən qürur duyuruq}')?></p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12">
                            <div class="nav nav-tabs team-member-link-wrapper" id="nav-tab2" role="tablist">

                                <?php
                                if(isset($this->listStaff) && !empty($this->listStaff)) {
                                    foreach ($this->listStaff as $key => $value) {
                                        $photo = !empty($value['photo']) ? UPLOAD_DIR_LINK . 'Image/staff/' . $value['photo'] : '';
                                        ?>
                                        <a class="nav-item nav-link">
                                            <div class="staff-img"><img src="<?=$photo?>" class="img-fluid" alt="<?= $value['title'] ?>"></div>
                                            <strong><?= str_replace(' ', '<br>', $value['title']) ?></strong>
                                            <span><?= $value['position'] ?></span>
                                        </a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of team area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>