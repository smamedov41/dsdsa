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
                            <th width="200"><?= Lang::get('{Ad Soyad}') ?></th>
                            <th width="200"><?= Lang::get('{E-mail}') ?></th>
                            <th><?= Lang::get('{Text}') ?></th>
                            <th width="100"><?= Lang::get('{Tarix}') ?></th>
                            <th width="80" class="no-sort"><?= Lang::get('{Əməliyyat}') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($this->listItems) && !empty($this->listItems)){
                        foreach ($this->listItems as $key => $value) {
                            ?>

                            <tr data-id="<?= $value['id'] ?>">
                                <td class="text-center"><?= $value['id'] ?></td>
                                <td><strong><?= $value['name'] ?></strong></td>
                                <td class="text-left"><?= $value['email'] ?></td>
                                <td class="text-left"><?= $value['msg'] ?></td>
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