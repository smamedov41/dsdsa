<form action="" method="post">
    <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>
    <input type="hidden" name="admin_csrf_name" value="<?= $unique_form_name ?>">
    <input type="hidden" name="admin_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

    <div class="row bg-title">
        <div class="col-md-12">
            <h4 class="page-title"><?= $this->title ?>
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> <span class="hidden-xs"><?= Lang::get('{Yadda saxla}') ?></span></button>
                    <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-remove"></span> <span class="hidden-xs"><?= Lang::get('{Sıfırla}') ?></span></button>
                </div>
            </h4>
            <ol class="breadcrumb">
                <li><a href="<?=URL?>index"><?=Lang::get('{İdarəetmə paneli}')?></a></li>
                <li><a href="<?=URL. $this->menu?>"><?= Lang::get($this->menu) ?></a></li>
                <li class="active"><?= $this->titleSub ?></li>
            </ol>
        </div>
    </div>
    
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
                        <div class="col-md-12">
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
                                            <div class="form-group">
                                                <label><?= Lang::get('{Açar söz və ya ifadə}') ?> *</label>
                                                <input class="form-control" name="data_title_<?=$key?>" value="<?=(isset($data->$title))?$data->$title:''?>">
                                                <?=(isset($error))?Func::showError('data_title_'.$key, $error):''?>
                                            </div>
                                            <div class="form-group">
                                                <label><?= Lang::get('{Mətn}') ?> *</label>
                                                <textarea class="form-control" name="data_text_<?=$key?>"><?=(isset($data->$text))?$data->$text:''?></textarea>
                                                <?=(isset($error))?Func::showError('data_text_'.$key, $error):''?>
                                            </div>
                                        </div>
                                        <?php
                                        $x++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(Func::checkAdminActionButton($this->admin, $this->menu, 'edit')){
                        ?>
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
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</form>