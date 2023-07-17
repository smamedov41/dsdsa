<div class="row bg-title">
    <div class="col-md-12">
        <h4 class="page-title"><?= $this->title ?></h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <table width="100%" class="table table-hover table-nodefaultorder" id="dataTables" data-url="<?= URL . $this->menu ?>" data-token="<?=$token?>">
                    <thead>
                    <tr>
                        <th><?= Lang::get('{Bölmələr}') ?></th>
                        <th width="80"><?= Lang::get('{Post sayı}') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($this->listItems) && !empty($this->listItems)){
                        foreach ($this->listItems as $key => $value) {
                            ?>

                            <tr data-id="<?= $value['id'] ?>">
                                <td><strong><a href="<?=URL.$key?>"><?=Lang::get($key)?></a></strong></td>
                                <td class="text-center"><?=$value?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                Upload Folder Size: <?=$this->uploadFolderSize?>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<?php require __DIR__.'/../delete_modal.php'; ?>
