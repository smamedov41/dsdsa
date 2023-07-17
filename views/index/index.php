
    <!--====================  hero slider area ====================-->
    <div class="hero-slider-area space__bottom--r120">
        <div class="hero-slick-slider-wrapper">
            <?php
            if(isset($this->listSlider) && !empty($this->listSlider)){
                foreach ($this->listSlider as $key=>$value){
                    $photo = !empty($value['photo'])?UPLOAD_DIR_LINK.'Image/slider/'.$value['photo']:'';
                    ?>

                    <div class="single-hero-slider single-hero-slider--background single-hero-slider--overlay position-relative bg-img" data-bg="<?=$photo?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- hero slider content -->
                                    <div class="hero-slider-content hero-slider-content--extra-space">
                                        <?php
                                        if(isset($value['title']) && !empty($value['title'])){
                                            ?><h3 class="hero-slider-content__subtitle"><?=$value['title']?></h3><?php
                                        }
                                        if(isset($value['subtitle']) && !empty($value['subtitle'])){
                                            ?><h2 class="hero-slider-content__title space__bottom--50"><?=$value['subtitle']?></h2><?php
                                        }
                                        if(isset($value['link']) && !empty($value['link'])){
                                            $link = (isset($value['link']) && !empty($value['link']))?$value['link']:'';
                                            ?><a href="<?=$link?>" class="default-btn default-btn--hero-slider"><?=Lang::get('{Ətraflı}')?></a><?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <!--====================  End of hero slider area  ====================-->

    <!--====================  about area ====================-->
    <div class="about-area space__bottom--r120 ">
        <div class="container">
            <div class="row align-items-center row-25">
                <div class="col-md-6">
                    <div class="about-image space__bottom__lm--30">
                        <?php
                        if(isset($this->def[15]) && !empty($this->def[15])){
                            ?><iframe width="100%" height="315" src="<?=$this->def[15]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content">
                        <!-- section title -->
                        <div class="section-title space__bottom--25">
                            <h3 class="section-title__sub"><?=Lang::get('{Shalset Group MMC}')?></h3>
                        </div>
                        <p class="about-content__text space__bottom--40"><?=Lang::get('{Tikinti sektorunda Azərbaycan Respublikasının qanunvericiliyinə uyğun fəaliyyət göstərən və bu sektorda özünü keyfiyyətli işlərlə doğrultmuş tikinti şirkətidir.}')?></p>
                        <a href="<?=URL.MF::$_lang?>/about" class="default-btn"><?=Lang::get('{Ətraflı}')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of about area  ====================-->

    <?php require __DIR__.'/../feature_block.php'; ?>

    <!--====================  project area ====================-->
    <div class="project-area space__bottom--r120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section title -->
                    <div class="section-title text-center  space__bottom--40 mx-auto">
                        <h3 class="section-title__sub"><?=Lang::get('{Layihələrimiz}')?></h3>
                        <h2 class="section-title__title"><?=Lang::get('{Həyata keçmiş ən son layihələrimiz ilə tanış ola bilərsiniz}')?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="project-wrapper space__bottom--m5" id="project-justify-wrapper">
            <?php
            if(isset($this->listProjects) && !empty($this->listProjects)) {
                foreach ($this->listProjects as $key => $value) {
                    $photo = !empty($value['photo']) ? UPLOAD_DIR_LINK . 'Image/projects/' . $value['photo'] : '';
                    $link = isset($value['id']) ? URL . MF::$_lang . '/projects/view/' . $value['id'] . '/' . Func::slug($value['title']) : '#';
                    ?>

                    <div class="single-project-wrapper">
                        <a class="single-project-item" href="<?= $link ?>">
                            <img src="<?= $photo ?>" class="img-fluid" alt="">
                            <span class="single-project-title"><?= $value['title'] ?></span>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <!--====================  End of project area  ====================-->

    <!--====================  team area ====================-->
    <div class="team-area space__bottom--r120 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 space__bottom__md--40 space__bottom__lm--40">
                    <div class="team-member-title-wrapper">
                        <!-- section title -->
                        <div class="section-title space__bottom--30 space__bottom__md--30  space__bottom__lm--20">
                            <h3 class="section-title__sub"><?=Lang::get('{Bizim komandanın}')?></h3>
                            <h2 class="section-title__title"><?=Lang::get('{Professional heyyəti}')?></h2>
                        </div>
                        <p class="team-text space__bottom--40 space__bottom__md--30 space__bottom__lm--20">
                            <?=Lang::get('{Bir komanda üçün lazım olan bütün keyfiyyətlərə sahib peşəkar heyyət ilə sizə xidmət göstərməkdən qürur duyuruq.}')?>
                        </p>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col-lg-8 team-slider-column-wrapper">
                    <!-- team member slider -->
                    <div class="team-slider-wrapper row">

                        <?php
                        if(isset($this->listStaff) && !empty($this->listStaff)) {
                            foreach ($this->listStaff as $key => $value) {
                                $photo = !empty($value['photo']) ? UPLOAD_DIR_LINK . 'Image/staff/' . $value['photo'] : '';
                                ?>

                                <div class="single-team-member col text-center">
                                    <div class="single-team-member__image space__bottom--10">
                                        <img src="<?=$photo?>" alt="<?= $value['title'] ?>" width="160">
                                    </div>
                                    <h5 class="single-team-member__name main-page-team-h5"><?= str_replace(' ', '<br>', $value['title']) ?></h5>
                                    <p class="single-team-member__des"><?= $value['position'] ?></p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of team area  ====================-->

    <!--====================  blog grid slider area ====================-->
    <div class="blog-grid-slider-area space__bottom--r120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- section title -->
                    <div class="section-title text-center  space__bottom--40 mx-auto">
                        <h3 class="section-title__sub"><?=Lang::get('{Xəbərlər}')?></h3>
                        <h2 class="section-title__title"><?=Lang::get('{Şirkətimiz və fəaliyyətimiz haqqında xəbərlər}')?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-wrapper space__bottom--m40">
                        <div class="row">
                            <?php
                            if(isset($this->listNews) && !empty($this->listNews)) {
                                foreach ($this->listNews as $key => $value) {
                                    $photo = !empty($value['photo']) ? UPLOAD_DIR_LINK . 'Image/news/' . $value['photo'] : '';
                                    $link = isset($value['id']) ? URL . MF::$_lang . '/news/view/' . $value['id'] . '/' . Func::slug($value['title']) : '#';
                                    ?>

                                    <div class="col-md-4">
                                        <div class="single-blog-grid space__bottom--40">
                                            <div class="single-blog-grid__image space__bottom--15">
                                                <a href="<?= $link ?>"><img src="<?= $photo ?>" class="img-fluid" alt="<?= $value['title'] ?>"></a>
                                            </div>
                                            <h4 class="single-blog-grid__title space__bottom--10"><a href="<?= $link ?>"><?= $value['title'] ?></a></h4>
                                            <p class="single-blog-grid__text"><?= $value['subtitle'] ?></p>
                                        </div>
                                    </div>
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
    <!--====================  End of blog grid slider area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>