<div class="row bg-title">
    <div class="col-lg-12">
        <h4 class="page-title"><?= Lang::get($this->menu) ?>
            <?php
            if(Func::checkAdminActionButton($this->admin, $this->menu, 'add')){
                ?><div class="pull-right"><a href="<?= URL . $this->menu ?>/add" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> <?= Lang::get('{Yenisini yarat}') ?></a></div> <?php
            }
            ?>
        </h4>
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

                <table width="100%" class="table table-hover table-ordering" id="dataTables" data-url="<?= URL . $this->menu ?>" data-token="<?=$token?>">
                    <thead>
                        <tr>
                            <th><?= Lang::get('{Sıra}') ?></th>
                            <th width="40"><?= Lang::get('{ID}') ?></th>
                            <th><?= Lang::get('{Başlıq}') ?></th>
                            <th width="120"><?= Lang::get('{Admin}') ?></th>
                            <th width="100"><?= Lang::get('{Tarix}') ?></th>
                            <th width="80" class="no-sort"><?= Lang::get('{Əməliyyat}') ?></th>
                            <th width="80"><?= Lang::get('{Status}') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($this->listItems) && !empty($this->listItems)){
                        foreach ($this->listItems as $key => $value) {
                            ?>

                            <tr data-id="<?= $value['id'] ?>">
                                <td><?= $value['ordering'] ?></td>
                                <td class="text-center reorder"><?= $value['id'] ?></td>
                                <td><strong><?= $value['title'] ?></strong></td>
                                <td class="text-left"><?= $value['creater_name'] ?></td>
                                <td class="text-center"><?= $value['create_date'] ?></td>
                                <td class="text-center">
                                    <?php
                                    if(Func::checkAdminActionButton($this->admin, $this->menu, 'edit')){
                                        ?><a class="btn btn-xs" href="<?= URL . $this->menu ?>/edit/<?= $value['id'] ?>"><span class="glyphicon glyphicon-pencil"></span></a> <?php
                                    }
                                    if(Func::checkAdminActionButton($this->admin, $this->menu, 'delete')){
                                        ?><a class="btn btn-xs confirm-delete"><span class="glyphicon glyphicon-trash"></span></a> <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-center" data-sort="<?= ($value['status'] == 2) ? '2' : '1' ?>">
                                    <?php
                                    if(Func::checkAdminActionButton($this->admin, $this->menu, 'edit')){
                                        ?><input type="checkbox"<?= ($value['status'] == 2) ? ' checked' : ' deactive' ?> data-toggle="toggle" data-size="mini"> <?php
                                    } else {
                                        echo ($value['status'] == 2) ? Lang::get('{Aktiv}') : '<span class="color-red">'.Lang::get('{Passiv}').'</span>';
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