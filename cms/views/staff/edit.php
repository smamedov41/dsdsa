<form action="<?= URL . $this->menu ?>/update/<?= isset($this->item['id'])?$this->item['id']:'0' ?>" method="post" enctype="multipart/form-data">
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

            // edit Error
            if(isset($this->postData->formError)){
                $error = $this->postData->formError;
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Şəkil}') ?> * (<?=Lang::get('{Şəkilin ölçüsü}')?>: <?=staff_width?> x <?=staff_height?> px)</label>
                                <input class="form-control" name="data_photo" type="file" size="32">
                                <?php
                                if($this->item['photo']) {
                                    ?>
                                    <br>
                                    <a class="btn btn-success btn-xs" href="<?= UPLOAD_DIR_LINK ?>Image/<?=$this->menu?>/<?= $this->item['photo']?>?v=<?=time()?>" target="_blank">
                                        <i class="glyphicon glyphicon-eye-open"></i> <?=Lang::get('{SHOW IMAGE}')?></a>
                                    <a class="btn btn-danger btn-xs pull-right" href="<?= URL . $this->menu?>/deletephoto/<?= $this->item['id'] ?>/<?=Func::token('token_photo_delete')?>">
                                        <i class="glyphicon glyphicon-remove"></i> <?=Lang::get('{DELETE IMAGE}')?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Sıralama}') ?> *</label>
                                <input class="form-control" name="data_ordering" value="<?=(isset($this->item['ordering']))?$this->item['ordering']:0?>">
                                <?=(isset($error))?Func::showError('data_ordering', $error):''?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
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
                                        ?>
                                        <div role="tabpanel" class="tab-pane<?=($x==1)?' active':''?>" id="tab_<?=$key?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label><?= Lang::get('{Başlıq}') ?> *</label>
                                                        <input class="form-control" name="data_title_<?=$key?>" value="<?=(isset($this->item['title'][$key]))?$this->item['title'][$key]:''?>">
                                                        <?=(isset($error))?Func::showError('data_title_'.$key, $error):''?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?= Lang::get('{Vəzifə}') ?> *</label>
                                                        <input class="form-control" name="data_position_<?=$key?>" value="<?=(isset($this->item['position'][$key]))?$this->item['position'][$key]:''?>">
                                                        <?=(isset($error))?Func::showError('data_position_'.$key, $error):''?>
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
                        <div class="col-md-12">
                            <div class="form-group radio">
                                <label><?= Lang::get('{Status}') ?></label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="data_status" value="2" <?= ($this->item['status'] == 2) ? ' checked' : '' ?>><?= Lang::get('{Aktiv}') ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="data_status" value="1" <?= ($this->item['status'] == 1) ? ' checked' : '' ?>><?= Lang::get('{Passiv}') ?>
                                </label>
                                <br>
                                <?=(isset($error))?Func::showError('data_status', $error):''?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    
</form>