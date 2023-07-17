
    <?php
    if(isset($this->projectsList) && !empty($this->projectsList)) {
        ?>

        <div class="sidebar">
            <h3 class="sidebar-title"><?=Lang::get('{Layihələr}')?></h3>
            <?php
            foreach ($this->projectsList as $key=>$value){
                $photo = !empty($value['photo'])?UPLOAD_DIR_LINK.'Image/projects/'.$value['photo']:'';
                $link = isset($value['id'])?URL.MF::$_lang.'/projects/view/'.$value['id'].'/'.Func::slug($value['title']):'#';
                $title = (isset($value['title']) && !empty($value['title']))?$value['title']:'';
                ?>

                <div class="sidebar-blog">
                    <a href="<?=$link?>" class="image"><img src="<?=$photo?>" alt=""></a>
                    <div class="content"><h5><a href="<?=$link?>"><?=$title?></a></h5></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>