<form action="<?= URL . $this->menu?>/update/<?= isset($this->item['id'])?$this->item['id']:'0' ?>" method="post">
    <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>
    <input type="hidden" name="admin_csrf_name" value="<?= $unique_form_name ?>">
    <input type="hidden" name="admin_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

    <div class="row bg-title">
        <div class="col-md-12">
            <h4 class="page-title"><?= $this->title ?>
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

            // edit Error
            if(isset($this->postData->formError)){
                $error = $this->postData->formError;
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?= Lang::get('{Name}') ?> *</label>
                                <input type="text" class="form-control" name="data_name" value="<?=(isset($this->item['name']))?$this->item['name']:''?>" required>
                                <?=(isset($error))?Func::showError('data_name', $error):''?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?= Lang::get('{Login}') ?> *</label>
                                <input type="text" class="form-control" name="data_login" value="<?=(isset($this->item['login']))?$this->item['login']:''?>" required>
                                <?=(isset($error))?Func::showError('data_login', $error):''?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?= Lang::get('{Password}') ?></label>
                                <input type="password" class="form-control" name="data_password">
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
                                    $role = json_decode($this->item['role'], true);
                                    //                                print '<pre>';
                                    //                                print_r($role);
                                    //                                print '</pre>';
                                    if(!is_array($role)){
                                        $role = [];
                                    }

                                    foreach (MFAdmin::$_admin_role_action as $key => $value) {
                                        ?>
                                        <tr>
                                            <th class="text-left"><?= Lang::get($key) ?></th>
                                            <td>
                                                <?php
                                                foreach ($value as $k => $v) {
                                                    $checked = (isset($role[$key]) && in_array($v, $role[$key])) ? ' checked' : '';
                                                    ?>
                                                    <div class="admin_role_div pull-left">
                                                        <label class="admin_role_label" for="for_<?= $key ?>_<?= $v ?>"><?= Lang::get($v) ?></label>
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group radio">
                                <label><?= Lang::get('{Status}') ?> *</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="data_status" value="2" <?= ($this->item['status'] == 2) ? ' checked' : '' ?>><?= Lang::get('{Active}') ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="data_status" value="1" <?= ($this->item['status'] == 1) ? ' checked' : '' ?>><?= Lang::get('{Passive}') ?>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</form>