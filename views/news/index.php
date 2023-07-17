
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

    <!--====================  blog area ====================-->
    <div class="blog-section space__bottom--r120">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-12">
                    <?php
                    if(isset($this->listNews) && !empty($this->listNews)){
                        ?>
                        <div class="row">
                            <?php
                            foreach ($this->listNews as $key=>$value){
                                $photo = !empty($value['photo'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$value['photo']:'';
                                $link = isset($value['id'])?URL.MF::$_lang.'/'.$this->menu.'/view/'.$value['id'].'/'.Func::slug($value['title']):'#';
                                ?>

                                <div class="col-sm-6 col-12">
                                    <div class="blog-post-slider__single-slide blog-post-slider__single-slide--grid-view">
                                        <div class="blog-post-slider__image space__bottom--30">
                                            <a href="<?=$link?>"><img src="<?=$photo?>" class="img-fluid" alt=""></a>
                                        </div>
                                        <div class="blog-post-slider__content">
                                            <p class="post-date"><?=$value['post_date']?></p>
                                            <h3 class="post-title"><a href="<?=$link?>"><?=$value['title']?></a></h3>
                                            <p class="post-excerpt"><?=$value['subtitle']?></p>
                                            <a href="<?=$link?>" class="see-more-link"><?=Lang::get('{ƏTRAFLI}')?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                        echo '<div class="row"><div class="col">';
                        echo (isset($this->pagination) && !empty($this->pagination))?$this->pagination:'';
                        echo '</div></div>';
                    }
                    ?>
                </div>

                <div class="col-lg-4 col-12 space__top__md--50 space__top__lm--50">
                    <?php require __DIR__.'/right_side.php'?>
                </div>

            </div>
        </div>
    </div>
    <!--====================  End of blog area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>