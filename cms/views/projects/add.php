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
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Şəkil}') ?> * (<?=Lang::get('{Şəkillərin ölçüsü}')?>: <?=projects_width?> x <?=projects_height?> px)</label>
                                <input type="hidden" id="sid" name="sid" value="<?=md5(Func::rund_number().time())?>">
                                <input type="file" id="file" multiple name="image[]">


                                <div class="bar">
                                    <span class="bar-fill" id="pb">
                                        <span class="bar-fill-text" id="pt"></span>
                                    </span>
                                </div>

                                <div class="uploads" id="uploads">
                                    <div id="succeeded"></div>
                                    <div id="failed"></div>
                                </div>

                                <p>
                                    <span>Şəkillərin maksimum çəkisi – 4MB olmalıdır.</span><br>
                                    <span>Şəkillərin formatı jpg, png və ya gif olmalıdır.</span><br>
                                    <span>Şəkillərin ölçüləri <?= projects_width ?>x768 piksel olmalıdır.</span><br>
                                </p>
                                <?=(isset($error))?Func::showError('sid', $error):''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label><?= Lang::get('{Tarix}') ?> *</label>
                                <input type="text" type="text" class="form-control datepicker" name="data_post_date" value="<?=isset($data->data_post_date)?$data->data_post_date:''?>">
                                <?=(isset($error))?Func::showError('data_post_date', $error):''?>
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
                                        $text = 'data_text_'.$key;
                                        ?>
                                        <div role="tabpanel" class="tab-pane<?=($x==1)?' active':''?>" id="tab_<?=$key?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?= Lang::get('{Başlıq}') ?> *</label>
                                                        <input class="form-control" name="data_title_<?=$key?>" value="<?=(isset($data->$title))?$data->$title:''?>">
                                                        <?=(isset($error))?Func::showError('data_title_'.$key, $error):''?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <label><?= Lang::get('{Mətn}') ?> *</label>
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
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    
</form>