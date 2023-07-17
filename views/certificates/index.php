
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

    <!--====================  testimonial area ====================-->
    <div class="testimonial-area space__bottom--r120">
        <div class="container">
            <?php
            if(isset($this->listItems) && !empty($this->listItems)){
                foreach ($this->listItems as $key=>$value) {
                    if(!empty($value['photos'])) {
                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <!-- section title -->
                                <div class="text-center space__bottom--40 mx-auto">
                                    <h3 class="section-title__sub"><?= $value['title'] ?></h3>
                                    <p><?= $value['text'] ?></p>
                                </div>

                                <!-- testimonial slider -->
                                <div class="testimonial-multi-slider-wrapper space__inner__bottom--50 space__inner__bottom__md--50 space__inner__bottom__lm--50 image-popup-gallery" id="gallery-<?=$key?>">
                                    <?php
                                    foreach ($value['photos'] as $k=>$v) {
                                        $thumb = !empty($v['thumb'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$v['thumb']:'';
                                        $photo = !empty($v['photo'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$v['photo']:'';
                                        ?>

                                        <div class="single-testimonial single-testimonial--style2">
                                            <a href="<?=$photo?>" class="gallery-item single-gallery-thumb">
                                                <img src="<?=$thumb?>" class="img-fluid">
                                                <span class="plus"></span>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>
                        <br>
                        <br>
                        <?php
                    }
                }
            }
            ?>


        </div>
    </div>
    <!--====================  End of testimonial area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>