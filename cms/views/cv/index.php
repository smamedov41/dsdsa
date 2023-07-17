<div class="row bg-title">
    <div class="col-lg-12">
        <h4 class="page-title"><?= Lang::get($this->menu) ?></h4>
        <ol class="breadcrumb">
            <li><a href="<?=URL?>index"><?=Lang::get('{İdarəetmə paneli}')?></a></li>
            <li><a href="<?=URL.$this->menu?>"><?= Lang::get($this->menu)?></a></li>
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
                            <th><?= Lang::get('{Ad Soyad}') ?></th>
                            <th><?= Lang::get('{Fayl}') ?></th>
                            <th width="100"><?= Lang::get('{Tarix}') ?></th>
                            <th width="80" class="no-sort"><?= Lang::get('{Əməliyyat}') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($this->listItems) && !empty($this->listItems)){
                        foreach ($this->listItems as $key => $value) {
                            $image = UPLOAD_DIR_LINK.'CV/'.$value['photo'];
                            $cv = UPLOAD_DIR_LINK.'CV/'.$value['cv_file'];
                            ?>

                            <tr data-id="<?= $value['id'] ?>">
                                <td class="text-center"><?= $value['id'] ?></td>
                                <td>
                                    <strong><?= $value['fio'] ?></strong><br>
                                    <strong><?=Lang::get('{Təvəllüd}')?></strong>: <?= $value['birthday'] ?><br>
                                    <strong><?=Lang::get('{Mobil telefon}')?></strong>: <?= $value['mob_phone'] ?><br>
                                    <strong><?=Lang::get('{E-poçt}')?></strong>: <?= $value['email'] ?>
                                </td>
                                <td class="text-center" width="100">
                                    <a class="btn btn-xs" href="<?= $image ?>" target="_blank"><span class="glyphicon glyphicon-picture"></span></a> |
                                    <a class="btn btn-xs" href="<?= $cv ?>" target="_blank"><span class="glyphicon glyphicon-paperclip"></span></a>
                                </td>
                                <td class="text-center"><?= $value['create_date'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if(Func::checkAdminActionButton($this->admin, $this->menu, 'delete')){
                                        ?><a class="btn btn-xs confirm-delete"><span class="glyphicon glyphicon-trash"></span></a> <?php
                                    }
                                    ?>
                                </td>
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

<?php require __DIR__.'/../delete_modal.php'; ?>