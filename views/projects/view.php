
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

    <!--====================  project details area ====================-->
    <div class="project-section space__bottom--r120">
        <div class="container">
            <div class="row">

                <?php
                if(isset($this->viewItems) && !empty($this->viewItems)){
                    $item = $this->viewItems;
                    ?>

                    <!--div class="col-lg-4 col-12 space__bottom--30">
                        <div class="project-information">
                            <h4 class="space__bottom--15">Project Information</h4>
                            <ul>
                                <li><strong>Client:</strong> <a href="#">RRS Company</a></li>
                                <li><strong>Location:</strong> San Francisco</li>
                                <li><strong>Area(sf):</strong> 550,000 sf</li>
                                <li><strong>Year:</strong> 2018</li>
                                <li><strong>Budget:</strong> $245000000</li>
                                <li><strong>Architect:</strong> Scott & Austin</li>
                                <li><strong>Sector:</strong> <a href="project.html">Tunnel</a>, <a href="project.html">Transport</a></li>
                            </ul>
                        </div>
                    </div-->
                    <div class="col-lg-12 col-12 space__bottom--30">
                        <div class="project-details">
                            <h3 class="space__bottom--15"><?=$item['title']?></h3>
                            <div class="project-more"><?=$item['text']?></div>
                        </div>
                    </div>
                    <?php
                    if(isset($item['photos']) && !empty($item['photos'])){
                        ?>

                        <div class="col-12">
                            <div class="row row-5 image-popup">
                                <?php
                                foreach ($item['photos'] as $k=>$v){
                                    $thumb = !empty($v['thumb'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$v['thumb']:'';
                                    $photo = !empty($v['photo'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$v['photo']:'';
                                    ?>
                                    <div class="col-xl-3 col-lg-4 col-sm-6 col-12 space__top--10">
                                        <a href="<?=$photo?>" class="gallery-item single-gallery-thumb">
                                            <img src="<?=$thumb?>" class="img-fluid" alt="<?=$item['title']?>">
                                            <span class="plus"></span>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <!--====================  End of project details area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>