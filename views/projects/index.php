
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

    <div class="project-section space__bottom--r120">
        <div class="container">
            <?php
            if(isset($this->listItems) && !empty($this->listItems)){
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="project-item-wrapper space__bottom--m40">
                        <div class="row">
                        <?php
                        foreach ($this->listItems as $key=>$value){
                            $photo = !empty($value['photo'])?UPLOAD_DIR_LINK.'Image/'.$this->menu.'/'.$value['photo']:'';
                            $link = isset($value['id'])?URL.MF::$_lang.'/'.$this->menu.'/view/'.$value['id'].'/'.Func::slug($value['title']):'#';
                            ?>

                            <div class="col-lg-4 col-md-6 col-12 space__bottom--40">
                                <div class="single-project-wrapper single-project-wrapper--reduced-abs">
                                    <a class="single-project-item p-0" href="<?=$link?>">
                                        <img src="<?=$photo?>" class="img-fluid" alt="<?=$value['title']?>">
                                        <span class="single-project-title"><?=$value['title']?></span>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
                echo '<div class="row space__top--50"><div class="col">';
                echo (isset($this->pagination) && !empty($this->pagination))?$this->pagination:'';
                echo '</div></div>';
            }
            ?>
        </div>
    </div>


    <?php require __DIR__.'/../footer_partners.php'; ?>