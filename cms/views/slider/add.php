<form action="" method="post" enctype="multipart/form-data">
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
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Şəkil}') ?> * (<?=Lang::get('{Şəkilin ölçüsü}')?>: <?=slider_width?> x <?=slider_height?> px)</label>
                                <input class="form-control" name="data_photo" type="file" size="32">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Sıralama}') ?> *</label>
                                <input class="form-control" name="data_ordering" value="<?=isset($data->data_ordering)?$data->data_ordering:$this->maxOrder?>">
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
                                        $subtitle = 'data_subtitle_'.$key;
                                        $link = 'data_link_'.$key;
                                        ?>
                                        <div role="tabpanel" class="tab-pane<?=($x==1)?' active':''?>" id="tab_<?=$key?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?= Lang::get('{Kiçik başlıq}') ?> *</label>
                                                        <input class="form-control" name="data_title_<?=$key?>" value="<?=(isset($data->$title))?$data->$title:''?>">
                                                        <?=(isset($error))?Func::showError('data_title_'.$key, $error):''?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?= Lang::get('{Böyük başlıq}') ?></label>
                                                        <input class="form-control" name="data_subtitle_<?=$key?>" value="<?=(isset($data->$subtitle))?$data->$subtitle:''?>">
                                                        <?=(isset($error))?Func::showError('data_subtitle_'.$key, $error):''?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?= Lang::get('{Ətraflı link}') ?></label>
                                                        <input class="form-control" name="data_link_<?=$key?>" value="<?=(isset($data->$link))?$data->$link:''?>">
                                                        <?=(isset($error))?Func::showError('data_link_'.$key, $error):''?>
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
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    
</form>