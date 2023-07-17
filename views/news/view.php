
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

    <!--====================  blog details ====================-->
    <div class="blog-section space__bottom--r120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">

                        <?php
                        if(isset($this->viewNews) && !empty($this->viewNews)) {
                            $item = $this->viewNews;
                            $photo = !empty($item['photo'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$item['photo']:'';
                            ?>

                            <div class="blog-details col-12">
                                <div class="blog-inner">
                                    <div class="media">
                                        <div class="image"><img src="<?=$photo?>" alt="<?=$item['title']?>"></div>
                                    </div>
                                    <div class="content">
                                        <h2 class="title"><?=$item['title']?></h2>
                                        <div class="desc space__bottom--30"><?=$item['text']?></div>
                                        <ul class="meta">
                                            <li><?=$item['post_date']?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="col-lg-4 col-12 space__top__md--50 space__top__lm--50">
                    <?php require __DIR__.'/right_side.php'?>
                </div>

            </div>
        </div>
    </div>
    <!--====================  End of blog details  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>