
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
    <div class="about-area space__bottom--r120 ">
        <div class="container">
            <div class="row align-items-center row-25">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="about-content">
                        <!-- section title -->
                        <div class="section-title space__bottom--25">
                            <h3 class="section-title__sub">Science 1982</h3>
                            <h2 class="section-title__title">Provide the best quality service and construct</h2>
                        </div>
                        <p class="about-content__text space__bottom--40">Publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infance</p>
                        <a href="contact.html" class="default-btn">Start now</a>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2">
                    <div class="about-image space__bottom__lm--30">
                        <img src="<?=URL?>public/assets/img/about/about-section-2.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of about area  ====================-->

    <!--====================  cta area ====================-->
    <div class="cta-area cta-area-bg bg-img" data-bg="<?=URL?>public/assets/img/backgrounds/cta-bg2.jpg">
        <div class="cta-wrapper background-color--dark-overlay space__inner__top--50 space__inner__bottom--150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="cta-block cta-block--default-color">
                            <p class="cta-block__light-text text-center">More than <span>25</span> years</p>
                            <p class="cta-block__semi-bold-text cta-block__semi-bold-text--medium text-center">Do you have project Just dial (toll free)</p>
                            <p class="cta-block__bold-text text-center">+98565 569 874</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of cta area  ====================-->

    <!-- funfact include -->
    <div class="funfact-wrapper space__top--m100">
        <!--====================  fun fact area ====================-->
        <div class="fun-fact-area space__bottom--r120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- fun fact wrapper -->
                        <div class="fun-fact-wrapper fun-fact-wrapper-bg bg-img" data-bg="<?=URL?>public/assets/img/backgrounds/funfact-bg.jpg">
                            <div class="fun-fact-inner background-color--default-overlay background-repeat--x-bottom space__inner--y30 bg-img" data-bg="<?=URL?>public/assets/img/icons/ruler-black.png">
                                <div class="fun-fact-content-wrapper">
                                    <div class="single-fun-fact">
                                        <h3 class="single-fun-fact__number counter">985</h3>
                                        <h4 class="single-fun-fact__text">Projects</h4>
                                    </div>
                                    <div class="single-fun-fact">
                                        <h3 class="single-fun-fact__number counter">529</h3>
                                        <h4 class="single-fun-fact__text">Clients</h4>
                                    </div>
                                    <div class="single-fun-fact">
                                        <h3 class="single-fun-fact__number counter">888</h3>
                                        <h4 class="single-fun-fact__text">Success</h4>
                                    </div>
                                    <div class="single-fun-fact">
                                        <h3 class="single-fun-fact__number counter">100</h3>
                                        <h4 class="single-fun-fact__text">Awards</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of fun fact area  ====================-->
    </div>
    <!--====================  feature area ====================-->
    <div class="feature-area space__bottom--r120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1">
                    <!-- feature content wrapper -->
                    <div class="feature-content-wrapper space__bottom--m35">
                        <div class="single-feature space__bottom--35">
                            <div class="single-feature__icon">
                                <img src="<?=URL?>public/assets/img/icons/feature-1.png" class="img-fluid" alt="">
                            </div>
                            <div class="single-feature__content">
                                <h4 class="single-feature__title">Top Rated</h4>
                                <p class="single-feature__text">Publishing packages and web page editors now use Lorem Ipsum as their default model text and a search for lorem ipsumwill uncover</p>
                            </div>
                        </div>
                        <div class="single-feature space__bottom--35">
                            <div class="single-feature__icon">
                                <img src="<?=URL?>public/assets/img/icons/feature-2.png" class="img-fluid" alt="">
                            </div>
                            <div class="single-feature__content">
                                <h4 class="single-feature__title">Best Quality</h4>
                                <p class="single-feature__text">Publishing packages and web page editors now use Lorem Ipsum as their default model text and a search for lorem ipsumwill uncover</p>
                            </div>
                        </div>
                        <div class="single-feature space__bottom--35">
                            <div class="single-feature__icon">
                                <img src="<?=URL?>public/assets/img/icons/feature-3.png" class="img-fluid" alt="">
                            </div>
                            <div class="single-feature__content">
                                <h4 class="single-feature__title">Low Price</h4>
                                <p class="single-feature__text">Publishing packages and web page editors now use Lorem Ipsum as their default model text and a search for lorem ipsumwill uncover</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 space__bottom__md--40 space__bottom__lm--40 order-1 order-lg-2">
                    <!-- feature content image -->
                    <div class="feature-content-image">
                        <img src="<?=URL?>public/assets/img/feature/feature-banner-1.jpg" class="img-fluid" alt="">
                        <img src="<?=URL?>public/assets/img/feature/feature-banner-2.jpg" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of feature area  ====================-->

    <!--====================  team area ====================-->
    <div class="team-area space__bottom--r120 position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 space__bottom__md--40 space__bottom__lm--40">
                    <div class="team-member-title-wrapper">
                        <!-- section title -->
                        <div class="section-title space__bottom--30 space__bottom__md--30  space__bottom__lm--20">
                            <h3 class="section-title__sub">Our Team</h3>
                            <h2 class="section-title__title">Best & quality team member</h2>
                        </div>
                        <p class="team-text">Publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-6">
                            <div class="nav nav-tabs team-member-link-wrapper" id="nav-tab2" role="tablist">
                                <a class="nav-item nav-link active" id="team-member1-tab" data-toggle="tab" href="#team-member1" role="tab" aria-selected="true">
                                    <img src="<?=URL?>public/assets/img/team/team-member1-sq.jpg" class="img-fluid" alt="">
                                </a>
                                <a class="nav-item nav-link" id="team-member2-tab" data-toggle="tab" href="#team-member2" role="tab" aria-selected="false">
                                    <img src="<?=URL?>public/assets/img/team/team-member2-sq.jpg" class="img-fluid" alt="">
                                </a>
                                <a class="nav-item nav-link" id="team-member3-tab" data-toggle="tab" href="#team-member3" role="tab" aria-selected="false">
                                    <img src="<?=URL?>public/assets/img/team/team-member3-sq.jpg" class="img-fluid" alt="">
                                </a>
                                <a class="nav-item nav-link" id="team-member4-tab" data-toggle="tab" href="#team-member4" role="tab" aria-selected="false">
                                    <img src="<?=URL?>public/assets/img/team/team-member4-sq.jpg" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="tab-content team-member__content-wrapper">
                                <div class="tab-pane fade show active" id="team-member1" role="tabpanel" aria-labelledby="team-member1-tab">
                                    <div class="single-team-member--shadow text-center">
                                        <div class="single-team-member__image">
                                            <img src="<?=URL?>public/assets/img/team/team-member1.jpg" alt="">
                                        </div>
                                        <div class="single-team-member__content">
                                            <h5 class="single-team-member__name">Smarto Jowly</h5>
                                            <p class="single-team-member__des">Chief Plamber</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="team-member2" role="tabpanel" aria-labelledby="team-member2-tab">
                                    <div class="single-team-member--shadow text-center">
                                        <div class="single-team-member__image">
                                            <img src="<?=URL?>public/assets/img/team/team-member2.jpg" alt="">
                                        </div>
                                        <div class="single-team-member__content">
                                            <h5 class="single-team-member__name">Franky Moina</h5>
                                            <p class="single-team-member__des">Chief Electrician</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="team-member3" role="tabpanel" aria-labelledby="team-member3-tab">
                                    <div class="single-team-member--shadow text-center">
                                        <div class="single-team-member__image">
                                            <img src="<?=URL?>public/assets/img/team/team-member3.jpg" alt="">
                                        </div>
                                        <div class="single-team-member__content">
                                            <h5 class="single-team-member__name">Navira Parey</h5>
                                            <p class="single-team-member__des">Chief Architect</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="team-member4" role="tabpanel" aria-labelledby="team-member4-tab">
                                    <div class="single-team-member--shadow text-center">
                                        <div class="single-team-member__image">
                                            <img src="<?=URL?>public/assets/img/team/team-member4.jpg" alt="">
                                        </div>
                                        <div class="single-team-member__content">
                                            <h5 class="single-team-member__name">Tandur Belali</h5>
                                            <p class="single-team-member__des">Engineer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of team area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>