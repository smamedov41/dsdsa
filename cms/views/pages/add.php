<form action="" method="post">
    <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>
    <input type="hidden" name="admin_csrf_name" value="<?= $unique_form_name ?>">
    <input type="hidden" name="admin_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

    <div class="row bg-title">
        <div class="col-lg-12">
            <h4 class="page-title"><?= Lang::get($this->menu) ?>
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger btn-sm"><?= Lang::get('{Yadda saxla}') ?></button>
                    <button type="reset" class="btn btn-primary btn-sm"><?= Lang::get('{Sıfırla}') ?></button>
                </div>
            </h4>
            <ol class="breadcrumb">
                <li><a href="<?=URL?>index"><?=Lang::get('{İdarəetmə paneli}')?></a></li>
                <li><a href="<?=URL.$this->menu?>"><?= Lang::get($this->menu) ?></a></li>
                <li class="active"><?= $this->titleSub ?></li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <?php
            // show success
            $alert = Session::get('note_success') ? Session::get('note_success') : NULL;
            if($alert){
                Func::headerAlert($alert, 'success');
                Session::delete('note_success');
            }

            // show success
            $alert = Session::get('note_error') ? Session::get('note_error') : NULL;
            if($alert){
                Func::headerAlert($alert, 'error');
                Session::delete('note_error');
            }

            // show error
            if(isset($this->postData->headerError)){
                Func::headerAlert($this->postData->headerError);
            }

            // show error
            if(isset($this->postData->mysqlError)){
                Func::headerAlert($this->postData->mysqlError);
            }

            // formError
            if(isset($this->postData->formError)){
                $error = $this->postData->formError;
            }

            // data
            if(isset($this->postData->data)){
                $data = $this->postData->data;
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?= Lang::get('{Üst səhifə}') ?></label>
                                <select class="form-control selectpicker" name="data_parent" data-live-search="true">
                                    <?php
                                    function buildMenu($parentId, $menuData, $level) {
                                        $level = ++$level;
                                        $html = '';
                                        if (isset($menuData['parents'][$parentId])) {
                                            foreach ($menuData['parents'][$parentId] as $itemId) {
                                                $html .= '<option class="level-'.$level.'" value="' . $menuData['items'][$itemId]['id'] . '">' . $menuData['items'][$itemId]['title'] . '</option>';
                                                $html .= buildMenu($itemId, $menuData, $level);
                                            }
                                        }
                                        return $html;
                                    }
                                    ?>

                                    <option value="0"><?=Lang::get('{Üst səhifəni seçin}')?></option>
                                    <?= buildMenu(0, $this->pagesList, 0) ?>
                                    <?php unset($this->pagesList); ?>
                                </select>
                                <?=(isset($error))?Func::showError('data_parent', $error):''?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?= Lang::get('{Sıralama}') ?> *</label>
                                <input class="form-control" name="data_ordering" value="<?=(isset($data->data_ordering))?$data->data_ordering:$this->maxOrder?>">
                                <?=(isset($error))?Func::showError('data_ordering', $error):''?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <!-- Tab -->
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php
                                    $x=1;
                                    foreach (MFAdmin::$_langs as $key=>$value){
                                        ?>
                                        <li role="presentation"<?=($x==1)?' class="active"':''?>><a href="#tab_<?=$key?>" aria-controls="tab_<?=$key?>"><?=$value?></a></li>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </ul>
                                <div class="tab-content">
                                    <?php
                                    $x=1;
                                    foreach (MFAdmin::$_langs as $key=>$value){
                                        $title = 'data_title_'.$key;
                                        $slug = 'data_slug_'.$key;
                                        $link = 'data_link_'.$key;
                                        $subtitle = 'data_subtitle_'.$key;
                                        $text = 'data_text_'.$key;
                                        ?>
                                        <div role="tabpanel" class="tab-pane<?=($x==1)?' active':''?>" id="tab_<?=$key?>" data-lang="<?=$key?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?= Lang::get('{Başlıq}') ?> *</label>
                                                        <input class="title form-control" name="data_title_<?=$key?>" value="<?=(isset($data->$title))?$data->$title:''?>">
                                                        <?=(isset($error))?Func::showError('data_title_'.$key, $error):''?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?= Lang::get('{Slug}') ?> *</label>
                                                        <input class="slug form-control" name="data_slug_<?=$key?>" value="<?=(isset($data->$slug))?$data->$slug:''?>">
                                                        <?=(isset($error))?Func::showError('data_slug_'.$key, $error):''?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><?= Lang::get('{Link}') ?></label>
                                                        <input class="form-control" name="data_link_<?=$key?>" value="<?=(isset($data->$link))?$data->$link:''?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><?= Lang::get('{Yarım başlıq}') ?></label>
                                                        <input class="form-control" name="data_subtitle_<?=$key?>" value="<?=(isset($data->$subtitle))?$data->$subtitle:''?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label><?= Lang::get('{Mətn}') ?></label>
                                                    <div class="form-group">
                                                        <textarea class="form-control summernote" name="data_text_<?=$key?>"><?=(isset($data->$text))?$data->$text:''?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- Tab -->

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Status}') ?> *</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="data_status" value="2" <?=(!isset($data->data_status) or (isset($data->data_status) && $data->data_status != 1))?'checked':''?>><?=Lang::get('{Aktiv}')?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="data_status" value="1" <?=(isset($data->data_status) && $data->data_status == 1)?'checked':''?>><?=Lang::get('{Passiv}')?>
                                </label>

                                <label class="radio-inline">
                                    <input type="checkbox" name="data_static_page" value="1"<?=(isset($data->data_static_page) && ($data->data_static_page>0))?' checked':''?>> <?= Lang::get('Static səhifə') ?>
                                </label>

                                <label class="radio-inline">
                                    <input type="checkbox" name="data_target" value="1"<?=(isset($data->data_target) && ($data->data_target>0))?' checked':''?>> <?= Lang::get('{Target: _blank}') ?>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    
</form>