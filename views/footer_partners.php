
    <?php
    if(isset($this->partnersList) && !empty($this->partnersList)) {
        ?>

        <!--====================  brand logo area ====================-->
        <div class="brand-logo-area space__bottom--r120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="brand-logo-wrapper">
                            <?php
                            foreach ($this->partnersList as $key=>$value){
                                $photo = !empty($value['photo'])?UPLOAD_DIR_LINK.'Image/partners/'.$value['photo']:'';
                                $link = (isset($value['link']) && !empty($value['link']))?$value['link']:'javascript:';
                                $target = (isset($value['link']) && !empty($value['link']))?' target="_blank"':'';
                                ?><div class="single-brand-logo"><a href="<?=$link?>"<?=$target?>><img src="<?=$photo?>" class="img-fluid" alt="<?=$value['title']?>"></a></div><?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of brand logo area  ====================-->
        <?php
    }
    ?>

    <!--====================  newsletter area ====================-->
    <div class="newsletter-area newsletter-area-bg bg-img" data-bg="<?=URL?>public/assets/img/backgrounds/newsletter-bg.jpg">
        <div class="newsletter-wrapper background-color--default-overlay space__inner--y60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-10 mx-auto">
                        <div class="row align-items-center">
                            <div class="col-lg-9 mb-9 mb-lg-9">
                                <!-- newsletter title -->
                                <h3 class="newsletter-title"><span><?=Lang::get('{Müraciətinizi əlaqə bölməsindən}')?></span> <?=Lang::get('{bizə ünvanlaya bilərsiniz}')?></h3>
                            </div>
                            <div class="col-lg-3">
                                <div class="newsletter-form text-center"><a href="<?=URL.MF::$_lang?>/contacts" class="btn btn-success btn-lg" href="#"><?=Lang::get('{MƏKTUB YAZ}')?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of newsletter area  ====================-->