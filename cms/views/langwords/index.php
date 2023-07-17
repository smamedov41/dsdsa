<form action="<?= URL . $this->menu ?>/index" method="post">
    <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>
    <input type="hidden" name="admin_csrf_name" value="<?= $unique_form_name ?>">
    <input type="hidden" name="admin_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

    <div class="row bg-title">
        <div class="col-md-12">
            <h4 class="page-title"><?= $this->title ?>
                <div class="pull-right">
                    <a href="<?= URL . $this->menu ?>/add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> <?= Lang::get('{Yeni sözləri əlavə et}') ?></a>
                    <button type="submit" name="action" value="save" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> <span class="hidden-xs"><?= Lang::get('{Yadda saxla}') ?></span></button>
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

            // show error
            $alert = Session::get('note_error') ? Session::get('note_error') : NULL;
            if($alert){
                Func::headerAlert($alert);
                Session::delete('note_error');
            }

            // token for ordering, delete, change status
            $token = Func::token('token_'.$this->menu);
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table width="100%" class="table table-hover table-nodefaultorder" id="dataTables" data-url="<?= URL . $this->menu ?>" data-token="<?=$token?>">
                        <thead>
                            <tr>
                                <th width="40"><?= Lang::get('{ID}') ?></th>
                                <th width="45%"><?= Lang::get('{Açar söz}') ?></th>
                                <?php
                                foreach(MFAdmin::$_langs as $k=>$v){
                                    ?><th><?=$v?></th><?php
                                }
                                ?>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($this->listItems)){
                            foreach ($this->listItems as $key => $value) {
                                ?>

                                <tr data-id="<?= $value['id'] ?>">
                                    <td class="text-center"><?= $value['id'] ?></td>
                                    <td data-order="<?= $value['key'] ?>">
                                        <strong><?= $value['key'] ?></strong><br>
                                        <i><?= $value['file'] ?></i>
                                    </td>
                                    <?php
                                    foreach(MFAdmin::$_langs as $k=>$v){
                                        ?>

                                        <td data-search="<?=htmlspecialchars($value[$k])?>" data-order="<?= htmlspecialchars($value[$k]) ?>">
                                            <input type="text" name="<?=$k?>[<?=$value['id']?>]" value="<?=$value[$k]?>" size="6" autocomplete="off" class="form-control">
                                            <input type="hidden" name="id[]" value="<?=$value['id']?>">
                                        </td>
                                        <?php
                                    }
                                    ?>

                                </tr>
                                <?php
                            }
                        }
                        ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</form>