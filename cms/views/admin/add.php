<form action="" method="post">
    <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>
    <input type="hidden" name="admin_csrf_name" value="<?= $unique_form_name ?>">
    <input type="hidden" name="admin_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

    <div class="row bg-title">
        <div class="col-md-12">
            <h4 class="page-title"><?= $this->title?>
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> <span class="hidden-xs"><?= Lang::get('{Save}') ?></span></button>
                    <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-remove"></span> <span class="hidden-xs"><?= Lang::get('{Reset}') ?></span></button>
                </div>
            </h4>
            <ol class="breadcrumb pull-left">
                <li><a href="<?=URL?>dashboard"><?=Lang::get('{Dashboard}')?></a></li>
                <li><a href="<?=URL. $this->menu?>"><?= Lang::get($this->menu) ?></a></li>
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

            // show error
            if(isset($this->postData->headerError)){
                Func::headerAlert($this->postData->headerError);
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?= Lang::get('{Name}') ?> *</label>
                                <input type="text" class="form-control" name="data_name" value="<?=(isset($data->data_name))?$data->data_name:''?>" required>
                                <?=(isset($error))?Func::showError('data_name', $error):''?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?= Lang::get('{Login}') ?> *</label>
                                <input type="text" class="form-control" name="data_login" value="<?=(isset($data->data_login))?$data->data_login:''?>" required>
                                <?=(isset($error))?Func::showError('data_login', $error):''?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?= Lang::get('{Password}') ?> *</label>
                                <input type="password" class="form-control" name="data_password" required>
                                <?=(isset($error))?Func::showError('data_password', $error):''?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group admin-role">
                                <label><?= Lang::get('{İmtiyazlar}') ?> *</label><br>
                                <table class="table admin-table">
                                    <?php
                                    $role = isset($data->data_role) ? (array) $data->data_role : [];

                                    foreach (MFAdmin::$_admin_role_action as $key => $value) {
                                        ?>
                                        <tr>
                                            <th width="200" class="text-left"><?= Lang::get($key) ?></th>
                                            <td>
                                                <?php
                                                foreach ($value as $k => $v) {
                                                    $checked = (isset($role[$key]) && in_array($v, $role[$key])) ? ' checked' : '';
                                                    ?>
                                                    <div class="admin_role_div pull-left">
                                                        <label class="admin_role_label" for="for_<?= $key ?>_<?= $v ?>"><?= mb_strtoupper($v) ?></label>
                                                        <input id="for_<?= $key ?>_<?= $v ?>" type="checkbox" name="data_role[<?= $key ?>][]" value="<?= $v ?>" <?= $checked ?>>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?=(isset($error))?Func::showError('data_role', $error):''?>
                                </table>
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
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</form>